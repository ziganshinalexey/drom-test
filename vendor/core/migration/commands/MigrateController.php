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
        Core::getApplication()->getMigration()->up()->run();

        echo 'Миграции успешно применены.' . PHP_EOL;
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
        Core::getApplication()->getMigration()->down()->run();

        echo 'Миграции успешно отменены.' . PHP_EOL;
    }
}
