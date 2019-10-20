<?php

declare(strict_types = 1);

namespace Core\migration\components;

use Core\BaseObject;
use Core\factory\traits\WithFactoryTrait;
use Core\migration\interfaces\IFactory;
use Core\migration\interfaces\IMigration;
use Core\migration\interfaces\operations\IDownOperation;
use Core\migration\interfaces\operations\IUpOperation;
use Exception;

/**
 * Класс Migration реализует методы компонента миграций.
 */
class Migration extends BaseObject implements IMigration
{
    use WithFactoryTrait {
        WithFactoryTrait::getFactory as getFactoryFromTrait;
    }

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

    /**
     * Метод возвращает операцию применения миграций.
     *
     * @return IUpOperation
     *
     * @throws Exception Если класс фабрики отсутствует.
     */
    public function up(): IUpOperation
    {
        $operation = $this->getFactory()->getUpOperation();
        $operation->setMigrationPath($this->getMigrationPath());

        return $operation;
    }

    /**
     * Метод возвращает операцию применения миграций.
     *
     * @return IDownOperation
     *
     * @throws Exception Если класс фабрики отсутствует.
     */
    public function down(): IDownOperation
    {
        $operation = $this->getFactory()->getDownOperation();

        return $operation;
    }

    /**
     * Метод возвращает объект фабрики.
     *
     * @return IFactory
     *
     * @throws Exception Если класс фабрики отсутствует.
     */
    protected function getFactory(): IFactory
    {
        /* @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->getFactoryFromTrait();
    }
}
