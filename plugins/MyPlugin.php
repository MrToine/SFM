<?php

namespace Plugins;

class MyPlugin {
    public function process() {
        $this->test();
    }

    public function test() {
        var_dump('Plugin Chargé');
    }
}