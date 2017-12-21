<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        echo U();
        echo u('asdf/asdf/fasdf/asdf');
        p('abc');
    }
}