<?php

declare(strict_types = 1);

namespace Core\request\components\console;

use Core\BaseObject;
use Core\request\interfaces\IRequest;
use Exception;

/**
 * Класс-компонент Request реализует методы парсинга входящего запроса.
 */
class Request extends BaseObject implements IRequest
{
    protected const SERVER_ARGUMENT_VALUE_KEY = 'argv';
    protected const ARGUMENT_KEY              = 1;
    protected const ARGUMENT_VALUE            = 2;

    /**
     * Метод возвращает путь обращения.
     *
     * @return string
     *
     * @throws Exception Если роутинг поломался.
     */
    public function getRoute(): string
    {
        $serverArgumentList = $this->getServerArgumentList();
        $route              = (string)array_shift($serverArgumentList);

        if (! $route) {
            throw new Exception('Роут не задан.');
        }

        return $route;
    }

    /**
     * Метод возвращает параметры запроса.
     *
     * @return array
     */
    public function getParamList(): array
    {
        $result    = [];
        $arguments = $this->getServerArgumentList();
        array_shift($arguments);

        foreach ($arguments as $argument) {
            preg_match('/^--([a-zA-Z0-9]*)=(\S*)$/', $argument, $matchList);
            [
                static::ARGUMENT_KEY   => $attribute,
                static::ARGUMENT_VALUE => $value,
            ] = $matchList;

            if (null === $attribute) {
                continue;
            }

            $result[$attribute] = $value;
        }

        return $result;
    }

    /**
     * Метод возвращает аргументы запроса.
     *
     * @return array
     */
    protected function getServerArgumentList(): array
    {
        $arguments = $_SERVER[static::SERVER_ARGUMENT_VALUE_KEY];
        array_shift($arguments);

        return (array)$arguments;
    }
}