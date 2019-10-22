<?php

declare(strict_types = 1);

namespace Core\db\interfaces;

use Core\result\interfaces\IDataResult;
use Core\result\interfaces\IWithDataResult;
use Exception;

/**
 * Интерфейс IConnection объявляет методы соединения с БД.
 */
interface IConnection extends IWithDataResult
{
    /**
     * Метод исполнения прямых запросов к БД.
     *
     * @param string $query Строка для БД.
     *
     * @return IDataResult
     *
     * @throws Exception Если что-то пошло не так с БД подключением.
     */
    public function execute(string $query): IDataResult;
}
