<?php

declare(strict_types = 1);

namespace Core\factory\traits;

use Core\factory\interfaces\IFactory;
use Exception;

/**
 * Трэит WithFactoryTrait подключает фабрику к классу.
 */
trait WithFactoryTrait
{
    /**
     * Свойство хранит объект фабрики.
     *
     * @var IFactory|null
     */
    protected $factory;

    /**
     * Метод задает объект фабрики.
     *
     * @param IFactory $value Новое значение.
     *
     * @return static
     */
    public function setFactory(IFactory $value)
    {
        $this->factory = $value;

        return $this;
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
        if (null === $this->factory) {
            throw new Exception('Объект фабрики отсутствует.');
        }
        return $this->factory;
    }
}
