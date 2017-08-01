<?php
class BlogPost extends ObjectModel
{
    public $id_blog;
    public $title;

    public static $definition = array(
        'table' => 'blog',
        'primary' => 'id_blog',
        'fields' => array(
            'title' => array('type' => self::TYPE_STRING, 'validate' => 'isString')
        ),
    );
}
