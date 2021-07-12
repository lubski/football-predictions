<?php


namespace App\DBAL;


class EnumStatusType extends EnumType
{
    protected string $name = 'enum_status';
    protected array $values = ['win', 'lost', 'unresolved'];
    protected string $default = 'unresolved';
}