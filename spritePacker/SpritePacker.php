<?php

require_once "interface/iSprite.php";
require_once "interface/iRenderer.php";
require_once "Sprite.php";
require_once "Atlas.php";
require_once "Block.php";
require_once "Order.php";

class SpritePacker {

    protected $sprites = array();
    protected $options = array(
        'atlas-width'   => 500,
        'atlas-height'  => 500,
    );

    protected $atlasWidth = 0;
    protected $atlasHeight = 0;
    protected $atlas = null;
    protected $atlasResource = null;
    protected $order = null;

    public function __construct($options = array()){

        $this->options = array_merge($this->options, $options);
        $this->atlas = new Atlas($this->options['atlas-width'], $this->options['atlas-height']);
        $this->order = new Order($this->atlas);
    }

    public function addSprite($spritePath){
        if(file_exists($spritePath) && $this->isImage($spritePath)){
            $sprite = new Sprite($spritePath);
            array_push($this->sprites, $sprite);
            return true;
        }
        return false;
    }

    public function run(){
        if(empty($this->sprites)){
            return false;
        }
        $this->createAtlas();
        $this->orderSprites();
        $this->populateAtlas();
        return true;
    }

    public function show(){
        header('Content-Type: image/png');
        imagepng($this->atlasResource);
    }

    protected function isImage($spritePath){
        if(getimagesize($spritePath) !== false){
            return true;
        }
        return false;
    }

    protected function createAtlas(){
        $this->atlasResource = imagecreate($this->options['atlas-width'], $this->options['atlas-height']);
    }

    protected function orderSprites(){
        $this->order->addSprites($this->sprites);
        $this->order->order();
    }

    protected function populateAtlas(){
        foreach($this->sprites AS $sprite){
            $dstImage = $this->atlasResource;
            $srcImage = $sprite->getImage();
            $dstX = $sprite->getAtlasPositionX();
            $dstY = $sprite->getAtlasPositionY();
            $srcX = 0;
            $srcY = 0;
            $srcW = $dstW = $sprite->getAtlasPositionWidth();
            $srcH = $dstH = $sprite->getAtlasPositionHeight();
            imagecopyresampled ($dstImage, $srcImage , $dstX , $dstY , $srcX , $srcX , $dstW , $dstH ,$srcW , $srcH);
        }
    }
}