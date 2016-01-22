<?php

/**
 * yii内存中的操作方法扩展，如日志方法等
 * @author ld 2015-2-10
 */
class YiiMem 
{
    protected static $onece = false;
    
    /**
     * 日志记录类扩展，方便节省日志大小
     * 这里注意记录条数，超出最大记录条数会被yii清空
     */
    public static function log( $msg, $level, $category )
    {
        if( false == self::$onece ){
            self::store(false);
            self::$onece = true;
        }

        Yii::log( $msg, $level, $category );
    }
    
    /**
     * 是否开启记录到其它存储上面
     */
    public static function store( $enabled = false )
    {
        self::$onece = $enabled;
        
        $routers = Yii::app()->log->getRoutes();
        foreach( $routers as $v ){
            if( true == isset($v->enabled) ){
                $v->enabled = $enabled;
            }
        }    
    }
}