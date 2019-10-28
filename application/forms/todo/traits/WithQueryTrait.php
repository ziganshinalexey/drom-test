<?php

namespace App\forms\todo\traits;

use App\interfaces\todo\IQuery;

/**
 * Трэит WithQueryTrait добавляет объект запросов.
 */
trait WithQueryTrait
{
    /**
     * Свойство хранит объект запросов.
     *
     * @var IQuery|null
     */
    protected $query;

    /**
     * Метод задает объект запросов.
     *
     * @param IQuery $value Новое значение.
     *
     * @return void
     */
    public function setQuery(IQuery $value): void
    {
        $this->query = $value;
    }

    /**
     * Метод возвращает объект запросов.
     *
     * @return IQuery
     */
    public function getQuery(): IQuery
    {
        return $this->query;
    }
}