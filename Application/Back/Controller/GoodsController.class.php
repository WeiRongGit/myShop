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
    function showList()
    {
        $model = D('Goods');

        $count = $model->count();//统计这么表里面的记录数
        $Page = new \Think\Page ($count, 3);//实例化分页对象


        $GoodsData = $model->limit($Page->firstRow . "," . $Page->listRows)->select();

        $Page->setConfig('next', '下一页');
        $show = $Page->show();
        $this->goods = $GoodsData;
        $this->pshow = $show;
        $this->display();
    }

    function add()
    {//添加商品和展示商品都在同一个操作里面 这样的好处是减少操作的数量

//        $model = D('Goods'); 先查找有没有自定义的模型，如果没有侧实例化默认模型
        $model = new Model\GoodsModel();

        //判断是否有信息post过来，如果有信息请求过来,那么就进行插入数据库 否则回退上一步
        if (IS_POST) {
            $goodData = $model->create();
            $goodData['goods_introduce'] = fanXSS($_POST['goods_introduce']);

            $result = $model->add($goodData);
            if ($result ) {
                $this->success("插入成功", U("showList"));
            } else {
                $this->error("插入失败啦", U("showList"));
            }
        } else {

            $this->display();
        }


    }

    function modify()
    {
        $this->display();
    }

    function update()
    {

        // 对数据进行修改
        if (!empty(I("post.goods_id"))) {

            //即使上传了图片,如果没有做其他的改动,修改会显示不成功

            //判断图片是否上传公成功,如果上传成功,假设已经写入到磁盘了.就给出输出信息
            $flag = false;
            foreach ($_FILES['goods_pics_upd']['error'] as $a => $b) {
                if ($b === 0) {
                    $flag = true;
                    break;
                }
            }

            $goodModle = new Model\GoodsModel();
            if ($goodModle->create()) {
                $result = $goodModle->save();
                if ($result) {
                    $this->success("修改成功", U("showList"));
                } else {
                    if($flag){
                        $this->success("图片上传成功", U("showList"));
                    }else{
                        $this->error("修改失败", U("showList"));
                    }
                }
            }
            //点击进来加载资料到模版
        } else if (!empty(I("get.goods_id"))) {



            $goodModle = D(Goods);
            $oneGood = $goodModle->find(I("get.goods_id"));

            $goodPric = D("goods_pics");
            $condition = array("goods_id" => I("get.goods_id"));
            $pic = $goodPric->where($condition)->select();

            $this->picsinfo = $pic;
            $this->good = $oneGood;
            $this->display();
        }
    }

    function delPics()
    {
        $pricModel = D("goods_pics");
        $pricData = $pricModel->find(I("post.pics_id"));

        $re = unlink( $pricData['pics_big'] );
        $re2 = unlink( $pricData['pics_small'] );
        if($re && $re2){
             $pricModel->delete(I("post.pics_id"));

            $this->ajaxReturn("true");
        }else{
            $this->ajaxReturn("false");
        }
    }
}