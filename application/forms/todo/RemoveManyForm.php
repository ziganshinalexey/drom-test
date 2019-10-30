<?php

declare(strict_types = 1);

namespace App\forms\todo;

use Core\form\BaseForm;
use Core\form\interfaces\IForm;
use Core\query\traits\WithQueryTrait;
use Core\result\interfaces\IDataResult;
use Exception;

/**
 * Класс RemoveManyForm реализует методы формы.
 */
class RemoveManyForm extends BaseForm implements IForm
{
    use WithQueryTrait;

    /**
     * Метод реализует основное действие формы.
     *
     * @return IDataResult
     *
     * @throws Exception
     */
    public function run(): IDataResult
    {
        $result = $this->getResult();

        $removeResult = $this->getQuery()->delete(['isCompleted' => true]);
        $result->setData($removeResult->getData());

        return $result;
    }
}
