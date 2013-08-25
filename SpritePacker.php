<?php

require_once "Sprite.php";

class SpritePacker {

    protected $sprites = array();
    protected $options = array(
        'atlas-width'   => 400,
    );

    protected $atlasWidth = 0;
    protected $atlasHeight = 0;
    protected $atlas   = null;

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
        $this->getAtlasDimensions();
        $this->createAtlas();
        $this->populateAtlas();
        return true;
    }

    public function show(){
        header('Content-Type: image/png');
        imagepng($this->atlas);
    }

    protected function isImage($spritePath){
        if(getimagesize($spritePath) !== false){
            return true;
        }
        return false;
    }

    protected function createAtlas(){
        $this->atlas = imagecreate($this->atlasWidth, $this->atlasHeight);
    }

    protected function getAtlasDimensions(){
        $height = 0;
        $currentWidth = 0;
        foreach($this->sprites AS $sprite){
            $spriteWidth = $sprite->getImageWidth();
            $spriteHeight = $sprite->getImageHeight();
            if($height == 0){
                $height += $spriteWidth;
                $currentWidth += $spriteWidth;
            }
            elseif($currentWidth + $spriteWidth > $this->options['atlas-width']){
                $currentWidth = 0;
                $height += $spriteHeight;
            } else {
                $currentWidth += $spriteWidth;
            }
        }
        $this->atlasHeight = $height;
        $this->atlasWidth  =$this->options['atlas-width'];
    }

    protected function populateAtlas(){
        $currentHeight = 0;
        $currentWidth = 0;
        foreach($this->sprites AS $sprite){
            $spriteWidth = $sprite->getImageWidth();
            $spriteHeight = $sprite->getImageHeight();
            $newLine = false;
            if($currentWidth + $spriteWidth > $this->options['atlas-width']){
                $currentHeight += $spriteHeight;
                $currentWidth = 0;
                $newLine = true;
            }

            $dstImage = $this->atlas;
            $srcImage = $sprite->getImage();
            $dstX = $currentHeight;
            $dstY = $currentWidth;
            $srcX = 0;
            $srcY = 0;
            $srcW = $sprite->getImageWidth();
            $srcH = $sprite->getImageHeight();

            imagecopy($dstImage, $srcImage, $dstX, $dstY, $srcX, $srcY, $srcW, $srcH);
            if(!$newLine){
                $currentWidth += $spriteWidth;
            }
        }
    }

}