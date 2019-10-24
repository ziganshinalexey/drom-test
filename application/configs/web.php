<?php

declare(strict_types = 1);

use Core\application\components\web\Application;
use Core\db\components\DataBase;
use Core\db\factories\Factory as DBFactory;
use Core\db\mysql\Connection;
use Core\migration\commands\MigrateController;
use Core\request\components\web\Request;
use Core\result\DataResult;
use Core\route\components\Route;

return [
    'class'   => Application::class,
    'request' => [
        'class' => Request::class,
    ],
    'route'   => [
        'class'         => Route::class,
        'defaultRoute'  => 'site/index',
        'controllerMap' => [
            'migrate' => MigrateController::class,
        ],
    ],
    'db'      => [
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