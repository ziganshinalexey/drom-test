<?php

declare(strict_types = 1);

namespace Core\application\factories;

use Core\application\interfaces\IFactory;
use Core\factory\Factory as BaseFactory;
use Core\request\interfaces\IRequest;

/**
 * Класс Factory реализует методы получения объектов для приложения.
 */
class Factory extends BaseFactory implements IFactory
{
    protected const REQUEST_COMPONENT = 'request';

    /**
     * Метод создает объект компонента запросов.
     *
     * @return IRequest
     */
    public function getRequest(): IRequest
    {
        return $this->getInstance(static::REQUEST_COMPONENT);
    }
}
