<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'SpritePacker.php';

$spritePacker = new SpritePacker();
$spritePacker->addSprite('test/sprites/test1.png');
$spritePacker->addSprite('test/sprites/test1.png');
$spritePacker->addSprite('test/sprites/test1.png');

$spritePacker->addSprite('test/sprites/dummy.pdf');
$spritePacker->run();

//var_dump($spritePacker);

$spritePacker->show();