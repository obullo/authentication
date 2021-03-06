<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

chdir(dirname(__DIR__));

require_once "vendor/autoload.php";

session_name("sessions");
session_set_cookie_params(
    0,
    '/',
    '',
    false,
    true
);
register_shutdown_function('session_write_close');
session_start();

$container = new League\Container\Container;

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals();
$container->share('request', $request);

$container->addServiceProvider('ServiceProvider\Redis');
$container->addServiceProvider('ServiceProvider\Memcached');
$container->addServiceProvider('ServiceProvider\Doctrine');
// $container->addServiceProvider('ServiceProvider\Mongo');
$container->addServiceProvider('ServiceProvider\Authentication');
