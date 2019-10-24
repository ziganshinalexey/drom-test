<?php

declare(strict_types = 1);

namespace Core\request\interfaces\web;

/**
 * Интерфейс IRequest объявляет методы компонента.
 */
interface IRequest
{
    /**
     * Метод возвращает путь обращения.
     *
     * @return string|null
     */
    public function getRoute(): ?string;

    /**
     * Метод возвращает параметры запроса метода GET.
     *
     * @param string $key Ключ для выборки.
     *
     * @return string|null
     */
    public function getByKey(string $key): ?string;

    /**
     * Метод возвращает параметры запроса метода POST.
     *
     * @return array
     */
    public function post(): array;
}
