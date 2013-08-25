<?php

class Sprite {

    private $spritePath;

    /**
     * Image
     */
    private $image;
    private $imageType;
    private $mimeType;
    private $imageWidth;
    private $imageHeight;

    /**
     * Sprite Dimensons
     */
    private $spriteWidth;
    private $spriteHeight;
    private $spriteTopX;
    private $spriteTopY;

    public function __construct($spritePath){
        if(empty($spritePath)){
            throw new Exception('spritePath is empty');
        }
        $this->spritePath = $spritePath;
        $this->setImageMeta();
        $this->loadImage();
        $this->setImageAlpha();
        $this->setSpriteDimensions();
    }

    public function getSpritePath(){
        return $this->spritePath;
    }

    public function getImageSize(){
        return array($this->imageWidth, $this->imageHeight);
    }

    public function getMimeType(){
        return $this->mimeType;
    }

    public function getImageType(){
        return $this->imageType;
    }

    public function getSpriteWidth(){
        return $this->spriteWidth;
    }

    public function getSpriteHeight(){
        return $this->spriteHeight;
    }

    public function getImageWidth(){
        return $this->imageWidth;
    }

    public function getImageHeight(){
        return $this->imageHeight;
    }


    public function getSpriteTopX(){
        return $this->spriteTopX;
    }

    public function getSpriteTopY(){
        return $this->spriteTopY;
    }

    public function getImage(){
        return $this->image;
    }

    protected function loadImage(){
        switch($this->imageType){
            case IMAGETYPE_PNG:
                $this->image = imagecreatefrompng($this->spritePath);
                break;
            case IMAGETYPE_JPEG:
                $this->image = imagecreatefromjpeg($this->spritePath);
                break;
            case IMAGETYPE_GIF:
                $this->image = imagecreatefromgif($this->spritePath);
                break;
            default:
                throw new Exception(sprintf('unsupportet image %s: (%s)',$this->spritePath, $this->mimeType));
                break;
        }
    }

    protected function setImageMeta(){
        $result = getimagesize($this->spritePath);
        $this->imageWidth = $result[0];
        $this->imageHeight = $result[1];
        $this->imageType = $result[2];
        $this->mimeType = $result['mime'];
    }

    protected function setImageAlpha(){
        imageAlphaBlending($this->image, true);
        imageSaveAlpha($this->image, true);
    }

    protected function setSpriteDimensions(){
        $x1 = $this->imageWidth;
        $x2 = 0;
        $y1 = $this->imageHeight;
        $y2 = 0;
        for($x = 0; $x < $this->imageWidth; $x++){
            for($y = 0; $y < $this->imageHeight; $y++){
                $rgba = imagecolorat($this->image, $x, $y);
                $alpha = ($rgba & 0x7F000000) >> 24;
                if($alpha < 127){
                    if($x < $x1){
                        $x1 = $x;
                    }
                    if($y < $y1){
                        $y1 = $y;
                    }
                    if($x > $x2){
                        $x2 = $x;
                    }
                    if($y > $y2){
                        $y2 = $y;
                    }

                }
            }
        }

        $this->spriteTopX = $x1;
        $this->spriteTopY = $y1;
        $this->spriteWidth = $x2 - $x1 + 1;
        $this->spriteHeight = $y2 - $y1 + 1;
    }

}