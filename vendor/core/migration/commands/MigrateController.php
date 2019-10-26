<?php

declare(strict_types = 1);

namespace Core\migration\commands;

use Core\controller\Controller;
use Core\migration\traits\WithMigrationComponent;
use Exception;

/**
 * Класс MigrateController реализует методы обработки миграций.
 */
class MigrateController extends Controller
{
    use WithMigrationComponent;

    /**
     * Метод реализует действие применения миграций.
     *
     * @return void
     *
     * @throws Exception Если объект приложения не задан.
     */
    public function actionUp(): void
    {
        $this->getMigrationComponent()->up()->run();

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
        $this->getMigrationComponent()->down()->run();

        echo 'Миграции успешно отменены.' . PHP_EOL;
    }
}
