<?php

namespace App\Filter;

class IsBlank
{
    public static function validate($value):bool {
        if($value === null || $value === '') {
            return true;
        }

        return false;
    }
}