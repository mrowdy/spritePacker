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
        file_put_contents($this->path, $this->css);
    }


    /**
     * TODO: replace hardcoded path with atlas name
     */
    public function createSpriteClass($atlas){
        $this->css = sprintf('
            .sprite {
                background: transparent url(%s);
                width: %dpx;
                height: %dpx;
            }
        ', 'atlas.png', $atlas->width, $atlas->height);
    }

    public function createSprites($sprites){
        foreach($sprites as $sprite){
            $spriteCss = sprintf('
                .sprite.%s {
                    width: %dpx;
                    height: %dpx;
                    background-position: -%dpx -%dpx;
                    display: block;
                    padding: 0px;
                }',
                $sprite->getName(),
                $sprite->getAtlasPositionWidth(),
                $sprite->getAtlasPositionHeight(),
                $sprite->getAtlasPositionX(),
                $sprite->getAtlasPositionY());

            $this->css .= $spriteCss;
        }



    }


}