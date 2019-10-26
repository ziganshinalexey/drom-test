<?php

declare(strict_types = 1);

namespace Core\migration\operations;

use Core\BaseObject;
use Core\db\traits\WithDatabaseComponent;
use Core\migration\interfaces\IMigration;
use Exception;

/**
 * Класс BaseOperation реализует базовые методы для операций.
 */
class BaseOperation extends BaseObject
{
    use WithDatabaseComponent;

    protected const MIGRATE_CLASS = 1;
    protected const MIGRATE_DATE  = 2;
    protected const MIGRATE_TIME  = 3;

    /**
     * Свойство содержит путь до папки с миграциями.
     *
     * @var string|null
     */
    protected $migrationPath;

    /**
     * Метод задает путь до папки с миграциями.
     *
     * @param string $value Новое значение.
     *
     * @return void
     */
    public function setMigrationPath(string $value): void
    {
        $this->migrationPath = $value;
    }

    /**
     * Метод возвращает список миграций.
     *
     * @throws Exception
     */
    protected function getMigrationList()
    {
        $migrationPath = $this->getMigrationPath();

        $fileList = scandir($migrationPath);
        $result   = [];
        foreach ($fileList as $file) {
            if (! preg_match('/^(m([0-9]{6})_([0-9]{6})\S*).php$/', $file, $matchList)) {
                continue;
            }

            // @todo: не уверен что это безопастно.
            /* @noinspection PhpIncludeInspection */
            require_once $migrationPath . DIRECTORY_SEPARATOR . $file;
            $result[$matchList[static::MIGRATE_DATE] . $matchList[static::MIGRATE_TIME]] = $matchList[static::MIGRATE_CLASS];
        }

        ksort($result);

        return $result;
    }

    /**
     * Метод возвращает путь до папки с миграциями.
     *
     * @return string
     *
     * @throws Exception Если пути нет.
     */
    protected function getMigrationPath(): string
    {
        if (null === $this->migrationPath) {
            throw new Exception('Путь до папки с миграциями не может быть пустым.');
        }

        if (! is_dir($this->migrationPath) || ! is_readable($this->migrationPath)) {
            throw new Exception('Папка с миграциями не создана или не читается.');
        }

        return $this->migrationPath;
    }

    /**
     * Метод удаляет запись миграции из таблицы.
     *
     * @param string $dateTime Время когда была создана миграция.
     *
     * @return bool
     *
     * @throws Exception
     */
    protected function removeAppliedMigration(string $dateTime)
    {
        $sql = 'delete from `' . IMigration::MIGRATION_TABLE_NAME . '` where `id`=' . $dateTime;

        $result = $this->getDatabaseComponent()->getConnection()->execute($sql);

        return $result->isSuccess();
    }

    /**
     * Метод добавляет запись с миграцией в таблицу.
     *
     * @param string $dateTime  Время когда была создана миграция.
     * @param string $className Название миграции.
     *
     * @return bool
     *
     * @throws Exception
     */
    protected function insertAppliedMigration(string $dateTime, string $className)
    {
        $sql = 'insert into `' . IMigration::MIGRATION_TABLE_NAME . '` (
            `id`,
            `name`
        ) values (
            \'' . $dateTime . '\',
            \'' . $className . '\'
        )';

        $result = $this->getDatabaseComponent()->getConnection()->execute($sql);

        return $result->isSuccess();
    }

    /**
     * Метод возвращает все миграции которые применили.
     *
     * @throws Exception
     *
     * @return array
     */
    protected function getAppliedMigration(): array
    {
        if (! $this->migrationTableExists() && ! $this->createMigrationTable()) {
            throw new Exception('Таблица с миграциями не существует или не может быть создана.');
        }

        $sql = 'select * from `' . IMigration::MIGRATION_TABLE_NAME . '`';

        $result = $this->getDatabaseComponent()->getConnection()->execute($sql);

        return $result->getData();
    }

    /**
     * Метод проверяет наличие таблицы с миграциями.
     *
     * @return bool
     *
     * @throws Exception
     */
    protected function migrationTableExists(): bool
    {
        $sql = 'show tables like "' . IMigration::MIGRATION_TABLE_NAME . '"';

        $data = $this->getDatabaseComponent()->getConnection()->execute($sql)->getData();

        return ! empty($data);
    }

    /**
     * Метод создает таблицу с миграциями.
     *
     * @return bool
     *
     * @throws Exception
     */
    protected function createMigrationTable()
    {
        $sql = 'create table `' . IMigration::MIGRATION_TABLE_NAME . '` (
            `id` varchar(12) primary key,
            `name` varchar(255) not null
        )';

        $result = $this->getDatabaseComponent()->getConnection()->execute($sql);

        return $result->isSuccess();
    }
}
