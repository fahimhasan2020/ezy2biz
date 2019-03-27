<?php
namespace App\Core;

use App\Model\CronJobModel;

class CronJob
{
    private $cronModel;
    private $jobs = [];
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
            5 => 50
        ],

        4 => [
            1 => 500,
            2 => 500,
            3 => 100,
            4 => 100,
            5 => 100
        ]
    ];

    public function __construct(CronJobModel $cronModel)
    {
        $this->cronModel = $cronModel;
    }

    public function start()
    {
        $this->init();
        foreach ($this->jobs as &$job) {
            $this->commission = [];
            $this->runJob($job);
        }
    }

    private function init()
    {
        $this->jobs = $this->cronModel->findJobs()->all();
    }

    private function runJob($job) {
        $this->cronModel->begin();

        for ($level = 1, $userId = $job->issuer_id; $level <= 5; $level++) {
            echo ('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>') . PHP_EOL;
            if (!$userId) {
                break;
            }

            $currentUserNode = $this->cronModel->getUser($userId);
            echo 'Jobs :' . PHP_EOL;
            print_r($this->jobs);

            foreach($this->jobs as $key => $job) {
                if ($job->issuer_id === $currentUserNode->id) {
                    $this->cronModel->jobComplete($job->id);
                    unset($this->jobs[$key]);
                }
            }

            echo ("User : {$currentUserNode->id}") . PHP_EOL;
            echo ("Parent : {$currentUserNode->parent_id}") . PHP_EOL;
            $promotionStep = $this->hasPromotion($currentUserNode);
            echo ("Promotion Step : {$promotionStep}") . PHP_EOL;
            echo ('Comission Tree : ') . PHP_EOL;
            print_r($this->commission);
            $commission = array_shift($this->commission);
            echo ("Commission : $commission") . PHP_EOL;
            if (!$currentUserNode->is_active) {
                echo ('User is not active') . PHP_EOL;
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

        $this->cronModel->end();
    }

    private function hasPromotion($user)
    {
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
        echo ("Total Children : $totalChildren") . PHP_EOL;
        echo ("Children Step: $childrenStep") . PHP_EOL;

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

        return $promotionStep;
    }

    private function aggregateCommission($prev, $new)
    {
        return $prev + $new;
    }
}