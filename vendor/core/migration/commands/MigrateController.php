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
        $migration = Core::getApplication()->getMigration();
        var_dump($migration);
        die;
    }

    /**
     * Метод реализует действие применения миграций.
     *
     * @return void
     */
    public function actionDown(): void
    {
        var_dump('actionDown');
        die;
    }
}
