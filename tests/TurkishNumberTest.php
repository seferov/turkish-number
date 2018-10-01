<?php

/*
 * (c) Farhad Safarov <https://farhadsafarov.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Seferov\TurkishNumber\Tests;

use PHPUnit\Framework\TestCase;
use Seferov\TurkishNumber\TurkishNumber;

class TurkishNumberTest extends TestCase
{
    /**
     * @dataProvider numberData
     *
     * @param $number
     * @param $spell
     */
    public function testSpell($number, $spell)
    {
        $this->assertSame($spell, TurkishNumber::spell($number));
    }

    public function testExceedMaxSupportedNumber()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('1000000000000000 is too big');
        TurkishNumber::spell(1000000000000000);
    }

    public function numberData()
    {
        return [
            [
                '1', 'bir',
            ],
            [
                '5', 'beş',
            ],
            [
                '10', 'on',
            ],
            [
                '20', 'yirmi',
            ],
            [
                '21', 'yirmi bir',
            ],
            [
                '43', 'kırk üç',
            ],
            [
                '100', 'yüz',
            ],
            [
                '101', 'yüz bir',
            ],
            [
                '111', 'yüz on bir',
            ],
            [
                '150', 'yüz elli',
            ],
            [
                '152', 'yüz elli iki',
            ],
            [
                '3233', 'üç bin iki yüz otuz üç',
            ],
            [
                '20127', 'yirmi bin yüz yirmi yedi',
            ],
            [
                '820127', 'sekiz yüz yirmi bin yüz yirmi yedi',
            ],
            [
                '1000000', 'bir milyon',
            ],
            [
                '1820127', 'bir milyon sekiz yüz yirmi bin yüz yirmi yedi',
            ],
            [
                '2820127', 'iki milyon sekiz yüz yirmi bin yüz yirmi yedi',
            ],
            [
                '11820127', 'on bir milyon sekiz yüz yirmi bin yüz yirmi yedi',
            ],
            [
                '1111820127', 'bir milyar yüz on bir milyon sekiz yüz yirmi bin yüz yirmi yedi',
            ],
            [
                '1000000000', 'bir milyar',
            ],
            [
                '1000000001', 'bir milyar bir',
            ],
            [
                '1000000000000', 'bir trilyon',
            ],
            [
                '999999999999999', 'dokuz yüz doksan dokuz trilyon dokuz yüz doksan dokuz milyar dokuz yüz doksan dokuz milyon dokuz yüz doksan dokuz bin dokuz yüz doksan dokuz',
            ],
        ];
    }
}
