<?php

namespace Core;

/**
 * Интерфейс для базовых объектов.
 */
interface IBaseObject
{
    /**
     * Базой конструктор.
     *
     * @param array $config Конфигурация для конструктора.
     *
     * @return void
     */
    public function __construct(array $config = []);
}
