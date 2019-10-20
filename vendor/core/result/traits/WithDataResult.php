<?php

declare(strict_types = 1);

namespace Core\result\traits;

use Core\result\interfaces\IDataResult;
use Exception;

/**
 * Трэит WithDataResult добавляет свойство результата к классу.
 */
trait WithDataResult
{
    /**
     * Свойтсво содержит результат.
     *
     * @var IDataResult|null
     */
    protected $result;

    /**
     * Метод задает результат.
     *
     * @param IDataResult $value Новое значение.
     *
     * @return static
     */
    public function setResult(IDataResult $value)
    {
        $this->result = $value;

        return $this;
    }

    /**
     * Метод возвращает результат.
     *
     * @return IDataResult
     *
     * @throws Exception Если результат не задан.
     */
    public function getResult(): IDataResult
    {
        if (null === $this->result) {
            throw new Exception('Объект результата не может быть null.');
        }

        return $this->result;
    }
}
