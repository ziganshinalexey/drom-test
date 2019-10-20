<?php

declare(strict_types = 1);

namespace Core\application\factories;

use Core\application\interfaces\IFactory;
use Core\factory\Factory as BaseFactory;
use Core\request\interfaces\IRequest;
use Core\route\interfaces\IRoute;
use Exception;

/**
 * Класс Factory реализует методы получения объектов для приложения.
 */
class Factory extends BaseFactory implements IFactory
{
    protected const REQUEST_COMPONENT = 'request';
    protected const ROUTE_COMPONENT   = 'route';

    /**
     * Метод создает объект компонента запросов.
     *
     * @return IRequest
     *
     * @throws Exception Если отсутствует нужный ключ в конфигурации.
     */
    public function getRequest(): IRequest
    {
        return $this->getInstance(static::REQUEST_COMPONENT);
    }

    /**
     * Метод создает объект компонента роутинга.
     *
     * @return IRoute
     *
     * @throws Exception Если отсутствует нужный ключ в конфигурации.
     */
    public function getRoute(): IRoute
    {
        return $this->getInstance(static::ROUTE_COMPONENT);
    }
}
