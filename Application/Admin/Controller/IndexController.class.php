<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{

    function _initialize()
    {

    }

    public function welcome()
    {
        $this->display();
    }

    public function index()
    {
        $this->display();
    }


}