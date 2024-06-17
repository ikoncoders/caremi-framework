<?php declare(strict_types=1); // public/index.php

use Caremi\Http\Kernel;
use Caremi\Http\Request;


define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

$container = require BASE_PATH . '/config/services.php';

// request received
$request = Request::createFromGlobals();

// perform some logic
$kernel = $container->get(Kernel::class);

// send response (string of content)
$response = $kernel->handle($request);

$response->send();