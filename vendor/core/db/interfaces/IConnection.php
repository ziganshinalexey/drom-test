<?php

declare(strict_types = 1);

namespace Core\db\interfaces;

use Core\result\interfaces\IDataResult;
use Core\result\interfaces\IWithDataResult;
use Exception;

/**
 * Интерфейс IConnection объявляет методы соединения с БД.
 */
interface IConnection extends IWithDataResult
{
    /**
     * Метод исполнения прямых запросов к БД.
     *
     * @param string $query Строка для БД.
     *
     * @return IDataResult
     *
     * @throws Exception Если что-то пошло не так с БД подключением.
     */
    public function execute(string $query): IDataResult;

    /**
     * Метод экранирует строку для MySQL.
     *
     * @param string $value Строка для экранизации.
     *
     * @return string
     */
    public function escapeString(string $value): string;

    /**
     * Метод возвращает идентификатор последней созданной записи.
     *
     * @return int|null
     */
    public function getLastInsertId(): ?int;
}
