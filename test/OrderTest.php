<?php

require_once '../iSprite.php';
require_once '../Sprite.php';
require_once '../Order.php';
require_once 'mock/SpriteMock.php';


class OrderTest extends PHPUnit_Framework_TestCase {

    public function testOrder_addSprite(){
        $sprite = new SpriteMock(120, 120, 100, 100);
        $order = new Order();
        $order->addSprite($sprite);
    }

    public function testOrder_getEmptySpriteList(){
        $order = new Order();
        $this->assertEquals(0, count($order->getSprites()));
    }

    public function testOrder_addTwoSprites_getTwoSprites(){
        $order = new Order();
        $sprite1 = new SpriteMock(120, 120, 100, 100);
        $sprite2 = new SpriteMock(120, 120, 100, 100);

        $order->addSprite($sprite1);
        $order->addSprite($sprite2);
        $this->assertEquals(2, count($order->getSprites()));
    }

    public function testOrder_orderOneSprite(){
        $sprite = new SpriteMock(120, 120, 100, 100);
        $order = new Order();
        $order->addSprite($sprite);
        $order->order();
    }

    public function testOrder_addTwoSingleSprites_largestToSmallest(){
        $order = new Order();
        $sprite1 = new SpriteMock(120, 120, 100, 100);
        $sprite2 = new SpriteMock(130, 130, 100, 100);

        $order->addSprite($sprite1);
        $order->addSprite($sprite2);

        $order->order();
        $orderedSprites = $order->getSprites();

        $this->assertSame($orderedSprites[0], $sprite2);
        $this->assertSame($orderedSprites[1], $sprite1);
    }

    public function testOrder_addTwoSingleSprites_largestToSmallestBySpriteSize(){
        $order = new Order();
        $sprite1 = new SpriteMock(120, 120, 120, 120);
        $sprite2 = new SpriteMock(130, 130, 100, 100);

        $order->addSprite($sprite1);
        $order->addSprite($sprite2);

        $order->setOrderBy(Order::ORDER_BY_SPRITESIZE);
        $order->order();
        $orderedSprites = $order->getSprites();

        $this->assertSame($orderedSprites[0], $sprite1);
        $this->assertSame($orderedSprites[1], $sprite2);
    }

    public function testOrder_orderTwoSprites_largestToSmallest(){
        $sprites = array(
            new SpriteMock(130, 130, 50, 50),
            new SpriteMock(120, 120, 40, 40),
        );

        $order = new Order();
        $order->addSprites($sprites);

        $order->order();
        $orderedSprites = $order->getSprites();

        $this->assertSame($orderedSprites[0], $sprites[1]);
        $this->assertSame($orderedSprites[1], $sprites[0]);
    }

    public function testOrder_orderFourSprites_largestToSmallest(){
        $sprites = array(
            new SpriteMock(100, 100, 50, 50),
            new SpriteMock(120, 120, 40, 40),
            new SpriteMock(130, 130, 30, 30),
            new SpriteMock(140, 140, 20, 20)
        );

        $order = new Order();
        $order->addSprites($sprites);

        $order->order();
        $orderedSprites = $order->getSprites();

        $this->assertSame($orderedSprites[0], $sprites[3]);
        $this->assertSame($orderedSprites[1], $sprites[2]);
        $this->assertSame($orderedSprites[2], $sprites[1]);
        $this->assertSame($orderedSprites[3], $sprites[0]);
    }

    public function testOrder_orderTwoBySpriteSize_LargestToSmallest(){
        $sprites = array(
            new SpriteMock(100, 100, 50, 50),
            new SpriteMock(120, 120, 40, 40),
        );

        $order = new Order();
        $order->addSprites($sprites);

        $order->setOrderBy(Order::ORDER_BY_SPRITESIZE);
        $order->order();
        $orderedSprites = $order->getSprites();

        $this->assertSame($orderedSprites[0], $sprites[0]);
        $this->assertSame($orderedSprites[1], $sprites[1]);
    }

    public function testOrder_ordeFourBySpriteSize_LargestToSmallest(){
        $sprites = array(
            new SpriteMock(100, 100, 50, 50),
            new SpriteMock(120, 120, 40, 40),
            new SpriteMock(130, 130, 30, 30),
            new SpriteMock(140, 140, 20, 20)
        );

        $order = new Order();
        $order->addSprites($sprites);

        $order->setOrderBy(Order::ORDER_BY_SPRITESIZE);
        $order->order();
        $orderedSprites = $order->getSprites();

        $this->assertSame($orderedSprites[0], $sprites[0]);
        $this->assertSame($orderedSprites[1], $sprites[1]);
        $this->assertSame($orderedSprites[2], $sprites[2]);
        $this->assertSame($orderedSprites[3], $sprites[3]);
    }
}
