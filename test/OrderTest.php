<?php

require_once '../iSprite.php';
require_once '../Sprite.php';
require_once '../Order.php';
require_once 'mock/SpriteMock.php';


class OrderTest extends PHPUnit_Framework_TestCase {

    public function testOrder_addSprite(){
        $sprite = new Sprite('sprites/test1.png');
        $order = new Order();
        $order->addSprite($sprite);
    }

    public function testOrder_getEmptySpriteList(){
        $order = new Order();
        $this->assertEquals(0, count($order->getSprites()));
    }

    public function testOrder_addTwoSprites_getTwoSprites(){
        $order = new Order();
        $sprite1 = new Sprite('sprites/test1.png');
        $sprite2 = new Sprite('sprites/test1.png');

        $order->addSprite($sprite1);
        $order->addSprite($sprite2);
        $this->assertEquals(2, count($order->getSprites()));
    }

    public function testOrder_orderOneSprite(){
        $sprite = new Sprite('sprites/test1.png');
        $order = new Order();
        $order->addSprite($sprite);
        $order->order();
    }

    public function testOrder_orderTwoSprites_largestToSmallest(){
        $sprite2 = new SpriteMock(120, 120, 100, 100);
        $sprite1 = new SpriteMock(100, 100, 80, 80);


        $order = new Order();
        $order->addSprite($sprite1);
        $order->addSprite($sprite2);
        $order->order();

        $sprites = $order->getSprites();
        $this->assertSame($sprites[0], $sprite2);
        $this->assertSame($sprites[1], $sprite1);

    }
}
