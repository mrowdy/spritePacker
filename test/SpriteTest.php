<?php

require_once "../iSprite.php";
require_once '../Sprite.php';


class SpriteTest extends PHPUnit_Framework_TestCase {

    private $sprite32x32 = 'sprites/testSprite1.png';
    private $sprite64x64 = 'sprites/testSprite2.png';
    private $sprite128x128 = 'sprites/testSprite3.png';

    /**
     * @expectedException Exception
     */
    public function testSprite_ConstructEmpty_Exception(){
        $sprite = new Sprite();
    }

    public function testSprite_ConstructValidImage(){
        $path = $this->sprite32x32;
        $sprite = new Sprite($path);
        $this->assertEquals($path, $sprite->getSpritePath());
    }

    public function testSprite_loadValidImage_correctImageDimensions(){
        $expectedWidth = 32;
        $expectedHeight = 32;
        $sprite = new Sprite($this->sprite32x32);
        $this->assertEquals($expectedWidth, $sprite->getImageWidth());
        $this->assertEquals($expectedHeight, $sprite->getImageHeight());
    }

    public function testSprite_getMimeType_png(){
        $expected = 'image/png';
        $sprite = new Sprite($this->sprite32x32);

        $this->assertEquals($expected, $sprite->getMimeType());
    }


    public function testSprite_getImageType_png(){
        $expected = '3';
        $sprite = new Sprite($this->sprite32x32);

        $this->assertEquals($expected, $sprite->getImageType());
    }

    public function testSprite_getSpriteTopX(){
        $expected = '1';
        $sprite = new Sprite($this->sprite32x32);

        $this->assertEquals($expected, $sprite->getSpriteTopX());
    }

    public function testSprite_getSpriteTopY(){
        $expected = '1';
        $sprite = new Sprite($this->sprite32x32);

        $this->assertEquals($expected, $sprite->getSpriteTopY());
    }

    public function testSprite_getSpriteWidth(){
        $expected = '30';
        $sprite = new Sprite($this->sprite32x32);

        $this->assertEquals($expected, $sprite->getSpriteWidth());
    }

    public function testSprite_getSpriteHeight(){
        $expected = '30';
        $sprite = new Sprite($this->sprite32x32);

        $this->assertEquals($expected, $sprite->getSpriteHeight());
    }

    public function testSprite_getImage_resource(){
        $sprite = new Sprite($this->sprite32x32);
        $this->assertEquals('resource', gettype($sprite->getImage()));
    }
}
