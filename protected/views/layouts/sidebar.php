<div id="subnavBox" class="subnavBox" style="position: relative;">
    <?php $toptag = XiaoxinMenu::getTopTag($this); $subTag = XiaoxinMenu::getSubTag($this);  ?>
    <ul class="menuItmeBox bBottom">
        <li>
            <a href="<?php echo Yii::app()->createUrl('notice/send'); ?>/" class="<?php if($toptag=='noticesend'){echo 'active';} ?>"><span class="icon icon1"> <i></i></span>发消息</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('class/index');?>/" class="<?php if($toptag=='banban' || ($toptag=='classfee' && in_array($subTag, ['fee_detail', 'fee_transfer']))){echo 'active';} ?>"><span class="icon icon2"> <i></i></span><span <?php if( true == JceClass::getNewAuditHint() ):?>class="noclick"<?php endif;?>>我的班班</span></a>
        </li>
	</ul>	
    <ul class="menuItmeBox bTop bBottom subMenu">
        <li>
            <?php $receivenum=NoticeService::getNoreadnum();?>
            <a  <?php if($receivenum) echo "style='font-weight:700'";?> href="<?php echo Yii::app()->createUrl('notice/receive'); ?>/" class="<?php if($toptag=='noticereceive'){echo 'active';} ?>">收件箱<?php echo $receivenum?('（'.$receivenum.'）'):""; ?></a>
		</li>
        <?php
        if($identity->isTeacher):?>
		<li>
            <a href="<?php echo Yii::app()->createUrl('notice/history'); ?>/" class="<?php if($toptag=='noticehistory'){echo 'active';} ?>">已发送</a>
		</li>
        <?php else:?>
                <?php  $list=JceNotice::getSendNotice(1,0,Yii::app()->user->id,0);
                       $sendnum=isset($list['total'])?$list['total']:0;
                ?>
                <?php if($sendnum):?>
                <li >
                    <a href="<?php echo Yii::app()->createUrl('notice/history'); ?>/" class="<?php if($toptag=='noticehistory'){echo 'active';} ?>">已发送</a>
                </li>
                <?php endif;?>

        <?php endif;?>
    </ul>
    <ul class="menuItmeBox bTop  subMenu <?php if($identity->isTeacher):?>bBottom<?php endif;?>" >
        <li>
            <a href="<?php echo Yii::app()->createUrl('bean/index'); ?>/" class="<?php if($toptag=='bean'){echo 'active';} ?>">我的青豆（<?php echo JceHelper::getBeanInfo(Yii::app()->user->id);?>）</a>

        </li> 
        <li>
            <a href="<?php echo Yii::app()->createUrl('expense/index'); ?>/" class="<?php if($toptag=='classfee' && !in_array($subTag, ['fee_detail', 'fee_transfer'])){echo 'active';} ?>">我的班费卡</a>
        </li>
   <?php if($identity->isTeacher):?>
    </ul>
    <ul class="menuItmeBox bTop subMenu">
    <?php endif;?>
        <?php if($identity->isTeacher):?>
            <li class="<?php echo Yii::app()->cache->get('userid_'.Yii::app()->user->id.'_inviteteacher')?'':'noclick';?>">
                <a href="<?php echo Yii::app()->createUrl('invite/index'); ?>/" class="<?php if($toptag=='invite'){echo 'active';} ?>">邀请有礼</a>
            </li>
        <?php endif;?>
    </ul>
    <div class="erweima" style=" padding-left: 20px; margin-top: 30px;">
        <a href="javascript:;" onclick="showPromptsRemind('#popupBoxActivity')" >
            <img class="" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/gif_nav.png" alt="">
        </a>
        <?php
            //只有新注册老师用户可以看到
            //if($identity->isTeacher): 
                //$user = Yii::app()->user->getInstance();
                //if($user->isnewuser == 0):  
        ?>
<!--        <a href="<?php echo Yii::app()->createUrl('gift/index');?>" class="gift">
            <img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/gift_nav.png" alt="">
        </a>-->
                <?php //endif;?>
        <?php // endif;?>
        <!--<img class="return" src="<?php /*echo Yii::app()->request->baseUrl; */?>/image/banban/erxiaoxin.png" alt="">
        <p>扫描二维码，下载班班手机应用</p>-->
    </div>
</div>