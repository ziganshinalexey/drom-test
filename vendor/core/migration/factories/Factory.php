<?php

declare(strict_types = 1);

namespace Core\migration\factories;

use Core\factory\Factory as BaseFactory;
use Core\migration\interfaces\IFactory;
use Core\migration\interfaces\operations\IDownOperation;
use Core\migration\interfaces\operations\IUpOperation;
use Core\result\interfaces\IDataResult;
use Core\result\interfaces\IWithDataResult;
use Exception;

/**
 * Класс IFactory реализует методы фабрики миграций.
 */
class Factory extends BaseFactory implements IFactory
{
    protected const UP_OPERATION   = 'upOperation';
    protected const DOWN_OPERATION = 'downOperation';
    protected const DATA_RESULT    = 'dataResult';

    /**
     * Метод возвращает операцию применения миграций.
     *
     * @return IUpOperation
     *
     * @throws Exception Если отсутствует нужный ключ в конфигурации.
     */
    public function getUpOperation(): IUpOperation
    {
        $result = $this->getInstance(static::UP_OPERATION);

        if ($result instanceof IWithDataResult) {
            $result->setResult($this->getResult());
        }

        return $result;
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
        $result = $this->getInstance(static::DOWN_OPERATION);

        if ($result instanceof IWithDataResult) {
            $result->setResult($this->getResult());
        }

        return $result;
    }

    /**
     * Метод возвращает объект результата.
     *
     * @return IDataResult
     *
     * @throws Exception Если отсутствует нужный ключ в конфигурации.
     */
    protected function getResult(): IDataResult
    {
        return $this->getInstance(static::DATA_RESULT);
    }
}
