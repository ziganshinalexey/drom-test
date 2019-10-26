<?php

declare(strict_types = 1);

namespace Core\migration;

use Core\BaseObject;
use Core\db\traits\WithDatabaseComponent;
use Core\migration\interfaces\IMigrationModel;

/**
 * Класс AbstractMigrationModel с не самым удачным нахванием, но реализует методы для миграций.
 */
abstract class AbstractMigrationModel extends BaseObject implements IMigrationModel
{
    use WithDatabaseComponent;

    /**
     * Метод накатывает миграцию.
     *
     * @return void
     */
    public abstract function up(): void;

    /**
     * Метод откатывает миграцию.
     *
     * @return void
     */
    public abstract function down(): void;
}
