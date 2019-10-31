<?php

declare(strict_types = 1);

namespace App\interfaces\user\forms;

use Core\form\interfaces\IForm;

/**
 * Интерфейс IFindOneForm объявляет методы поиска одной сущности.
 */
interface IFindOneForm extends IForm
{
    /**
     * Метод добавляет фильтры по ключу доступа.
     *
     * @param string $accessToken Ключ доступа.
     *
     * @return static
     */
    public function byAccessToken(string $accessToken): IFindOneForm;

    /**
     * Метод добавляет фильтры по идентификатору.
     *
     * @param int $id Идентификатор.
     *
     * @return static
     */
    public function byId(int $id): IFindOneForm;
}
