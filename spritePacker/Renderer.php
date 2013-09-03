<?php

class Renderer implements iRenderer {

    protected $image;

    public function renderAtlas(Atlas $atlas, array $sprites){
        $this->createAtlas($atlas);
        $this->populateImage($sprites);
        $this->show();
    }

    public function show(){
        header('Content-Type: image/png');
        imagepng($this->image);
    }

    public function save($path){

    }

    protected function createAtlas(Atlas $atlas){
        $this->image = imagecreate($atlas->width, $atlas->height);
    }

    protected function populateImage(array $sprites){
        foreach($sprites AS $sprite){
            $dstImage = $this->image;
            $srcImage = $sprite->getImage();
            $dstX = $sprite->getAtlasPositionX();
            $dstY = $sprite->getAtlasPositionY();
            $srcX = 0;
            $srcY = 0;
            $srcW = $dstW = $sprite->getAtlasPositionWidth();
            $srcH = $dstH = $sprite->getAtlasPositionHeight();
            imagecopyresampled (
                $dstImage,
                $srcImage ,
                $dstX ,
                $dstY ,
                $srcX ,
                $srcY ,
                $dstW ,
                $dstH ,
                $srcW ,
                $srcH
            );
        }
    }
}