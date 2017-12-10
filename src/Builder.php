<?php
/**
 * Created by PhpStorm.
 * User: kasim
 * Date: 07.12.2017
 * Time: 4:55
 */

namespace ArcheeNic\Map2D;


class Builder
{

    /**
     * @var Map
     */
    protected $map;

    /**
     * @return Map
     */
    public function getMap()
    {
        return $this->map;
    }

    public function __construct(Map $map)
    {
        $this->map = $map;
    }

    /**
     * Проверяем возможность установки
     * @param array $map карта
     * @param array $coordinate координата x,y
     * @param array $size размер x,y
     * @return bool
     */
    function checkPotentialBuild($coordinate = [0, 0], $size = [2, 2])
    {
        $maxX = $size[0];
        $maxY = $size[1];
        $buildCoordinateX = $coordinate[0];
        $buildCoordinateY = $coordinate[1];

        for ($y = 0; $y < $maxY; $y++) {
            for ($x = 0; $x < $maxX; $x++) {
                $newCoordinateX = $buildCoordinateX + $x;
                $newCoordinateY = $buildCoordinateY + $y;
                $cell = $this->map->getCell($newCoordinateX,$newCoordinateY);
//                print '<pre>';
//                print "\t$newCoordinateY:$newCoordinateX (".var_export($cell->getValue(),1).") | isExists:".var_export($cell->isExists(), 1)." | isEmpty:".var_export($cell->isEmpty(), 1);
                if (!$cell->isExists() || !$cell->isEmpty()) {
//                    print "\t | result =  false";
//                    print '</pre>';

                    return false;
                }else{
//                    print "\t | result =  true";
//                    print '</pre>';
                }
            }
        }
        return true;
    }

    /**
     * Установка здания на карту
     * @param int $id id здания
     * @param array $coordinate координаты x,y
     * @param array $size размер Ш, Д
     * @return bool
     */
    function deploy($id, $coordinate = [0, 0], $size = [2, 2])
    {
        if ($this->checkPotentialBuild($coordinate, $size)) {
            $map = $this->map;
            $maxX = $size[0];
            $maxY = $size[1];
            $buildCoordinateX = $coordinate[0];
            $buildCoordinateY = $coordinate[1];

            for ($x = 0; $x < $maxX; $x++) {
                for ($y = 0; $y < $maxY; $y++) {
                    $setX = $buildCoordinateX + $x;
                    $setY = $buildCoordinateY + $y;
                    $map->setCell($setX, $setY, $id);
                }
            }
            View::fullMap($map);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Автоустановка здания
     * @param int $id id здания
     * @param array $size размер Ш, Д
     * @return bool
     */
    function autoDeploy($id, $size = [2, 2])
    {
        $coordinate = $this->findFreeSpace($size);
        if ($coordinate === null) {
            return false;
        }
        return $this->deploy($id, $coordinate, $size);
    }

    /**
     * Поиск удобного места для здания
     * @param array $size
     * @return array|null возвращает координату или, если не нашёл - возвращает null
     */
    function findFreeSpace($size = [2, 2])
    {
        $map = $this->map->getData();
        foreach ($map as $y => $xLine) {
            foreach ($xLine as $x => $value) {
//                print '<pre>';
//                var_dump($value);
//                print '</pre>';
                if (!$value && $this->checkPotentialBuild([$x, $y], $size)) {
                    return [$x, $y];
                }
            }
        }
        return null;
    }

}