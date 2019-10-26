<?php

declare(strict_types = 1);

namespace Core\request\interfaces\components\console;

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
     * Метод возвращает параметры запроса.
     *
     * @return array
     */
    public function getParamList(): array;
}
