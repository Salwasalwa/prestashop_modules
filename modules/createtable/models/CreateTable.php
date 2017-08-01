<?php
class CreateTable extends ObjectModel
{
    public $id_test;
    public $name;

    public static $definition = array(
        'table' => 'blog',
        'primary' => 'id_test',
        'fields' => array(
            'name' => 		array('type' => self::TYPE_STRING, 'validate' => 'isString')
        ),
    );
}
