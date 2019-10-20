<?php

namespace Core\result\interfaces;

use Exception;

/**
 * Интерфейс IWithDataResult для всех результатов в виде массивов.
 */
interface IWithDataResult
{
    /**
     * Метод задает результат.
     *
     * @param IDataResult $value Новое значение.
     *
     * @return static
     */
    public function setResult(IDataResult $value);

    /**
     * Метод возвращает результат.
     *
     * @return IDataResult
     *
     * @throws Exception Если результат не задан.
     */
    public function getResult(): IDataResult;
}
