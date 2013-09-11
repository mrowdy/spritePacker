SpritePacker
================================

SpritePacker packs many small images on to larger images to reduce the HTTP overhead produced by many image downloads.
It stores the locations of the smaller images as CSS or JSON so they are easily referenced by their filename in
your code.

SpritePacker is based on the bin packing algorithm.

Demo
------------------------
http://slemgrim.github.io/spritePacker/

Usage
-------------------------
Create an instance from SpritePacker class and add your images.

```php
require_once 'spritePacker/SpritePacker.php';

$spritePacker = new SpritePacker();

//Add all images from directory
$spritePacker->addFromDir('images/sprites');

//Add single image
$spritePacker->addSprite('images/sprite.png');
$spritePacker->addSprite('images/logo-sprite.png');

$spritePacker->run();
```

Without config a 500x500px atlas will be generated under atlas/atlas.png with the corresponding css atlas/atlas.css.

**The folder 'atlas' has to be writable.**

```html
<!-- load generated css -->
<link rel="stylesheet" type="text/css" href="atlas/example-sprite.css">

<!-- use your sprites -->
<span class="atlas sprite"></span>
<span class="atlas logo-sprite"></span>
```

Example Atlas
------------------------

![alt tag](https://raw.github.com/Slemgrim/spritePacker/gh-pages/images/atlas/options-atlas.png)

Example images from:
* http://openiconlibrary.sourceforge.net/
* http://unrestrictedstock.com/


Usage with config
-------------------------

```php
$options = array(
    'name' => 'gui-atlas',
    'path' => '/image/atlas/',
);

$spritePacker = new SpritePacker($options);
$spritePacker->addFromDir('image/sprites/gui');
$spritePacker->run();
```

Creates /image/atlas/gui-atlas.png and /image/atlas/gui-atlas.css.

**The folder 'image/atlas/' has to be writable.**

```html
<!-- load generated css -->
<link rel="stylesheet" type="text/css" href="/image/atlas/gui-atlas.css">

<!-- use your sprites -->
<span class="gui-atlas sprite"></span>
<span class="gui-atlas logo-sprite"></span>
```

Options:
-------------------------

<table>
    <tr>
        <th>Option</th>
        <th>Description</th>
        <th>Default</th>
        <th>Type</th>
    </tr>
    <tr>
        <td>name</td>
        <td>Name of the generated files and CSS class</td>
        <td>atlas</td>
        <td>String</td>
    </tr>
    <tr>
        <td>path</td>
        <td>path for generated files</td>
        <td>atlas</td>
        <td>String</td>
    </tr>
    <tr>
        <td>atlas-width</td>
        <td>Width of generated atlas in px</td>
        <td>500</td>
        <td>Int</td>
    </tr>
    <tr>
        <td>atlas-height</td>
        <td>Height of generated atlas in px</td>
        <td>500</td>
        <td>Int</td>
    </tr>
    <tr>
        <td>gutter</td>
        <td>space between sprites (prevents overlapping in animations)</td>
        <td>0</td>
        <td>Int</td>
    </tr>
    <tr>
        <td>render</td>
        <td>Files to render</td>
        <td>array('RenderPNG', 'RenderCSS')</td>
        <td>Array</td>
    </tr>
    <tr>
        <td>save</td>
        <td>save generated files to disk</td>
        <td>true</td>
        <td>Boolean</td>
    </tr>
</table>

Available Renderer
-------------------------
<table>
    <tr>
        <th>Name</th>
        <th>Description</th>
    </tr>
    <tr>
        <td>RenderPNG</td>
        <td>Create PNG atlas</td>
    </tr>
    <tr>
        <td>RenderCSS</td>
        <td>Create CSS file from atlas. Sprite names generated from file names</td>
    </tr>
    <tr>
        <td>RenderJSON</td>
        <td>Create CSS file from atlas. Sprite names generated from file names</td>
    </tr>
</table>

Use custom renderer
-------------------------

If CSS doesn't fit your needs, you can create your own renderer:

```php

Class RenderDerp extends iRenderer {
    public function __construct($name, $path){}

    public function render(Atlas $atlas, array $sprites){
        //Render your custom format
    }

    public function show(){
        //output your format
    }

    public function save(){
        //save your format to disk
    }

}

$options = array(
    'render' => 'RenderDerp',
);

$spritePacker = new SpritePacker($options);

```

