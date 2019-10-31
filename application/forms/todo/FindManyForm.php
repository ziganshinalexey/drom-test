<?php

declare(strict_types = 1);

namespace App\forms\todo;

use App\traits\WithUserComponent;
use Core\form\BaseForm;
use Core\form\interfaces\IForm;
use Core\query\traits\WithQueryTrait;
use Core\result\interfaces\IDataResult;
use Exception;

/**
 * Класс FindForm реализует методы формы.
 */
class FindManyForm extends BaseForm implements IForm
{
    use WithQueryTrait;
    use WithUserComponent;
    /**
     * Свойство хранит признак выполнености.
     *
     * @var bool|null
     */
    protected $isCompleted;

    /**
     * Метод задает признак выполнености.
     *
     * @param bool|null $value Новое значение.
     *
     * @return void
     */
    public function setIsCompleted(?bool $value): void
    {
        $this->isCompleted = $value;
    }

    /**
     * Метод возвращает признак выполнености.
     *
     * @return int|null
     */
    public function getIsCompleted(): ?int
    {
        return null === $this->isCompleted ? null : (int)$this->isCompleted;
    }

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

        $condition = [];
        if (null !== $this->getIsCompleted()) {
            $condition['isCompleted'] = $this->getIsCompleted();
        }
        $userId = $this->getUserComponent()->getCurrentUser()['id'] ?? null;
        if (null === $userId) {
            return $result;
        }
        $condition['userId'] = $userId;

        $data = $this->getQuery()->all($condition)->getData();
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
                'name'        => (string)htmlspecialchars($todoData['name'] ?? ''),
                'isCompleted' => (bool)$todoData['isCompleted'] ?? null,
            ];
        }

        return $result;
    }
}
