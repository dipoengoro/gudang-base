<?php

namespace Dipoengoro\GudangBase\Util;

class Input
{
    static function input(string $info): string
    {
        echo "$info: ";
        $result = fgets(STDIN);
        return trim(strtolower($result));
    }
}
