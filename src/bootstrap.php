<?php

use DI\ContainerBuilder;
use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->loadEnv(dirname(__DIR__).'/.env');

$builder = new ContainerBuilder();
$builder->addDefinitions(dirname(__DIR__).'/config/container.php');
$container = $builder->build();
