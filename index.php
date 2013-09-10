<?php

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require_once 'spritePacker/spritePacker/SpritePacker.php';

    $options = array(
        'name' => 'web',
        'path' => 'images/atlas/'
    );

    $spritePacker = new SpritePacker($options);
    $spritePacker->addFromDir('spritePacker/spritePacker/example/images');
    $spritePacker->run();

var_dump($spritePacker);
die();

?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset='utf-8' />
    <meta http-equiv="X-UA-Compatible" content="chrome=1" />
    <meta name="description" content="Spritepacker : SpritePacker is a PHP tool to create sprite atlases automatically from an existing image folder." />

    <link rel="stylesheet" type="text/css" media="screen" href="stylesheets/stylesheet.css">
    <link rel="stylesheet" type="text/css" media="screen" href="images/atlas/web.css">

    <title>Spritepacker</title>
  </head>

  <body>

    <!-- HEADER -->
    <div id="header_wrap" class="outer">
        <header class="inner">
          <a id="forkme_banner" href="https://github.com/Slemgrim/spritePacker">View on GitHub</a>

          <h1 id="project_title">Spritepacker</h1>
          <h2 id="project_tagline">SpritePacker is a PHP tool to create sprite atlases automatically from an existing image folder.</h2>

            <section id="downloads">
              <a class="zip_download_link" href="https://github.com/Slemgrim/spritePacker/zipball/master">Download this project as a .zip file</a>
              <a class="tar_download_link" href="https://github.com/Slemgrim/spritePacker/tarball/master">Download this project as a tar.gz file</a>
            </section>
        </header>
    </div>

    <!-- MAIN CONTENT -->
    <div id="main_content_wrap" class="outer">
      <section id="main_content" class="inner">


      </section>
    </div>

    <!-- FOOTER  -->
    <div id="footer_wrap" class="outer">
      <footer class="inner">
        <p class="copyright">Spritepacker maintained by <a href="https://github.com/Slemgrim">Slemgrim</a></p>
        <p>Published with <a href="http://pages.github.com">GitHub Pages</a></p>
      </footer>
    </div>

    

  </body>
</html>
