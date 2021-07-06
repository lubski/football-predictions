<?php


namespace App\DBAL;


class EnumMarketType extends EnumType
{
    protected $name = 'enum_market_type';
    protected $values = array('1x2', 'correct_score');
}