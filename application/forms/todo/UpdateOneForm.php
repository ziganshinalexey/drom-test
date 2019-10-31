<?php

declare(strict_types = 1);

namespace App\forms\todo;

use App\forms\todo\traits\WithAttributeTrait;
use Core\form\BaseForm;
use Core\form\interfaces\IForm;
use Core\query\traits\WithQueryTrait;
use Core\result\interfaces\IDataResult;
use Core\user\traits\WithUserComponent;
use Exception;

/**
 * Класс UpdateForm реализует методы формы.
 */
class UpdateOneForm extends BaseForm implements IForm
{
    use WithAttributeTrait;
    use WithQueryTrait;
    use WithUserComponent;
    /**
     * Свойство хранит идентификатор.
     *
     * @var int|null
     */
    protected $id;

    /**
     * Метод задает идентификатор.
     *
     * @param int $value Новое значение.
     *
     * @return void
     */
    public function setId(int $value): void
    {
        $this->id = $value;
    }

    /**
     * Метод возвращает идентификатор.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return null === $this->id ? null : (int)$this->id;
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

        $userId = $this->getUserComponent()->getCurrentUser()['id'] ?? null;
        $data   = $this->getUpdateData();
        $this->getQuery()->update($data, [
            'id'     => $this->getId(),
            'userId' => $userId,
        ]);

        $data['id'] = $this->getId();
        $result->setData($data);

        return $result;
    }

    /**
     * Метод формирует данные для редактирования.
     *
     * @return array
     */
    protected function getUpdateData(): array
    {
        return [
            'name'        => $this->getName(),
            'isCompleted' => $this->getIsCompleted(),
        ];
    }
}
