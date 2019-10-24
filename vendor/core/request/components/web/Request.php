<?php

declare(strict_types = 1);

namespace Core\request\components\web;

use Core\BaseObject;
use Core\request\interfaces\web\IRequest;
use Exception;

/**
 * Класс-компонент Request реализует методы парсинга входящего запроса.
 */
class Request extends BaseObject implements IRequest
{
    protected const SERVER_REQUEST_URI_KEY = 'REQUEST_URI';

    /**
     * Метод возвращает путь обращения.
     *
     * @return string|null
     *
     * @throws Exception Если роутинг поломался.
     */
    public function getRoute(): ?string
    {
        return substr($_SERVER[static::SERVER_REQUEST_URI_KEY], 1);
    }

    /**
     * Метод возвращает параметры запроса метода GET.
     *
     * @param string $key Ключ для выборки.
     *
     * @return string|null
     */
    public function getByKey(string $key): ?string
    {
        return (string)$_GET[$key] ?? null;
    }

    /**
     * Метод возвращает параметры запроса метода POST.
     *
     * @return array
     */
    public function post(): array
    {
        return (array)$_POST;
    }
}