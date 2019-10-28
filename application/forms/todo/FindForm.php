<?php

declare(strict_types = 1);

namespace App\forms\todo;

use App\forms\todo\traits\WithQueryTrait;
use Core\form\BaseForm;
use Core\form\interfaces\IForm;
use Core\result\interfaces\IDataResult;
use Exception;

/**
 * Класс FindForm реализует методы формы.
 */
class FindForm extends BaseForm implements IForm
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

        $data = $this->getQuery()->all()->getData();
        $data = $this->prepareData($data);
        $result->setData($data);

        return $result;
    }

    /**
     * Метод типизирует данные.
     *
     * @param array $data Данные из query.
     *
     * @return array
     */
    protected function prepareData(array $data): array
    {
        $result = [];

        foreach ($data as $todoData) {
            $result[] = [
                'id'          => (int)$todoData['id'] ?? null,
                'name'        => (string)$todoData['name'] ?? null,
                'isCompleted' => (bool)$todoData['isCompleted'] ?? null,
            ];
        }

        return $result;
    }
}
