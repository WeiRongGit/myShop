<?php
/**
 * Created by PhpStorm.
 * User: ｗｉｎｇ
 * Date: 2016/12/6
 * Time: 13:03
 */

namespace Model;

use Think\Image;
use Think\Model;
use Think\Upload;


/*数据表字段
 * goods_id
goods_name
goods_price
goods_shop_price
goods_number
goods_weight
cat_id
brand_id
goods_big_logo
goods_small_logo
goods_introduce
is_sale
is_rec
is_hot
is_new
add_time
upd_time
is_del

 */
 //视频中使用了自动完成来对更新时间进行更新
class GoodsModel extends Model
{
    // 插入数据前的回调方法
    protected function _before_insert(&$data, $options)
    {
        //检测到图片上传失败就不上传图片。当 gools——logo error 不是0时图标表示没有图片可以上传
        if ($_FILES['goods_logo']['error'] === 0) {
            $config = array(
                'rootPath' => "./UserImage/Logo/", //保存根路径
            );
            $upload = new Upload($config);

            $result = $upload->uploadOne($_FILES['goods_logo']);
            $big_path_name = $upload->rootPath . $result['savepath'] . $result['savename'];

            $data['goods_big_logo'] = $big_path_name;

            //生成压缩图片
            $image = new Image();
            $image->open($big_path_name);
            $image->thumb(60, 60);
            $small_path_name = $upload->rootPath . $result['savepath'] . "small_" . $result['savename'];
            $image->save($small_path_name);

            $data['goods_small_logo'] = $small_path_name;
        }


    }    // 插入成功后的回调方法

    protected function _after_insert($data, $options)
    {

//        上传相册图片判断（只要有一个相册上传，就往下进行）
        $flag = false;
        foreach ($_FILES['goods_pics']['error'] as $a => $b) {
            if ($b === 0) {
                $flag = true;
                break;
            }
        }
        if ($flag === true) {
            $config = array(
                'rootPath' => "./UserImage/pric/", //保存根路径
            );
            $upload = new Upload($config);
            //保存全部
            $result = $upload->upload(array("goods_pics" => $_FILES['goods_pics']));


            $model = D('goods_pics');

            foreach ($result as $onePhoto) {

                $big_path_name = $upload->rootPath . $onePhoto['savepath'] . $onePhoto['savename'];

                $image = new Image();
                $image->open($big_path_name);
                $image->thumb(60, 60);
                $small_path_name = $upload->rootPath . $onePhoto['savepath'] . "small_" . $onePhoto['savename'];
                $image->save($small_path_name);

                $parm = array(
                    "goods_id" => $data['goods_id'],
                    "pics_big" => $big_path_name,
                    "pics_small" => $small_path_name,
                );
                $model->add($parm);
            }
        }
    }

    // 更新数据前的回调方法
    protected function _before_update(&$data, $options)
    {


        if ($_FILES['goods_logo_upd']['error'] === 0) {
            $goodId = I("post.goods_id");
            $oneGood = $this->find($goodId);
            //删除来源的图片
            if (!empty($oneGood['goods_big_logo']) || !empty($oneGood['goods_small_logo'])) {
                unlink($oneGood['goods_big_logo']);
                unlink($oneGood['goods_small_logo']);
            }

            $config = array(
                'rootPath' => "./UserImage/Logo/", //保存根路径
            );
            $upload = new upload($config);


            $result = $upload->uploadOne($_FILES['goods_logo_upd']);
            $big_path_name = $upload->rootPath . $result['savepath'] . $result['savename'];

            $data['goods_big_logo'] = $big_path_name;

            //生成压缩图片
            $image = new Image();
            $image->open($big_path_name);
            $image->thumb(60, 60);
            $small_path_name = $upload->rootPath . $result['savepath'] . "small_" . $result['savename'];
            $image->save($small_path_name);

            $data['goods_small_logo'] = $small_path_name;

        }

        $flag = false;
        foreach ($_FILES['goods_pics_upd']['error'] as $a => $b) {
            if ($b === 0) {
                $flag = true;
                break;
            }
        }
        if ($flag === true) {

                $config = array(
                    'rootPath' => "./UserImage/pric/", //保存根路径
                );

                $upload = new Upload($config);
//            //保存全部
                $result = $upload->upload(array("goods_pics_upd" => $_FILES['goods_pics_upd']));

                $model = D('goods_pics');

                foreach ($result as $onePhoto) {

                    $big_path_name = $upload->rootPath . $onePhoto['savepath'] . $onePhoto['savename'];

                    $image = new Image();
                    $image->open($big_path_name);
                    $image->thumb(60, 60);
                    $small_path_name = $upload->rootPath . $onePhoto['savepath'] . "small_" . $onePhoto['savename'];
                    $image->save($small_path_name);

                    $parm = array(
                        "goods_id" => I("post.goods_id"),
                        "pics_big" => $big_path_name,
                        "pics_small" => $small_path_name,
                    );
                    $re = $model->add($parm);
                }
            }



    }

    // 更新成功后的回调方法
    protected function _after_update($data, $options)
    {
    }


}