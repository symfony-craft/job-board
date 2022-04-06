<?php

declare(strict_types=1);

namespace SymfonyCraft\JobBoard\Tests\TestHelper;

final class TestHelper
{
    public function stringToArray(string $string): array
    {
        return array_map(fn (string $item) => trim($item), explode(',', $string));
    }

    public function toMap(array $array, string $key): array
    {
        $arrayMap = [];
        foreach ($array as $item) {
            $arrayMap[$item[$key]] = $item;
        }

        return $arrayMap;
    }
}
