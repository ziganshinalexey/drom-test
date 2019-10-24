<?php

declare(strict_types = 1);

namespace Core\application\components\web;

use Core\application\components\BaseApplication;
use Core\application\interfaces\web\IApplication;
use Core\request\interfaces\web\IRequest;
use Exception;

/**
 * Класс приложения.
 */
class Application extends BaseApplication implements IApplication
{
    /**
     * Свойство хранит объект компонента запроса.
     *
     * @var IRequest|null
     */
    protected $requestComponent;

    /**
     * Метод исполнения заветных желаний.
     *
     * @return void
     *
     * @throws Exception
     */
    public function run(): void
    {
        $request = $this->getRequest();
        $route   = $request->getRoute();

        $controller = $this->getRoute()->findController($route);

        $controller->runAction($route);
    }

    /**
     * Метод возвращает компонент запросов.
     *
     * @param IRequest $value Новое значение.
     *
     * @return void
     *
     * @throws Exception Если класс фабрики отсутствует.
     */
    public function setRequest(IRequest $value): void
    {
        $this->requestComponent = $value;
    }

    /**
     * Метод возвращает компонент запросов.
     *
     * @return IRequest
     *
     * @throws Exception
     */
    public function getRequest(): IRequest
    {
        if (null === $this->requestComponent) {
            throw new Exception('Компонент отсутствует.');
        }

        return $this->requestComponent;
    }
}