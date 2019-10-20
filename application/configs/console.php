<?php

declare(strict_types = 1);

use Core\application\console\Application;
use Core\migration\commands\MigrateController;
use Core\migration\components\Migration;
use Core\migration\factories\Factory;
use Core\request\components\console\Request;
use Core\route\components\Route;

return [
    'class'     => Application::class,
    'request'   => [
        'class' => Request::class,
    ],
    'route'     => [
        'class'         => Route::class,
        'controllerMap' => [
            'migrate' => MigrateController::class,
        ],
    ],
    'migration' => [
        'class'         => Migration::class,
        'factory'       => [
            'class'  => Factory::class,
            'config' => [],
        ],
        'migrationPath' => dirname(__FILE__, 2) . '/migrations',
    ],
];