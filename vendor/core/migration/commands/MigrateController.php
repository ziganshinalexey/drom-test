<?php

declare(strict_types = 1);

namespace Core\migration\commands;

use Core\controller\Controller;
use Core\Core;
use Exception;

/**
 * Класс MigrateController реализует методы обработки миграций.
 */
class MigrateController extends Controller
{
    /**
     * Метод реализует действие применения миграций.
     *
     * @return void
     *
     * @throws Exception Если объект приложения не задан.
     */
    public function actionUp(): void
    {
        $operation = Core::getApplication()->getMigration()->up();
        var_dump($operation);
        die;
    }

    /**
     * Метод реализует действие применения миграций.
     *
     * @return void
     *
     * @throws Exception Если объект приложения не задан.
     */
    public function actionDown(): void
    {
        $operation = Core::getApplication()->getMigration()->down();
        var_dump($operation);
        die;
    }
}
