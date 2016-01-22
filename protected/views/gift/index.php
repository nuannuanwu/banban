<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/giftStyle.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon5">&nbsp;</span>我的礼包
        </div>
        <div class="box"> 
            <!-- 老用户 或者 新用户但身份不为老师 并且 没有邀请礼包 -->
            <?php if(($isnewuser == 1 || ($isnewuser == 0 && !$identity->isTeacher)) && empty($okArr) && empty($notArr) && empty($exArr)):?>
            <p style=" margin-top: 20px; line-height: 25px;">
                    您还没有任何礼包。<br/>  
                    <?php if($identity->isTeacher):?>
                        赶快使用“<a class="linkbtn" href="<?php echo Yii::app()->createUrl('invite/index');?>" style="vertical-align: 0;">邀请推荐</a>”功能吧，就有机会获得N多话费礼包哦！
                    <?php else:?>
                        赶快邀请更多人注册使用班班吧，就有机会获得N多话费礼包哦！
                        <a style="vertical-align: 0;" href="<?php echo Yii::app()->createUrl('invite/awarddetail');?>">详情</a>
                    <?php endif;?> 
            </p>                
            <?php else:?>        
                <div class="gifteBox">
                    <ul class="gifteList">
                        <?php if($isnewuser == 0 && $identity->isTeacher):?>
                            <?php if($exchange == 1):?>
                            <li class="createClass">
                                <a class="link linkC" href="<?php echo Yii::app()->createUrl('gift/detail');?>"> 
                                </a>
                                <div class="gifteInfo">
                                    <h3 class="cH3">系统赠送</h3>
                                    <p class="cP">领取条件：</p>
                                    <p class="cP">激活人数(<?php if($activeusers>=30):?><?php echo $activeusers;?><?php else: ?><span><?php echo $activeusers;?></span><?php endif; ?>/30)</p>
                                    <p class="cP">青豆数(<?php if($bean>=500):?><?php echo $bean;?><?php else: ?><span><?php echo $bean;?></span><?php endif; ?>/500)</p>
                                </div>
                                <div class="type btnBox"> 
                                    <a href="<?php echo Yii::app()->createUrl('gift/share');?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/invite/c_c_btn.png" ></a>
                                </div>
                            </li>
                            <?php elseif($exchange == 3):?>
                            <li class="createClass">
                               <a class="link linkC" href="<?php echo Yii::app()->createUrl('gift/detail');?>"> 
                                </a>
                                <div class="gifteInfo gifteInfoHide">
                                    <h3 class="cH3">系统赠送</h3> 
                                </div>
                                <div class="type">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/invite/gift_c_type1.png" >
                                </div>
                            </li>
                            <?php elseif($exchange == 0):?>                    
                            <li class="createClass">
                                <a class="link linkC" href="<?php echo Yii::app()->createUrl('gift/detail');?>"> 
                                </a>
                                <div class="gifteInfo">
                                    <h3 class="cH3">系统赠送</h3>
                                    <p class="cP">领取条件：</p>
                                    <p class="cP">激活人数(<?php if($activeusers>=30):?><?php echo $activeusers;?><?php else: ?><span><?php echo $activeusers;?></span><?php endif; ?>/30)</p>
                                    <p class="cP">青豆数(<?php if($bean>=500):?><?php echo $bean;?><?php else: ?><span><?php echo $bean;?></span><?php endif; ?>/500)</p>
                                </div>
                                <div class="type">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/invite/gift_c_type2.png" >
                                </div>
                            </li>
                            <?php elseif($exchange == 2):?>
                            <li class="createHide">
                                <a class="link linkChide" href="<?php echo Yii::app()->createUrl('gift/detail');?>"> 
                                </a>
                                <div class="gifteInfo gifteInfoHide">
                                    系统赠送
                                </div>
                                <div class="type">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/invite/gift_type.png" >
                                </div>
                            </li>
                            <?php endif;?>
                        <?php endif;?>
                        
                        <?php foreach ($okArr as $okItem):?>
                            <li class="inviteG">
                                <a class="link linkI" href="<?php echo Yii::app()->createUrl('invite/awarddetail');?>"> 
                                </a>
                                <div class="gifteInfo giftInvite">
                                    <h3 class="cH3"><?php echo $okItem['tname']?$okItem['tname']:'某';?>老师赠送</h3>
                                    <p class="cP">赠送人已达到 </p>
                                    <p class="cP">建班礼包领取条件</p> 
                                </div>
                               <div class="type btnBox"> 
                                    <a href="<?php echo Yii::app()->createUrl('gift/invite/'.$okItem['inviteid']);?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/invite/gift_i_btn.png" ></a>
                                </div>
                            </li>
                        <?php endforeach;?>
                        
                        <?php foreach ($notArr as $notItem):?>
                        <li class="inviteG">
                            <a class="link linkI" href="<?php echo Yii::app()->createUrl('invite/awarddetail');?>"> 
                            </a>
                            <div class="gifteInfo giftInvite tipPupBtn">
                                <h3 class="cH3"><?php echo $notItem['tname']?$notItem['tname']:'某';?>老师赠送</h3>
                                <p class="cP">需要赠送人达到 </p>
                                <p class="cP">建班礼包领取条件</p> 
                            </div>
                            <div class="tipPupBox">
                                <h3>Ta的建班大礼包进度：</h3>
                                <p>激活人数（<span class="red"><?php echo $notItem['activitys'];?></span>/30）</p>
                                <p>青豆数（<span class="red"><?php echo $notItem['bean'];?></span>/500）</p>
                            </div>
                            <div class="type">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/invite/gift_i_type2.png" >
                            </div>
                        </li>
                        <?php endforeach;?>
                        
                        <?php foreach ($exArr as $exItem):?>
                        <li class="inviteG">
                            <a class="link linkI" href="<?php echo Yii::app()->createUrl('invite/awarddetail');?>"> 
                            </a>
                           <div class="gifteInfo gifteInfoHide">
                                <h3 class="cH3"><?php echo $exItem['tname']?$exItem['tname']:'某';?>老师赠送</h3>
                            </div>
                            <div class="type">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/invite/gift_i_type1.png" >
                            </div>
                        </li>
                        <?php endforeach;?>
                        <!-- >li class="inviteHide">
                            <a class="link linkIhide" href="<?php //echo Yii::app()->createUrl('invite/awarddetail');?>"> 
                            </a>
                            <div class="gifteInfo gifteInfoHide">
                                李老师赠送
                            </div>
                            <div class="type">
                                <img src="<?php //echo Yii::app()->request->baseUrl; ?>/image/banban/invite/gift_type.png" >
                            </div>
                        </li -->
                        
                        
                    </ul> 
                </div>
            <?php endif;?>
        </div>
    </div> 
</div> 
<script>
    $(function(){
        $('.tipPupBtn ,.tipPupBox').hover(function(){
            $(this).parents('li').find('.tipPupBox').show();
        },function(){
            $(this).parents('li').find('.tipPupBox').hide();
        }
        );
    });
</script>
    
