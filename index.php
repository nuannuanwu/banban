<?php
function getRenderedHTML($path)
{
    ob_start();
    include($path);
    $var=ob_get_contents(); 
    ob_end_clean();
    return $var;
}

function __shutdown($httperror=false) {
    $error = error_get_last();
    // var_dump($error);
    if(isset($error['type']) && !in_array($error['type'], array(E_STRICT,E_DEPRECATED))){
        $html = getRenderedHTML('__error.html');
        echo $html;
        exit;
    }
}
register_shutdown_function('__shutdown');


// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';

$config=dirname(__FILE__).'/protected/config/main.php';

$application=dirname(__FILE__).'/protected/components/UrlWebApplication.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

function conlog($msg='')
{
    echo "<pre>";
    print_r($msg);
    exit;
}
function D($msg='')
{
    header("Content-type:text/html;charset=utf-8");
    echo "<pre>";
    print_r($msg);
    exit;
}
function mlog($msg='')
{
    echo "<pre>";
    var_dump($msg);
    exit;
}
require_once($yii);
require_once($application);
$app = new UrlWebApplication($config);  
$app->run();

