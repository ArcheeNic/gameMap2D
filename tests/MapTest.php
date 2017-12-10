<?php

use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
{
    private function getStartData(){
        return [
            [0, 0, 0, 0, 0],
            [0, 1, 1, 0, 0],
            [0, 1, 1, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
        ];
    }

    /**
     * Проверка устоановки занчения в ячейке
     * @test
     */
    public function testGetValue()
    {
        $startData=$this->getStartData();
        $Map=new \ArcheeNic\Map2D\Map($startData);

        $this->assertEquals($Map->getCell(0,0)->getValue(),0);
        $this->assertEquals($Map->getCell(1,1)->getValue(),1);
    }

    /**
     * Проверка устоановки занчения в ячейке
     * @test
     */
    public function testSetValue()
    {
        $startData=$this->getStartData();
        $resultData=[
            [2, 0, 0, 0, 0],
            [0, 2, 1, 0, 0],
            [0, 1, 1, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
        ];
        $Map=new \ArcheeNic\Map2D\Map($startData);
        $Map->setCell(0,0,2);
        $Map->setCell(1,1,2);

        $this->assertEquals($Map->getData(),$resultData);
    }
}