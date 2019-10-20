<?php

declare(strict_types = 1);

use Core\migration\commands\MigrateController;
use Core\migration\components\Migration;
use Core\request\components\console\Request;
use Core\route\components\Route;

return [
    'componentList' => [
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
            'migrationPath' => dirname(__FILE__, 2) . '/migrations',
        ],
    ],
];