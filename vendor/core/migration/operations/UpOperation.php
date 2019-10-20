<?php

declare(strict_types = 1);

namespace Core\migration\operations;

use Core\BaseObject;
use Core\Core;
use Core\migration\interfaces\IMigrationModel;
use Core\migration\interfaces\operations\IUpOperation;
use Exception;

/**
 * Класс UpOperation реализует методы операции.
 */
class UpOperation extends BaseObject implements IUpOperation
{
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
     * @return IUpOperation
     */
    public function setMigrationPath(string $value): IUpOperation
    {
        $this->migrationPath = $value;

        return $this;
    }

    /**
     * Метод исполнения операции.
     *
     * @return void
     *
     * @throws Exception
     */
    public function run(): void
    {
        foreach ($this->getMigrationList() as $migrationClass) {
            $migration = Core::createObject(['class' => $migrationClass]);

            if (! $migration instanceof IMigrationModel) {
                continue;
            }

            echo 'Сейчас для вас накатывается: ' . $migrationClass . PHP_EOL;
            $migration->up();
        }
    }

    /**
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
}
