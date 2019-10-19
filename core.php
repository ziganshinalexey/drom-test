<?php

use Core\application\console\Application;
use Core\Core;

require_once __DIR__ . '/vendor/autoload.php';

$config      = require_once __DIR__ . '/application/configs/console.php';
$application = new Application($config);

// @todo: реализовать DI.
require_once __DIR__ . '/vendor/core/Core.php';
Core::setApplication($application);

$application->run();
