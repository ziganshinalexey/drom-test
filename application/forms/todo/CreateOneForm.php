<?php

declare(strict_types = 1);

namespace App\forms\todo;

use App\forms\todo\traits\WithAttributeTrait;
use App\traits\WithUserComponent;
use Core\form\BaseForm;
use Core\form\interfaces\IForm;
use Core\query\traits\WithQueryTrait;
use Core\result\interfaces\IDataResult;
use Exception;

/**
 * Класс CreateForm реализует методы формы.
 */
class CreateOneForm extends BaseForm implements IForm
{
    use WithAttributeTrait;
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

        $data         = $this->getInsertData();
        $insertResult = $this->getQuery()->insert($data);

        $id         = (int)$insertResult->getData()['id'] ?? null;
        $data['id'] = $id;
        $result->setData($data);

        return $result;
    }

    /**
     * Метод возвращает данные для добавления в БД.
     *
     * @return array
     *
     * @throws Exception Если компонент не зарегистирован.
     */
    protected function getInsertData(): array
    {
        $user = $this->getUserComponent()->getCurrentUser();

        return [
            'name'        => $this->getName(),
            'isCompleted' => $this->getIsCompleted(),
            'userId'      => isset($user['id']) ? (int)$user['id'] : null,
        ];
    }
}
