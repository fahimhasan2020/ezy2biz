<?php
namespace App\Core;

use App\Model\CronJobModel;

class CronJob
{
    private $cronJobModel;
    private $regJobs = [];
    private $promoteJobs = [];

    public function __construct(CronJobModel $cronJobModel)
    {
        $this->cronJobModel = $cronJobModel;
    }

    private function init()
    {
        $datetime = date('Y-m-d H:i:s', time());
        $jobs = $this->cronJobModel->searchJob($datetime)->all();
        $this->permute($jobs);
    }

    public function start()
    {
        $this->init();

        foreach ($this->regJobs as $job) {
            $this->runRegJob($job);
        }
        foreach ($this->promoteJobs as $job) {
            $this->runPromoteJob($job);
        }
    }

    private function permute(Array $jobs)
    {
        foreach ($jobs as $job) {
            if ($job->job_type === 'reg') {
                $this->regJobs[] = $job;
            }
            if ($job->job_type === 'promote') {
                $this->promoteJobs[] = $job;
            }
        }
    }

    private function runRegJob($job)
    {
        $this->cronJobModel->begin();
        $issuer = $this->cronJobModel->getUser($job->issuer_id);

        $parentLvl2 = $this->cronJobModel->getUser($issuer->parent_id);
        if (isset($parentLvl2)) {
            $this->cronJobModel->addToTree($parentLvl2->id, $issuer->id, 2);

            if ($parentLvl2->is_active) {
                if ($issuer->referrer_id === $parentLvl2->id) {
                    $this->cronJobModel->addPoints($parentLvl2->id, 1.5);
                } else {
                    $this->cronJobModel->addPoints($parentLvl2->id, 1);
                }

                if ($this->checkPromotion($parentLvl2->id)) {
                    $this->cronJobModel->schedulePromoteJob($parentLvl2->id);
                }
            }

            $parentLvl3 = $this->cronJobModel->getUser($parentLvl2->parent_id);
        }

        if (isset($parentLvl3)) {
            $this->cronJobModel->addToTree($parentLvl3->id, $issuer->id, 3);

            if ($parentLvl3->is_active) {
                if ($issuer->referrer_id === $parentLvl3->id) {
                    $this->cronJobModel->addPoints($parentLvl3->id, 1.5);
                } else {
                    $this->cronJobModel->addPoints($parentLvl3->id, 1);
                }

                if ($this->checkPromotion($parentLvl3->id)) {
                    $this->cronJobModel->schedulePromoteJob($parentLvl3->id);
                }
            }

            $parentLvl4 = $this->cronJobModel->getUser($parentLvl3->parent_id);
        }


        if (isset($parentLvl4)) {
            $this->cronJobModel->addToTree($parentLvl4->id, $issuer->id, 4);

            if ($parentLvl4->is_active) {
                if ($issuer->referrer_id === $parentLvl4->id) {
                    $this->cronJobModel->addPoints($parentLvl4->id, 1.5);
                } else {
                    $this->cronJobModel->addPoints($parentLvl4->id, 1);
                }

                if ($this->checkPromotion($parentLvl4->id)) {
                    $this->cronJobModel->schedulePromoteJob($parentLvl4->id);
                }
            }

            $parentLvl5 = $this->cronJobModel->getUser($parentLvl4->parent_id);
        }


        if (isset($parentLvl5)) {
            $this->cronJobModel->addToTree($parentLvl5->id, $issuer->id, 5);

            if ($parentLvl5->is_active) {
                if ($issuer->referrer_id === $parentLvl5->id) {
                    $this->cronJobModel->addPoints($parentLvl5->id, 1.5);
                } else {
                    $this->cronJobModel->addPoints($parentLvl5->id, 1);
                }

                if ($this->checkPromotion($parentLvl5->id)) {
                    $this->cronJobModel->schedulePromoteJob($parentLvl5->id);
                }
            }
        }

        $this->cronJobModel->jobSucceed($job->id);
        $this->cronJobModel->finish();
    }

    private function checkPromotion($userId)
    {
        $count = $this->cronJobModel->totalChildUsers($userId);
        if ($count === 30) {
            return true;
        }
        return false;
    }

    private function checkStep3Promotion($userId)
    {
        $count = $this->cronJobModel->totalStep2ChildUsers($userId);
        if ($count === 30) {
            return true;
        }

        return false;
    }

    private function runPromoteJob($job)
    {
        $this->cronJobModel->begin();

        $issuer = $this->cronJobModel->getUser($job->issuer_id);

        if ($this->checkPromotion($issuer->id)) {
            $this->cronJobModel->promote($issuer->id, 2);
        }
        $parentLvl2 = $this->cronJobModel->getUser($issuer->parent_id);

        if (isset($parentLvl2)) {
            if ($this->checkStep3Promotion($parentLvl2->id)) {
                $this->cronJobModel->promote($parentLvl2->id, 3);
            }

            $parentLvl3 = $this->cronJobModel->getUser($parentLvl2->parent_id);
        }

        if (isset($parentLvl3)) {
            if ($this->checkStep3Promotion($parentLvl3->id)) {
                $this->cronJobModel->promote($parentLvl3->id, 3);
            }

            $parentLvl4 = $this->cronJobModel->getUser($parentLvl3->parent_id);
        }

        if (isset($parentLvl4)) {
            if ($this->checkStep3Promotion($parentLvl4->id)) {
                $this->cronJobModel->promote($parentLvl4->id, 3);
            }

            $parentLvl5 = $this->cronJobModel->getUser($parentLvl4->parent_id);
        }

        if (isset($parentLvl5)) {
            if ($this->checkStep3Promotion($parentLvl5->id)) {
                $this->cronJobModel->promote($parentLvl5->id, 3);
            }
        }

        $this->cronJobModel->finish();
    }
}