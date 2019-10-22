<?php

namespace Core;

use Core\application\interfaces\IApplication;
use Exception;
use ReflectionClass;
use ReflectionException;

/**
 * Здесь мог быть нормальный DI.
 */
class Core
{
    /**
     * Свойство хранит объект приложения.
     *
     * @var IApplication|null
     */
    protected static $application;

    /**
     * Метод задает объект приложения.
     *
     * @param IApplication $value Новое значение.
     *
     * @return void
     */
    public static function setApplication(IApplication $value): void
    {
        static::$application = $value;
    }

    /**
     * Метод возвращает объект приложения.
     *
     * @return IApplication
     *
     * @throws Exception Если объект приложения не задан.
     */
    public static function getApplication(): IApplication
    {
        if (null === static::$application) {
            throw new Exception('Приложение не может быть пустым.');
        }

        return static::$application;
    }

    /**
     * Метод инициализации приложения.
     *
     * @param array $config Конфигурация приложения.
     *
     * @throws ReflectionException
     */
    public static function init($config = [])
    {
        static::$application = static::createObject($config);
    }

    /**
     * Метод создания объекта (Почти как DI).
     *
     * @param array $config Конфигурация объекта.
     *
     * @return object
     *
     * @throws ReflectionException Если рефлекшены в плохом настроении.
     * @throws Exception Если отсутствует название класса в конфигурации.
     */
    public static function createObject($config = [])
    {
        $argumentList = [];

        $class = $config['class'] ?? null;
        unset($config['class']);
        if (! $class) {
            throw new Exception('Название класса отсутствует.');
        }

        foreach ($config as $attribute => $value) {
            $dependencyClass = $value['class'] ?? null;

            if ($dependencyClass) {
                $value = static::createObject($value);
            }

            $argumentList[$attribute] = $value;
        }

        $reflection = new ReflectionClass($class);

        if ($reflection->implementsInterface('Core\IBaseObject')) {
            return $reflection->newInstance($argumentList);
        }

        return $reflection->newInstanceArgs($argumentList);
    }
}
