<?php

declare(strict_types = 1);

namespace Core\db\interfaces;

/**
 * Интерфейс IFactory объявляет методы компонента БД.
 */
interface IDatabase
{
    /**
     * Метод возвращает объект для соединения с БД.
     *
     * @return IConnection
     */
    public function getConnection(): IConnection;
}
