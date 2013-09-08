<?php

require_once "interface/iSprite.php";
require_once "interface/iRenderer.php";
require_once "Sprite.php";
require_once "render/RenderPNG.php";
require_once "render/RenderCSS.php";
require_once "render/RenderJSON.php";
require_once "Atlas.php";
require_once "Block.php";
require_once "Order.php";

class SpritePacker {

    protected $sprites = array();
    protected $options = array(
        'name' => 'atlas',
        'path' => 'atlas',
        'atlas-width' => 500,
        'atlas-height' => 500,
        'gutter' => 0,
        'render' => array(
            'RenderCSS',
            'RenderPNG',
            //'RenderJSON',
        ),
        'save' => true,
    );

    protected $atlasWidth = 0;
    protected $atlasHeight = 0;
    protected $atlas = null;
    protected $atlasResource = null;
    protected $order = null;

    protected $renderer = null;

    public function __construct($options = array()) {

        $this->options = array_merge($this->options, $options);
        $this->atlas = new Atlas($this->options['atlas-width'], $this->options['atlas-height']);
        $this->order = new Order($this->atlas, $this->options['gutter']);

        foreach ($this->options['render'] AS $rendererName) {
            $renderer = new $rendererName($this->options['name'], $this->options['path']);
            if ($renderer instanceof iRenderer) {
                $this->renderer[$rendererName] = $renderer;
            }
        }
    }

    public function addSprite($spritePath) {
        if (file_exists($spritePath) && is_file($spritePath) && $this->isImage($spritePath)) {
            $sprite = new Sprite($spritePath);
            $this->sprites[$sprite->getName()] = $sprite;
            return true;
        }
        return false;
    }

    public function addFromDir($dir) {
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    $file = sprintf('%s/%s', $dir, $file);
                    $this->addSprite($file);
                }
            }
        }
    }

    public function run() {
        if (empty($this->sprites)) {
            return false;
        }
        $this->orderSprites();
        $this->render();
        return true;
    }

    public function show($name) {
        $this->renderer[$name]->show();
    }

    protected function isImage($spritePath) {
        if (getimagesize($spritePath) !== false) {
            return true;
        }
        return false;
    }

    protected function orderSprites() {
        $this->order->addSprites($this->sprites);
        $this->sprites = $this->order->order();
    }

    protected function render() {
        foreach ($this->renderer as $renderer) {
            $renderer->render($this->atlas, $this->sprites);
            if ($this->options['save']) {
                $renderer->save();
            }
        }
    }
}