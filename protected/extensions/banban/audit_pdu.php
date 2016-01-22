<?php

// **********************************************************************
// This file was generated by a TAF parser!
// TAF version 3.0.0.32 by WSRD Tencent.
// Generated from `./jce/audit.jce'
// **********************************************************************


require_once('jce.php');
class TAuditRecord extends c_struct
{
    public $id;
    public $uid;
    public $childName;
    public $userName;
    public $phone;
    public $photo;
    public $content;
    public $cid;
    public $cidName;
    public $createTime;
    public $status;
    public $index;
    public $subject;
    public $auditor;
    public $auditTime;
    public $relation;
    public $type;
    public $clientType;
    public $studentId;

    public function __clone()
    {
        $this->id = clone $this->id;
        $this->uid = clone $this->uid;
        $this->childName = clone $this->childName;
        $this->userName = clone $this->userName;
        $this->phone = clone $this->phone;
        $this->photo = clone $this->photo;
        $this->content = clone $this->content;
        $this->cid = clone $this->cid;
        $this->cidName = clone $this->cidName;
        $this->createTime = clone $this->createTime;
        $this->status = clone $this->status;
        $this->index = clone $this->index;
        $this->subject = clone $this->subject;
        $this->auditor = clone $this->auditor;
        $this->auditTime = clone $this->auditTime;
        $this->relation = clone $this->relation;
        $this->type = clone $this->type;
        $this->clientType = clone $this->clientType;
        $this->studentId = clone $this->studentId;
    }

    public function __construct()
    {
        $this->id = new  c_string;
        $this->uid = new  c_string;
        $this->childName = new  c_string;
        $this->userName = new  c_string;
        $this->phone = new  c_string;
        $this->photo = new  c_string;
        $this->content = new  c_string;
        $this->cid = new  c_int;
        $this->cidName = new  c_string;
        $this->createTime = new  c_int64;
        $this->status = new  c_int;
        $this->index = new  c_int64;
        $this->subject = new  c_string;
        $this->auditor = new  c_string;
        $this->auditTime = new  c_string;
        $this->relation = new  c_string;
        $this->type = new  c_int;
        $this->clientType = new  c_int;
        $this->studentId = new  c_string;
    }

    public function get_class_name()
    {
        return "Apollo.TAuditRecord";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->id->write($_out,0);
        $this->uid->write($_out,1);
        $this->childName->write($_out,2);
        $this->userName->write($_out,3);
        $this->phone->write($_out,4);
        $this->photo->write($_out,5);
        $this->content->write($_out,6);
        $this->cid->write($_out,7);
        $this->cidName->write($_out,8);
        $this->createTime->write($_out,9);
        $this->status->write($_out,10);
        $this->index->write($_out,11);
        $this->subject->write($_out,12);
        $this->auditor->write($_out,13);
        $this->auditTime->write($_out,14);
        $this->relation->write($_out,15);
        $this->type->write($_out,16);
        $this->clientType->write($_out,17);
        $this->studentId->write($_out,18);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->id->read($_in , 0, true);
        $this->uid->read($_in , 1, true);
        $this->childName->read($_in , 2, false);
        $this->userName->read($_in , 3, true);
        $this->phone->read($_in , 4, true);
        $this->photo->read($_in , 5, true);
        $this->content->read($_in , 6, true);
        $this->cid->read($_in , 7, true);
        $this->cidName->read($_in , 8, true);
        $this->createTime->read($_in , 9, true);
        $this->status->read($_in , 10, true);
        $this->index->read($_in , 11, true);
        $this->subject->read($_in , 12, true);
        $this->auditor->read($_in , 13, false);
        $this->auditTime->read($_in , 14, false);
        $this->relation->read($_in , 15, false);
        $this->type->read($_in , 16, false);
        $this->clientType->read($_in , 17, false);
        $this->studentId->read($_in , 18, false);
    }
}

class TReqSendAuditRecord extends c_struct
{
    public $uid;
    public $childName;
    public $cid;
    public $type;
    public $subject;
    public $relation;
    public $clientType;
    public $studentId;

    public function __clone()
    {
        $this->uid = clone $this->uid;
        $this->childName = clone $this->childName;
        $this->cid = clone $this->cid;
        $this->type = clone $this->type;
        $this->subject = clone $this->subject;
        $this->relation = clone $this->relation;
        $this->clientType = clone $this->clientType;
        $this->studentId = clone $this->studentId;
    }

    public function __construct()
    {
        $this->uid = new  c_string;
        $this->childName = new  c_string;
        $this->cid = new  c_int;
        $this->type = new  c_int;
        $this->subject = new  c_string;
        $this->relation = new  c_string;
        $this->clientType = new  c_int;
        $this->studentId = new  c_string;
    }

    public function get_class_name()
    {
        return "Apollo.TReqSendAuditRecord";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->uid->write($_out,0);
        $this->childName->write($_out,1);
        $this->cid->write($_out,2);
        $this->type->write($_out,3);
        $this->subject->write($_out,4);
        $this->relation->write($_out,5);
        $this->clientType->write($_out,6);
        $this->studentId->write($_out,7);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->uid->read($_in , 0, true);
        $this->childName->read($_in , 1, false);
        $this->cid->read($_in , 2, true);
        $this->type->read($_in , 3, true);
        $this->subject->read($_in , 4, false);
        $this->relation->read($_in , 5, false);
        $this->clientType->read($_in , 6, false);
        $this->studentId->read($_in , 7, false);
    }
}

class TRespSendAuditRecord extends c_struct
{
    public $result;
    public $msg;

    public function __clone()
    {
        $this->result = clone $this->result;
        $this->msg = clone $this->msg;
    }

    public function __construct()
    {
        $this->result = new  c_int;
        $this->msg = new  c_string;
    }

    public function get_class_name()
    {
        return "Apollo.TRespSendAuditRecord";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->result->write($_out,0);
        $this->msg->write($_out,1);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->result->read($_in , 0, true);
        $this->msg->read($_in , 1, false);
    }
}

class TReqQueryAuditRecord extends c_struct
{
    public $uid;
    public $index;
    public $flag;

    public function __clone()
    {
        $this->uid = clone $this->uid;
        $this->index = clone $this->index;
        $this->flag = clone $this->flag;
    }

    public function __construct()
    {
        $this->uid = new  c_string;
        $this->index = new  c_int64;
        $this->flag = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TReqQueryAuditRecord";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->uid->write($_out,0);
        $this->index->write($_out,1);
        $this->flag->write($_out,2);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->uid->read($_in , 0, true);
        $this->index->read($_in , 1, true);
        $this->flag->read($_in , 2, true);
    }
}

class TRespQueryAuditRecord extends c_struct
{
    public $vAuditRecord;
    public $total;

    public function __clone()
    {
        $this->vAuditRecord = clone $this->vAuditRecord;
        $this->total = clone $this->total;
    }

    public function __construct()
    {
        $this->vAuditRecord = new  c_vector (new TAuditRecord);
        $this->total = new  c_int64;
    }

    public function get_class_name()
    {
        return "Apollo.TRespQueryAuditRecord";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->vAuditRecord->write($_out,0);
        $this->total->write($_out,1);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->vAuditRecord->read($_in , 0, true);
        $this->total->read($_in , 1, true);
    }
}

class TReqUpdateAuditRecord extends c_struct
{
    public $uid;
    public $auditRecordId;
    public $clientType;
    public $status;

    public function __clone()
    {
        $this->uid = clone $this->uid;
        $this->auditRecordId = clone $this->auditRecordId;
        $this->clientType = clone $this->clientType;
        $this->status = clone $this->status;
    }

    public function __construct()
    {
        $this->uid = new  c_string;
        $this->auditRecordId = new  c_string;
        $this->clientType = new  c_int;
        $this->status = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TReqUpdateAuditRecord";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->uid->write($_out,0);
        $this->auditRecordId->write($_out,1);
        $this->clientType->write($_out,2);
        $this->status->write($_out,3);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->uid->read($_in , 0, true);
        $this->auditRecordId->read($_in , 1, true);
        $this->clientType->read($_in , 2, true);
        $this->status->read($_in , 3, true);
    }
}

class TRespUpdateAuditRecord extends c_struct
{
    public $result;

    public function __clone()
    {
        $this->result = clone $this->result;
    }

    public function __construct()
    {
        $this->result = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TRespUpdateAuditRecord";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->result->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->result->read($_in , 0, true);
    }
}

class TReqPushAudit extends c_struct
{
    public $vAudit;

    public function __clone()
    {
        $this->vAudit = clone $this->vAudit;
    }

    public function __construct()
    {
        $this->vAudit = new  c_vector (new TAuditRecord);
    }

    public function get_class_name()
    {
        return "Apollo.TReqPushAudit";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->vAudit->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->vAudit->read($_in , 0, true);
    }
}

class TClientReceiveAuditIndex extends c_struct
{
    public $cid;
    public $index;
    public $uid;

    public function __clone()
    {
        $this->cid = clone $this->cid;
        $this->index = clone $this->index;
        $this->uid = clone $this->uid;
    }

    public function __construct()
    {
        $this->cid = new  c_string;
        $this->index = new  c_int64;
        $this->uid = new  c_string;
    }

    public function get_class_name()
    {
        return "Apollo.TClientReceiveAuditIndex";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->cid->write($_out,0);
        $this->index->write($_out,1);
        $this->uid->write($_out,2);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->cid->read($_in , 0, true);
        $this->index->read($_in , 1, true);
        $this->uid->read($_in , 2, true);
    }
}

class TRespPushAudit extends c_struct
{
    public $vRespIndex;

    public function __clone()
    {
        $this->vRespIndex = clone $this->vRespIndex;
    }

    public function __construct()
    {
        $this->vRespIndex = new  c_vector (new TClientReceiveAuditIndex);
    }

    public function get_class_name()
    {
        return "Apollo.TRespPushAudit";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->vRespIndex->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->vRespIndex->read($_in , 0, true);
    }
}


?>