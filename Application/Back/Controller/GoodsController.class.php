<?php
/**
 * Created by PhpStorm.
 * User: ｗｉｎｇ
 * Date: 2016/12/5
 * Time: 20:08
 */

namespace Back\Controller;
use Think\Controller;

class GoodsController extends Controller
{
    function showList(){
        $model = D('Goods');

        $this->display();
    }
    function add(){
        $this->display();
    }

    function modify(){
        $this->display();
    }
    function update(){
        $this->display();

    }
}