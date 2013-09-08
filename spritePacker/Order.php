<?php

class Order {

    const ORDER_BY_IMAGESIZE = 0;
    const ORDER_BY_SPRITESIZE = 1;
    protected static $orderBy;

    protected $atlas = null;
    protected $sprites = array();
    protected $gutter = 0;

    public function __construct(Atlas $atlas = null, $gutter = 0) {
        $this->atlas = $atlas;
        $this->gutter = $gutter;
        self::$orderBy = self::ORDER_BY_IMAGESIZE;
    }

    public function getSprites() {
        return $this->sprites;
    }

    public function addSprite(iSprite $sprite) {
        array_push($this->sprites, $sprite);
    }

    public function addSprites($sprites) {
        if (is_array($sprites)) {
            foreach ($sprites as $sprite) {
                $this->addSprite($sprite);
            }
        } else {
            $this->addSprite($sprites);
        }
    }

    public function order() {
        if (!empty($this->sprites)) {
            usort($this->sprites, array('Order', 'orderLargestToSmallest'));
        }

        if ($this->atlas) {
            foreach ($this->sprites as $sprite) {
                $width = $this->getSpriteWidth($sprite);
                $height = $this->getSpriteHeight($sprite);

                try {
                    $widthG = $width + ($this->gutter);
                    $heightG = $height + ($this->gutter);
                    $position = $this->atlas->findPosition($widthG, $heightG);

                    $sprite->setAtlasPositionX($position['x']);
                    $sprite->setAtlasPositionY($position['y']);
                    $sprite->setAtlasPositionWidth($width);
                    $sprite->setAtlasPositionHeight($height);
                } catch (Exception $e) {
                    //TODO: handle to big sprites
                }
            }
        }
        return $this->sprites;
    }

    public function setOrderBy($orderBy) {
        switch ($orderBy) {
            case self::ORDER_BY_SPRITESIZE:
                self::$orderBy = self::ORDER_BY_SPRITESIZE;
                break;
            case self::ORDER_BY_IMAGESIZE:
            default:
                self::$orderBy = self::ORDER_BY_IMAGESIZE;
                break;
        }
    }

    protected static function orderLargestToSmallest($a, $b) {
        switch (self::$orderBy) {
            case self::ORDER_BY_IMAGESIZE:
                $aSize = $a->getImageWidth() * $a->getImageHeight();
                $bSize = $b->getImageWidth() * $b->getImageHeight();
                break;
            case self::ORDER_BY_SPRITESIZE:
            default:
                $aSize = $a->getSpriteWidth() * $a->getSpriteHeight();
                $bSize = $b->getSpriteWidth() * $b->getSpriteHeight();
                break;
        }

        if ($aSize == $bSize) {
            return 0;
        }
        return ($aSize > $bSize) ? -1 : 1;
    }

    protected function getSpriteWidth(iSprite $sprite) {
        switch (self::$orderBy) {
            case self::ORDER_BY_SPRITESIZE:
                return $sprite->getSpriteWidth();
                break;
            case self::ORDER_BY_IMAGESIZE:
            default:
                return $sprite->getImageWidth();
                break;
        }
    }

    protected function getSpriteHeight(iSprite $sprite) {
        switch (self::$orderBy) {
            case self::ORDER_BY_SPRITESIZE:
                return $sprite->getSpriteHeight();
                break;
            case self::ORDER_BY_IMAGESIZE:
            default:
                return $sprite->getImageHeight();
                break;
        }
    }
}