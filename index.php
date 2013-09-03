<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'spritePacker/SpritePacker.php';

$options = array(
    'atlas-width' => 500,
    'atlas-height' => 500,
);

$spritePacker = new SpritePacker($options);




for($i = 0; $i < 8; $i++){
    $spritePacker->addSprite('test/sprites/testSprite1.png');
}

for($i = 0; $i < 3; $i++){
    $spritePacker->addSprite('test/sprites/testSprite2.png');
}

for($i = 0; $i < 2; $i++){
    $spritePacker->addSprite('test/sprites/testSprite3.png');
}

$spritePacker->run();
$spritePacker->show();