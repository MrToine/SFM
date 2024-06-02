<?php

namespace App\Controllers;

use SFM\Controller\BaseController;

class DataVisualizerController extends BaseController {

    public $layout = "DataVisualizer/layout";

    public function index(){
        
        $files = scandir(dirname(__DIR__, 2).'/data/');

        foreach($files as $file) {
            if($file !== '.htaccess' && $file !== '.' && $file !== '..') {
                $file = trim($file, '.json');
                $classname = ucfirst($file);
                $fileClass = "App\\Models\\$classname";
                if(class_exists($fileClass)){
                    $model = new $fileClass();
                    $data[$file] = $model->all();
                }
            }
        }

        return $this->render('DataVisualizer/index.php', $data);
    }
}