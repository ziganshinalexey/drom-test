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
 * Класс UpdateManyForm реализует методы формы.
 */
class UpdateManyForm extends BaseForm implements IForm
{
    use WithQueryTrait;
    use WithUserComponent;
    /**
     * Свойство хранит идентификатор.
     *
     * @var int|null
     */
    protected $isCompleted;

    /**
     * Метод задает идентификатор.
     *
     * @param int $value Новое значение.
     *
     * @return void
     */
    public function setIsCompleted(int $value): void
    {
        $this->isCompleted = $value;
    }

    /**
     * Метод возвращает идентификатор.
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
        $userId = $this->getUserComponent()->getCurrentUser()['id'] ?? null;

        return $this->getQuery()->update(['isCompleted' => $this->getIsCompleted()], ['userId' => $userId]);
    }
}
