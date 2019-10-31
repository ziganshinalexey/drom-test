<?php

declare(strict_types = 1);

namespace App\forms\todo;

use Core\form\BaseForm;
use Core\form\interfaces\IForm;
use Core\query\traits\WithQueryTrait;
use Core\result\interfaces\IDataResult;
use Core\user\traits\WithUserComponent;
use Exception;

/**
 * Класс RemoveManyForm реализует методы формы.
 */
class RemoveManyForm extends BaseForm implements IForm
{
    use WithQueryTrait;
    use WithUserComponent;

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

        $userId       = $this->getUserComponent()->getCurrentUser()['id'] ?? null;
        $removeResult = $this->getQuery()->delete([
            'isCompleted' => true,
            'userId'      => $userId,
        ]);
        $result->setData($removeResult->getData());

        return $result;
    }
}
