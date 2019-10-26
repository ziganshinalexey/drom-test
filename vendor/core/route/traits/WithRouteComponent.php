<?php

declare(strict_types = 1);

namespace Core\route\traits;

use Core\Core;
use Core\route\interfaces\IRoute;
use Exception;

/**
 * Трэит WithRouteComponent подключает переменную компонента к классу.
 */
trait WithRouteComponent
{
    /**
     * Свойство содержит компонент.
     *
     * @var IRoute|null
     */
    protected $routeComponent;

    /**
     * Метод возвращает компонент.
     *
     * @return IRoute
     *
     * @throws Exception Если компонент не зарегистирован.
     */
    protected function getRouteComponent(): IRoute
    {
        if (null === $this->routeComponent) {
            $this->routeComponent = Core::getApplication()->getComponent(IRoute::COMPONENT_NAME);
        }

        return $this->routeComponent;
    }

    /**
     * Метод задает компонент.
     *
     * @param IRoute $value Новое значение.
     *
     * @return void
     */
    protected function setRouteComponent(IRoute $value): void
    {
        $this->routeComponent = $value;
    }
}
