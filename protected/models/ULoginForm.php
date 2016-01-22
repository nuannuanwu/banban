<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ULoginForm extends CFormModel
{
	public $username;
	public $password;
	// public $role;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required','message'=>'{attribute}不能为空'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'账号',
			'password'=>'密码',
			// 'role'=>'角色',
			'rememberMe'=>'记住我',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','用户名或密码错误');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			if($this->rememberMe){
				//记cookie以防用session导致记住我功能失效
		        // $cookie = new CHttpCookie(XIAOXIN_LOGIN_IDENTITY, $this->role);
		        // $cookie->expire = time()+60*60*24*30;  //有限期30天
		        // Yii::app()->request->cookies[XIAOXIN_LOGIN_IDENTITY]=$cookie;
			}
			Yii::app()->user->login($this->_identity,$duration);
			// $identity = $this->_identity->getIdentity();
			// if($identity!=5){
			// 	Yii::app()->user->setIdentity($identity);
			// }else{
			// 	Yii::app()->user->setIdentity(1);
			// }
			
			
			return true;
		}
		else
			return false;
	}
}
