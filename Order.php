<?php

class Order {

    protected $sprites = array();

    public function getSprites(){
        return $this->sprites;
    }

    public function addSprite(Sprite $sprite){
        array_push($this->sprites, $sprite);
    }

    public function order(){
        if(!empty($this->sprites)){
            usort($this->sprites, array('Order', 'orderLargestToSmallest'));
        }
    }

    protected static function orderLargestToSmallest($a, $b){

        $aSize = $a->getImageWidth() * $a->getImageHeight();
        $bSize = $b->getImageWidth() * $b->getImageHeight();

        if ($aSize == $bSize) {
            return 0;
        }
        return ($aSize < $bSize) ? -1 : 1;

    }


}