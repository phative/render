<?php

declare(strict_types=1);

namespace Phative\Render\State;

use Tkui\Widgets\Common\ValueInVariable;

/**
 * @property $value
 */
class Value
{
    private ?ValueInVariable $valueInVariable = null;

    public function __construct(public readonly mixed $initial = null)
    {}

    public function attach(ValueInVariable $valueInVariable): void
    {
        $this->valueInVariable = $valueInVariable;
        $this->value = $this->initial;
    }

    public function __get(string $name): mixed
    {
        if (null === $this->valueInVariable) {
            return null;
        }

        return call_user_func([$this->valueInVariable, 'getValue']);
    }

    public function __set(string $name, mixed $value): void
    {
        if (null === $this->valueInVariable) {
            return;
        }

        call_user_func([$this->valueInVariable, 'setValue']);
    }

    public function __toString(): string
    {
        if (null === $this->value) {
            return '';
        }

        return $this->value;
    }
}
