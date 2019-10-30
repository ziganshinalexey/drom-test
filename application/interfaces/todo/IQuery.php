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
     * @param array $condition Условия выборки.
     *
     * @return IDataResult
     */
    public function all(array $condition = []): IDataResult;

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
     * @param array $data      Новое значение.
     * @param array $condition Условие удаления.
     *
     * @return IDataResult
     */
    public function update(array $data, array $condition = []): IDataResult;
}
