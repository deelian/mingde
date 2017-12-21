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
        $this->display();
    }
}