<?php

declare(strict_types = 1);

namespace Core\db\interfaces;

use Exception;

/**
 * Интерфейс IConnection объявляет методы соединения с  БД.
 */
interface IConnection
{
    /**
     * Метод исполнения прямых запросов к БД.
     *
     * @param string $query Строка для БД.
     *
     * @return bool
     *
     * @throws Exception Если что-то пошло не так с БД подключением.
     */
    public function execute(string $query): bool;
}
