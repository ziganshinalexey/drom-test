<?php

declare(strict_types = 1);

namespace App\forms\todo;

use Core\form\BaseForm;
use Core\form\interfaces\IForm;
use Core\result\interfaces\IDataResult;
use Exception;

/**
 * Класс CreateOneForm реализует методы формы.
 */
class CreateOneForm extends BaseForm implements IForm
{
    /**
     * Метод реализует основное действие формы.
     *
     * @return IDataResult
     *
     * @throws Exception
     */
    public function run(): IDataResult
    {

    }
}
