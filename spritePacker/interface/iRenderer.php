<?php

interface iRenderer{

    public function renderAtlas(Atlas $atlas, array $sprites);
    public function show();
    public function save($path);

}