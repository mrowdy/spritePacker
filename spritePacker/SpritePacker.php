<?php

require_once "interface/iSprite.php";
require_once "interface/iRenderer.php";
require_once "Sprite.php";
require_once "Renderer.php";
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

    protected $renderer = null;

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
        $this->orderSprites();
        $this->render();
        return true;
    }

    public function show(){
        $this->renderer->show();
    }

    protected function isImage($spritePath){
        if(getimagesize($spritePath) !== false){
            return true;
        }
        return false;
    }

    protected function orderSprites(){
        $this->order->addSprites($this->sprites);
        $this->sprites = $this->order->order();
    }

    protected function render(){
        $this->renderer = new Renderer();
        $this->renderer->renderAtlas($this->atlas, $this->sprites);
    }
}