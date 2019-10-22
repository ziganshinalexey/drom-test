<?php

declare(strict_types = 1);

namespace Core\migration\operations;

use Core\Core;
use Core\migration\interfaces\IMigrationModel;
use Core\migration\interfaces\operations\IDownOperation;
use Exception;

/**
 * Класс DownOperation реализует методы операции.
 */
class DownOperation extends BaseOperation implements IDownOperation
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

        $migrationList = $this->getMigrationList();
        krsort($migrationList);

        foreach ($migrationList as $dateTime => $migrationClass) {
            if (! isset($dateTimeList[$dateTime])) {
                continue;
            }

            $migration = Core::createObject(['class' => $migrationClass]);

            if (! $migration instanceof IMigrationModel) {
                continue;
            }

            echo 'Сейчас для вас откатывается: ' . $migrationClass . PHP_EOL;
            $migration->down();

            $this->removeAppliedMigration((string)$dateTime);
        }
    }
}
