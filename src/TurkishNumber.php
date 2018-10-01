<?php

/*
 * (c) Farhad Safarov <https://farhadsafarov.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Seferov\TurkishNumber;

class TurkishNumber
{
    const MAX_SUPPORTED_NUMBER = 999999999999999;

    /**
     * @internal
     */
    const BREAK_NUMBERS = [10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 1000, 1000000, 1000000000, 1000000000000];

    /**
     * @internal
     */
    const MAPPING = [
        0 => 'sıfır',
        1 => 'bir',
        2 => 'iki',
        3 => 'üç',
        4 => 'dört',
        5 => 'beş',
        6 => 'altı',
        7 => 'yedi',
        8 => 'sekiz',
        9 => 'dokuz',
        10 => 'on',
        20 => 'yirmi',
        30 => 'otuz',
        40 => 'kırk',
        50 => 'elli',
        60 => 'altmış',
        70 => 'yetmiş',
        80 => 'seksen',
        90 => 'doksan',
        100 => 'yüz',
        1000 => 'bin',
        1000000 => 'milyon',
        1000000000 => 'milyar',
        1000000000000 => 'trilyon',
    ];

    public static function spell($number)
    {
        $number = (int) $number;

        if ($number > self::MAX_SUPPORTED_NUMBER) {
            throw new \InvalidArgumentException($number.' is too big!');
        }

        $result = self::result($number);
        if (in_array($result, array_slice(self::MAPPING, 20))) {
            $result = 'bir '.$result;
        }

        return $result;
    }

    private static function result(int $number)
    {
        if (isset(self::MAPPING[$number])) {
            return self::MAPPING[$number];
        }

        $breakNumber = self::findBreakNumber($number);
        $breakNumberMultiplier = (int) floor($number/$breakNumber);
        $leftOver = $number - ($breakNumber * $breakNumberMultiplier);

        $components = [];
        if (1 !== $breakNumberMultiplier || $breakNumber > 10000) {
            $components[] = $breakNumberMultiplier;
        }
        $components[] = $breakNumber;
        if (0 !== $leftOver) {
            $components[] = $leftOver;
        }

        $result = [];
        foreach ($components as $component) {
            $result[] = self::result($component);
        }

        return implode(' ', $result);
    }

    private static function findBreakNumber(int $number)
    {
        $result = $number;
        foreach (self::BREAK_NUMBERS as $breakNumber) {
            if ($number > $breakNumber) {
                $result = $breakNumber;
                continue;
            }

            return $result;
        }

        return $result;
    }
}
