<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{

    function _initialize()
    {
        echo "string";
    }

    public function index()
    {
        echo U();
        echo u('/asdf/asdf/fasdf/asdf');
        $this->display();
    }
}