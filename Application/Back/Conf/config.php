<?php
return array(
//	//'配置项'=>'配置值'
    TMPL_PARSE_STRING  => array(
        '__CSS__' =>  '/Public/Admin/style' ,   //  更改默认的 __css__ 替换规则
        '__JS__' =>  '/Public/Admin/js' ,   //  更改默认的 __css__ 替换规则
        '__IMAGES__' => "/Public/Admin/img",

        '__UEDITOR__'=>  "/Plugin/ueditor",
        '__UPLOAD_PREVIEW__'=>  "/Plugin/uploadPreview",

        '__UserImage_PRIC__'=>  "/UserImage/pric",
        '__UserImage_LOGO__'=>  "/UserImage/Logo",
    ),
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'shop02',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '394053371',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'php41_',    // 数据库表前缀
    'DB_PARAMS'          	=>  array(), // 数据库连接参数
    'DB_DEBUG'  			=>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
);