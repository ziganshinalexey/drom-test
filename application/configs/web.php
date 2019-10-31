<?php

declare(strict_types = 1);

use App\components\TodoComponent;
use App\controllers\TodoController;
use App\factories\TodoFactory;
use App\forms\todo\CreateOneForm as TodoCreateOneForm;
use App\forms\todo\FindManyForm as TodoFindManyForm;
use App\forms\todo\RemoveManyForm as TodoRemoveManyForm;
use App\forms\todo\RemoveOneForm as TodoRemoveOneForm;
use App\forms\todo\UpdateManyForm as TodoUpdateManyForm;
use App\forms\todo\UpdateOneForm as TodoUpdateOneForm;
use Core\application\components\web\Application;
use Core\db\components\DataBase;
use Core\db\factories\Factory as DBFactory;
use Core\db\mysql\Connection;
use Core\query\Query;
use Core\request\components\web\Request;
use Core\request\parsers\JsonParser;
use Core\response\components\Response;
use Core\result\DataResult;
use Core\route\components\Route;
use Core\user\components\UserComponent;
use Core\user\controllers\UserController;
use Core\user\factories\UserFactory;
use Core\user\forms\CreateOneForm as UserCreateOneForm;
use Core\user\forms\FindOneForm as UserFindOneForm;
use Core\user\forms\LoginForm as UserLoginForm;

$appDirectory    = dirname(__FILE__, 2);
$vendorDirectory = dirname(__FILE__, 3) . '/vendor';

return [
    'class'         => Application::class,
    'componentList' => [
        Request::COMPONENT_NAME       => [
            'class'            => Request::class,
            'defaultRouteName' => 'user/login',
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
                'user' => [
                    'class'   => UserController::class,
                    'viewMap' => [
                        'login'    => $vendorDirectory . '/core/user/views/user/login.php',
                        'register' => $vendorDirectory . '/core/user/views/user/register.php',
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
                    TodoFactory::FIND_MANY_FORM   => [
                        'class'  => TodoFindManyForm::class,
                        'result' => ['class' => DataResult::class],
                        'query'  => [
                            'class'     => Query::class,
                            'tableName' => 'todo',
                        ],
                    ],
                    TodoFactory::CREATE_ONE_FORM  => [
                        'class'  => TodoCreateOneForm::class,
                        'result' => ['class' => DataResult::class],
                        'query'  => [
                            'class'     => Query::class,
                            'tableName' => 'todo',
                        ],
                    ],
                    TodoFactory::UPDATE_ONE_FORM  => [
                        'class'  => TodoUpdateOneForm::class,
                        'result' => ['class' => DataResult::class],
                        'query'  => [
                            'class'     => Query::class,
                            'tableName' => 'todo',
                        ],
                    ],
                    TodoFactory::REMOVE_ONE_FORM  => [
                        'class'  => TodoRemoveOneForm::class,
                        'result' => ['class' => DataResult::class],
                        'query'  => [
                            'class'     => Query::class,
                            'tableName' => 'todo',
                        ],
                    ],
                    TodoFactory::UPDATE_MANY_FORM => [
                        'class'  => TodoUpdateManyForm::class,
                        'result' => ['class' => DataResult::class],
                        'query'  => [
                            'class'     => Query::class,
                            'tableName' => 'todo',
                        ],
                    ],
                    TodoFactory::REMOVE_MANY_FORM => [
                        'class'  => TodoRemoveManyForm::class,
                        'result' => ['class' => DataResult::class],
                        'query'  => [
                            'class'     => Query::class,
                            'tableName' => 'todo',
                        ],
                    ],
                ],
            ],
        ],
        UserComponent::COMPONENT_NAME => [
            'class'   => UserComponent::class,
            'factory' => [
                'class'  => UserFactory::class,
                'config' => [
                    UserFactory::LOGIN_FORM      => [
                        'class'  => UserLoginForm::class,
                        'result' => ['class' => DataResult::class],
                        'query'  => [
                            'class'     => Query::class,
                            'tableName' => 'user',
                        ],
                    ],
                    UserFactory::CREATE_ONE_FORM => [
                        'class'  => UserCreateOneForm::class,
                        'result' => ['class' => DataResult::class],
                        'query'  => [
                            'class'     => Query::class,
                            'tableName' => 'user',
                        ],
                    ],
                    UserFactory::FIND_ONE_FORM   => [
                        'class'  => UserFindOneForm::class,
                        'result' => ['class' => DataResult::class],
                        'query'  => [
                            'class'     => Query::class,
                            'tableName' => 'user',
                        ],
                    ],
                ],
            ],
        ],
    ],
];