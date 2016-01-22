<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;
    private $user;
    // public $role;

    /**
     * Constructor.
     * @param string $username username
     * @param string $password password
     * @param string $role role
     */
    public function __construct($username,$password)
    {
        $this->username=$username;
        $this->password=$password;
    }

    public function authenticate()
    {
        $is_mobile = is_numeric($this->username) && strlen($this->username)==11;
    	if($is_mobile){
    		$type = 'mobilephone';
    	}else{
    		$is_email = CheckHelper::IsMail($this->username);
    		if($is_email){
    			$type = 'email';
    		}else{
    			$type = 'account';
    		}
    	}

        $record = JceHelper::userLogin($this->username, $this->password);
        if($record && $record->uid->val){
            $this->_id=$record->uid->val;
            $record = Member::model()->findByPk($this->_id);
            $this->user=$record;
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getIdentity()
    {
        return $this->user?$this->user->identity:0;
    }
}