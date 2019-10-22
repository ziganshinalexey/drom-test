<?php

declare(strict_types = 1);

namespace Core\db\mysql;

use Core\db\interfaces\IConnection;
use Core\result\interfaces\IDataResult;
use Core\result\traits\WithDataResult;
use Exception;
use mysqli;
use mysqli_result;

/**
 * Класс Connection реализует подключение с БД.
 */
class Connection extends mysqli implements IConnection
{
    use WithDataResult;

    /**
     * Метод исполнения прямых запросов к БД.
     *
     * @param string $query Строка для БД.
     *
     * @return IDataResult
     *
     * @throws Exception Если что-то пошло не так с БД подключением.
     */
    public function execute(string $query): IDataResult
    {
        $result = $this->getResult();

        if ($this->connect_errno) {
            throw new Exception($this->connect_error);
        }

        $data = $this->query($query);

        if ($this->errno) {
            throw new Exception($this->error);
        }

        if ($data instanceof mysqli_result) {
            $arrayData = (array)$data->fetch_all(MYSQLI_ASSOC);
            $result->setData($arrayData);
        }

        return $result;
    }
}
