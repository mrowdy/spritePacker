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
        $this->css = sprintf(
            '.%s {' . PHP_EOL
            . '    background: transparent url(%s.png);' . PHP_EOL
            . '    width: %dpx;' . PHP_EOL
            . '    height: %dpx;' . PHP_EOL
            . '}' . PHP_EOL,
            $this->name,
            $this->name,
            $atlas->width,
            $atlas->height
        );
    }

    public function createSprites($sprites){
        foreach($sprites as $sprite){
            $spriteCss = sprintf( PHP_EOL .
                '.%s.%s {' . PHP_EOL
                . '    width: %dpx;' . PHP_EOL
                . '    height: %dpx;' . PHP_EOL
                . '    background-position: -%dpx -%dpx;' . PHP_EOL
                . '    display: block;' . PHP_EOL
                . '    padding: 0px;' . PHP_EOL
                . '}' . PHP_EOL,
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
