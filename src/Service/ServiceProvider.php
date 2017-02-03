<?php
namespace App\Service;

use App\Helpers\Cache;
use League\Container\ServiceProvider\AbstractServiceProvider;
use MongoDB\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use App\Helpers\Config;
use App\Helpers\cURL;

class ServiceProvider extends AbstractServiceProvider {
    protected $provides = array(
        "log",
        "mongo",
        "config",
        "curl",
        "cache",
        "startTime"
    );
    public function register() {
        $container = $this->getContainer();

        // When the library started
        $container->share("startTime", time());

        // The configuration file
        $config = new Config(__DIR__ . "/../Config/config.php");
        $container->share("config", $config);

        // Monolog logger.. Outputs directly to stdout, but can be changed to log to a file.
        $container->share("log", "Monolog\\Logger")->withArgument("Nazara");
        $container->get("log")->pushHandler(new StreamHandler("php://stdout", Logger::INFO));

        // Sets up the mongo connection to the localhost version of Mongo, can be changed..
        $mongo = new Client("mongodb://localhost:27017", array(), array("typeMap" => array("root" => "array", "document" => "array", "array" => "array")));
        $container->share("mongo", $mongo);

        // cURL send/get
        $container->share("curl", cURL::class);

        // Connects to a local redis cache using Predis.
        $container->share("cache", Cache::class);
    }
}