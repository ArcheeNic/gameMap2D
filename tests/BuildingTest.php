<?php

use PHPUnit\Framework\TestCase;

use \ArcheeNic\Map2D\Map;
use \ArcheeNic\Map2D\Builder;

class BuildingTest extends TestCase
{
    private function getStartData(){
        return new Map([
            [0, 0, 0, 0, 0],
            [0, 1, 1, 0, 0],
            [0, 1, 1, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
        ]);
    }

    /**
     * Проверка на установку дома
     * @test
     */
    public function addBuildingTest(){
        $startData=$this->getStartData();
        $Builder=new Builder($startData);
        $Builder->deploy(5,[3,3],[2,2]);
        $resultData=new Map([
            [0, 0, 0, 0, 0],
            [0, 1, 1, 0, 0],
            [0, 1, 1, 0, 0],
            [0, 0, 0, 5, 5],
            [0, 0, 0, 5, 5],
        ]);
        $this->assertEquals($startData,$resultData);
    }

    /**
     * Проверка на невозможность установки дома
     * @test
     */
    public function notAddBuildingTest(){
        $startData=$this->getStartData();
        $Builder=new Builder($startData);
        $Builder->deploy(5,[0,0],[2,2]);
        $resultData=new Map([
            [0, 0, 0, 0, 0],
            [0, 1, 1, 0, 0],
            [0, 1, 1, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
        ]);
        $this->assertEquals($resultData,$startData);
    }

    /**
     * Проверка на невозможность установки дома
     * @test
     */
    public function notAutoBuildingTest(){
        $startData=$this->getStartData();
        $Builder=new Builder($startData);
        $Builder->autoDeploy(5,[2,2]);
        $resultData=new Map([
            [0, 0, 0, 5, 5],
            [0, 1, 1, 5, 5],
            [0, 1, 1, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
        ]);
        $this->assertEquals($resultData,$startData);
    }

}