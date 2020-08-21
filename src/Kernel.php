<?php

namespace YoutubeToS3;

use DI\Container;
use DI\ContainerBuilder;

class Kernel
{
    private $container;

    public function __construct()
    {
        $this->initContainer();
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
}