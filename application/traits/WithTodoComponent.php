<?php

declare(strict_types = 1);

namespace App\traits;

use App\interfaces\todo\IComponent;
use Core\Core;
use Exception;

trait WithTodoComponent
{
    /**
     * Свойство содержит компонент.
     *
     * @var IComponent|null
     */
    protected $todoComponent;

    /**
     * Метод возвращает компонент.
     *
     * @return IComponent
     *
     * @throws Exception Если компонент не зарегистирован.
     */
    protected function getTodoComponent(): IComponent
    {
        if (null === $this->todoComponent) {
            $this->todoComponent = Core::getApplication()->getComponent(IComponent::COMPONENT_NAME);
        }

        return $this->todoComponent;
    }

    /**
     * Метод задает компонент.
     *
     * @param IComponent $value Новое значение.
     *
     * @return void
     */
    protected function setTodoComponent(IComponent $value): void
    {
        $this->todoComponent = $value;
    }
}
