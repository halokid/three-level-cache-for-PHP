# three-level-cache-for-PHP

PHP three level cache , support APC,  redis, static page

just one set & one get 

you can defined your cache adater by yourself

PHP三层缓存类，支持APC, redis， 静态文件, 支持set , get方法，初始化三种缓存的配置，详情看代码

调用代码如下：

<?php

$tc = new Three_Cache();
$tc->set_first_adater();
$tc->set_second_adater('127.0.0.1', 6379);
$tc->set_third_adater('/opt/cache/');
$tc->set('test_key', 'test_value');
echo $tc->get('test_key');

?>
