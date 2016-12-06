<?php
/**
 * Created by PhpStorm.
 * User: ｗｉｎｇ
 * Date: 2016/12/5
 * Time: 20:08
 */

namespace Back\Controller;
use Think\Controller;
use Model;
class GoodsController extends Controller
{
    function showList(){
        $model = D('Goods');
        $GoodsData =  $model->select();

        $this->goods = $GoodsData;

        $this->display();
    }
    function add(){//添加商品和展示商品都在同一个操作里面 这样的好处是减少操作的数量

        $model = D('goods');
        //判断是否有信息post过来，如果有信息请求过来,那么就进行插入数据库 否则回退上一步
        if( IS_POST ){
        $goodData = $model->create();
        $goodData['goods_introduce'] = fanXSS($_POST['goods_introduce']);

        $result =  $model->add($goodData);
            if( $result ){
                $this ->success("插入成功",U("showList"));
            }else{
                $this->error("插入失败啦",U("showList"));
            }
        }else{

            $this->display();
        }





    }

    function modify(){
        $this->display();
    }
    function update(){
        $this->display();

    }
}