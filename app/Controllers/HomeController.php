<?php
namespace App\Controllers;

use SFM\Controller\BaseController;
use App\Models\Test;

class HomeController extends BaseController {

    public function index(){
        $test = new Test();
        $last = $test->last();
        $data = [
            'id' => $last->id + 1,
            'name' => 'John Doe',
            'content' => 'Sample content'
        ];
        //$test->insert($data);

        $data = [
            'variable_test' => 'Je suis une variable',
        ];

        $myPlugin = new \Plugins\MyPlugin();
        $myPlugin->process();

        return $this->render('home/index.php', $data);
    }

    public function save_test(){
        $test = new Test();
        $data = $test->find(2);
        if($data) {
            $data->name = 'Toine Toine';
            $data->save();
        }

        return $this->render('home/test.php', $data);
    }

    public function delete(){
        $test = new Test();
        $data = $test->find(2);
        if($data) {
            $data->destroy(32);
        }

        return $this->render('home/test.php', $data);
    }

    public function test() {
        return $this->redirect_to_route('home', $data);
    }
}