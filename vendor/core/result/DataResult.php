<?php

declare(strict_types = 1);

namespace Core\result;

use Core\BaseObject;
use Core\result\interfaces\IDataResult;

/**
 * Класс DataResult для всех результатов в виде массивов.
 */
class DataResult extends BaseObject implements IDataResult
{
    /**
     * Свойство содержит данные результата.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Свойство содержит ошибки.
     *
     * @var array
     */
    protected $errorList = [];

    /**
     * Метод задает данные результата.
     *
     * @param array $value Новое значение.
     *
     * @return static
     */
    public function setData(array $value): IDataResult
    {
        $this->data = $value;

        return $this;
    }

    /**
     * Метод возвращает данные результата.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Метод задает ошибку.
     *
     * @param string $description Описание ошибки.
     * @param string $name        Название ошибки.
     *
     * @return static
     */
    public function addError(string $description, string $name = 'system'): IDataResult
    {
        $this->errorList = [$name => $description];

        return $this;
    }

    /**
     * Метод возвращает ошибки.
     *
     * @return array
     */
    public function getErrorList(): array
    {
        return $this->errorList;
    }

    /**
     * Метод возвращает признак отсутствия ошибок.
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return empty($this->getErrorList());
    }
}
