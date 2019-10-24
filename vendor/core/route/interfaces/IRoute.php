<?php

declare(strict_types = 1);

namespace Core\route\interfaces;

use Core\controller\interfaces\IController;

/**
 * Интерфейс Route объявляет методы поиска контроллера.
 */
interface IRoute
{
    /**
     * Метод возвращает объект контроллера.
     *
     * @param null|string $route роут контроллера.
     *
     * @return IController|null
     */
    public function findController(string $route = null): ?IController;
}
