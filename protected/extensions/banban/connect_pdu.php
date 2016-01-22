<?php

// **********************************************************************
// This file was generated by a TAF parser!
// TAF version 3.0.0.32 by WSRD Tencent.
// Generated from `./jce/connect.jce'
// **********************************************************************


require_once('jce.php');
class TReqAuth extends c_struct
{
    public $sVer;
    public $nClientType;
    public $sDeviceID;
    public $sessionCode;
    public $timestamp;
    public $apnsToken;

    public function __clone()
    {
        $this->sVer = clone $this->sVer;
        $this->nClientType = clone $this->nClientType;
        $this->sDeviceID = clone $this->sDeviceID;
        $this->sessionCode = clone $this->sessionCode;
        $this->timestamp = clone $this->timestamp;
        $this->apnsToken = clone $this->apnsToken;
    }

    public function __construct()
    {
        $this->sVer = new  c_string;
        $this->nClientType = new  c_short;
        $this->sDeviceID = new  c_string;
        $this->sessionCode = new  c_string;
        $this->timestamp = new  c_int64;
        $this->apnsToken = new  c_string;
    }

    public function get_class_name()
    {
        return "Apollo.TReqAuth";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->sVer->write($_out,0);
        $this->nClientType->write($_out,1);
        $this->sDeviceID->write($_out,2);
        $this->sessionCode->write($_out,3);
        $this->timestamp->write($_out,4);
        $this->apnsToken->write($_out,5);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->sVer->read($_in , 0, true);
        $this->nClientType->read($_in , 1, true);
        $this->sDeviceID->read($_in , 2, true);
        $this->sessionCode->read($_in , 3, true);
        $this->timestamp->read($_in , 4, false);
        $this->apnsToken->read($_in , 5, false);
    }
}

class TRespAuth extends c_struct
{
    public $iRet;
    public $sMsg;
    public $iTime;

    public function __clone()
    {
        $this->iRet = clone $this->iRet;
        $this->sMsg = clone $this->sMsg;
        $this->iTime = clone $this->iTime;
    }

    public function __construct()
    {
        $this->iRet = new  c_int;
        $this->sMsg = new  c_string;
        $this->iTime = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TRespAuth";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->iRet->write($_out,0);
        $this->sMsg->write($_out,1);
        $this->iTime->write($_out,2);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->iRet->read($_in , 0, true);
        $this->sMsg->read($_in , 1, true);
        $this->iTime->read($_in , 2, true);
    }
}

class TNotifyOffline extends c_struct
{
    public $iRet;
    public $lTime;
    public $sMsg;

    public function __clone()
    {
        $this->iRet = clone $this->iRet;
        $this->lTime = clone $this->lTime;
        $this->sMsg = clone $this->sMsg;
    }

    public function __construct()
    {
        $this->iRet = new  c_int;
        $this->lTime = new  c_int64;
        $this->sMsg = new  c_string;
    }

    public function get_class_name()
    {
        return "Apollo.TNotifyOffline";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->iRet->write($_out,0);
        $this->lTime->write($_out,1);
        $this->sMsg->write($_out,2);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->iRet->read($_in , 0, true);
        $this->lTime->read($_in , 1, true);
        $this->sMsg->read($_in , 2, true);
    }
}

class TReqLogout extends c_struct
{
    public $nClientType;

    public function __clone()
    {
        $this->nClientType = clone $this->nClientType;
    }

    public function __construct()
    {
        $this->nClientType = new  c_short;
    }

    public function get_class_name()
    {
        return "Apollo.TReqLogout";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->nClientType->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->nClientType->read($_in , 0, true);
    }
}

class TNotifyUpdateUserBase extends c_struct
{
    public $flag;
    public $userbase;

    public function __clone()
    {
        $this->flag = clone $this->flag;
        $this->userbase = clone $this->userbase;
    }

    public function __construct()
    {
        $this->flag = new  c_int;
        $this->userbase = new  TUserBase;
    }

    public function get_class_name()
    {
        return "Apollo.TNotifyUpdateUserBase";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->flag->write($_out,0);
        $this->userbase->write($_out,1);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->flag->read($_in , 0, true);
        $this->userbase->read($_in , 1, false);
    }
}


?>