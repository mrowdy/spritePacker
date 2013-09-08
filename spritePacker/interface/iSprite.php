<?php

interface iSprite {
    public function getImageWidth();

    public function getImageHeight();

    public function getSpriteWidth();

    public function getSpriteHeight();

    public function getAtlasPositionX();

    public function getAtlasPositionY();

    public function setAtlasPositionX($pos);

    public function setAtlasPositionY($pos);

    public function getAtlasPositionWidth();

    public function getAtlasPositionHeight();

    public function setAtlasPositionWidth($width);

    public function setAtlasPositionHeight($height);
}