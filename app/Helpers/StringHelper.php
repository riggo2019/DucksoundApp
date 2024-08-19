<?php

namespace App\Helpers;

use voku\helper\ASCII;
use getID3;

class StringHelper
{
    public static function convertToSlug($string)
    {
        // Chuyển đổi chuỗi thành chữ thường và loại bỏ các ký tự có dấu
        $string = ASCII::to_ascii($string);
        $string = mb_strtolower($string, 'UTF-8');

        // Thay thế khoảng trắng và ký tự đặc biệt bằng dấu gạch ngang
        $string = preg_replace('/[^\w\s]/', '', $string);
        $string = preg_replace('/\s+/', '-', $string);

        return $string;
    }
}
