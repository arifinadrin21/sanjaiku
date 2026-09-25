<?php

namespace App\Helpers;

class BadWordFilter
{
    protected static array $badWords = [
        'anjing',
        'bangsat',
        'kontol',
        'memek',
        'tolol',
        'goblok',
        'bego',
        'idiot',
        'brengsek',
        'jancok',
        'asu',
        'kampret',
        'sialan',
        'tai',
        'monyet',
        'pantek',
        'ngentot',
        'pepek',
        'lonte',
        'pelacur',
        'bajingan',
        'basi',
        'bau',
        'banci',
        'sawit',
        'babi',
        'bajingan',
        'bangsat',
        'poke',
        'celeng',

    ];

    public static function containsBadWord(string $text): bool
    {
        $text = strtolower($text);

        foreach (self::$badWords as $word) {
            if (str_contains($text, $word)) {
                return true;
            }
        }

        return false;
    }
}