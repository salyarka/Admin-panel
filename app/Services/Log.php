<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;



class Log
{
    public function write($message)
    {
        $log = new Logger('adminlog');
        $handler = new RotatingFileHandler(storage_path().'/logs/admins_action.log', Logger::INFO);
        $handler->setFormatter(new LineFormatter(null, null, false, true));
        $log->pushHandler($handler);
        $admin = Auth::user();
        $log->addInfo($admin->login . ' ' . $message);
    }
}