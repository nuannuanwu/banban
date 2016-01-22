<?php
// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
date_default_timezone_set("PRC");
require_once('DatabaseConfig.php');
require_once('Constants.php');
require_once(dirname(__FILE__).'/../extensions/JceHelper.php');
return array (
        'basePath' => dirname ( __FILE__ ) . DIRECTORY_SEPARATOR . '..',
        'name' => 'My Console Application',
        'import'=>array(
            'application.models.*',
            'application.commands.*',
            'application.backend.models.base.*',
            'application.backend.models.member.*',
            'application.backend.models.official.*',
            'application.backend.models.*',
            'application.modules.xiaoxin.models.*',
            // 'application.backend.modules.member.models.*',
            // 'application.modules.api.models.*',
            'application.components.*',
            'application.extensions.*',
            'application.extensions.banban.*',
            'application.modules.official.components.*',
            'application.modules.official.models.*',
            'application.extensions.*',
            'application.helpers.*',
        ),
        'modules'=>array(
            // uncomment the following to enable the Gii tool
            'api',
            'xiaoxin',
            'official',
            'gii'=>array(
                'class'=>'system.gii.GiiModule',
                'password'=>'123456',
                // If removed, Gii defaults to localhost only. Edit carefully to taste.
                'ipFilters'=>array('127.0.0.1', '::1'),
            ),
            
        ),
        'components' => array (
                // Main DB connection
            'db'=>DatabaseConfig::dbinfo(),
            'db_member'=>DatabaseConfig::memberinfo(),
            'db_xiaoxin'=>DatabaseConfig::xiaoxin(),
            'db_msg'=>DatabaseConfig::msgInfo('xw_sms'),//手机验证短信库
            'db_msg_qtxx'=>DatabaseConfig::msgInfo('qtxx_sms'),//校信通知短信库
            'db_official'=>DatabaseConfig::official(),//公众号数据库
            
                'cache'=>DatabaseConfig::cacheInfo(),
                'log' => array (
                        'class' => 'CLogRouter',
                        'routes' => array (
                                array (
                                        'class' => 'CFileLogRoute',
                                        'levels' => 'error, warning'
                                ) 
                        ) 
                ) 
        ) 
);