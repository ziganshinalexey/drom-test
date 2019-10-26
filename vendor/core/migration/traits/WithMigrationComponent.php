<?php

declare(strict_types = 1);

namespace Core\migration\traits;

use Core\Core;
use Core\migration\interfaces\IMigration;
use Exception;

/**
 * Трэит WithMigrationComponent подключает переменную компонента к классу.
 */
trait WithMigrationComponent
{
    /**
     * Свойство содержит компонент.
     *
     * @var IMigration|null
     */
    protected $migrationComponent;

    /**
     * Метод возвращает компонент.
     *
     * @return IMigration
     *
     * @throws Exception Если компонент не зарегистирован.
     */
    protected function getMigrationComponent(): IMigration
    {
        if (null === $this->migrationComponent) {
            $this->migrationComponent = Core::getApplication()->getComponent(IMigration::COMPONENT_NAME);
        }

        return $this->migrationComponent;
    }

    /**
     * Метод задает компонент.
     *
     * @param IMigration $value Новое значение.
     *
     * @return void
     */
    protected function setMigrationComponent(IMigration $value): void
    {
        $this->migrationComponent = $value;
    }
}
