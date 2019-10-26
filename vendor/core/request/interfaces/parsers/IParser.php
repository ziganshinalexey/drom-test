<?php

namespace Core\request\interfaces\parsers;

/**
 * Интерфейс IParser объявляет методы парсера.
 */
interface IParser
{
    /**
     * Метод парсит входящий ответ.
     *
     * @return array
     */
    public function parse(): array;
}
