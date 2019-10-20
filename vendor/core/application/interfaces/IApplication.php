<?php

namespace Core\application\interfaces;

use Core\factory\interfaces\IWithFactory;
use Core\migration\interfaces\IMigration;
use Core\request\interfaces\IRequest;
use Core\route\interfaces\IRoute;

/**
 * Интерфейс IApplication объявляет методы приложения.
 */
interface IApplication extends IWithFactory
{
    /**
     * Метод возвращает компонент запросов.
     *
     * @return IRequest
     */
    public function getRequest(): IRequest;

    /**
     * Метод возвращает компонент роутинга.
     *
     * @return IRoute
     */
    public function getRoute(): IRoute;

    /**
     * Метод возвращает компонент миграций.
     *
     * @return IMigration
     */
    public function getMigration(): IMigration;
}
