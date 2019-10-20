<?php

declare(strict_types = 1);

namespace Core\migration\interfaces;

/**
 * Интерфейс IMigrationModel объявляет методы миграции.
 */
interface IMigrationModel
{
    /**
     * Метод накатывает миграцию.
     *
     * @return void
     */
    public function up(): void;

    /**
     * Метод откатывает миграцию.
     *
     * @return void
     */
    public function down(): void;
}
