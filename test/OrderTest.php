<?php

require_once '../Sprite.php';
require_once '../Order.php';

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
        $sprite = new Sprite('sprites/test1.png');
        $sprite = new Sprite('sprites/test1.png');
        $this->assertEquals(2, count($order->getSprites()));
    }

    public function testOrder_orderOneSprite(){
        $sprite = new Sprite('sprites/test1.png');
        $order = new Order();
        $order->addSprite($sprite);
        $order->order();
    }

}
