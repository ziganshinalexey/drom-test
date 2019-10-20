<?php

declare(strict_types = 1);

namespace Core\migration\operations;

use Core\BaseObject;
use Core\migration\interfaces\operations\IDownOperation;
use Core\result\traits\WithDataResult;

/**
 * Класс DownOperation реализует методы операции.
 */
class DownOperation extends BaseObject implements IDownOperation
{
    use WithDataResult;
}
