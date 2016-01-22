<?php

class UrlWebApplication extends CWebApplication
{
	/**
	 * Creates a relative URL based on the given controller and action information.
	 * @param string $route the URL route. This should be in the format of 'ControllerID/ActionID'.
	 * @param array $params additional GET parameters (name=>value). Both the name and value will be URL-encoded.
	 * @param string $ampersand the token separating name-value pairs in the URL.
	 * @return string the constructed URL
	 */
	public function createUrl($route,$params=array(),$ampersand='&')
	{
	    $urlRoute = '';
	    foreach( $params as $k => $v ){
	        if( true == is_numeric( $v ) ){
	            $params[$k] = BaseUrl::encode($v);
	        }
	    }
	    
	    $parseUrls =  parse_url( $route );
	    
	    $parseUrls['path'] = trim($parseUrls['path'],'/');
	    $path = explode('/',$parseUrls['path']);
	    
	    if( true == $path && is_numeric( $path[count($path)-1] ) ){
	        $path[count($path)-1] = BaseUrl::encode($path[count($path)-1]);
	        
	        $urlRoute = join('/', $path);
	        
	        if( true == isset($parseUrls['query']) && true == $parseUrls['query'] ){
	            $queryData = [];
	             
	            parse_str( $parseUrls['query'], $queryData);
	             
	            foreach( $queryData as $k => $v ){
	                if( true == is_numeric( $v ) ){
	                    $queryData[$k] = BaseUrl::encode($v);
	                }
	            }
	            	
	            $urlRoute .= '?'.http_build_query( $queryData );
	        }
	    }

	    if( false == $urlRoute ){
	        $urlRoute = $route;
	    }

		return parent::createUrl($urlRoute,$params,$ampersand);
	}
}