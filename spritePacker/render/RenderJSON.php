<?php

class RenderJSON implements iRenderer {

    protected $path;
    protected $name;

    protected $atlas;
    protected $sprites;

    protected $json;

    public function __construct($name, $path) {
        $this->name = $name;
        $this->path = $path;
    }

    public function render(Atlas $atlas, array $sprites) {
        $this->atlas = $atlas;
        $this->sprites = $sprites;
        $this->createJSON();
    }

    public function show() {
        echo $this->json;
    }

    public function save() {
        $path = sprintf('%s/%s.json', $this->path, $this->name);
        file_put_contents($path, $this->json);
    }

    protected function createJson() {
        $atlas = array(
            'name' => $this->name,
            'path' => $this->path,
            'count' => count($this->sprites),
            'sprites' => $this->sprites,
        );
        $this->json = json_encode($atlas);
    }
}