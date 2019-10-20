<?php

declare(strict_types = 1);

namespace Core\request\components\console;

use Core\BaseObject;
use Core\request\interfaces\IRequest;

/**
 * Класс-компонент Request реализует методы парсинга входящего запроса.
 */
class Request extends BaseObject implements IRequest
{
    /**
     * Метод возвращает путь обращения.
     *
     * @return null|string
     */
    public function getRoute(): ?string
    {
        return '';
    }

    /**
     * Метод возвращает параметры запроса.
     *
     * @return array
     */
    public function getParamList(): array
    {
        return [];
    }
}