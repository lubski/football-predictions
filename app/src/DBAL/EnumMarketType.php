<?php


namespace App\DBAL;


class EnumMarketType extends EnumType
{
    protected string $name = 'enum_market_type';
    protected array $values = array('1x2', 'correct_score');
}