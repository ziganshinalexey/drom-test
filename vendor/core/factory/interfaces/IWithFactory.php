<?php

declare(strict_types = 1);

namespace Core\factory\interfaces;

/**
 * Интерфейс IWithFactory объявляет методы присутствия фабрики.
 */
interface IWithFactory
{
    /**
     * Метод задает объект фабрики.
     *
     * @param IFactory $value Новое значение.
     *
     * @return static
     */
    public function setFactory(IFactory $value);

    /**
     * Метод задает класс фабрики.
     *
     * @param string $value Новое значение.
     *
     * @return static
     */
    public function setFactoryClass(string $value);
}
