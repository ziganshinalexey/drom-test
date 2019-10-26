<?php

declare(strict_types = 1);

namespace Core\request\interfaces\components\console;

/**
 * Интерфейс IRequest объявляет методы компонента.
 */
interface IRequest
{
    /**
     * Метод возвращает путь обращения.
     *
     * @return string
     */
    public function getRouteName(): string;

    /**
     * Метод возвращает параметры запроса.
     *
     * @return array
     */
    public function getParamList(): array;
}
