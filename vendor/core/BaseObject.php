<?php

declare(strict_types = 1);

namespace Core;

use Exception;

/**
 * Базовый класс для всех классов от которых будут пораждать объекты.
 */
class BaseObject implements IBaseObject
{
    /**
     * Базовый конструктор.
     *
     * @param array $config Конфигурация для конструктора.
     *
     * @return void
     *
     * @throws Exception Если свойства не существует.
     */
    public function __construct(array $config = [])
    {
        foreach ($config as $attribute => $value) {
            $setterName = 'set' . ucfirst($attribute);
            if (method_exists($this, $setterName)) {
                $this->$setterName($value);
                continue;
            }

            if (property_exists($this, $attribute)) {
                $this->$attribute = $value;
                continue;
            }

            throw new Exception('Атрибут ' . $attribute . ' не существует.');
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
