<?php
/**
 * Created by PhpStorm.
 * User: kasim
 * Date: 07.12.2017
 * Time: 4:53
 */

namespace ArcheeNic\Map2D;

class Map
{

    protected $data = [];

    /**
     * Данные для несуществующей строки
     */
    const IS_NOT_EXISTS_ROW = null;

    /**
     * Данные для несуществующей колонки
     */
    const IS_NOT_EXISTS_COL = null;

    /**
     * Map constructor.
     * @param null|array $data
     * @throws \Exception
     */
    public function __construct($data = null)
    {
        if (is_array($this->data)) {
            $this->data = $data;
        } else {
            if (is_null($this->data)) {
                $this->data = [];
            } else {
                throw new \Exception('Incorrect data set');
            }
        }
    }

    /**
     * @param $x
     * @param $y
     * @return MapCell
     */
    function getCell($x, $y)
    {
        if (!isset($this->data[$y])) {
            $data = MapCell::IS_NOT_EXISTS;
        } elseif (!isset($this->data[$y][$x])) {
            $data = MapCell::IS_NOT_EXISTS;
        } else {
            $data = $this->data[$y][$x];
        }

        return new MapCell($data);
    }

    /**
     * Записать ячейку
     * @param $x
     * @param $y
     * @param $value
     * @return bool
     */
    function setCell($x, $y, $value)
    {
        $cell = $this->getCell($x, $y);
        if ($cell->isExists()) {
            $this->data[$y][$x] = $value;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Получить строку
     * @param $yIndex
     * @return mixed|null
     */
    function getRow($yIndex)
    {
        if (isset($this->data[$yIndex])) {
            return $this->data[$yIndex];
        } else {
            return static::IS_NOT_EXISTS_ROW;
        }

    }

    /**
     * Получить колонку
     * @param $xIndex
     * @return null
     * @return array|null
     */
    function getColumn($xIndex)
    {
        $column = [];
        foreach ($this->data as $yIndex => $xRow) {
            $cell = $this->getCell($xIndex, $yIndex);
            if (!$cell->isExists()) {
                return static::IS_NOT_EXISTS_COL;
            }
            $column[$yIndex] = $cell->getValue();
        }
        return $column;
    }

    function getData()
    {
        return $this->data;
    }

}