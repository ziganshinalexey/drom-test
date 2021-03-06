<?php

declare(strict_types = 1);

namespace Core\migration\interfaces;

use Core\application\interfaces\IComponent;
use Core\factory\interfaces\IWithFactory;
use Core\migration\interfaces\operations\IDownOperation;
use Core\migration\interfaces\operations\IUpOperation;

/**
 * Интерфейс Migration объявляет методы компонента миграций.
 */
interface IMigration extends IWithFactory, IComponent
{
    public const COMPONENT_NAME       = 'migration';
    public const MIGRATION_TABLE_NAME = 'migration';

    /**
     * Метод возвращает операцию применения миграций.
     *
     * @return IUpOperation
     */
    public function up(): IUpOperation;

    /**
     * Метод возвращает операцию применения миграций.
     *
     * @return IDownOperation
     */
    public function down(): IDownOperation;
}
