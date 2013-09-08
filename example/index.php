<?php

require_once '../spritePacker/SpritePacker.php';

$options = array(
    'name' => 'example-sprite',
    'gutter' => 5,
);

$spritePacker = new SpritePacker($options);
$spritePacker->addFromDir('images');
$spritePacker->run();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8 />
    <title>SpritePacker example</title>
    <link rel="stylesheet" type="text/css" href="atlas/example-sprite.css">
</head>
<body>
    <span class="example-sprite application-exit-4"></span>
</body>
</html>

