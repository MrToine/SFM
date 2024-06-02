<?php

namespace SFM\Plugins;

class PluginManager {
    public function __construct(){

    }

    public static function loadPlugins(): void {
        $pluginDir = dirname(__DIR__, 2).'/plugins/';
        $files = scandir($pluginDir);

        foreach($files as $file) {
            if($file !== '.' && $file !== '..' && is_dir($pluginDir.$file)) {
                $namespace = 'Plugins\\'.$file;
                $class = $namespace.'\\'.$file;

                if(class_exists($class)) {
                    $plugin = new $class;
                }
            }
        }
    }
}