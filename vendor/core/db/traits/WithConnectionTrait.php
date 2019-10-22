<?php

declare(strict_types = 1);

namespace Core\db\traits;

use Core\Core;
use Core\db\interfaces\IConnection;
use Exception;

/**
 * Trait WithConnectionTrait Подключает соединение к БД.
 */
trait WithConnectionTrait
{
    /**
     * Свойство хранит соединение с БД.
     *
     * @var IConnection|null
     */
    protected $connection;

    /**
     * Метод возвращает соединение с БД.
     *
     * @return IConnection
     *
     * @throws Exception
     */
    public function getConnection(): IConnection
    {
        if (null === $this->connection) {
            $this->connection = Core::getApplication()->getDb()->getConnection();
        }

        return $this->connection;
    }

    /**
     * Метод задает соединение с БД.
     *
     * @param IConnection $value новое значение.
     *
     * @return static
     */
    public function setConnection(IConnection $value)
    {
        $this->connection = $value;

        return $this;
    }
}
