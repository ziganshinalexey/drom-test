<?php

declare(strict_types = 1);

namespace Core\application\console;

use Core\application\factories\Factory;
use Core\application\interfaces\IApplication;
use Core\application\interfaces\IFactory;
use Core\BaseObject;
use Core\factory\traits\WithFactoryTrait;
use Core\request\interfaces\IRequest;
use Core\route\interfaces\IRoute;

/**
 * Класс приложения.
 */
class Application extends BaseObject implements IApplication
{
    use WithFactoryTrait {
        WithFactoryTrait::getFactory as getFactoryFromTrait;
    }

    protected const COMPONENT_KEY = 'componentList';
    /**
     * Свойство хранит объект компонента запроса.
     *
     * @var IRequest
     */
    protected $requestComponent;
    /**
     * Свойство хранит объект компонента роутинга.
     *
     * @var IRoute
     */
    protected $routeComponent;

    /**
     * Конструктор класса.
     *
     * @param array $config Конфигурация приложения.
     *
     * @return void
     */
    public function __construct(array $config = [])
    {
        $factoryConfig = (array)$config[static::COMPONENT_KEY] ?? [];
        unset($config[static::COMPONENT_KEY]);
        $this->getFactory()->setConfig($factoryConfig);

        parent::__construct($config);
    }

    /**
     * Метод исполнения заветных желаний.
     *
     * @return void
     */
    public function run(): void
    {
        $request = $this->getRequest();

        $route     = $request->getRoute();
        $paramList = $request->getParamList();

        var_dump($route, $paramList, $this->getRoute());
        die;
    }

    /**
     * Метод возвращает компонент запросов.
     *
     * @return IRequest
     */
    public function getRequest(): IRequest
    {
        if (null === $this->requestComponent) {
            $this->requestComponent = $this->getFactory()->getRequest();
        }

        return $this->requestComponent;
    }

    /**
     * Метод возвращает компонент роутинга.
     *
     * @return IRoute
     */
    public function getRoute(): IRoute
    {
        if (null === $this->routeComponent) {
            $this->routeComponent = $this->getFactory()->getRoute();
        }

        return $this->routeComponent;
    }

    /**
     * Метод возвращает фабрику.
     *
     * @return IFactory
     */
    protected function getFactory(): IFactory
    {
        if (null === $this->factory) {
            $this->factory = new Factory();
        }

        return $this->factory;
    }
}
