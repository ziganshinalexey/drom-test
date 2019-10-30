<?php

declare(strict_types = 1);

namespace App\traits;

use App\interfaces\user\IComponent;
use Core\Core;
use Exception;

trait WithUserComponent
{
    /**
     * Свойство содержит компонент.
     *
     * @var IComponent|null
     */
    protected $userComponent;

    /**
     * Метод возвращает компонент.
     *
     * @return IComponent
     *
     * @throws Exception Если компонент не зарегистирован.
     */
    protected function getUserComponent(): IComponent
    {
        if (null === $this->userComponent) {
            $this->userComponent = Core::getApplication()->getComponent(IComponent::COMPONENT_NAME);
        }

        return $this->userComponent;
    }

    /**
     * Метод задает компонент.
     *
     * @param IComponent $value Новое значение.
     *
     * @return void
     */
    protected function setUserComponent(IComponent $value): void
    {
        $this->userComponent = $value;
    }
}
