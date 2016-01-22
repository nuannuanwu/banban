<?php

/**
 * 网址操作静态类
 * @author ld
 * @version 2015年6月9日 下午3:49:49
 */
class BaseUrl {
    /**
     * 适合GET方式传递的base64编码
     * @param string $param
     * @return string
     */
    public static function base64Encode( $param ) 
    {
        return rtrim(strtr(base64_encode($param), '+/', '-_'), '=');
    }

    /**
     * 适合GET方式传递的base64解码
     * @param string $param
     * @return string
     */
    public static function base64Decode( $param ) 
    {
        return base64_decode(str_pad(strtr($param, '-_', '+/'), strlen($param) % 4, '=', STR_PAD_RIGHT));
    }
    
    /**
     * 对字符串反转，然后base64 特殊处理 转码
     * @param string $param
     * @return string
     */
    public static function encode( $param )
    {
        return SITE_URL_KEY.str_rot13( self::base64Encode( strrev( $param ) ) );
    }
    
    /**
     * 对字符串反转，然后base64 特殊处理 解码
     * @param string $param
     * @return string
     */
    public static function decode( $param )
    {        
        if( substr( $param, 0, strlen( SITE_URL_KEY ) ) != SITE_URL_KEY ){
            return $param;
        }
        
       $delKeyParam = str_rot13( substr( $param, strlen( SITE_URL_KEY ) )  );
                
        return strrev( self::base64Decode(  $delKeyParam  ) );
    }
    
    /**
     * 检查GET提交，自动解码GET参数
     * 不支持递归级的解码操作
     */
    public static function decodeAllGet()
    {
        foreach( $_GET as $k => $v ){
            if( is_string( $v ) ){
                $_GET[$k] = self::decode( $v );
            }
        }
    }
}