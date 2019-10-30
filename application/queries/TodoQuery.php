<?php

namespace App\queries;

use App\interfaces\todo\IQuery;
use Core\BaseObject;
use Core\db\traits\WithDatabaseComponent;
use Core\result\interfaces\IDataResult;
use Exception;

/**
 * Класс TodoQuery реализует методы запросов.
 */
class TodoQuery extends BaseObject implements IQuery
{
    use WithDatabaseComponent;
    protected const UPDATE_TEMPLATE = '';
    /**
     * Свойтсво хранит название таблицы.
     *
     * @var string|null
     */
    protected $tableName;

    /**
     * Метод удаляет записи из БД.
     *
     * @param array $data      Новое значение.
     * @param array $condition Условие удаления.
     *
     * @return IDataResult
     *
     * @throws Exception
     */
    public function update(array $data, array $condition = []): IDataResult
    {
        $connection = $this->getDatabaseComponent()->getConnection();

        $conditionList = [];
        foreach ($condition as $columnName => $value) {
            $columnName = sprintf('`%s`', $connection->escapeString($columnName));
            $value      = is_string($value) ? sprintf('"%s"', $connection->escapeString($value)) : $value;

            $conditionList[] = sprintf('%s = %s', $columnName, $value);
        }

        $dataList = [];
        foreach ($data as $columnName => $value) {
            $columnName = sprintf('`%s`', $connection->escapeString($columnName));
            $value      = is_string($value) ? sprintf('"%s"', $connection->escapeString($value)) : $value;

            $dataList[] = sprintf('%s = %s', $columnName, $value);
        }

        if (empty($dataList)) {
            throw new Exception('Список данных пуст.');
        }

        $conditionList = empty($conditionList) ? 1 : implode(' and ', $conditionList);
        $dataList      = implode(',', $dataList);
        $sql           = sprintf('update `%s` set %s where %s', $this->getTableName(), $dataList, $conditionList);

        return $connection->execute($sql);
    }

    /**
     * Метод удаляет записи из БД.
     *
     * @param array $condition Условие удаления.
     *
     * @return IDataResult
     *
     * @throws Exception
     */
    public function delete(array $condition): IDataResult
    {
        $connection = $this->getDatabaseComponent()->getConnection();

        $conditionList = [];
        foreach ($condition as $columnName => $value) {
            $columnName = sprintf('`%s`', $connection->escapeString($columnName));
            $value      = is_string($value) ? sprintf('"%s"', $connection->escapeString($value)) : $value;

            $conditionList[] = sprintf('%s = %s', $columnName, $value);
        }

        if (empty($conditionList)) {
            throw new Exception('Список данных пуст.');
        }

        $conditionList = implode(' and ', $conditionList);
        $sql           = sprintf('delete from `%s` where (%s)', $this->getTableName(), $conditionList);

        return $connection->execute($sql);
    }

    /**
     * Метод добавляет запись в БД.
     *
     * @param array $data Данные для вставки.
     *
     * @return IDataResult
     *
     * @throws Exception
     */
    public function insert(array $data): IDataResult
    {
        $connection     = $this->getDatabaseComponent()->getConnection();
        $columnNameList = [];
        $valueList      = [];
        foreach ($data as $columnName => $value) {
            $columnNameList[] = sprintf('`%s`', $connection->escapeString($columnName));
            $valueList[]      = is_string($value) ? sprintf('"%s"', $connection->escapeString($value)) : $value;
        }

        if (empty($columnNameList) || empty($valueList)) {
            throw new Exception('Список данных пуст.');
        }

        $columnNameList = implode(',', $columnNameList);
        $valueList      = implode(',', $valueList);
        $sql            = sprintf('insert into `%s` (%s) values (%s)', $this->getTableName(), $columnNameList, $valueList);
        $result         = $connection->execute($sql);

        if ($result->isSuccess() && isset($result->getData()['success'])) {
            $result->setData(['id' => $connection->getLastInsertId()]);
        }

        return $result;
    }

    /**
     * Метод возвращает выборку из БД.
     *
     * @param array $condition Условия выборки.
     *
     * @return IDataResult
     *
     * @throws Exception
     */
    public function all($condition = []): IDataResult
    {
        $connection = $this->getDatabaseComponent()->getConnection();

        $conditionList = [];
        foreach ($condition as $columnName => $value) {
            $columnName = sprintf('`%s`', $connection->escapeString($columnName));
            $value      = is_string($value) ? sprintf('"%s"', $connection->escapeString($value)) : $value;

            $conditionList[] = sprintf('%s = %s', $columnName, $value);
        }

        $conditionList = empty($conditionList) ? 1 : implode(' and ', $conditionList);
        $sql           = sprintf('select * from `%s` where %s', $this->getTableName(), $conditionList);

        return $connection->execute($sql);
    }

    /**
     * Метод задает название таблицы.
     *
     * @param string $value Новое значение.
     *
     * @return void
     */
    public function setTableName(string $value): void
    {
        $this->tableName = $value;
    }

    /**
     * Метод возвращает название таблицы.
     *
     * @return string
     *
     * @throws Exception
     */
    public function getTableName(): string
    {
        if (null === $this->tableName) {
            throw new Exception('Название таблицы отсутствует.');
        }

        return $this->tableName;
    }
}
