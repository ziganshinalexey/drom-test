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
        $appliedMigrationList = $this->getAppliedMigration();
        $dateTimeList         = array_flip(array_column($appliedMigrationList, 'id'));

        foreach ($this->getMigrationList() as $dateTime => $migrationClass) {
            if (isset($dateTimeList[$dateTime])) {
                continue;
            }

            $migration = Core::createObject(['class' => $migrationClass]);

            if (! $migration instanceof IMigrationModel) {
                continue;
            }

            echo 'Сейчас для вас накатывается: ' . $migrationClass . PHP_EOL;
            $migration->up();

            $this->insertAppliedMigration((string)$dateTime, (string)$migrationClass);
        }
    }
}
