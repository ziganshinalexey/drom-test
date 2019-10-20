<?php

declare(strict_types = 1);

namespace Core\route\components;

use Core\BaseObject;
use Core\route\interfaces\IRoute;

/**
 * Класс Route реализует методы поиска контроллера.
 */
class Route extends BaseObject implements IRoute
{
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
}
