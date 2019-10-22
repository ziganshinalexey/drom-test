<?php

declare(strict_types = 1);

namespace Core\migration\operations;

use Core\Core;
use Core\migration\interfaces\IMigrationModel;
use Core\migration\interfaces\operations\IUpOperation;
use Exception;

/**
 * Класс UpOperation реализует методы операции.
 */
class UpOperation extends BaseOperation implements IUpOperation
{
    /**
     * Метод исполнения операции.
     *
     * @return void
     *
     * @throws Exception
     */
    public function run(): void
    {
        $this->getAppliedMigration();

        foreach ($this->getMigrationList() as $migrationClass) {
            $migration = Core::createObject(['class' => $migrationClass]);

            if (! $migration instanceof IMigrationModel) {
                continue;
            }

            echo 'Сейчас для вас накатывается: ' . $migrationClass . PHP_EOL;
            $migration->up();
        }
    }
}
