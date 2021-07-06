<?php


namespace App\DBAL;


class EnumStatusType extends EnumType
{
    protected $name = 'enum_status';
    protected $values = array('win', 'lost', 'unresolved');
    protected $default = 'unresolved';
}