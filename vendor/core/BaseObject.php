<?php

namespace Core;

use Exception;

/**
 * Базовый класс для всех классов от которых будут пораждать объекты.
 */
class BaseObject
{
    /**
     * Базой конструктор.
     *
     * @param array $config Конфигурация для конструктора.
     *
     * @return void
     */
    public function __construct($config = [])
    {
        foreach ($config as $attribute => $value) {
            $this->$attribute = $value;
        }
    }

    /**
     * Магический метод возвращает значение атрибута.
     *
     * @param string $name Название атрибута.
     *
     * @return mixed
     *
     * @throws Exception Если свойства не существует.
     */
    public function __get($name)
    {
        $getterName = 'get' . ucfirst($name);
        if (method_exists($this, $getterName)) {
            return $this->$getterName();
        }

        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new Exception('Атрибут ' . $name . ' не существует.');
    }

    /**
     * Магический метод задает значение атрибуту.
     *
     * @param string $name  Название атрибута.
     * @param mixed  $value Новое значение.
     *
     * @return mixed
     *
     * @throws Exception Если свойства не существует.
     */
    public function __set($name, $value)
    {
        $setterName = 'set' . ucfirst($name);
        if (method_exists($this, $setterName)) {
            return $this->$setterName($value);
        }

        if (property_exists($this, $name)) {
            return $this->$name = $value;
        }

        throw new Exception('Атрибут ' . $name . ' не существует.');
    }
}
