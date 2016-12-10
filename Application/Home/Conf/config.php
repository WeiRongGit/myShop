<?php
return array(
	//'配置项'=>'配置值'
    TMPL_PARSE_STRING  => array(
        '__CSS__' =>  '/Public/Home/style' ,   //  更改默认的 __css__ 替换规则
        '__JS__' =>  '/Public/Home/js' ,   //  更改默认的 __css__ 替换规则
        '__IMAGES__' => "/Public/Home/images",

    ),
    'LAYOUT_ON'             =>  true, // 是否启用布局
    'LAYOUT_NAME'           =>  'layout', // 当前布局名称 默认为layout
);