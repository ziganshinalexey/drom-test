<?php

declare(strict_types = 1);

namespace Core\db\interfaces;

use Core\application\interfaces\IComponent;

/**
 * Интерфейс IFactory объявляет методы компонента БД.
 */
interface IDatabase extends IComponent
{
    public const COMPONENT_NAME = 'db';

    /**
     * Метод возвращает объект для соединения с БД.
     *
     * @return IConnection
     */
    public function getConnection(): IConnection;
}
