<?php

declare(strict_types = 1);

namespace Core\route\interfaces;

use Core\application\interfaces\IComponent;
use Core\controller\interfaces\IController;

/**
 * Интерфейс Route объявляет методы поиска контроллера.
 */
interface IRoute extends IComponent
{
    public const COMPONENT_NAME = 'route';

    /**
     * Метод возвращает объект контроллера.
     *
     * @param string $route роут контроллера.
     *
     * @return IController|null
     */
    public function findController(string $route): ?IController;
}
