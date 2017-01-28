<?php

namespace App\Log;

use Illuminate\Support\Facades\Auth;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;



class Log
{
    public function write()
    {
        $log = new Logger('adminlog');
        $log->pushHandler(new StreamHandler(storage_path().'/logs/admins_action.log', Logger::INFO));
        $admin = Auth::user();
        $log->addInfo('Администратор: '. $admin->login);

    }
}