<?php

declare(strict_types = 1);

namespace App\interfaces\user;

use App\interfaces\user\forms\IFindOneForm;
use Core\form\interfaces\IForm;

/**
 * Интерфейс IFactory объявляет методы фабрики пользователей.
 */
interface IFactory
{
    /**
     * Метод создает форму поиска сущности.
     *
     * @return IForm
     */
    public function getLoginForm(): IForm;

    /**
     * Метод создает форму создания сущности.
     *
     * @return IForm
     */
    public function getCreateOneForm(): IForm;

    /**
     * Метод создает форму поиска одной сущности.
     *
     * @return IFindOneForm
     */
    public function getFindOneForm(): IFindOneForm;
}
