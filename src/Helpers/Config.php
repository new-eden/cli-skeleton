<?php

namespace App\Helpers;

class Config {
    private $config;

    public function __construct($configFile) {
        $this->loadConfig($configFile);
    }

    public function loadConfig($configFile) {
        if (!file_exists(realpath($configFile))) {
            return;
        }
        $this->config = array_change_key_case(include($configFile), \CASE_LOWER);
    }

    public function get(string $key, string $type = null, string $default = null): string {
        $type = strtolower($type);
        if (!empty($this->config[$type][$key])) {
            return (string) $this->config[$type][$key];
        }
        return (string) $default;
    }

    public function getAll(string $type = null): array {
        $type = strtolower($type);
        if (!empty($this->config[$type])) {
            return $this->config[$type];
        }
        return array();
    }
}