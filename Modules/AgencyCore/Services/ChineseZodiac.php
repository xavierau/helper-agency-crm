<?php
/**
 * A & A Creation Co.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    A & A Creation
 * @package
 * @Date        : 18/1/2021
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyCore\Services;


use Carbon\Carbon;

class ChineseZodiac
{
    public static function get(Carbon $birthDate): string
    {
        //生肖
        $zodiac = ['鼠', '牛', '虎', '兔', '龍', '蛇', '馬', '羊', '猴', '雞', '狗', '猪'];
        $zodiac = ['Rat', 'Ox', 'Tiger', 'Rabbit', 'Dragon', 'Snake', 'Horse', 'Goat', 'Monkey', 'Rooster', 'Dog', 'Pig'];
        //天干
        $tiangan = ['甲', '乙', '丙', '丁', '戊', '己', '庚', '辛', '壬', '癸'];
        //地支
        $dizhi = ['子', '丑', '寅', '卯', '辰', '巳', '午', '未', '申', '酉', '戌', '亥'];
        //tiangan
        //截取年份最后一位数
        $ganNum = substr($birthDate->year,
            -1);
        //天干计算法
        $ganNum > 3 ? $gan = $ganNum - 3 : $gan = $ganNum - 3 + 10;
        //dizhi
        //取模运算 得到 年份余数
        $diNum = fmod($birthDate->year,
            12);
        //地支计算法
        $diNum > 3 ? $zhi = $diNum - 3 : $zhi = $diNum - 3 + 12;

        return $zodiac[$zhi - 1];
        //return 干支纪年法和生肖
        //        return $tiangan[$gan - 1].$dizhi[$zhi - 1].'年 生肖'.$zodiac[$zhi - 1];
    }
}
