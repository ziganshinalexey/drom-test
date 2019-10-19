<?php

declare(strict_types = 1);

namespace Core\factory;

use Core\factory\interfaces\IFactory;
use Exception;
use ReflectionClass;

/**
 * Класс Factory реализует фабрику.
 */
class Factory implements IFactory
{
    protected const CLASS_KEY = 'class';

    /**
     * Свойтсво хранит конфигурацию для создания объектов.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Метод задает конфигурацию для создания объектов.
     *
     * @param array $value Новое значение.
     *
     * @return static
     */
    public function setConfig(array $value): IFactory
    {
        $this->config = $value;

        return $this;
    }

    /**
     * Метод возвращает конфигурацию для создания объектов.
     *
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * Метод инициализации объекта.
     *
     * @param string $configKey Ключ внутри конфигурации.
     *
     * @return mixed
     *
     * @throws Exception Если отсутствует нудный ключ в конфигурации.
     */
    protected function getInstance(string $configKey)
    {
        if (! isset($this->getConfig()[$configKey]) && ! is_array($this->getConfig()[$configKey])) {
            throw new Exception('Фабрика сконфигурирована неверно.');
        }

        if (! isset($this->getConfig()[$configKey][static::CLASS_KEY])) {
            throw new Exception('Не указан класс.');
        }

        $config = $this->getConfig()[$configKey];
        $class  = $config[static::CLASS_KEY];
        unset($config[static::CLASS_KEY]);
        $reflection = new ReflectionClass($class);

        if (empty($config)) {
            $config = null;
        }

        return $reflection->newInstance($config);
    }
}
