<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/banban/site.css">
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon9"></span>设置
        </div>
        <div class="box">
            <div class="titleBox">
                <ul class="titleTable"> 
                    <li><a href="<?php echo Yii::app()->createUrl('site/account');?>" >基本信息</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('site/password');?>">修改密码</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('site/invitelist');?>" class="focus">邀请人</a></li>
                </ul>
            </div>
            <div class="formBox">
                <div class="box"> 
                    
                    <div class="inviteBox">
                        <p class="title">您注册时填写的邀请人</p>
                        <ul>
                            <?php if($inviteMe): ?>
                            <li>
                                <div class="pic"> 
                                   <?php  
                                        if($inviteMe->s){
                                            $currIdentity = Yii::app()->user->getCUrrIdentity($inviteMe->s->userid);    
                                        }
                                        if(isset($currIdentity) && $currIdentity->isPatriarch){
                                            $type = 4;  //家长
                                    ?>
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/class/class_pic_6.png" />
                                    <?php }elseif(isset($currIdentity) && $currIdentity->isTeacher){
                                        $type = 1;  //老师
                                    ?> 
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/class/class_pic_2.png" />
                                    <?php }else{
                                        $type = 0; //无身份 
                                    ?>
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/class/class_pic_5.png" />
                                    <?php  }?> 
                                </div>
                                <div class="rInfo">
                                    <div class="title"><?php echo $inviteMe->mobilephone; ?></div>
                                    <p><?php echo $type==0?'':$inviteMe->s->name; ?><?php if($type == 0): ?><span class="red">（未注册）</span><?php endif; ?></p>
                                </div>
                            </li>
                            <?php else: ?>
                                <li style=" height: 40px;">
                                    您注册时没有填写邀请人
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                     
                    <div class="inviteBox">
                        <p class="title">注册时填写您为邀请人的用户（<span><?php echo count($myInvite); ?></span>）</p>
                        <ul>
                            <?php if(count($myInvite)): ?>
                                <?php 
                                    foreach($myInvite as $mi): 
                                        if($mi->r){
                                            $rIdentity = Yii::app()->user->getCUrrIdentity($mi->r->userid);
                                        }
                                ?>
                                <li>
                                    <div class="pic"> 
                                        <?php  if(isset($rIdentity) && $rIdentity->isPatriarch){ $type = 4;  //家长 ?>
                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/class/class_pic_6.png" />
                                        <?php }elseif(isset($rIdentity) && $rIdentity->isTeacher){ $type = 1;  //老师?>
                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/class/class_pic_2.png" />
                                        <?php }else{ $type = 0; //未注册 ?>
                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/class/class_pic_5.png" />
                                        <?php } ?> 
                                    </div> 
                                    <div class="rInfo">
                                        <div class="title"><?php echo $mi->r->mobilephone; ?></div>
                                        <p><?php echo $type == 4?Member::getParentName($mi->r->userid):$mi->r->name; ?></p>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li style=" height: 40px;">
                                    没有人填写您为邀请人
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div> 
                </div> 
            </div>
        </div> 
    </div>
</div>

 


