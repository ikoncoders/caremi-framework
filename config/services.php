<?php // config/services.php

use Caremi\Http\Kernel;
use Caremi\Routing\Router;
use Caremi\Routing\RouterInterface;

$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load(dirname(__DIR__) . '/.env');

// dd($_SERVER['APP_ENV']);

$container = new \League\Container\Container();

$container->delegate(new \League\Container\ReflectionContainer(true));

# parameters for application config
$routes = include BASE_PATH . '/routes/web.php';

 #add env to container
 $appEnv = 'prod';
 $container->add('APP_ENV', new \League\Container\Argument\Literal\StringArgument($appEnv));

 
# services

$container->add(RouterInterface::class,Router::class);  // ask for RouterInterface to get a Router

//extend 
$container->extend(RouterInterface::class)
    ->addMethodCall('setRoutes', [new \League\Container\Argument\Literal\ArrayArgument($routes)]);

$container->add(Kernel::class)
          ->addArgument(RouterInterface::class)
          ->addArgument($container); // adding the Kernel to the container

return $container;