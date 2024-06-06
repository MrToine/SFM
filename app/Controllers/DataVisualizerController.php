<?php

namespace App\Controllers;

use SFM\Controller\BaseController;

class DataVisualizerController extends BaseController {

    public $layout = "DataVisualizer/layout";

    public function index($table){
        $data['table_name'] = $table;
        $table = ucfirst($table);
        $files = scandir(dirname(__DIR__, 2).'/data/');

        foreach($files as $file) {
            if($file !== '.htaccess' && $file !== '.' && $file !== '..') {
                $file = trim($file, '.json');
                $fileClass = "App\\Models\\$table";
                if(class_exists($fileClass)){
                    $model = new $fileClass();
                    $data['table'][$file] = $model->all();
                }
            }
        }

        return $this->render('DataVisualizer/index.php', $data);
    }

    public function add() {

        return $this->render('DataVisualizer/add.php');
    }
}