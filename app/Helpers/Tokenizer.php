<?php

namespace App\Helpers;

use Illuminate\Support\Str;

/**
 * Класс хелпера генерации "уникальных" токенов
 * Токены имеют длину 60 символов в формате base62
 *
 * Class Tokenizer
 * @package App\Helpers
 */
class Tokenizer
{
    /**
     * Генерирует "уникальных" токен.
     *
     * Формат возвращаемой строки base62.
     * Длинна 60 символов.
     *
     * @return string
     */
    public static function generate()
    {
        $uid = uniqid('', true);
        $hex = substr($uid, 0, 14);
        $dec = substr($uid, 15);
        $res = base_convert($hex, 16, 36) . base_convert($dec, 10, 36);
        $arr = str_split($res);
        array_walk($arr, function(&$val) {
            if (mt_rand(0, 1)) {
                $val = strtoupper($val);
            }
        });
        $uniqid = implode('', $arr);
        $ranlen = 60 - strlen($uniqid);
        $prefix = Str::random($ranlen);

        return $prefix.$uniqid;
    }
}
