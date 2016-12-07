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

class GoodsModel extends Model
{
    // 插入数据前的回调方法
    protected function _before_insert(&$data,$options) {
        //检测到图片上传失败就不上传图片。当 gools——logo error 不是0时图标表示没有图片可以上传
        if( $_FILES['goods_logo']['error'] === 0 ){
            $config = array(
                'rootPath'      =>  "./UserImage/Logo/", //保存根路径
            );
            $upload = new Upload( $config );

            $result =   $upload->uploadOne( $_FILES['goods_logo'] );
            $big_path_name = $upload->rootPath.$result['savepath'].$result['savename'];

            $data['goods_big_logo'] = $big_path_name;

            //生成压缩图片
            $image = new Image();
            $image -> open($big_path_name);
            $image ->thumb(60,60);
            $small_path_name = $upload->rootPath.$result['savepath']."small_".$result['savename'];
            $image ->save($small_path_name);

            $data['goods_small_logo'] = $small_path_name;
        }



    }    // 插入成功后的回调方法
    protected function _after_insert($data,$options)
    {

//        //上传相册图片判断（只要有一个相册上传，就往下进行）
//        $flag = false;
//        foreach ($_FILES['goods_pics']['error'] as $a => $b) {
//            if ($b === 0) {
//                $flag = true;
//                break;
//            }
//        }
//        if ($flag === true) {


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
//    }




}