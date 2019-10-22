<?php

declare(strict_types = 1);

namespace Core\db\interfaces;

/**
 * Интерфейс IWithConnection объявляет методы соединения с БД.
 */
interface IWithConnection
{
    /**
     * Метод возвращает соединение с БД.
     *
     * @return IConnection
     */
    public function getConnection(): IConnection;

    /**
     * Метод задает соединение с БД.
     *
     * @param IConnection $value новое значение.
     *
     * @return static
     */
    public function setConnection(IConnection $value);
}
