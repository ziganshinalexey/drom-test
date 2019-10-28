<?php

namespace Core\form;

use Core\BaseObject;
use Core\form\interfaces\IForm;
use Core\result\interfaces\IDataResult;
use Core\result\traits\WithDataResult;

/**
 * Класс BaseForm реализует методы базовой формы.
 */
abstract class BaseForm extends BaseObject implements IForm
{
    use WithDataResult;

    /**
     * Метод реализует загрузку формы.
     *
     * @param array $data Входящие данные.
     *
     * @return bool
     */
    public function load(array $data): bool
    {
        foreach ($data as $attributeName => $value) {
            if (property_exists($this, $attributeName)) {
                $this->$attributeName = $value;
            }
        }

        return true;
    }

    /**
     * Метод реализует основное действие формы.
     *
     * @return IDataResult
     */
    abstract public function run(): IDataResult;
}