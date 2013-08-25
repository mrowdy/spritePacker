<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'SpritePacker.php';

$options = array(
    'atlas-width' => 1600,
    'atlas-height' => 2000,
);

$spritePacker = new SpritePacker($options);

for($i = 0; $i < 8; $i++){
    $spritePacker->addSprite('test/sprites/test1.png');
}

for($i = 0; $i < 3; $i++){
    $spritePacker->addSprite('test/sprites/test1x2.png');
}

for($i = 0; $i < 2; $i++){
    $spritePacker->addSprite('test/sprites/test1x4.png');
}

$spritePacker->run();
$spritePacker->show();