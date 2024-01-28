<?php

namespace controllers;

use core\helpers\Log;
use Exception;
use exceptions\SystemError;
use exceptions\UserError;
use services\JobService;

class CronController
{
    public static function run(): void
    {
        try {
            JobService::runCurrentTimeJobs();
        } catch (SystemError $e) {
            echo "System error";
            Log::error($e->getMessage());
        } catch (UserError $e) {
            echo "User error";
            Log::error($e->getMessage());
        } catch (Exception $e) {
            echo "Unknown error";
            Log::error($e->getMessage());
        }
    }
}