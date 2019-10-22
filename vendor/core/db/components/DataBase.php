<?php

declare(strict_types = 1);

namespace Core\db\components;

use Core\BaseObject;
use Core\db\interfaces\IConnection;
use Core\db\interfaces\IDatabase;
use Core\db\interfaces\IFactory;
use Core\factory\traits\WithFactoryTrait;
use Exception;

/**
 * Класс DataBase реализует методы для взаимодействия с БД.
 */
class DataBase extends BaseObject implements IDatabase
{
    use WithFactoryTrait {
        WithFactoryTrait::getFactory as getFactoryFromTrait;
    }

    /**
     * Метод возвращает объект для соединения с БД.
     *
     * @return IConnection
     *
     * @throws Exception Если класс фабрики отсутствует.
     */
    public function getConnection(): IConnection
    {
        return $this->getFactory()->getConnection();
    }

    /**
     * Метод возвращает объект фабрики.
     *
     * @return IFactory
     *
     * @throws Exception Если класс фабрики отсутствует.
     */
    protected function getFactory(): IFactory
    {
        /* @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->getFactoryFromTrait();
    }
}