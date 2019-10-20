<?php

declare(strict_types = 1);

namespace Core\migration\operations;

use Core\BaseObject;
use Core\migration\interfaces\operations\IUpOperation;
use Core\result\traits\WithDataResult;

/**
 * Класс UpOperation реализует методы операции.
 */
class UpOperation extends BaseObject implements IUpOperation
{
    use WithDataResult;
}
