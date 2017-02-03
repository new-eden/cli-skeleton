<?php

namespace App\Helpers;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Log {
    public $log;

    public function __construct() {
        $this->log = new Logger("App");
        $this->log->pushHandler(new StreamHandler(__DIR__ . "/../../logs/app.log", Logger::INFO));
    }

    public function addInfo(string $msg, array $context = array()) {
        $this->log->info($msg, $context);
    }

    public function addWarning(string $msg, array $context = array()) {
        $this->log->warning($msg, $context);
    }

    public function addError(string $msg, array $context = array()) {
        $this->log->error($msg, $context);
    }

}