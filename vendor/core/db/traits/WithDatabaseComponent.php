<?php

declare(strict_types = 1);

namespace Core\db\traits;

use Core\Core;
use Core\db\interfaces\IDatabase;
use Exception;

/**
 * Трэит WithDatabaseComponent подключает переменную компонента к классу.
 */
trait WithDatabaseComponent
{
    /**
     * Свойство содержит компонент.
     *
     * @var IDatabase|null
     */
    protected $dbComponent;

    /**
     * Метод возвращает компонент.
     *
     * @return IDatabase
     *
     * @throws Exception Если компонент не зарегистирован.
     */
    protected function getDatabaseComponent(): IDatabase
    {
        if (null === $this->dbComponent) {
            $this->dbComponent = Core::getApplication()->getComponent(IDatabase::COMPONENT_NAME);
        }

        return $this->dbComponent;
    }

    /**
     * Метод задает компонент.
     *
     * @param IDatabase $value Новое значение.
     *
     * @return void
     */
    protected function setDatabaseComponent(IDatabase $value): void
    {
        $this->dbComponent = $value;
    }
}
