<?php
namespace App\Core;

use App\Model\CronJobModel;

class CronJob
{
    private $cronModel;
    private $jobs = [];
    private $commissionLog = [];
    private $commission = [];
    private $commissionMap = [
        2 => [
            1 => 100,
            2 => 25,
            3 => 10,
            4 => 10,
            5 => 10
        ],

        3 => [
            1 => 200,
            2 => 100,
            3 => 50,
            4 => 50,
            5 => 50,
        ],

        4 => [
            1 => 500,
            2 => 500,
            3 => 100,
            4 => 100,
            5 => 100,
        ]
    ];

    public function __construct(CronJobModel $cronModel)
    {
        $this->cronModel = $cronModel;
    }

    public function start()
    {
        $this->init();
        echo 'Total jobs: ' . count($this->jobs) . PHP_EOL;
        foreach ($this->jobs as &$job) {
            $this->commission = [];
            $this->commissionLog = [];
            $this->runJob($job);
        }
        echo 'All jobs completed.' . PHP_EOL;
    }

    private function init()
    {
        $this->jobs = $this->cronModel->findJobs()->all();
    }

    private function runJob($job) {
        $this->cronModel->begin();
        $history = [];
        for ($level = 1, $userId = $job->issuer_id; $level <= 5; $level++) {
            //echo ('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>') . PHP_EOL;
            if (!$userId) {
                break;
            }

            $currentUserNode = $this->cronModel->getUser($userId);
            //echo 'Jobs :' . PHP_EOL;
            //print_r($this->jobs);

            foreach($this->jobs as $key => $job) {
                if ($job->issuer_id === $currentUserNode->id) {
                    $this->cronModel->jobComplete($job->id);
                    unset($this->jobs[$key]);
                }
            }

            //echo ("User : {$currentUserNode->id}") . PHP_EOL;
            //echo ("Parent : {$currentUserNode->parent_id}") . PHP_EOL;
            $promotionStep = $this->hasPromotion($currentUserNode);

            //echo ("Promotion Step : {$promotionStep}") . PHP_EOL;
            //echo ('Comission Tree : ') . PHP_EOL;
            //print_r($this->commission);
            $commission = array_shift($this->commission);
            $commissionLog = array_shift($this->commissionLog);

            //echo ("Commission : $commission") . PHP_EOL;

            if (isset($commissionLog) && is_array($commissionLog)) {
                foreach ($commissionLog as  $log) {
                    $temp = [
                        'commission_type'   => 'Promote',
                        'receiver_id'       => $currentUserNode->id,
                        'amount'            => $log['commission']
                    ];

                    if ($log['level'] === 1) {
                        $temp['description'] = "You got promoted to step {$log['promotion_step']}";
                    } else {
                        $temp['description'] = "{$log['source_name']} on level {$log['level']} got promoted to step {$log['promotion_step']}";
                    }

                    $history[] = $temp;
                }
            }

            if (!$currentUserNode->is_active) {
                //echo ('User is not active') . PHP_EOL;
                $userId = $currentUserNode->parent_id;
                continue;
            }

            if (!$promotionStep) {
                if ($commission) {
                    $this->cronModel->addCommission($currentUserNode->id, $commission);
                }
                $userId = $currentUserNode->parent_id;
                continue;
            }

            $this->cronModel->promote(
                $currentUserNode->id, $promotionStep, $commission);

            $userId = $currentUserNode->parent_id;
            $level = 1;
        }

        print_r($history);
        $this->cronModel->populateCommissionHistory($history);
        $this->cronModel->end();
    }

    private function hasPromotion($user)
    {
        if (!$user->is_active) {
            return false;
        }

        $childrenCount = $this->cronModel->referralTree($user->id)->all();

        if (!$childrenCount) {
            return false;
        }

        $totalChildren = 0;
        $childrenStep = 0;
        foreach ($childrenCount as $childCount) {
            $totalChildren += $childCount->children;
            if (!$childrenStep || $childCount->step < $childrenStep) {
                $childrenStep = $childCount->step;
            }
        }
        //echo ("Total Active Children : $totalChildren") . PHP_EOL;
        //echo ("Children Step: $childrenStep") . PHP_EOL;

        if ($totalChildren !== 30 || $user->step > $childrenStep || 4 <= $user->step) {
            return false;
        }

        if (4 > $childrenStep) {
            $promotionStep = $childrenStep + 1;
        } else {
            $promotionStep = $childrenStep;
        }

        $this->commission = array_map(
            [$this, 'aggregateCommission'], $this->commission, $this->commissionMap[$promotionStep]);

        $curCommissionLog = [];
        foreach ($this->commissionMap[$promotionStep] as $level => $commission) {
            $curCommissionLog[] = [
                'level'             => $level,
                'commission'        => $commission,
                'source_name'       => "{$user->first_name} {$user->last_name}",
                'promotion_step'    => $promotionStep
            ];
        }

        $this->commissionLog = array_map([$this, 'aggregateCommissionLog'], $this->commissionLog, $curCommissionLog);

        return $promotionStep;
    }

    private function aggregateCommission($prev, $new)
    {
        return $prev + $new;
    }

    private function aggregateCommissionLog($prev, $new)
    {
        $prev[] = $new;
        return $prev;
    }
}