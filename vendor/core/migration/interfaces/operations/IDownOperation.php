<?php

declare(strict_types = 1);

namespace Core\migration\interfaces\operations;

/**
 * Интерфейс IDownOperation объявляет методы операции.
 */
interface IDownOperation
{
    /**
     * Метод исполнения операции.
     *
     * @return void
     */
    public function run(): void;

    /**
     * Метод задает путь до папки с миграциями.
     *
     * @param string $value Новое значение.
     *
     * @return void
     */
    public function setMigrationPath(string $value): void;
}
