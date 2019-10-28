<?php

declare(strict_types = 1);

namespace Core\form\interfaces;

use Core\result\interfaces\IDataResult;
use Core\result\interfaces\IWithDataResult;

/**
 * Интерфейс IForm объявляет методы базовой формы.
 */
interface IForm extends IWithDataResult
{
    /**
     * Метод реализует загрузку формы.
     *
     * @param array $data Входящие данные.
     *
     * @return bool
     */
    public function load(array $data): bool;

    /**
     * Метод реализует основное действие формы.
     *
     * @return IDataResult
     */
    public function run(): IDataResult;
}
