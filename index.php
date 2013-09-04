<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'spritePacker/SpritePacker.php';

$options = array(
    'atlas-width' => 500,
    'atlas-height' => 500,
);

$spritePacker = new SpritePacker($options);


$spritePacker->addSprite('test/sprites/testSprite1.png');
$spritePacker->addSprite('test/sprites/testSprite2.png');
$spritePacker->addSprite('test/sprites/testSprite3.png');


$spritePacker->run();
//$spritePacker->show('render-css');

?>

<link rel="stylesheet" type="text/css" href="atlas/atlas.css">
<span class="sprite testSprite1"></span>

