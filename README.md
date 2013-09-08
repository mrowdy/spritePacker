SpritePacker
================================

SpritePacker packs many smaller images on to larger images to reduce the HTTP overhead produced by many image downloads.
It stores the locations of the smaller images as CSS or JSON so they are easily referenced by their filename in
your code.

SpritePacker is based on the bin packing algorithm

Usage
-------------------------
Create instance from SpritePacker class and add your images.

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

without config a 500x500px atlas will be generated under atlas/atlas.png with the css atlas/atlas.css.
**The folder 'atlas' has to be writable.**

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
        <td>Which files to render.
        available:
        * RenderPNG
        * RenderCSS
        * RenderJSON</td>
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
