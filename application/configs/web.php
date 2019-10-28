<?php

declare(strict_types = 1);

use App\components\TodoComponent;
use App\controllers\TodoController;
use App\factories\TodoFactory;
use App\forms\todo\CreateOneForm as TodoCreateOneForm;
use App\forms\todo\FindManyForm as TodoFindManyForm;
use App\forms\todo\RemoveOneForm as TodoRemoveOneForm;
use App\forms\todo\UpdateOneForm as TodoUpdateOneForm;
use App\queries\TodoQuery;
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
    'class'         => Application::class,
    'componentList' => [
        Request::COMPONENT_NAME       => [
            'class'            => Request::class,
            'defaultRouteName' => 'todo/index',
            'parserList'       => [
                'application/json' => ['class' => JsonParser::class],
            ],
        ],
        Route::COMPONENT_NAME         => [
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
        DataBase::COMPONENT_NAME      => [
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
        Response::COMPONENT_NAME      => ['class' => Response::class],
        TodoComponent::COMPONENT_NAME => [
            'class'   => TodoComponent::class,
            'factory' => [
                'class'  => TodoFactory::class,
                'config' => [
                    TodoFactory::FIND_FORM   => [
                        'class'  => TodoCreateOneForm::class,
                        'result' => ['class' => DataResult::class],
                        'query'  => [
                            'class'     => TodoQuery::class,
                            'tableName' => 'todo',
                        ],
                    ],
                    TodoFactory::CREATE_FORM => [
                        'class'  => TodoFindManyForm::class,
                        'result' => ['class' => DataResult::class],
                        'query'  => [
                            'class'     => TodoQuery::class,
                            'tableName' => 'todo',
                        ],
                    ],
                    TodoFactory::UPDATE_FORM => [
                        'class'  => TodoRemoveOneForm::class,
                        'result' => ['class' => DataResult::class],
                        'query'  => [
                            'class'     => TodoQuery::class,
                            'tableName' => 'todo',
                        ],
                    ],
                    TodoFactory::REMOVE_FORM => [
                        'class'  => TodoUpdateOneForm::class,
                        'result' => ['class' => DataResult::class],
                        'query'  => [
                            'class'     => TodoQuery::class,
                            'tableName' => 'todo',
                        ],
                    ],
                ],
            ],
        ],
    ],
];