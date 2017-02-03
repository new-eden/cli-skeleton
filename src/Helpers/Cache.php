<?php

namespace App\Helpers;

use Predis\Client;

class Cache {
    private $redis;

    public function __construct() {
        $this->redis = new Client();
    }

    /**
     * Return data from the Cache
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key) {
        return json_decode($this->redis->get($key), true);
    }

    /**
     * Insert data tot he cache
     *
     * @param string $key
     * @param $data
     * @param int $timeout
     *
     * @return bool
     */
    public function set(string $key, $data, $timeout = 3600): bool {
        if(!empty($this->redis->get($key)))
            $this->redis->del(array($key));

        return $this->redis->setex($key, $timeout, json_encode($data));
    }
}