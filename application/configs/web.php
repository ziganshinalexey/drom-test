<?php

declare(strict_types = 1);

use App\controllers\TodoController;
use Core\application\components\web\Application;
use Core\db\components\DataBase;
use Core\db\factories\Factory as DBFactory;
use Core\db\mysql\Connection;
use Core\request\components\web\Request;
use Core\request\parsers\JsonParser;
use Core\response\components\Response;
use Core\result\DataResult;
use Core\route\components\Route;

$appDirectory = dirname(__FILE__, 2);

return [
    'class'    => Application::class,
    'request'  => [
        'class'            => Request::class,
        'defaultRouteName' => 'todo/index',
        'parserList'       => [
            'application/json' => ['class' => JsonParser::class],
        ],
    ],
    'route'    => [
        'class'         => Route::class,
        'controllerMap' => [
            'todo' => [
                'class'   => TodoController::class,
                'viewMap' => [
                    'index' => $appDirectory . '/views/site/index.php',
                ],
            ],
        ],
    ],
    'db'       => [
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
    'response' => ['class' => Response::class],
];