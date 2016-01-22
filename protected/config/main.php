<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here. 
date_default_timezone_set("PRC");
require_once('DatabaseConfig.php');
if(BANBAN_ENVIRONMENT=='product'){
	ini_set('display_errors', 0);
}

require_once('Constants.php');
require_once(dirname(__FILE__).'/../extensions/JceHelper.php');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>SITE_NAME,
	'defaultController'=>'site',
    'language'=>'zh_cn',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.backend.models.base.*',
		'application.backend.models.member.*',
		'application.backend.models.official.*',
		'application.backend.models.*',
		// 'application.backend.modules.member.models.*',
		// 'application.modules.api.models.*',
		'application.components.*',
		'application.extensions.*',
	    'application.helpers.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'api',
		'official',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class'=>'WebUser',
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:('.SITE_URL_KEY.'\w+)|(\d+)>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:('.SITE_URL_KEY.'\w+)|(\d+)>'=>'<controller>/<action>',
				'<modules:\w+>/<controller:\w+>/<action:\w+>/<id:('.SITE_URL_KEY.'\w+)|(\d+)>'=>'<modules>/<controller>/<action>',
				'<modules:\w+>/<controller:\w+>/<action:\w+>'=>'<modules>/<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

				// 'http://pc.qtxiaoxin.com'=>'official/default/index',
				// 'http://gzh.qtxiaoxin.com'=>'official/default/index',
				// 'http://gzh.test'=>'official/default/index',
				// 'http://gzh.local'=>'official/default/index',

				'http://<module:\w+>.local.com/' => '<module>/default',
				'http://<module:\w+>.local.com/<controller:\w+>' => '<module>/<controller>/',
				'http://<module:\w+>.local.com/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
				'http://<module:\w+>.local.com/<controller:\w+>/<action:\w+>/<id:('.SITE_URL_KEY.'\w+)|(\d+)>' => '<module>/<controller>/<action>',

				'http://<module:\w+>.test.com/' => '<module>/default',
				'http://<module:\w+>.test.com/<controller:\w+>' => '<module>/<controller>/',
				'http://<module:\w+>.test.com/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
				'http://<module:\w+>.test.com/<controller:\w+>/<action:\w+>/<id:('.SITE_URL_KEY.'\w+)|(\d+)>' => '<module>/<controller>/<action>',
			),
		),
		
		'db'=>DatabaseConfig::dbinfo(),
		'db_member'=>DatabaseConfig::memberinfo(),
        'db_xiaoxin'=>DatabaseConfig::xiaoxin(),
        'db_msg'=>DatabaseConfig::msgInfo('xw_sms'),//手机验证短信库
        'db_msg_qtxx'=>DatabaseConfig::msgInfo('xw_sms'),//校信通知短信库
        'db_official'=>DatabaseConfig::official(),//公众号数据库
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'msg' => array(
			'class' => 'application.extensions.emessage.EMessage'
		),

		'authManager'=>array(
			'class'=>'application.components.AuthManager',
		),

		'cache'=>DatabaseConfig::cacheInfo(),
		'log'=>array(
		 	'class'=>'CLogRouter',
		 	'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error',
					'categories'=>'Curl.*',
					'logFile'=> 'curl.log',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error',
					'categories'=>'Tenpay.*',
					'logFile'=> 'tenpay.log',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error',
					'categories'=>'Api.*',
					'logFile'=> 'api.log',
				),
				// // uncomment the following to show log messages on web pages
				
				// array(
				// 	'class'=>'CWebLogRoute',
				// ),
				// array(  
		  //           'class'=>'CDbLogRoute',  
		  //           'connectionID'=>'db',  
		  //           'levels'=>'trace',  
		  //           'logTableName' => 'sql_querylogs',  
		  //           'categories'=>'system.db.CDbCommand',  
		  //       ), 
     
				
		 	),
        ),
	    'image'=>array(
	        'class'=>'application.extensions.image.CImageComponent',
	        // GD or ImageMagick
	        'driver'=>'GD',
	        // ImageMagick setup path
	        // 'params'=>array('directory'=>'D:/Program Files/ImageMagick-6.4.8-Q16'),
	    ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'platform' => 'fronted',
        'memcache'=>DatabaseConfig::nativeCacheInfo(),
	),
);