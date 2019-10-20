<?php

declare(strict_types = 1);

namespace Core\route\components;

use Core\BaseObject;
use Core\controller\interfaces\IController;
use Core\route\interfaces\IRoute;
use Exception;

/**
 * Класс Route реализует методы поиска контроллера.
 */
class Route extends BaseObject implements IRoute
{
    protected const CONTROLLER_ROUTE  = 1;
    protected const CONTROLLER_ACTION = 2;
    /**
     * Свойтсво содержит карту роут => класс котроллера.
     *
     * @var array
     */
    protected $controllerMap = [];

    /**
     * Метод задает карту роут => класс котроллера.
     *
     * @param array $value Новое значение.
     *
     * @return static
     */
    public function setControllerMap(array $value): self
    {
        $this->controllerMap = $value;

        return $this;
    }

    /**
     * Метод возвращает карту роут => класс котроллера.
     *
     * @return array
     */
    public function getControllerMap(): array
    {
        return $this->controllerMap;
    }

    /**
     * Метод возвращает объект контроллера.
     *
     * @param string $route роут контроллера.
     *
     * @return IController|null
     *
     * @throws Exception Если роут передан неверно или контроллер не найден.
     */
    public function findController(string $route): ?IController
    {
        preg_match('/^(\S*)\/(\S*)$/', $route, $matchList);
        [
            static::CONTROLLER_ROUTE  => $controllerRoute,
            static::CONTROLLER_ACTION => $actionId,
        ] = $matchList;

        if (null === $controllerRoute || null === $actionId) {
            throw new Exception('Роут указан неверно.');
        }

        $controllerClass = $this->getControllerMap()[$controllerRoute] ?? null;
        if (! $controllerClass) {
            throw new Exception('Контроллер не найден.');
        }

        // @todo: Придумать что-нибудь получше.
        $controller = new $controllerClass();

        return $controller;
    }
}
