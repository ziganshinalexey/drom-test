<?php

declare(strict_types = 1);

namespace Core\db\factories;

use Core\db\interfaces\IConnection;
use Core\db\interfaces\IFactory;
use Core\factory\Factory as BaseFactory;
use Core\result\interfaces\IDataResult;
use Core\result\interfaces\IWithDataResult;
use Exception;

/**
 * Класс IFactory реализует методы фабрики миграций.
 */
class Factory extends BaseFactory implements IFactory
{
    public const CONNECTION = 'connection';
    public const RESULT     = 'dataResult';

    /**
     * Метод возвращает объект для соединения с БД.
     *
     * @return IConnection
     *
     * @throws Exception Если отсутствует нужный ключ в конфигурации.
     */
    public function getConnection(): IConnection
    {
        $object = $this->getInstance(static::CONNECTION);
        if ($object instanceof IWithDataResult) {
            $object->setResult($this->getResult());
        }

        return $object;
    }

    /**
     * Метод возвращает объект для соединения с БД.
     *
     * @return IDataResult
     *
     * @throws Exception Если отсутствует нужный ключ в конфигурации.
     */
    protected function getResult(): IDataResult
    {
        return $this->getInstance(static::RESULT);
    }
}
