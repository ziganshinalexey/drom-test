<?php

declare(strict_types = 1);

namespace Core\application\console;

use Core\application\factories\Factory;
use Core\application\interfaces\IApplication;
use Core\application\interfaces\IFactory;
use Core\factory\traits\WithFactoryTrait;
use Core\request\interfaces\IRequest;

/**
 * Класс приложения.
 */
class Application implements IApplication
{
    use WithFactoryTrait {
        WithFactoryTrait::getFactory as getFactoryFromTrait;
    }

    protected const COMPONENT_KEY = 'componentList';

    /**
     * Конструктор класса.
     *
     * @param array $config Конфигурация приложения.
     *
     * @return void
     */
    public function __construct(array $config)
    {
        $factoryConfig = (array)$config[static::COMPONENT_KEY] ?? [];

        $this->getFactory()->setConfig($factoryConfig);
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

    /**
     * Метод исполнения заветных желаний.
     *
     * @return void
     */
    public function run(): void
    {
        $request = $this->getRequest();

        var_dump($request);
        die;
    }

    /**
     * Метод возвращает компонент запросов.
     *
     * @return IRequest
     */
    public function getRequest(): IRequest
    {
        return $this->getFactory()->getRequest();
    }
}
