<?php

class SpriteMock implements iSprite{

    private $imageWidth;
    private $imageHeight;
    private $spriteWidth;
    private $spriteHeight;

    /**
     * Atlas Position
     */
    private $atlasPositionX = 0;
    private $atlasPositionY = 0;
    private $atlasPositionWidth = 0;
    private $atlasPositionHeight = 0;

    public function __construct($imageWidth, $imageHeight, $spriteWidth, $spriteHeight) {
        $this->imageWidth = $imageWidth;
        $this->imageHeight = $imageHeight;
        $this->spriteWidth = $spriteWidth;
        $this->spriteHeight = $spriteHeight;
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
    }

    public function setAtlasPositionX($pos){
        $this->atlasPositionX = $pos;
    }

    public function setAtlasPositionY($pos){
        $this->atlasPositionY = $pos;
    }

    public function getAtlasPositionX(){
        return $this->atlasPositionX;
    }

    public function getAtlasPositionY(){
        return $this->atlasPositionY;
    }

    public function setAtlasPositionWidth($width){
        $this->atlasPositionWidth = $width;
    }

    public function setAtlasPositionHeight($height){
        $this->atlasPositionHeight = $height;
    }

    public function getAtlasPositionWidth(){
        return $this->atlasPositionWidth;
    }

    public function getAtlasPositionHeight(){
        return $this->atlasPositionHeight;
    }
}