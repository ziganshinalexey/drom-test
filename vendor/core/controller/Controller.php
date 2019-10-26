<?php

declare(strict_types = 1);

namespace Core\controller;

use Core\BaseObject;
use Core\controller\interfaces\IController;
use Core\Core;
use Exception;

/**
 * Класс Controller реализует методы контроллера.
 */
class Controller extends BaseObject implements IController
{
    /**
     * Свойтсво хранит карту Условное название => Путь к файлу.
     *
     * @var array
     */
    protected $viewMap = [];

    /**
     * Метод задает карту Условное название => Путь к файлу.
     *
     * @param array $value Новое значение.
     *
     * @return static
     */
    public function setViewMap(array $value): IController
    {
        $this->viewMap = $value;

        return $this;
    }

    /**
     * Метод возвращает карту Условное название => Путь к файлу.
     *
     * @return array
     */
    public function getViewMap(): array
    {
        return $this->viewMap;
    }

    /**
     * Метод  исполнения действия.
     *
     * @param string $route Роут.
     *
     * @return void
     *
     * @throws Exception Если действие не найдено.
     */
    public function runAction(string $route): void
    {
        $actionId   = substr($route, strripos($route, '/') + 1);
        $actionName = static::ACTION_PREFIX . ucfirst($actionId);

        if (! method_exists($this, $actionName)) {
            throw new Exception('Действие не найдено.');
        }

        $this->$actionName();
    }

    /**
     * Метод рендера страницы.
     *
     * @param string $view      Ключ для карты с шаблоном вьюхи.
     * @param array  $paramList Список параметров для рендера страницы.
     *
     * @return void
     *
     * @throws Exception
     */
    protected function render(string $view, array $paramList = []): void
    {
        $viewPath = $this->getViewMap()[$view] ?? null;
        if (null === $viewPath || ! is_file($viewPath) || ! is_readable($viewPath)) {
            throw new Exception('Вью не найдена.');
        }

        extract($paramList, EXTR_OVERWRITE);
        ob_start();
        require_once $viewPath;
        $content = ob_get_contents();
        ob_end_clean();

        Core::getApplication()->getResponse()->send($content);
    }

    /**
     * Метод рендера json документа.
     *
     * @param array $paramList Список параметров для рендера страницы.
     *
     * @return void
     *
     * @throws Exception
     */
    protected function renderJson(array $paramList = []): void
    {
        $content  = json_encode($paramList);
        $response = Core::getApplication()->getResponse();
        $response->addHeader('Content-Type', 'application/json');

        $response->send($content);
    }
}
