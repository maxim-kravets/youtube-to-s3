<?php

namespace YoutubeToS3;

use DI\Container;
use DI\ContainerBuilder;
use Symfony\Component\Dotenv\Dotenv;

class Kernel
{
    private $container;

    public function __construct()
    {
        $this->initContainer();
        $this->initDotenv();
    }

    private function initDotenv()
    {
        $dotenv = new Dotenv();
        $dotenv->loadEnv(dirname(__DIR__).'/.env');
    }

    private function initContainer()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(dirname(__DIR__).'/config/container.php');
        $this->container = $builder->build();
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    public static function getDownloadsDir(): string
    {
        return dirname(__DIR__).'/downloads/';
    }
}
