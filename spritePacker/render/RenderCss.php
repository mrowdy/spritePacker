<?php

class RenderCSS implements iRenderer {

    protected $css;
    protected $path;
    protected $name;

    public function __construct($name, $path){
        $this->name = $name;
        $this->path = $path;
    }

    public function render(Atlas $atlas, array $sprites){
        $this->createSpriteClass($atlas);
        $this->createSprites($sprites);
    }

    public function show(){
        echo $this->css;
    }

    public function save(){
        $path = sprintf('%s/%s.css', $this->path, $this->name);
        file_put_contents($path, $this->css);
    }

    public function createSpriteClass($atlas){
        $this->css = sprintf('
            .%s {
                background: transparent url(%s.png);
                width: %dpx;
                height: %dpx;
            }',
            $this->name,
            $this->name,
            $atlas->width,
            $atlas->height
        );
    }

    public function createSprites($sprites){
        foreach($sprites as $sprite){
            $spriteCss = sprintf('
                .%s.%s {
                    width: %dpx;
                    height: %dpx;
                    background-position: -%dpx -%dpx;
                    display: block;
                    padding: 0px;
                }',
                $this->name,
                $sprite->getName(),
                $sprite->getAtlasPositionWidth(),
                $sprite->getAtlasPositionHeight(),
                $sprite->getAtlasPositionX(),
                $sprite->getAtlasPositionY());

            $this->css .= $spriteCss;
        }



    }


}