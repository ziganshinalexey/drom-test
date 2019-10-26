<?php

declare(strict_types = 1);

namespace Core\application\components;

use Core\application\interfaces\IComponent;
use Core\BaseObject;
use Core\Core;
use Exception;

/**
 * Класс приложения.
 */
abstract class BaseApplication extends BaseObject
{
    /**
     * Свойство содержит список компонентов.
     *
     * @var array
     */
    protected $componentList = [];

    /**
     * Метод задает список компонентов.
     *
     * @param array $value
     */
    public function setComponentList(array $value): void
    {
        $value = array_map(function($config) {
            return Core::createObject($config);
        }, $value);

        $this->componentList = $value;
    }

    /**
     * Метод возвращает компонент по его названию.
     *
     * @param string $name Название компонента.
     *
     * @return IComponent
     *
     * @throws Exception
     */
    public function getComponent(string $name): IComponent
    {
        $component = $this->componentList[$name] ?? null;
        if (! $component instanceof IComponent) {
            throw new Exception($name . ' компонент не задан.');
        }

        return $component;
    }

    /**
     * Метод исполнения заветных желаний.
     *
     * @return void
     *
     * @throws Exception
     */
    abstract public function run(): void;
}
