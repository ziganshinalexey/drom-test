<?php

declare(strict_types = 1);

namespace Core\migration\interfaces;

use Core\migration\interfaces\operations\IDownOperation;
use Core\migration\interfaces\operations\IUpOperation;

/**
 * Интерфейс IFactory объявляет методы фабрики миграций.
 */
interface IFactory
{
    /**
     * Метод возвращает операцию применения миграций.
     *
     * @return IUpOperation
     */
    public function getUpOperation(): IUpOperation;

    /**
     * Метод возвращает операцию отката миграций.
     *
     * @return IDownOperation
     */
    public function getDownOperation(): IDownOperation;
}
