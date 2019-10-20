<?php

declare(strict_types = 1);

namespace Core\controller;

use Core\BaseObject;
use Core\controller\interfaces\IController;
use Exception;

/**
 * Класс Controller реализует методы контроллера.
 */
class Controller extends BaseObject implements IController
{
    /**
     * Метод  исполнения действия.
     *
     * @param string $route     Роут.
     * @param array  $paramList Список параметров.
     *
     * @return void
     *
     * @throws Exception Если действие не найдено.
     */
    public function runAction(string $route, array $paramList = []): void
    {
        $actionId   = substr($route, strripos($route, '/') + 1);
        $actionName = static::ACTION_PREFIX . ucfirst($actionId);

        if (! method_exists($this, $actionName)) {
            throw new Exception('Действие не найдено.');
        }

        $this->$actionName();
    }
}
