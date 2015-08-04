<?php

namespace Data\Field;

use SplSubject;
use SplObserver;
use Data\Type\Type;
use SplObjectStorage;

use InvalidArgumentException;

abstract class Field implements SplObserver, SplSubject
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Type
     */
    protected $data;

    /**
     * @var mixed
     */
    protected $default;

    /**
     * @var bool
     */
    protected $nullable;

    /**
     * @var SplObjectStorage
     */
    protected $observers;

    /**
     * @param string $name
     * @param Type   $data
     * @param bool   $nullable
     */
    public function __construct($name, Type $data, $nullable)
    {
        if (! is_string($name) || strlen($name) < 1) {
            throw new InvalidArgumentException('Name must be string, at least one character long');
        }

        if (! is_bool($nullable)) {
            throw new InvalidArgumentException('Nullable must be bool');
        }

        $this->name = $name;
        $this->data = $data;
        $this->nullable = $nullable;

        if (! $this->getData()->isNull()) {
            $this->check();
            $this->default = $this->getData()->value();
        }
        $this->getData()->attach($this);
    }

    /**
     * Check the value of the data when it's changing
     */
    abstract protected function check();

    /**
     * Setter for the data instance
     *
     * @param mixed $value
     */
    public function set($value)
    {
        $this->getData()->set($value);
    }

    /**
     * Data instance getter
     *
     * @return mixed
     */
    public function value()
    {
        return $this->getData()->value();
    }

    /**
     * Return the name property
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return the data instance
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Return the default property
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Observe the change of the data
     *
     * @param SplSubject $subject
     */
    public function update(SplSubject $subject)
    {
        if (! $subject->isNull()) {
            $this->check();
        } elseif (! $this->isNullable()) {
            $subject->set($this->getDefault());
        }

        $this->notify();
    }

    /**
     * Is this field nullable?
     *
     * @return bool
     */
    public function isNullable()
    {
        return $this->nullable === true;
    }

    /**
     * @see SplObserver
     */
    final public function attach(SplObserver $observer)
    {
        if ($this->observers === null) {
            $this->observers = new SplObjectStorage();
        }

        $this->observers->attach($observer);
    }

    /**
     * @see SplObserver
     */
    final public function detach(SplObserver $observer)
    {
        if ($this->observers !== null) {
            $this->observers->detach($observer);
        }
    }

    /**
     * @see SplObserver
     */
    final public function notify()
    {
        if ($this->observers !== null) {
            foreach ($this->observers as $observer) {
                $observer->update($this);
            }
        }
    }

    /**
     * Clone the data instance and attach the cloned Field
     */
    public function __clone()
    {
        $this->data = clone $this->getData();
        $this->getData()->attach($this);
    }

    /**
     * Return the data instance when converted to string
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getData();
    }
}
