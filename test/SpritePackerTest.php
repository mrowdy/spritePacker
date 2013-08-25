<?php

require_once '../SpritePacker.php';

class SpritePackerTest extends PHPUnit_Framework_TestCase {

    protected $spritePacker;

    public function setUp(){
        parent::setUp();
        $this->spritePacker = new SpritePacker();
    }

    public function tearDown(){
        parent::tearDown();
        unset($this->spritePacker);
    }

    public function testSpritePacker_ConstructEmptyOptions() {
       $this->spritePacker = new SpritePacker(array());

       $this->assertTrue($this->spritePacker instanceof SpritePacker);
    }

    public function testSpritePacker_RunEmpty_false(){
        $result = $this->spritePacker->run();
        $this->assertFalse($result);
    }

    public function testSpritePacker_RunWith1Sprite_true() {
        $this->spritePacker->addSprite('sprites/test1.png');
        $result = $this->spritePacker->run();
        $this->assertTrue($result);
    }

    public function testSpritePacker_addEmptySprite_false(){
        $result = $this->spritePacker->addSprite('');
        $this->assertFalse($result);
    }

    public function testSpritePacker_addExistingSprite_true(){
        $result = $this->spritePacker->addSprite('sprites/test1.png');
        $this->assertTrue($result);
    }

    public function testSpritePacker_addNonImageSprite_false(){
        $result = $this->spritePacker->addSprite('sprites/dummy.pdf');
        $this->assertFalse($result);
    }

}
