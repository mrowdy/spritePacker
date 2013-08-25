<?php

class Order {

    const ORDER_BY_IMAGESIZE = 0;
    const ORDER_BY_SPRITESIZE = 1;
    protected static $orderBy;

    protected $sprites = array();

    public function __construct(){
        self::$orderBy = self::ORDER_BY_IMAGESIZE;
    }

    public function getSprites(){
        return $this->sprites;
    }

    public function addSprite(iSprite $sprite){
        array_push($this->sprites, $sprite);
    }

    public function addSprites($sprites){
        if(is_array($sprites)){
            foreach($sprites as $sprite){
                $this->addSprite($sprite);
            }
        } else {
            $this->addSprite($sprites);
        }
    }

    public function order(){
        if(!empty($this->sprites)){
            usort($this->sprites, array('Order', 'orderLargestToSmallest'));
        }
    }

    public function setOrderBy($orderBy){
        switch($orderBy){
            case self::ORDER_BY_SPRITESIZE:
                self::$orderBy = self::ORDER_BY_SPRITESIZE;
                break;
            case self::ORDER_BY_IMAGESIZE:
            default:
                self::$orderBy = self::ORDER_BY_IMAGESIZE;
                break;
        }
    }

    protected static function orderLargestToSmallest($a, $b){

        switch(self::$orderBy){
            case self::ORDER_BY_SPRITESIZE:
                $aSize = $a->getImageWidth() * $a->getImageHeight();
                $bSize = $b->getImageWidth() * $b->getImageHeight();
                break;
            case self::ORDER_BY_IMAGESIZE:
            default:
                $aSize = $a->getSpriteWidth() * $a->getSpriteHeight();
                $bSize = $b->getSpriteWidth() * $b->getSpriteHeight();
                break;
        }

        if ($aSize == $bSize) {
            return 0;
        }
        return ($aSize < $bSize) ? -1 : 1;

    }
}