<?php

declare(strict_types = 1);

namespace Core\db\mysql;

use Core\db\interfaces\IConnection;
use Exception;
use mysqli;

/**
 * Класс Connection реализует подключение с БД.
 */
class Connection extends mysqli implements IConnection
{
    /**
     * Метод исполнения прямых запросов к БД.
     *
     * @param string $query Строка для БД.
     *
     * @return bool
     *
     * @throws Exception Если что-то пошло не так с БД подключением.
     */
    public function execute(string $query): bool
    {
        if ($this->connect_errno) {
            throw new Exception($this->connect_error);
        }

        $result = $this->query($query);

        if ($this->errno) {
            throw new Exception($this->error);
        }

        return $result;
    }
}
