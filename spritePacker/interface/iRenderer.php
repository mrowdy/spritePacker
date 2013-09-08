<?php

interface iRenderer {

    public function __construct($name, $path);

    public function render(Atlas $atlas, array $sprites);

    public function show();

    public function save();
}