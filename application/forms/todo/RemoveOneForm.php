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
 * Класс RemoveForm реализует методы формы.
 */
class RemoveOneForm extends BaseForm implements IForm
{
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

        $userId       = $this->getUserComponent()->getCurrentUser()['id'] ?? null;
        $removeResult = $this->getQuery()->delete([
            'id'     => $this->getId(),
            'userId' => $userId,
        ]);
        $result->setData($removeResult->getData());

        return $result;
    }
}
