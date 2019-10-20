<?php

declare(strict_types = 1);

namespace Core\migration\operations;

use Core\BaseObject;
use Core\migration\interfaces\operations\IDownOperation;

/**
 * Класс DownOperation реализует методы операции.
 */
class DownOperation extends BaseObject implements IDownOperation
{
    /**
     * Метод исполнения операции.
     *
     * @return void
     */
    public function run(): void
    {

    }
}
