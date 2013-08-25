<?php

class SpriteMock implements iSprite{

    private $imageWidth;
    private $imageHeight;
    private $spriteWidth;
    private $spriteHeight;

    public function __construct($imageWidth, $imageHeight, $spriteWidth, $spirteHeight){
        $this->imageWidth = $imageWidth;
        $this->imageHeight = $imageHeight;
        $this->spriteWidth = $spriteWidth;
        $this->spriteHeight = $spirteHeight;
    }

    public function getImageWidth(){
        return $this->imageWidth;
    }

    public function getImageHeight(){
        return $this->imageHeight;
    }

    public function getSpriteWidth(){
        return $this->spriteWidth;
    }

    public function getSpriteHeight(){
        return $this->spriteHeight;
        return $this->spriteHeight;
    }

}