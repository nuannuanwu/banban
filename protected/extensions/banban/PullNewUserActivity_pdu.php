<?php

// **********************************************************************
// This file was generated by a TAF parser!
// TAF version 3.0.0.32 by WSRD Tencent.
// Generated from `./jce/PullNewUserActivity.jce'
// **********************************************************************


require_once('jce.php');
class TPullNewCid extends c_struct
{
    public $cid;
    public $name;

    public function __clone()
    {
        $this->cid = clone $this->cid;
        $this->name = clone $this->name;
    }

    public function __construct()
    {
        $this->cid = new  c_int;
        $this->name = new  c_string;
    }

    public function get_class_name()
    {
        return "Apollo.TPullNewCid";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->cid->write($_out,0);
        $this->name->write($_out,1);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->cid->read($_in , 0, true);
        $this->name->read($_in , 1, true);
    }
}

class TRespPullNewGetUserTeachCid extends c_struct
{
    public $vPNC;

    public function __clone()
    {
        $this->vPNC = clone $this->vPNC;
    }

    public function __construct()
    {
        $this->vPNC = new  c_vector (new TPullNewCid);
    }

    public function get_class_name()
    {
        return "Apollo.TRespPullNewGetUserTeachCid";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->vPNC->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->vPNC->read($_in , 0, true);
    }
}

class TReqPullNewCidUpToStandard extends c_struct
{
    public $cid;

    public function __clone()
    {
        $this->cid = clone $this->cid;
    }

    public function __construct()
    {
        $this->cid = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TReqPullNewCidUpToStandard";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->cid->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->cid->read($_in , 0, true);
    }
}

class TRespPullNewCidUpToStandard extends c_struct
{
    public $b;

    public function __clone()
    {
        $this->b = clone $this->b;
    }

    public function __construct()
    {
        $this->b = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TRespPullNewCidUpToStandard";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->b->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->b->read($_in , 0, true);
    }
}


?>