<?php

// **********************************************************************
// This file was generated by a TAF parser!
// TAF version 3.0.0.32 by WSRD Tencent.
// Generated from `./jce/ClassFeeCard.jce'
// **********************************************************************


require_once('jce.php');
class TClassFeeCardRule extends c_struct
{
    public $ruleid;
    public $name;
    public $description;
    public $amount;
    public $createtime;
    public $headcount;
    public $minmoney;
    public $maxmoney;
    public $averagemoney;
    public $proportion;
    public $endtime;
    public $type;
    public $deleted;
    public $activeid;

    public function __clone()
    {
        $this->ruleid = clone $this->ruleid;
        $this->name = clone $this->name;
        $this->description = clone $this->description;
        $this->amount = clone $this->amount;
        $this->createtime = clone $this->createtime;
        $this->headcount = clone $this->headcount;
        $this->minmoney = clone $this->minmoney;
        $this->maxmoney = clone $this->maxmoney;
        $this->averagemoney = clone $this->averagemoney;
        $this->proportion = clone $this->proportion;
        $this->endtime = clone $this->endtime;
        $this->type = clone $this->type;
        $this->deleted = clone $this->deleted;
        $this->activeid = clone $this->activeid;
    }

    public function __construct()
    {
        $this->ruleid = new  c_string;
        $this->name = new  c_string;
        $this->description = new  c_string;
        $this->amount = new  c_int;
        $this->createtime = new  c_int64;
        $this->headcount = new  c_int64;
        $this->minmoney = new  c_int64;
        $this->maxmoney = new  c_int64;
        $this->averagemoney = new  c_int64;
        $this->proportion = new  c_int;
        $this->endtime = new  c_int64;
        $this->type = new  c_int;
        $this->deleted = new  c_int;
        $this->activeid = new  c_string;
    }

    public function get_class_name()
    {
        return "Apollo.TClassFeeCardRule";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->ruleid->write($_out,0);
        $this->name->write($_out,1);
        $this->description->write($_out,2);
        $this->amount->write($_out,3);
        $this->createtime->write($_out,4);
        $this->headcount->write($_out,5);
        $this->minmoney->write($_out,6);
        $this->maxmoney->write($_out,7);
        $this->averagemoney->write($_out,8);
        $this->proportion->write($_out,9);
        $this->endtime->write($_out,10);
        $this->type->write($_out,11);
        $this->deleted->write($_out,12);
        $this->activeid->write($_out,13);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->ruleid->read($_in , 0, true);
        $this->name->read($_in , 1, true);
        $this->description->read($_in , 2, true);
        $this->amount->read($_in , 3, true);
        $this->createtime->read($_in , 4, true);
        $this->headcount->read($_in , 5, true);
        $this->minmoney->read($_in , 6, true);
        $this->maxmoney->read($_in , 7, true);
        $this->averagemoney->read($_in , 8, true);
        $this->proportion->read($_in , 9, true);
        $this->endtime->read($_in , 10, true);
        $this->type->read($_in , 11, true);
        $this->deleted->read($_in , 12, true);
        $this->activeid->read($_in , 13, true);
    }
}

class TClassFeeCard extends c_struct
{
    public $cardid;
    public $name;
    public $category;
    public $money;
    public $createtime;
    public $endtime;
    public $status;
    public $ruleid;
    public $index;

    public function __clone()
    {
        $this->cardid = clone $this->cardid;
        $this->name = clone $this->name;
        $this->category = clone $this->category;
        $this->money = clone $this->money;
        $this->createtime = clone $this->createtime;
        $this->endtime = clone $this->endtime;
        $this->status = clone $this->status;
        $this->ruleid = clone $this->ruleid;
        $this->index = clone $this->index;
    }

    public function __construct()
    {
        $this->cardid = new  c_int64;
        $this->name = new  c_string;
        $this->category = new  c_int;
        $this->money = new  c_int;
        $this->createtime = new  c_int64;
        $this->endtime = new  c_int64;
        $this->status = new  c_int;
        $this->ruleid = new  c_string;
        $this->index = new  c_int64;
    }

    public function get_class_name()
    {
        return "Apollo.TClassFeeCard";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->cardid->write($_out,0);
        $this->name->write($_out,1);
        $this->category->write($_out,2);
        $this->money->write($_out,3);
        $this->createtime->write($_out,4);
        $this->endtime->write($_out,5);
        $this->status->write($_out,6);
        $this->ruleid->write($_out,7);
        $this->index->write($_out,8);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->cardid->read($_in , 0, true);
        $this->name->read($_in , 1, true);
        $this->category->read($_in , 2, true);
        $this->money->read($_in , 3, true);
        $this->createtime->read($_in , 4, true);
        $this->endtime->read($_in , 5, true);
        $this->status->read($_in , 6, true);
        $this->ruleid->read($_in , 7, false);
        $this->index->read($_in , 8, false);
    }
}

class TReqPublishClassFeeCardRule extends c_struct
{
    public $classFeeCardRule;

    public function __clone()
    {
        $this->classFeeCardRule = clone $this->classFeeCardRule;
    }

    public function __construct()
    {
        $this->classFeeCardRule = new  TClassFeeCardRule;
    }

    public function get_class_name()
    {
        return "Apollo.TReqPublishClassFeeCardRule";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->classFeeCardRule->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->classFeeCardRule->read($_in , 0, true);
    }
}

class TRespPublishClassFeeCardRule extends c_struct
{
    public $ruleid;

    public function __clone()
    {
        $this->ruleid = clone $this->ruleid;
    }

    public function __construct()
    {
        $this->ruleid = new  c_string;
    }

    public function get_class_name()
    {
        return "Apollo.TRespPublishClassFeeCardRule";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->ruleid->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->ruleid->read($_in , 0, true);
    }
}

class TReqControlClassFeeCardRule extends c_struct
{
    public $ruleid;
    public $flag;

    public function __clone()
    {
        $this->ruleid = clone $this->ruleid;
        $this->flag = clone $this->flag;
    }

    public function __construct()
    {
        $this->ruleid = new  c_string;
        $this->flag = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TReqControlClassFeeCardRule";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->ruleid->write($_out,0);
        $this->flag->write($_out,1);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->ruleid->read($_in , 0, true);
        $this->flag->read($_in , 1, true);
    }
}

class TReqJoinClassFeeCardActivity extends c_struct
{
    public $uid;
    public $activeid;

    public function __clone()
    {
        $this->uid = clone $this->uid;
        $this->activeid = clone $this->activeid;
    }

    public function __construct()
    {
        $this->uid = new  c_string;
        $this->activeid = new  c_string;
    }

    public function get_class_name()
    {
        return "Apollo.TReqJoinClassFeeCardActivity";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->uid->write($_out,0);
        $this->activeid->write($_out,1);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->uid->read($_in , 0, true);
        $this->activeid->read($_in , 1, true);
    }
}

class TRespJoinClassFeeCardActivity extends c_struct
{
    public $result;
    public $card;

    public function __clone()
    {
        $this->result = clone $this->result;
        $this->card = clone $this->card;
    }

    public function __construct()
    {
        $this->result = new  c_int;
        $this->card = new  TClassFeeCard;
    }

    public function get_class_name()
    {
        return "Apollo.TRespJoinClassFeeCardActivity";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->result->write($_out,0);
        $this->card->write($_out,1);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->result->read($_in , 0, true);
        $this->card->read($_in , 1, false);
    }
}

class TReqAddClassFeeCard extends c_struct
{
    public $uid;
    public $category;
    public $name;
    public $money;
    public $endtime;

    public function __clone()
    {
        $this->uid = clone $this->uid;
        $this->category = clone $this->category;
        $this->name = clone $this->name;
        $this->money = clone $this->money;
        $this->endtime = clone $this->endtime;
    }

    public function __construct()
    {
        $this->uid = new  c_string;
        $this->category = new  c_int;
        $this->name = new  c_string;
        $this->money = new  c_int64;
        $this->endtime = new  c_int64;
    }

    public function get_class_name()
    {
        return "Apollo.TReqAddClassFeeCard";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->uid->write($_out,0);
        $this->category->write($_out,1);
        $this->name->write($_out,2);
        $this->money->write($_out,3);
        $this->endtime->write($_out,4);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->uid->read($_in , 0, true);
        $this->category->read($_in , 1, true);
        $this->name->read($_in , 2, true);
        $this->money->read($_in , 3, true);
        $this->endtime->read($_in , 4, true);
    }
}

class TRespAddClassFeeCard extends c_struct
{
    public $card;

    public function __clone()
    {
        $this->card = clone $this->card;
    }

    public function __construct()
    {
        $this->card = new  TClassFeeCard;
    }

    public function get_class_name()
    {
        return "Apollo.TRespAddClassFeeCard";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->card->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->card->read($_in , 0, true);
    }
}

class TReqBindClassFeeCard extends c_struct
{
    public $uid;
    public $cardid;

    public function __clone()
    {
        $this->uid = clone $this->uid;
        $this->cardid = clone $this->cardid;
    }

    public function __construct()
    {
        $this->uid = new  c_string;
        $this->cardid = new  c_int64;
    }

    public function get_class_name()
    {
        return "Apollo.TReqBindClassFeeCard";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->uid->write($_out,0);
        $this->cardid->write($_out,1);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->uid->read($_in , 0, true);
        $this->cardid->read($_in , 1, true);
    }
}

class TRespBindClassFeeCard extends c_struct
{
    public $card;

    public function __clone()
    {
        $this->card = clone $this->card;
    }

    public function __construct()
    {
        $this->card = new  TClassFeeCard;
    }

    public function get_class_name()
    {
        return "Apollo.TRespBindClassFeeCard";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->card->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->card->read($_in , 0, true);
    }
}

class TReqCardList extends c_struct
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
        return "Apollo.TReqCardList";
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

class TRespCardList extends c_struct
{
    public $usableCards;
    public $unusableCards;
    public $usableCardsCount;
    public $amount;

    public function __clone()
    {
        $this->usableCards = clone $this->usableCards;
        $this->unusableCards = clone $this->unusableCards;
        $this->usableCardsCount = clone $this->usableCardsCount;
        $this->amount = clone $this->amount;
    }

    public function __construct()
    {
        $this->usableCards = new  c_vector (new TClassFeeCard);
        $this->unusableCards = new  c_vector (new TClassFeeCard);
        $this->usableCardsCount = new  c_int;
        $this->amount = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TRespCardList";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->usableCards->write($_out,0);
        $this->unusableCards->write($_out,1);
        $this->usableCardsCount->write($_out,2);
        $this->amount->write($_out,3);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->usableCards->read($_in , 0, true);
        $this->unusableCards->read($_in , 1, true);
        $this->usableCardsCount->read($_in , 2, true);
        $this->amount->read($_in , 3, false);
    }
}

class TReqCardAmountList extends c_struct
{
    public $uids;

    public function __clone()
    {
        $this->uids = clone $this->uids;
    }

    public function __construct()
    {
        $this->uids = new  c_vector (new c_string);
    }

    public function get_class_name()
    {
        return "Apollo.TReqCardAmountList";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->uids->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->uids->read($_in , 0, true);
    }
}

class TClassFeeCardAmountList extends c_struct
{
    public $uid;
    public $amount;

    public function __clone()
    {
        $this->uid = clone $this->uid;
        $this->amount = clone $this->amount;
    }

    public function __construct()
    {
        $this->uid = new  c_string;
        $this->amount = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TClassFeeCardAmountList";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->uid->write($_out,0);
        $this->amount->write($_out,1);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->uid->read($_in , 0, true);
        $this->amount->read($_in , 1, true);
    }
}

class TRespCardAmountList extends c_struct
{
    public $amountList;

    public function __clone()
    {
        $this->amountList = clone $this->amountList;
    }

    public function __construct()
    {
        $this->amountList = new  c_vector (new TClassFeeCardAmountList);
    }

    public function get_class_name()
    {
        return "Apollo.TRespCardAmountList";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->amountList->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->amountList->read($_in , 0, true);
    }
}

class TReqConsume extends c_struct
{
    public $uid;
    public $uidName;
    public $cardid;
    public $optype;
    public $cid;

    public function __clone()
    {
        $this->uid = clone $this->uid;
        $this->uidName = clone $this->uidName;
        $this->cardid = clone $this->cardid;
        $this->optype = clone $this->optype;
        $this->cid = clone $this->cid;
    }

    public function __construct()
    {
        $this->uid = new  c_string;
        $this->uidName = new  c_string;
        $this->cardid = new  c_int64;
        $this->optype = new  c_int;
        $this->cid = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TReqConsume";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->uid->write($_out,0);
        $this->uidName->write($_out,1);
        $this->cardid->write($_out,2);
        $this->optype->write($_out,3);
        $this->cid->write($_out,4);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->uid->read($_in , 0, true);
        $this->uidName->read($_in , 1, true);
        $this->cardid->read($_in , 2, true);
        $this->optype->read($_in , 3, true);
        $this->cid->read($_in , 4, false);
    }
}

class TClassFeeCardRolloutLog extends c_struct
{
    public $uid;
    public $strName;
    public $sEventID;
    public $dValue;
    public $timestamp;
    public $strRemark;
    public $lOrderNum;
    public $vCardidList;

    public function __clone()
    {
        $this->uid = clone $this->uid;
        $this->strName = clone $this->strName;
        $this->sEventID = clone $this->sEventID;
        $this->dValue = clone $this->dValue;
        $this->timestamp = clone $this->timestamp;
        $this->strRemark = clone $this->strRemark;
        $this->lOrderNum = clone $this->lOrderNum;
        $this->vCardidList = clone $this->vCardidList;
    }

    public function __construct()
    {
        $this->uid = new  c_string;
        $this->strName = new  c_string;
        $this->sEventID = new  c_short;
        $this->dValue = new  c_int;
        $this->timestamp = new  c_int;
        $this->strRemark = new  c_string;
        $this->lOrderNum = new  c_int64;
        $this->vCardidList = new  c_vector (new c_int64);
    }

    public function get_class_name()
    {
        return "Apollo.TClassFeeCardRolloutLog";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->uid->write($_out,0);
        $this->strName->write($_out,1);
        $this->sEventID->write($_out,2);
        $this->dValue->write($_out,3);
        $this->timestamp->write($_out,4);
        $this->strRemark->write($_out,5);
        $this->lOrderNum->write($_out,6);
        $this->vCardidList->write($_out,7);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->uid->read($_in , 0, true);
        $this->strName->read($_in , 1, true);
        $this->sEventID->read($_in , 2, true);
        $this->dValue->read($_in , 3, true);
        $this->timestamp->read($_in , 4, true);
        $this->strRemark->read($_in , 5, false);
        $this->lOrderNum->read($_in , 6, false);
        $this->vCardidList->read($_in , 7, false);
    }
}

class TReqClassFeeCardBillDetail extends c_struct
{
    public $uid;
    public $lOrderNum;
    public $iNum;
    public $flag;

    public function __clone()
    {
        $this->uid = clone $this->uid;
        $this->lOrderNum = clone $this->lOrderNum;
        $this->iNum = clone $this->iNum;
        $this->flag = clone $this->flag;
    }

    public function __construct()
    {
        $this->uid = new  c_string;
        $this->lOrderNum = new  c_int64;
        $this->iNum = new  c_int;
        $this->flag = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TReqClassFeeCardBillDetail";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->uid->write($_out,0);
        $this->lOrderNum->write($_out,1);
        $this->iNum->write($_out,2);
        $this->flag->write($_out,3);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->uid->read($_in , 0, true);
        $this->lOrderNum->read($_in , 1, true);
        $this->iNum->read($_in , 2, true);
        $this->flag->read($_in , 3, true);
    }
}

class TRespClassFeeCardBillDetail extends c_struct
{
    public $vLog;

    public function __clone()
    {
        $this->vLog = clone $this->vLog;
    }

    public function __construct()
    {
        $this->vLog = new  c_vector (new TClassFeeCardRolloutLog);
    }

    public function get_class_name()
    {
        return "Apollo.TRespClassFeeCardBillDetail";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->vLog->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->vLog->read($_in , 0, true);
    }
}

class TReqClassFeeCardRollout extends c_struct
{
    public $uid;
    public $strName;
    public $iType;

    public function __clone()
    {
        $this->uid = clone $this->uid;
        $this->strName = clone $this->strName;
        $this->iType = clone $this->iType;
    }

    public function __construct()
    {
        $this->uid = new  c_string;
        $this->strName = new  c_string;
        $this->iType = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TReqClassFeeCardRollout";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->uid->write($_out,0);
        $this->strName->write($_out,1);
        $this->iType->write($_out,2);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->uid->read($_in , 0, true);
        $this->strName->read($_in , 1, true);
        $this->iType->read($_in , 2, false);
    }
}

class TRespClassFeeCardRollout extends c_struct
{
    public $iRet;
    public $strMsg;
    public $lOrderNum;
    public $amount;

    public function __clone()
    {
        $this->iRet = clone $this->iRet;
        $this->strMsg = clone $this->strMsg;
        $this->lOrderNum = clone $this->lOrderNum;
        $this->amount = clone $this->amount;
    }

    public function __construct()
    {
        $this->iRet = new  c_int;
        $this->strMsg = new  c_string;
        $this->lOrderNum = new  c_int64;
        $this->amount = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TRespClassFeeCardRollout";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->iRet->write($_out,0);
        $this->strMsg->write($_out,1);
        $this->lOrderNum->write($_out,2);
        $this->amount->write($_out,3);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->iRet->read($_in , 0, true);
        $this->strMsg->read($_in , 1, true);
        $this->lOrderNum->read($_in , 2, false);
        $this->amount->read($_in , 3, false);
    }
}

class TReqClassFeeCardRollback extends c_struct
{
    public $lOrderNum;
    public $dValue;
    public $uid;
    public $strName;

    public function __clone()
    {
        $this->lOrderNum = clone $this->lOrderNum;
        $this->dValue = clone $this->dValue;
        $this->uid = clone $this->uid;
        $this->strName = clone $this->strName;
    }

    public function __construct()
    {
        $this->lOrderNum = new  c_int64;
        $this->dValue = new  c_int;
        $this->uid = new  c_string;
        $this->strName = new  c_string;
    }

    public function get_class_name()
    {
        return "Apollo.TReqClassFeeCardRollback";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->lOrderNum->write($_out,0);
        $this->dValue->write($_out,1);
        $this->uid->write($_out,2);
        $this->strName->write($_out,3);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->lOrderNum->read($_in , 0, true);
        $this->dValue->read($_in , 1, true);
        $this->uid->read($_in , 2, true);
        $this->strName->read($_in , 3, true);
    }
}

class TReqQueryWtihdrawWhiteList extends c_struct
{
    public $uid;

    public function __clone()
    {
        $this->uid = clone $this->uid;
    }

    public function __construct()
    {
        $this->uid = new  c_string;
    }

    public function get_class_name()
    {
        return "Apollo.TReqQueryWtihdrawWhiteList";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->uid->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->uid->read($_in , 0, true);
    }
}

class TRespQueryWtihdrawWhiteList extends c_struct
{
    public $uid;

    public function __clone()
    {
        $this->uid = clone $this->uid;
    }

    public function __construct()
    {
        $this->uid = new  c_string;
    }

    public function get_class_name()
    {
        return "Apollo.TRespQueryWtihdrawWhiteList";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->uid->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->uid->read($_in , 0, true);
    }
}

class TReqEditWtihdrawWhiteList extends c_struct
{
    public $uids;
    public $option;

    public function __clone()
    {
        $this->uids = clone $this->uids;
        $this->option = clone $this->option;
    }

    public function __construct()
    {
        $this->uids = new  c_vector (new c_string);
        $this->option = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TReqEditWtihdrawWhiteList";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->uids->write($_out,0);
        $this->option->write($_out,1);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->uids->read($_in , 0, true);
        $this->option->read($_in , 1, true);
    }
}

class TRespEditWtihdrawWhiteList extends c_struct
{
    public $uids;

    public function __clone()
    {
        $this->uids = clone $this->uids;
    }

    public function __construct()
    {
        $this->uids = new  c_vector (new c_string);
    }

    public function get_class_name()
    {
        return "Apollo.TRespEditWtihdrawWhiteList";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->uids->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->uids->read($_in , 0, true);
    }
}

class TReqTotalMoneyAndHead extends c_struct
{
    public $ruleid;

    public function __clone()
    {
        $this->ruleid = clone $this->ruleid;
    }

    public function __construct()
    {
        $this->ruleid = new  c_string;
    }

    public function get_class_name()
    {
        return "Apollo.TReqTotalMoneyAndHead";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->ruleid->write($_out,0);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->ruleid->read($_in , 0, true);
    }
}

class TRespTotalMoneyAndHead extends c_struct
{
    public $totalMoney;
    public $totalHead;

    public function __clone()
    {
        $this->totalMoney = clone $this->totalMoney;
        $this->totalHead = clone $this->totalHead;
    }

    public function __construct()
    {
        $this->totalMoney = new  c_int;
        $this->totalHead = new  c_int;
    }

    public function get_class_name()
    {
        return "Apollo.TRespTotalMoneyAndHead";
    }

    public function writeTo(&$_out,$tag)
    {
        $this->totalMoney->write($_out,0);
        $this->totalHead->write($_out,1);
    }
    public function readFrom(&$_in,$tag,$isRequire = true)
    {
        $this->totalMoney->read($_in , 0, true);
        $this->totalHead->read($_in , 1, true);
    }
}


?>