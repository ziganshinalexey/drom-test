<?php

declare(strict_types = 1);

namespace Core\factory\interfaces;

/**
 * Интерфейс IFactory объявляет методы фабрики.
 */
interface IFactory
{
    /**
     * Метод задает конфигурацию для создания объектов.
     *
     * @param array $value
     *
     * @return static
     */
    public function setConfig(array $value): IFactory;

    /**
     * Метод возвращает конфигурацию для создания объектов.
     *
     * @return array
     */
    public function getConfig(): array;
}
