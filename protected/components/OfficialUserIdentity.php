<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class OfficialUserIdentity extends CUserIdentity
{

    const ERROR_OFFICIAL_BLOCK = 201;

    private $_id;

    private $user;

    /**
     * Constructor.
     *
     * @param string $username
     *            username
     * @param string $password
     *            password
     * @param string $role
     *            role
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function authenticate($arr = array())
    {

        foreach ($arr as $key => $value) {
            $this->setState($key, $value);
        }
        $this->_id = $arr['officialAccountId'];
        $this->errorCode = self::ERROR_NONE;
        return true;
    }

    public function getId()
    {
        return $this->_id;
    }
}