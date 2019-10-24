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
     * Свойтсво хранит роут по-умолчанию.
     *
     * @var string|null
     */
    protected $defaultRouteName;

    /**
     * Метод возвращает путь обращения.
     *
     * @return string
     *
     * @throws Exception Если роутинг поломался.
     */
    public function getRouteName(): string
    {
        $uri = substr($_SERVER[static::SERVER_REQUEST_URI_KEY], 1);

        if (empty($uri)) {
            return $this->getDefaultRouteName();
        }

        return $uri;
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

    /**
     * Метод задает роут по-умолчанию.
     *
     * @param string $value Новое значение.
     *
     * @return void
     */
    public function setDefaultRouteName(string $value): void
    {
        $this->defaultRouteName = $value;
    }

    /**
     * Метод возвращает роут по-умолчанию.
     *
     * @return string|null
     *
     * @throws Exception
     */
    protected function getDefaultRouteName(): ?string
    {
        if (null === $this->defaultRouteName) {
            throw new Exception('Роут по-умолчанию не задан.');
        }

        return $this->defaultRouteName;
    }
}