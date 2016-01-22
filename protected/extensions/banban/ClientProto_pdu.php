<?php

// **********************************************************************
// This file was generated by a TAF parser!
// TAF version 3.0.0.32 by WSRD Tencent.
// Generated from `./jce/ClientProto.jce'
// **********************************************************************


require_once('jce.php');
class TMsgBody extends c_struct
{
    public $nCMDID;
    public $nMsgType;
    public $vMsgData;
    public $iRet;
    public $sMsg;

    public function __clone()
    {
        $this->nCMDID = clone $this->nCMDID;
        $this->nMsgType = clone $this->nMsgType;
        $this->vMsgData = clone $this->vMsgData;
        $this->iRet = clone $this->iRet;
        $this->sMsg = clone $this->sMsg;
    }

    public function __construct()
    {
        $this->nCMDID = new  c_short;
        $this->nMsgType = new  c_short;
        $this->vMsgData = new  c_vector (new c_char);
        $this->iRet = new  c_int;
        $this->sMsg = new  c_string;
    }

    public function get_class_name()
    {
        return "Apollo.TMsgBody";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->nCMDID->write($_out,0);
        $this->nMsgType->write($_out,1);
        $this->vMsgData->write($_out,2);
        $this->iRet->write($_out,3);
        $this->sMsg->write($_out,4);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->nCMDID->read($_in , 0, true);
        $this->nMsgType->read($_in , 1, true);
        $this->vMsgData->read($_in , 2, false);
        $this->iRet->read($_in , 3, false);
        $this->sMsg->read($_in , 4, false);
    }
}

class TClientPackage extends c_struct
{
    public $uid;
    public $iSequence;
    public $msgBody;

    public function __clone()
    {
        $this->uid = clone $this->uid;
        $this->iSequence = clone $this->iSequence;
        $this->msgBody = clone $this->msgBody;
    }

    public function __construct()
    {
        $this->uid = new  c_string;
        $this->iSequence = new  c_int64;
        $this->msgBody = new  TMsgBody;
    }

    public function get_class_name()
    {
        return "Apollo.TClientPackage";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->uid->write($_out,0);
        $this->iSequence->write($_out,1);
        $this->msgBody->write($_out,2);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->uid->read($_in , 0, true);
        $this->iSequence->read($_in , 1, true);
        $this->msgBody->read($_in , 2, true);
    }
}

class TRespCommon extends c_struct
{
    public $iRet;
    public $sMsg;
    public $lTime;

    public function __clone()
    {
        $this->iRet = clone $this->iRet;
        $this->sMsg = clone $this->sMsg;
        $this->lTime = clone $this->lTime;
    }

    public function __construct()
    {
        $this->iRet = new  c_int;
        $this->sMsg = new  c_string;
        $this->lTime = new  c_int64;
    }

    public function get_class_name()
    {
        return "Apollo.TRespCommon";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->iRet->write($_out,0);
        $this->sMsg->write($_out,1);
        $this->lTime->write($_out,2);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->iRet->read($_in , 0, true);
        $this->sMsg->read($_in , 1, true);
        $this->lTime->read($_in , 2, true);
    }
}

class TMsgRequestEcho extends c_struct
{
    public $iTime;

    public function __clone()
    {
        $this->iTime = clone $this->iTime;
    }

    public function __construct()
    {
        $this->iTime = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TMsgRequestEcho";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->iTime->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->iTime->read($_in , 0, true);
    }
}

class TMsgResponseEcho extends c_struct
{
    public $iRet;
    public $iTime;

    public function __clone()
    {
        $this->iRet = clone $this->iRet;
        $this->iTime = clone $this->iTime;
    }

    public function __construct()
    {
        $this->iRet = new  c_int;
        $this->iTime = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TMsgResponseEcho";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->iRet->write($_out,0);
        $this->iTime->write($_out,1);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->iRet->read($_in , 0, true);
        $this->iTime->read($_in , 1, true);
    }
}

class TMsgTest extends c_struct
{
    public $iSec;
    public $iUSec;

    public function __clone()
    {
        $this->iSec = clone $this->iSec;
        $this->iUSec = clone $this->iUSec;
    }

    public function __construct()
    {
        $this->iSec = new  c_int;
        $this->iUSec = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TMsgTest";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->iSec->write($_out,0);
        $this->iUSec->write($_out,1);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->iSec->read($_in , 0, true);
        $this->iUSec->read($_in , 1, true);
    }
}


?>