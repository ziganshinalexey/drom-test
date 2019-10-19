<?php

declare(strict_types = 1);

namespace Core\request\interfaces;

/**
 * Интерфейс IRequest объявляет методы компонента.
 */
interface IRequest
{
    /**
     * Метод возвращает путь обращения.
     *
     * @return null|string
     */
    public function getRoute(): ?string;

    /**
     * Метод возвращает параметры запроса.
     *
     * @return array
     */
    public function getParamList(): array;
}
