<?php

namespace AppBundle\Enum;

abstract class Diet {
    const CARNIVOR = 1;
    const OTHERS = 2;

    public static function getPossibilitiesWithLabels()
    {
        return [
            static::CARNIVOR => 'Les vrais',
            static::OTHERS => 'Les autres'
        ];
    }

    public static function getPossibilities()
    {
        return array_keys(static::getPossibilitiesWithLabels());
    }
}
