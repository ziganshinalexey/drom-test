<?php

declare(strict_types = 1);

use Core\application\components\console\Application;
use Core\db\components\DataBase;
use Core\db\factories\Factory as DBFactory;
use Core\db\mysql\Connection;
use Core\migration\commands\MigrateController;
use Core\migration\components\Migration;
use Core\migration\factories\Factory as MigrationFactory;
use Core\migration\operations\DownOperation;
use Core\migration\operations\UpOperation;
use Core\request\components\console\Request;
use Core\result\DataResult;
use Core\route\components\Route;

return [
    'class'     => Application::class,
    'request'   => [
        'class' => Request::class,
    ],
    'route'     => [
        'class'         => Route::class,
        'controllerMap' => [
            'migrate' => ['class' => MigrateController::class],
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
    'db'        => [
        'class'   => DataBase::class,
        'factory' => [
            'class'  => DBFactory::class,
            'config' => [
                DBFactory::CONNECTION => [
                    'class'    => Connection::class,
                    'host'     => 'db',
                    'username' => 'root',
                    'passwd'   => '123',
                    'dbname'   => 'todo',
                ],
                DBFactory::RESULT     => ['class' => DataResult::class],
            ],
        ],
    ],
];