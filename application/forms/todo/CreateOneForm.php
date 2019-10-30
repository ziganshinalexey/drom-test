<?php

declare(strict_types = 1);

namespace App\forms\todo;

use App\forms\todo\traits\WithAttributeTrait;
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
     */
    protected function getInsertData(): array
    {
        return [
            'name'        => $this->getName(),
            'isCompleted' => $this->getIsCompleted(),
        ];
    }
}
