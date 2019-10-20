<?php

declare(strict_types = 1);

use Core\request\components\console\Request;
use Core\route\components\Route;

return [
    'componentList' => [
        'request' => [
            'class' => Request::class,
        ],
        'route'   => [
            'class'         => Route::class,
            'controllerMap' => [
                'migrate' => 'testtest',
            ],
        ],
    ],
];