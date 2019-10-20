<?php

namespace Core\application\interfaces;

use Core\factory\interfaces\IFactory as BaseIFactory;
use Core\request\interfaces\IRequest;
use Core\route\interfaces\IRoute;

/**
 * Интерфейс IFactory объявляет методы фабрики приложения.
 */
interface IFactory extends BaseIFactory
{
    /**
     * Метод создает объект компонента запросов.
     *
     * @return IRequest
     */
    public function getRequest(): IRequest;

    /**
     * Метод создает объект компонента роутинга.
     *
     * @return IRoute
     */
    public function getRoute(): IRoute;
}
