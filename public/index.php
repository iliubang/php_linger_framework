<?php
/*
 |------------------------------------------------------------------
 | linger.iliubang.cn
 |------------------------------------------------------------------
 | @author    : liubang 
 | @date      : 16/3/23 下午8:20
 | @copyright : (c) iliubang.cn
 | @license   : MIT (http://opensource.org/licenses/MIT)
 |------------------------------------------------------------------
 */


define('APP_ROOT', realpath(dirname(__FILE__) . '/../'));

define('APP_NAME', 'app');

require APP_ROOT . '/Linger/Linger.php';

app(APP_ROOT . '/app/conf/config.php')->bootstrap()->run();
