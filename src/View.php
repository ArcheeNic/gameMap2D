<?php
/**
 * Created by PhpStorm.
 * User: kasim
 * Date: 07.12.2017
 * Time: 7:19
 */

namespace ArcheeNic\Map2D;


class View
{

    /**
     * Вывести визуально карту
     * @return string
     */
    static function fullMap(Map $map){
        $mapData=$map->getData();
        ob_start();
        print '<pre>';
        $i=0;
        foreach ($mapData as $y=>$xLine){
            if($i===0){
                $xIndexes=[];
                foreach ($xLine as $key=>$value){
                    $xIndexes[]=$key;
                }
                print "y/x\t|\t".implode(",\t",$xIndexes).' '."\n";
                print "--------------------------------------------------\n";
            }
            $i++;
            print $y."\t|\t".implode(",\t",$xLine)."\n";
        }
        print '</pre>';
        return ob_get_clean();
    }
}