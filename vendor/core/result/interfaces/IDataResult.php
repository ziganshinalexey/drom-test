<?php

namespace Core\result\interfaces;

/**
 * Интерфейс IDataResult для всех результатов в виде массивов.
 */
interface IDataResult
{
    /**
     * Метод задает данные результата.
     *
     * @param array $value Новое значение.
     *
     * @return static
     */
    public function setData(array $value): IDataResult;

    /**
     * Метод возвращает данные результата.
     *
     * @return array
     */
    public function getData(): array;

    /**
     * Метод задает ошибку.
     *
     * @param string $description Описание ошибки.
     * @param string $name        Название ошибки.
     *
     * @return static
     */
    public function addError(string $description, string $name = 'system'): IDataResult;

    /**
     * Метод возвращает ошибки.
     *
     * @return array
     */
    public function getErrorList(): array;

    /**
     * Метод возвращает признак отсутствия ошибок.
     *
     * @return bool
     */
    public function isSuccess(): bool;
}
