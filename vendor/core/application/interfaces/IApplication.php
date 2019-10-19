<?php

namespace Core\application\interfaces;

use Core\factory\interfaces\IWithFactory;
use Core\request\interfaces\IRequest;

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
}
