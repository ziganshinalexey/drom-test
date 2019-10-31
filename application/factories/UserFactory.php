<?php

declare(strict_types = 1);

namespace App\factories;

use App\interfaces\user\forms\IFindOneForm;
use App\interfaces\user\IFactory;
use Core\factory\Factory;
use Core\form\interfaces\IForm;
use Exception;

/**
 * Класс UserFactory реализует методы фабрики действий.
 */
class UserFactory extends Factory implements IFactory
{
    public const LOGIN_FORM      = 'loginForm';
    public const CREATE_ONE_FORM = 'createOneForm';
    public const FIND_ONE_FORM   = 'findOneForm';

    /**
     * Метод создает форму поиска сущности.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function getLoginForm(): IForm
    {
        return $this->getInstance(static::LOGIN_FORM);
    }

    /**
     * Метод создает форму создания сущности.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function getCreateOneForm(): IForm
    {
        return $this->getInstance(static::CREATE_ONE_FORM);
    }

    /**
     * Метод создает форму поиска одной сущности.
     *
     * @return IFindOneForm
     *
     * @throws Exception
     */
    public function getFindOneForm(): IFindOneForm
    {
        return $this->getInstance(static::FIND_ONE_FORM);
    }
}
