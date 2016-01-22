<?php

//班班运行环境
//本地环境localhost
//测试环境develop
//正式环境product
define ("BANBAN_ENVIRONMENT", "develop"); 


class DatabaseConfig
{
    //班班用户数据库
    static function memberInfo($dbname = 'bb_user_center')
    {
        $db_config = array(
            'connectionString' => 'mysql:host=119.147.71.83:3366;dbname='.$dbname,
            'class'=>'system.db.CDbConnection',
            'emulatePrepare' => true,
            'username' => 'dbManager',
            'password' => '123456',
            'tablePrefix'=>'tb_',
            'charset' => 'utf8mb4',
        );
        return $db_config;
    }

    //班班应用数据库
    static function xiaoxin($dbname = 'bb_xiaoxin')
    {
        $db_config = array(
            'connectionString' => 'mysql:host=119.147.71.83:3366;dbname='.$dbname,
            'class'=>'system.db.CDbConnection',
            'emulatePrepare' => true,
            'username' => 'dbManager',
            'password' => '123456',
            'tablePrefix'=>'tb_',
            'charset' => 'utf8mb4',
        );
        return $db_config;
    }

    //商务应用数据库
    static function dbInfo($dbname = 'bb_business_new')
    {
        $db_config = array(
            'connectionString' => 'mysql:host=119.147.71.83:3366;dbname='.$dbname,
            'emulatePrepare' => true,
            'username' => 'dbManager',
            'password' => '123456',
            'tablePrefix'=>'tb_',
            'charset' => 'utf8mb4',
        );
        return $db_config;
    }

    //公众号应用数据库
    static function official($dbname = 'official_account')
    {
        $db_config = array(
            'connectionString' => 'mysql:host=119.147.71.83:3366;dbname='.$dbname,
            'class'=>'system.db.CDbConnection',
            'emulatePrepare' => true,
            'username' => 'dbManager',
            'password' => '123456',
            'tablePrefix'=>'op_',
            'charset' => 'utf8mb4',
        );
        return $db_config;
    }

    //短信数据库
    static function msgInfo($dbname = 'qtxx_sms')
    {
        $host = BANBAN_ENVIRONMENT=='localhost'?'119.147.71.78':'10.1.1.2';
        $db_config = array(
            'connectionString' => 'mysql:host='.$host.';dbname='.$dbname,
            'class'=>'system.db.CDbConnection',
            'emulatePrepare' => true,
            'username' => 'site',
            'password' => 'bYscX0kFiTGzeUyNeexTFDSa2',
            'tablePrefix'=>'tb_',
            'charset' => 'utf8',
        );
        return $db_config;
    }

    static function cacheInfo()
    {
        $frontend=dirname(dirname(__FILE__));
        //检查是否有memchache模块
        $t = extension_loaded('memcached');
        if(!$t)
        {
            $cache = array(
                'class'=>'system.caching.CFileCache',
                'directoryLevel'=>'2',
                'cachePath'=>$frontend.'/runtime/cache',
                'keyPrefix'=>'qthd_'
            );
        }else{
            $cache = array(
                'class'=>'system.caching.CMemCache',
                'keyPrefix'=>'banban',
                'hashKey'=>true,
                'useMemcached'=>'true',
                'servers'=>array(
                    array('host'=>'127.0.0.1', 'port'=>11211, 'weight'=>100),
                ),
            );
        }
        return $cache;
    }

    /*
     * 此方法用于配置memecach，不同于上面，主要是要使用原生的一些方法s
     * 比如increment,cas,decrement,yii::app()->cache只做了向个通用的set ,get ,delete方法
     */
    public static function nativeCacheInfo(){
        return array('host'=>'127.0.0.1','port'=>11211);
    }
}
