<?php
/**
 * Created by PhpStorm.
 * User: kasim
 * Date: 07.12.2017
 * Time: 5:51
 */

namespace ArcheeNic\Map2D;


class MapCell
{
    protected $value;

    const IS_EMPTY=0;
    const IS_NOT_EXISTS=null;

    function __construct($value)
    {
        $this->value=$value;
    }

    /**
     * Проверить ячейку на свободность
     * @return bool
     */
    function isEmpty(){
        return ($this->value===static::IS_EMPTY);
    }

    /**
     * Проверить на существование ячейки
     * @return bool
     */
    function isExists(){
        return ($this->value!==static::IS_NOT_EXISTS);
    }

    /**
     * @return mixed
     */
    function getValue(){
        return $this->value;
    }
}