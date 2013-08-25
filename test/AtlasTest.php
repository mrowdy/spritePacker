<?php

require_once '../Atlas.php';
require_once "../Block.php";

class AtlasTest extends PHPUnit_Framework_TestCase {

    public function testAtlas_createAtlasWithWidthAndHeight(){
        $width = 300;
        $height = 200;
        $atlas = new Atlas($width, $height);

        $this->assertEquals($atlas->width, $width);
        $this->assertEquals($atlas->height, $height);
    }

    public function testAtlas_createAtlas_hasOneBlock(){
        $width = 300;
        $height = 200;
        $atlas = new Atlas($width, $height);
        $this->assertEquals(1, count($atlas->blocks));
    }
    
    public function testAtlas_findFirstPosition_TopLeft(){
        $width = 300;
        $height = 200;
        $atlas = new Atlas($width, $height);

        $position = $atlas->findPosition(222, 134);
        $this->assertEquals($position['x'], 0);
        $this->assertEquals($position['y'], 0);
    }

    public function testAtlas_findFirstPosition_twoBlocks(){
        $width = 300;
        $height = 200;
        $atlas = new Atlas($width, $height);

        $position = $atlas->findPosition(100,100);
        $this->assertEquals(2, count($atlas->blocks));
    }


    public function testAtlas_findSecondPosition_LeftToFirst(){
        $width = 300;
        $height = 200;
        $atlas = new Atlas($width, $height);

        $position = $atlas->findPosition(100,100);
        $position = $atlas->findPosition(100,100);
        $this->assertEquals($position['x'], 100);
        $this->assertEquals($position['y'], 0);
    }

    public function testAtlas_findSecondPosition_twoBlocks(){
        $width = 300;
        $height = 200;
        $atlas = new Atlas($width, $height);

        $position = $atlas->findPosition(100,100);
        $position = $atlas->findPosition(100,100);

        $this->assertEquals(2, count($atlas->blocks));
    }

    /**
     * @expectedException Exception
     */
    public function testAtlas_noSpaceLeft_exception(){
        $width = 300;
        $height = 200;
        $atlas = new Atlas($width, $height);
        $position = $atlas->findPosition(301, 200);
    }


    public function testAtlas_perfectFit_findPosition(){
        $width = 300;
        $height = 200;
        $atlas = new Atlas($width, $height);

        $position = $atlas->findPosition(300, 200);
        $this->assertEquals($position['x'], 0);
        $this->assertEquals($position['y'], 0);

        $this->assertEquals(0, count($atlas->blocks));
    }

    /**
     * @expectedException Exception
     */
    public function testAtlas_noSpaceAfterPerfectFit_throwsException(){
        $width = 300;
        $height = 200;
        $atlas = new Atlas($width, $height);

        $position = $atlas->findPosition(300, 200);
        $position = $atlas->findPosition(1, 1);

        $this->assertEquals(0, count($atlas->blocks));
    }

    public function testAtlas_fullFill_noBlocks(){
        $width = 300;
        $height = 200;
        $atlas = new Atlas($width, $height);

        $position = $atlas->findPosition(100, 100);
        $position = $atlas->findPosition(100, 100);
        $position = $atlas->findPosition(100, 100);
        $position = $atlas->findPosition(100, 100);
        $position = $atlas->findPosition(100, 100);
        $position = $atlas->findPosition(100, 100);

        $this->assertEquals($position['x'], 200);
        $this->assertEquals($position['y'], 100);

        $this->assertEquals(0, count($atlas->blocks));
    }

    public function testAtlas_fullFillDifferentWidth_noBlocks(){
        $width = 300;
        $height = 200;
        $atlas = new Atlas($width, $height);

        $position = $atlas->findPosition(200, 100);
        $position = $atlas->findPosition(100, 100);
        $position = $atlas->findPosition(100, 100);
        $position = $atlas->findPosition(200, 100);

        $this->assertEquals($position['x'], 100);
        $this->assertEquals($position['y'], 100);

        $this->assertEquals(0, count($atlas->blocks));
    }

    public function testAtlas_fullFillDifferentHeight_noBlocks(){
        $width = 300;
        $height = 200;
        $atlas = new Atlas($width, $height);

        $position = $atlas->findPosition(100, 200);
        $position = $atlas->findPosition(100, 100);
        $position = $atlas->findPosition(100, 100);
        $position = $atlas->findPosition(100, 100);
        $position = $atlas->findPosition(100, 100);

        $this->assertEquals($position['x'], 200);
        $this->assertEquals($position['y'], 100);

        $this->assertEquals(0, count($atlas->blocks));
    }
}