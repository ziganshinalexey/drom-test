<?php

declare(strict_types = 1);

namespace Core\user\components;

use App\interfaces\user\forms\IFindOneForm;
use App\interfaces\user\IComponent;
use App\interfaces\user\IFactory;
use Core\BaseObject;
use Core\factory\traits\WithFactoryTrait;
use Core\form\interfaces\IForm;
use Core\request\traits\web\WithRequestComponent;
use Exception;

/**
 * Класс UserComponent реализует методы работы с пользователями.
 */
class UserComponent extends BaseObject implements IComponent
{
    use WithRequestComponent;
    use WithFactoryTrait {
        WithFactoryTrait::getFactory as getFactoryFromTrait;
    }

    public const TOKEN_HEADER_NAME = 'x-access-token';
    /**
     * Свойство содержит текущего пользователя.
     *
     * @var
     */
    protected $currentUser;

    /**
     * Метод возвращает форму поиска.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function login(): IForm
    {
        return $this->getFactory()->getLoginForm();
    }

    /**
     * Метод возвращает форму создания.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function createOne(): IForm
    {
        return $this->getFactory()->getCreateOneForm();
    }

    /**
     * Метод возвращает форму поиска одной сущности.
     *
     * @return IFindOneForm
     *
     * @throws Exception
     */
    public function findOne(): IFindOneForm
    {
        return $this->getFactory()->getFindOneForm();
    }

    /**
     * Метод возвращает текущего пользователя.
     *
     * @return array|null
     *
     * @throws Exception Если компонент не зарегистирован.
     */
    public function getCurrentUser(): ?array
    {
        if (null == $this->currentUser) {
            $token = (string)$this->getRequestComponent()->getHeaderByName(static::TOKEN_HEADER_NAME);

            $result            = $this->findOne()->byAccessToken($token)->run();
            $this->currentUser = $result->getData();
        }

        return null === $this->currentUser ? null : $this->currentUser;
    }

    /**
     * Метод переопределяет метод трейта для автокомплита.
     *
     * @return IFactory
     *
     * @throws Exception
     */
    protected function getFactory(): IFactory
    {
        /* @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->getFactoryFromTrait();
    }
}
