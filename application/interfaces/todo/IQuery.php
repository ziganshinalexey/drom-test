<?php

declare(strict_types = 1);

namespace App\interfaces\todo;

use Core\result\interfaces\IDataResult;

/**
 * Интерфейс IQuery объявляет методы запросов.
 */
interface IQuery
{
    /**
     * Метод задает название таблицы.
     *
     * @param string $value Новое значение.
     *
     * @return void
     */
    public function setTableName(string $value): void;

    /**
     * Метод возвращает название таблицы.
     *
     * @return string
     */
    public function getTableName(): string;

    /**
     * Метод возвращает выборку из БД.
     *
     * @return IDataResult
     */
    public function all(): IDataResult;

    /**
     * Метод добавляет запись в БД.
     *
     * @param array $data Данные для вставки.
     *
     * @return IDataResult
     */
    public function insert(array $data): IDataResult;

    /**
     * Метод удаляет записи из БД.
     *
     * @param array $condition Условие удаления.
     *
     * @return IDataResult
     */
    public function delete(array $condition): IDataResult;

    /**
     * Метод удаляет записи из БД.
     *
     * @param array $condition Условие удаления.
     * @param array $data      Новое значение.
     *
     * @return IDataResult
     */
    public function update(array $condition, array $data): IDataResult;
}