<?php

declare(strict_types = 1);

namespace Core\migration\factories;

use Core\factory\Factory as BaseFactory;
use Core\migration\interfaces\IFactory;
use Core\migration\interfaces\operations\IDownOperation;
use Core\migration\interfaces\operations\IUpOperation;
use Exception;

/**
 * Класс IFactory реализует методы фабрики миграций.
 */
class Factory extends BaseFactory implements IFactory
{
    public const UP_OPERATION   = 'upOperation';
    public const DOWN_OPERATION = 'downOperation';

    /**
     * Метод возвращает операцию применения миграций.
     *
     * @return IUpOperation
     *
     * @throws Exception Если отсутствует нужный ключ в конфигурации.
     */
    public function getUpOperation(): IUpOperation
    {
        return $this->getInstance(static::UP_OPERATION);
    }

    /**
     * Метод возвращает операцию отката миграций.
     *
     * @return IDownOperation
     *
     * @throws Exception Если отсутствует нужный ключ в конфигурации.
     */
    public function getDownOperation(): IDownOperation
    {
        return $this->getInstance(static::DOWN_OPERATION);
    }
}
