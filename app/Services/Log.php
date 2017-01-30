<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;

class Log
{
    /**
     * Write admins actions in log file.
     * 
     * @param  string $message what admin do
     * @return void
     */
    public function write($message)
    {
        $log = new Logger('adminlog');
        $handler = new RotatingFileHandler(
            storage_path().'/logs/admins_action.log', Logger::INFO
        );
        $handler->setFormatter(new LineFormatter(
            null, null, false, true
        ));
        $log->pushHandler($handler);
        $admin = Auth::user();
        $log->addInfo($admin->login . ' ' . $message);
    }
}