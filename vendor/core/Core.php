<?php

namespace Core;

use Core\application\interfaces\IApplication;
use Exception;

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
}
