<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Domain\VO;

final class Identifier
{
    public function __construct(
        private string $id)
    {
    }

    public function get(): string
    {
        return $this->id;
    }
}
