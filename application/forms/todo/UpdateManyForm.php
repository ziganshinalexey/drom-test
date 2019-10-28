<?php

declare(strict_types = 1);

namespace App\forms\todo;

use App\forms\todo\traits\WithQueryTrait;
use Core\form\BaseForm;
use Core\form\interfaces\IForm;
use Core\result\interfaces\IDataResult;
use Exception;

/**
 * Класс UpdateManyForm реализует методы формы.
 */
class UpdateManyForm extends BaseForm implements IForm
{
    use WithQueryTrait;
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
        $result = $this->getResult();

        $this->getQuery()->update(['isCompleted' => 1], ['isCompleted' => 0]);
        $this->getQuery()->update(['isCompleted' => 0], ['isCompleted' => $this->getIsCompleted()]);

        return $result;
    }
}
