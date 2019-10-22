<?php

declare(strict_types = 1);

namespace Core\db\factories;

use Core\db\interfaces\IConnection;
use Core\db\interfaces\IFactory;
use Core\factory\Factory as BaseFactory;
use Exception;

/**
 * Класс IFactory реализует методы фабрики миграций.
 */
class Factory extends BaseFactory implements IFactory
{
    public const CONNECTION = 'connection';

    /**
     *  Метод возвращает объект для соединения с БД.
     *
     * @return IConnection
     *
     * @throws Exception Если отсутствует нужный ключ в конфигурации.
     */
    public function getConnection(): IConnection
    {
        return $this->getInstance(static::CONNECTION);
    }
}
