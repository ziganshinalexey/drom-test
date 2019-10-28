<?php

declare(strict_types = 1);

namespace App\forms\todo;

use App\forms\todo\traits\WithAttributeTrait;
use App\forms\todo\traits\WithQueryTrait;
use Core\form\BaseForm;
use Core\form\interfaces\IForm;
use Core\result\interfaces\IDataResult;
use Exception;

/**
 * Класс UpdateForm реализует методы формы.
 */
class UpdateOneForm extends BaseForm implements IForm
{
    use WithAttributeTrait;
    use WithQueryTrait;
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

        $data = $this->getUpdateData();
        $this->getQuery()->update(['id' => $this->getId()], $data);

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
