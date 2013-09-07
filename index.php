<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'spritePacker/SpritePacker.php';

$options = array(
    'name' => 'test-sprite',
    'gutter' => 5,
);

$spritePacker = new SpritePacker($options);
$spritePacker->addFromDir('test/sprites');
$spritePacker->addFromDir('test/sprites');
$spritePacker->run();

?>

<link rel="stylesheet" type="text/css" href="atlas/test-sprite.css">
<span class="test-sprite testSprite1"></span>