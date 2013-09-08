<?php

class Atlas {

    public $x = 0;
    public $y = 0;
    public $width = 0;
    public $height = 0;
    public $blocks = array();

    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
        $this->blocks[] = new Block(0, 0, $width, $height);
    }

    public function findPosition($width, $height) {
        $position = array(
            'x' => 0,
            'y' => 0,
        );
        foreach ($this->blocks AS $blockId => $block) {
            $block = $this->blocks[$blockId];
            if ($width <= $block->width && $height <= $block->height) {
                $position['x'] = $block->x;
                $position['y'] = $block->y;
                $this->splitBlock($blockId, $width, $height);
                return $position;
            }
        }
        throw new Exception('no space');
    }

    protected function splitBlock($blockId, $width, $height) {
        $block = $this->blocks[$blockId];

        $rightBlock = new Block(
            $block->x + $width,
            $block->y,
            $block->width - $width,
            $height
        );

        $downBlock = new Block(
            $block->x,
            $block->y + $height,
            $block->width,
            $block->height - $height
        );

        if ($rightBlock->width != 0 && $rightBlock->height != 0) {
            $this->blocks[] = $rightBlock;
        }

        if ($downBlock->width != 0 && $downBlock->height != 0) {
            $this->blocks[] = $downBlock;
        }

        unset($this->blocks[$blockId]);

        usort($this->blocks, array('Atlas', 'sortBlocks'));
    }

    protected static function sortBlocks($a, $b) {
        $aSize = $a->width;
        $bSize = $b->width;

        if ($aSize == $bSize) {
            return 0;
        }
        return ($aSize < $bSize) ? -1 : 1;
    }
}