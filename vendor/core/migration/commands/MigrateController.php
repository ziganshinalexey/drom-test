<?php

declare(strict_types = 1);

namespace Core\migration\commands;

use Core\controller\Controller;

/**
 * Класс MigrateController реализует методы обработки миграций.
 */
class MigrateController extends Controller
{
    /**
     * Метод реализует действие применения миграций.
     *
     * @return void
     */
    public function actionUp(): void
    {
        var_dump('actionUp');
        die;
    }
}
