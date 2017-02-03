<?php

namespace App\Helpers;

use App\Service\ServiceProvider;
use League\Container\ReflectionContainer;

class Container {
    private $container;

    public function __construct() {
        $this->container = new \League\Container\Container();
        $this->container->delegate(new ReflectionContainer());
        $this->container->add("configFile", __DIR__ . "/../Config/config.php");
        $this->container->addServiceProvider(ServiceProvider::class);
    }

    public function getContainer() {
        return $this->container;
    }

}