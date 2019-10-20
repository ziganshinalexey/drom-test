<?php

declare(strict_types = 1);

namespace Core\migration\components;

use Core\BaseObject;
use Core\migration\interfaces\IMigration;
use Exception;

/**
 * Класс Migration реализует методы компонента миграций.
 */
class Migration extends BaseObject implements IMigration
{
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
     * @return static
     */
    public function setMigrationPath(string $value): self
    {
        $this->migrationPath = $value;

        return $this;
    }

    /**
     * Метод возвращает путь до папки с миграциями.
     *
     * @return string
     *
     * @throws Exception Если пути нет.
     */
    public function getMigrationPath(): string
    {
        if (null === $this->migrationPath) {
            throw new Exception('Путь до папки с миграциями не может быть пустым.');
        }

        return $this->migrationPath;
    }
}
