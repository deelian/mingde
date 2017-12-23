<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{

    function _initialize()
    {

    }

    public function index()
    {
        echo U();
        echo '<br>';
        echo u('asdf/asdf');
        $this->display();
    }
}