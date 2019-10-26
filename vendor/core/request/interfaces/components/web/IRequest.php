<?php

declare(strict_types = 1);

namespace Core\request\interfaces\components\web;

use Core\application\interfaces\IComponent;

/**
 * Интерфейс IRequest объявляет методы компонента.
 */
interface IRequest extends IComponent
{
    public const COMPONENT_NAME = 'request';

    /**
     * Метод возвращает путь обращения.
     *
     * @return string
     */
    public function getRouteName(): string;

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
