<?php

namespace controllers;

use core\exceptions\SystemError;
use core\exceptions\UserError;
use core\helpers\Log;
use Exception;
use services\JobService;

class CronController
{
    public static function run(): ?string
    {
        try {
            return JobService::runCurrentTimeJobs() . " jobs run successfully!";
        } catch (SystemError $e) {
            echo "System error";
            Log::error($e->getMessage());
        } catch (UserError $e) {
            echo $e->getMessage();
        } catch (Exception $e) {
            echo "Unknown error";
            Log::error($e->getMessage());
        }
        return null;
    }
}