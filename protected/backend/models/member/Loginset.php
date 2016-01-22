<?php

/**
 * This is the model class for table "{{loginset}}".
 *
 * The followings are the available columns in table '{{loginset}}':
 * @property string $id
 * @property string $name
 * @property string $logo
 * @property string $encryptkey
 * @property string $encryptway
 * @property integer $deleted
 * @property string $updatetime
 * @property string $creationtime
 */
class Loginset extends MemberActiveRecord
{
    const BANBAN_LOGIN_EXPIRE = 1800;  // 登陆自身班班的超时秒数
    const NOT_DELETE = 0;           // 未删除
    
    const CURL_TIME_OUT = 20;        // curl 执行的超时时间
    
    protected static $cacheLoinsetRows = [];

    const DEFAULT_ENCRYPT_KEY = 'cdds'; // 第三方登陆我方的默认key，如有传递编号则使用配置表中的key
    
    const CURL_SUCCESS = 0;         // 第三方接口返回成功值
    
    /*
     * 去除了一部分非用户的操作的提示
     * 
     * 完整：
     * "-1", "参数值不正确"
     * "-2", "账号和密码错误"
     * "-3", "时间格式不正确"
     * "-4", "时间超时"
     * "-5", "验证码不正确"
     * "-6", "账号密码不正确"
     * "-7", "无用户信息"
     * "0" 成功
     */
    protected $curlState = [
       // "-1" => "参数值不正确",
        "-2" => "账号和密码错误",
       // "-3" => "时间格式不正确",
        "-4" => "第三方服务超时",
       // "-5" => "验证码不正确",
        "-6" => "账号密码不正确",
        "-7" => "无用户信息",
        "0" => "成功"
    ];
    
    /**
     * 获取与用户操作相关的第三方错误提示
     * @param string $key
     * @return string
     */
    public function getCurlErrorMsg( $key )
    {
        return true == isset($this->curlState[$key])?$this->curlState[$key]:'';
    }
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{loginset}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, encryptkey, encryptway', 'required'),
			array('deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>80),
			array('logo', 'length', 'max'=>150),
			array('encryptkey', 'length', 'max'=>50),
			array('encryptway', 'length', 'max'=>200),
			array('updatetime, creationtime', 'safe'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '编号',
			'name' => '名称',
			'logo' => '图标',
			'encryptkey' => '密钥',
			'encryptway' => '加密方式',
			'deleted' => '已删除',
			'updatetime' => '更新时间',
			'creationtime' => '创建时间',
		);
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->db_member;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Loginset the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
	
	/**
	 * 获取固定的第三方登陆
	 * @return multitype:CActiveRecord 
	 */
	public function getUnionLogins()
	{
	    // $models = $this->findAll( array('condition'=>'deleted='.self::NOT_DELETE, 'limit'=>3) );
	    $models = $this->findAllByAttributes(array('deleted'=>self::NOT_DELETE,'areaid'=>array(101,100))); 
	    return $models;	    
	}
	
    /**
     * 获取id的登陆配置
     * @param int $id
     * @throws \RuntimeException
     * @return multitype:
     */
    public function getLoginset( $id )
    {
        if( false == isset(self::$cacheLoinsetRows[$id]) ){
            
            $row         = $this->find( 'areaid=\''.$id.'\'' );
            $definedKeys = [
                'loginurl',
                'infourl',
                'encryptway',
                'encryptkey',
                'logo',
                'name',
                'areaid'
            ];
            
            $row = is_object($row)?$row->attributes:array();
            
            $loginset = array_merge( array_fill_keys( $definedKeys, '' ), (array)$row );
            
            if( false == trim($loginset['loginurl']) || false == trim($loginset['encryptway']) ){
                throw new \RuntimeException(sprintf(
                                'Not third part "loginurl" or "encryptway" by areaid "%s".', $id));
            }
            
            self::$cacheLoinsetRows[$id] = $loginset;
        }
        
        return self::$cacheLoinsetRows[$id];
    }
    
    
    /**
     * 获取一个登陆时候的第三方js 令牌
     * @param int $id
     * @param string $account
     * @param string $pwd
     * @throws \InvalidArgumentException
     * @return array
     */
    public function getLoginToken( $id, $account, $pwd  )
    {
        if( false == $id || false == $account || false == $pwd ){
            throw new \InvalidArgumentException(
                sprintf('Identifier $id "%s" $account "%s" $pwd "%s" is false.', $id,$account, $pwd));
        }
        
        $row         = $this->getLoginset( $id );
        $time        = date('Y-m-d H:i:s');
        $row['encryptway'] = trim($row['encryptway']);
        
        if( true == $row['encryptway'] && true == method_exists( 'Encrypt', $row['encryptway']) ){
            $pwd = Encrypt::$row['encryptway']($pwd);
        }

        $data = [
            'area_id' => $row['areaid'],
            'account' => $account,
            'pwd' => $pwd,
            'time' => $time,
            'token' =>  md5( md5( $row['encryptkey'].$row['areaid'].$account.$pwd.$time) )
        ];
        
        return $data;
    }
    
    /**
     * 检测第三方成功登陆返回值是否准确
     * @param int $userid
     * @param string $utoken
     * @param $utoken $token
     * @throws \InvalidArgumentException
     * @return boolean
     */
    public function checkLoginToken( $id, $userid, $utoken, $token, $time )
    {
        if( false == $userid || false == $utoken || false == $token ){
            throw new \InvalidArgumentException(
                sprintf('Identifier $userid "%s" $utoken "%s" $token "%s" is false.', $userid, $utoken, $token));
        }

        $row = $this->getLoginset( $id );   // 已设置默认数据表字段
        
        if( $utoken == md5(  md5( $row['encryptkey'].$userid.$token ) )  ){
            
            return true;
        }
        else{
            return false;
        }
    }
    
    /**
     * 发送登陆请求验证到第三方，返回的是json字符串结果
     * @param int $id
     * @param string $account
     * @param string $pwd
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @return array
     */
    public function sendLoginData( $id, $account, $pwd )
    {
        if( false == $id || false == $account || false == $pwd ){
            throw new \InvalidArgumentException(
                        sprintf('Identifier $id "%s" $account "%s" $pwd "%s" is false.', $id,$account, $pwd));
        }
        
        $row         = $this->getLoginset( $id );   // 已设置默认数据表字段
        $time        = date('Y-m-d H:i:s');
        
        YiiMem::log( 'sendLoginData-getLoginset-return:'.var_export( $row ,true), 'info', 'application.backend.models');
        
        $row['encryptway'] = trim($row['encryptway']);
        
        // 使用配置表中的php脚本表达式加密
        if( true == $row['encryptway'] ){
            $row['encryptway'] = 'return '.ltrim(rtrim( $row['encryptway'],';'),'return').';';
            $encryptScript = str_replace( '{pwd}', '$pwd', $row['encryptway'] );
            $pwd = @eval( $encryptScript );
        }
        
        if( false === $pwd ){
            throw new \RuntimeException(sprintf(
                'Not third part "encryptway" error or $pwd "%s" by id "%s".', $pwd, $id));
        }
        
        $data = [
            'area_id' => $row['areaid'],
            'account' => $account,
            'pwd' => $pwd,
            'time' => $time,
            'token' => md5(  md5( $row['encryptkey'].$row['areaid'].$account.$pwd.$time ) )
        ];
        
        $urlData = $this->getUrlQueryMerge( $row['loginurl'], $data);
        
        YiiMem::log( 'sendLoginData-getUrlQueryMerge-return:'.var_export( $urlData ,true), 'info', 'application.backend.models');
        
        $curl   = new Curl();
        $curl->setOpt( CURLOPT_TIMEOUT, self::CURL_TIME_OUT );        // 设置超时执行时间
        $json   = $curl->get( $urlData['base'] ,$urlData['query'] );
        
        YiiMem::log( 'sendLoginData-curl-json:'.$json, 'info', 'application.backend.models');
        
        $result = json_decode( $json, true );

        $definedKeys = array( 'result','errmsg','user_id' );
        
        return array_merge( array_fill_keys($definedKeys, ''), (array)$result );
    }
        
    /**
     * 检查第三方的登陆请求是否准确
     * @param int $areaId
     * @param int $userId
     * @param string $time
     * @param string $token
     * @return string | boolean 成功返回banban正确的token
     */
    public function checkThirdPartLogin( $areaId, $userId, $time, $token )
    {
        // 检测半小时有效 
        if( time() - strtotime( $time )  <= self::BANBAN_LOGIN_EXPIRE  ){
            
            $row = $this->find('areaid='.(int)$areaId );
            
            if( true == $row && md5(  md5( $row['encryptkey'].$areaId.$userId.$time)  ) == $token ) {
                
                $querys = [
                    'area_id' => $areaId,
                    'user_id' => $userId,
                    'time' => $time,
                    'token' => md5(  md5( $userId . $time . LOGIN_BANBAN_KEY ) )
                ];
                
                return http_build_query( $querys );
            }
            else{
                $row['encryptkey'] = isset( $row['encryptkey'] )?$row['encryptkey']:'';
                YiiMem::log( 'checkThirdPartLogin:unionMd5='.md5(  md5( $row['encryptkey'].$areaId.$userId.$time)  )
                                .'!='.$token, 'info', 'application.backend.models');
                return false;
            }
        }
        else {
            YiiMem::log( 'checkThirdPartLogin:unionTimeLong='.(time() - strtotime( $time ))
                            .' sysTimeLong='.self::BANBAN_LOGIN_EXPIRE, 'info', 'application.backend.models');
            return false;
        }
    }
    
    /**
     * 把要转成url的query的数组，合并到已有query的url中
     * @param string $url
     * @param array $querys
     * @return array 键为base,query
     */
    protected function getUrlQueryMerge( $url, $querys )
    {
        if( false == is_string($url) && false == trim($url) ){
            return array('base'=>'','query'=>'');
        }
        
        $data = array();
        
        // 强制转换非数组的query的url字符串
        if( false == is_array($querys) ){
            parse_str( (string)$querys, $data );
        }
        else{
            $data = $querys;
        }
        
        $urls = parse_url($url);
        
        // 是否包含有query的url
        if( true == isset( $urls['query'] ) && true == $urls['query'] ){
            $querysTemp = array();
            parse_str($urls['query'], $querysTemp);
            $data = array_merge( $querysTemp, $data );
        }
        
        if( false !== ($cuteLenth = strpos( $url , '?' )) ){
        	$baseUrl =  substr( $url, 0, $cuteLenth );
    	}
    	else{
    		$baseUrl = $url;
    	}
        
        return array(
            'base' => $baseUrl,
            'query' => $data
        );
    }
    
    /**
     * 获取用户的第三方资料信息
     * @param int $areaid
     * @param int $user_id
     * @param array $row
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @throws \UnexpectedValueException
     * @return array
     */
    public function getRemoteInfoData( $areaid, $unionUserid, $row )
    {
        if( false == $areaid ){
            throw new \InvalidArgumentException(
                sprintf('Identifier $areaid "%s" is false.', $areaid ));
        }
        
        $time   = date('Y-m-d H:i:s');
        $data   = [
            'area_id' => $row['areaid'],
            'user_id' => $unionUserid,
            'time' => $time,
            'token' => md5(md5( $row['encryptkey'].$row['areaid'].$unionUserid.$time ) )
        ];
        
        $urlData = $this->getUrlQueryMerge( $row['infourl'], $data);
        
        YiiMem::log( 'getRemoteInfoData-getUrlQueryMerge-return:'.var_export( $urlData ,true), 'info', 'application.backend.models');
        
        $curl   = new Curl();
        $curl->setOpt( CURLOPT_TIMEOUT, self::CURL_TIME_OUT );        // 设置超时执行时间
        $json   =  $curl->get( $urlData['base'] ,$urlData['query']);
        $jsonData = json_decode( $json, true );                     // 返回二维数组结果

        YiiMem::log( 'getRemoteInfoData-curl-json:'.$json, 'info', 'application.backend.models');
        
        $definedKeys = array('result','errmsg','userinfo');
        $result      = array_merge( array_fill_keys($definedKeys, ''), (array)$jsonData );
        
        $definedKeys = array('name','sex','mobilephone','school_id','school_name');
        $resultUserinfo  = array_merge( array_fill_keys($definedKeys, ''), (array)$result['userinfo'] );
        
        $result['userinfo'] = $resultUserinfo;

        return $result;
    }
   
    
	/**
	 * 获取错误消息的第一条
	 * @param array $errors
	 * @return string
	 */
	public function getErrorMsg()
	{
	    $errors = $this->getErrors();

        if( true == is_array( $errors ) ){
            $error = (array)reset( $errors);

            return reset( $error );
        }

        return '';
	}
}
