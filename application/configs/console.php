<?php

declare(strict_types = 1);

use Core\application\console\Application;
use Core\migration\commands\MigrateController;
use Core\migration\components\Migration;
use Core\migration\factories\Factory as MigrationFactory;
use Core\migration\operations\DownOperation;
use Core\migration\operations\UpOperation;
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
            'class'  => MigrationFactory::class,
            'config' => [
                MigrationFactory::DOWN_OPERATION => ['class' => DownOperation::class],
                MigrationFactory::UP_OPERATION   => ['class' => UpOperation::class],
            ],
        ],
        'migrationPath' => dirname(__FILE__, 2) . '/migrations',
    ],
];