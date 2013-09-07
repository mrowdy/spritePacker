<?php

class RenderPNG implements iRenderer {

    protected $image;
    protected $path;
    protected $name;

    public function __construct($name, $path){
        $this->name = $name;
        $this->path = $path;
    }

    public function render(Atlas $atlas, array $sprites){
        $this->createAtlas($atlas);
        $this->populateImage($sprites);
    }

    public function show(){
        header('Content-Type: image/png');
        imagepng($this->image);
    }

    public function save(){
        $path = sprintf('%s/%s.png', $this->path, $this->name);
        imagepng($this->image, $path);
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