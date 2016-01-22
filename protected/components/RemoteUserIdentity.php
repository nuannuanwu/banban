<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class RemoteUserIdentity extends CUserIdentity
{
    private $_id;
    private $user;
    public $uinstance;

    /**
     * Constructor.
     * @param string $username username
     * @param string $password password
     * @param string $role role
     */
    public function __construct($record)
    {
        $this->_id=$record->uid;
        $this->user=$record;
    }

    public function authenticate()
    {
        $this->errorCode=self::ERROR_NONE;
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }
}