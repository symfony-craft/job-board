<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Domain\VO;

final class Email
{
    public function __construct(
        private string $value
    ) {
    }

    public function get(): string
    {
        return $this->value;
    }
}
