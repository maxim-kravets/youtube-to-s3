<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->loadEnv(dirname(__DIR__).'/.env');
