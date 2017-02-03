<?php
namespace PHPSTORM_META {
    $STATIC_METHOD_TYPES = [
        \Interop\Container\ContainerInterface::get('') => [
            "log" instanceof \Monolog\Logger,
            "mongo" instanceof \MongoDB\Client,
            "config" instanceof \App\Helpers\Config,
            "curl" instanceof \App\Helpers\cURL,
            "cache" instanceof \App\Helpers\Cache,
            "startTime",
        ]
    ];
}