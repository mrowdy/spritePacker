<?php

require_once '../Sprite.php';

class SpriteTest extends PHPUnit_Framework_TestCase {

    /**
     * @expectedException Exception
     */
    public function testSprite_ConstructEmpty_Exception(){
        $sprite = new Sprite();
    }

    public function testSprite_ConstructValidImage(){
        $path = 'sprites/test1.png';
        $sprite = new Sprite($path);
        $this->assertEquals($path, $sprite->getSpritePath());
    }

    public function testSprite_loadValidImage_correctImageDimensions(){
        $expectedWidth = 200;
        $expectedHeight = 200;
        $sprite = new Sprite('sprites/test1.png');
        $size = $sprite->getImageSize();
        $this->assertEquals($expectedWidth, $size[0]);
        $this->assertEquals($expectedHeight, $size[1]);
    }

    public function testSprite_getMimeType_png(){
        $expected = 'image/png';
        $sprite = new Sprite('sprites/test1.png');

        $this->assertEquals($expected, $sprite->getMimeType());
    }


    public function testSprite_getImageType_png(){
        $expected = '3';
        $sprite = new Sprite('sprites/test1.png');

        $this->assertEquals($expected, $sprite->getImageType());
    }

    public function testSprite_getSpriteTopX(){
        $expected = '5';
        $sprite = new Sprite('sprites/test1.png');

        $this->assertEquals($expected, $sprite->getSpriteTopX());
    }

    public function testSprite_getSpriteTopY(){
        $expected = '13';
        $sprite = new Sprite('sprites/test1.png');

        $this->assertEquals($expected, $sprite->getSpriteTopY());
    }

    public function testSprite_getSpriteWidth(){
        $expected = '190';
        $sprite = new Sprite('sprites/test1.png');

        $this->assertEquals($expected, $sprite->getSpriteWidth());
    }

    public function testSprite_getSpriteHeight(){
        $expected = '176';
        $sprite = new Sprite('sprites/test1.png');

        $this->assertEquals($expected, $sprite->getSpriteHeight());
    }

    public function testSprite_getImage_resource(){
        $sprite = new Sprite('sprites/test1.png');
        $this->assertEquals('resource', gettype($sprite->getImage()));
    }
}
