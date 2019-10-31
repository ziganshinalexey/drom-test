<?php

declare(strict_types = 1);

namespace Core\user\forms;

use App\interfaces\user\forms\IFindOneForm;
use Core\form\BaseForm;
use Core\query\traits\WithQueryTrait;
use Core\result\interfaces\IDataResult;
use Exception;

/**
 * Класс FindOneForm реализует методы формы.
 */
class FindOneForm extends BaseForm implements IFindOneForm
{
    use WithQueryTrait;
    /**
     * Свойство содержит фильтрю
     *
     * @var array
     */
    protected $filter = [];

    /**
     * Метод реализует основное действие формы.
     *
     * @return IDataResult
     *
     * @throws Exception
     */
    public function run(): IDataResult
    {
        $data = $this->getQuery()->all($this->filter)->getData();
        $user = array_shift($data);

        if (null !== $user) {
            $this->getResult()->setData($user);
        }

        return $this->getResult();
    }

    /**
     * Метод добавляет фильтры по ключу доступа.
     *
     * @param string $accessToken Ключ доступа.
     *
     * @return static
     *
     * @throws Exception
     */
    public function byAccessToken(string $accessToken): IFindOneForm
    {
        $this->filter['accessToken'] = $accessToken;

        return $this;
    }

    /**
     * Метод добавляет фильтры по идентификатору.
     *
     * @param int $id Идентификатор.
     *
     * @return static
     *
     * @throws Exception
     */
    public function byId(int $id): IFindOneForm
    {
        $this->filter['id'] = $id;

        return $this;
    }
}
