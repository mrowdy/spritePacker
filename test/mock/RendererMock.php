<?php

class RendererMock implements iRenderer {

    public function __construct($path){

    }

    public function render(Atlas $atlas, array $sprites){
        return false;
    }


    public function show(){

    }

    public function save(){

    }


}