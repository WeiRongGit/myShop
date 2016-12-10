<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html >
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>会员列表</title>

        <link href="/index.php/Back/Goods/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：商品管理-》商品列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('Back/Goods/add');?>">【添加商品】</a>
                </span>
            </span>
        </div>
        <div></div>
        <div class="div_search">
            <span>
                <form action="#" method="get">
                    品牌<select name="s_product_mark" style="width: 100px;">
                        <option selected="selected" value="0">请选择</option>
                        <option value="1">苹果apple</option>
                    </select>
                    <input value="查询" type="submit" />
                </form>
            </span>
        </div>
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                    <td>序号</td><td>商品名称</td>
                    <td>价格</td><td>重量</td><td>大图</td><td>小图</td><td>创建时间</td>
                    <td align="center" colspan='2'>操作</td>
                </tr>
                <?php if(is_array($goods)): foreach($goods as $key=>$v): ?><tr id="product1">
                        <td><?php echo ($v["goods_id"]); ?></td>
                        <td><a href="#"><?php echo ($v["goods_name"]); ?></a></td>
                        <td><?php echo ($v["goods_price"]); ?></td>
                        <td><?php echo ($v["goods_weight"]); ?></td>
                        <td><img src='<?php echo (deletePoint($v["goods_big_logo"])); ?>' alt='暂无图片' width='100' height='100'/></td>
                        <td><img src='<?php echo (deletePoint($v["goods_small_logo"])); ?>' alt='暂无图片' width='60' height='60'/></td>
                        <td><?php echo ($v["add_time"]); ?></td>
                        <!--<td><a href="/index.php/Back/Goods/upd/goods_id/<?php echo ($v["goods_id"]); ?>" >修改</a></td>-->
                        <td><a href="<?php echo U('update',array('goods_id'=>$v['goods_id']));?>" >修改</a></td>
                        <td><a href="javascript:;" onclick="delete_product(1)">删除</a></td>
                    </tr><?php endforeach; endif; ?>
                <tr>
                    <td colspan="20" style="text-align: center;">
                        <?php echo ($pagelist); ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <?php echo ($pshow); ?>
    </body>
</html>