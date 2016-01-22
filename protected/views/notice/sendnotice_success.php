<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/send.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="senNavbox">
            <ul class="applicationList bBttomT">
               <li>
                    <div class="applicationItme">  
                        <a rel="noticetypeBtn" href="<?php echo Yii::app()->createUrl('/notice/send?noticetype=').Constant::NOTICE_TYPE_1;?>" noticetype="<?php echo Constant::NOTICE_TYPE_1;?>">
                            <span class="fleft sendPic" ><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app1.png"/></span>
                            <span class="send-info applicationTitle">布置作业 </span>
                            <span class="send-info applicationInfo">给学生布置作业</span>
                            <!--<span class="navIco"></span>-->
                        </a> 
                    </div>
                </li>
                <li>
                    <div class="applicationItme">  
                        <a rel="noticetypeBtn" href="<?php echo Yii::app()->createUrl('/notice/send?noticetype=').Constant::NOTICE_TYPE_2;?>" noticetype="<?php echo Constant::NOTICE_TYPE_2;?>">
                            <span class="fleft sendPic"><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app2.png"/></span>
                            <span class="send-info applicationTitle">通知家长 </span>
                            <span class="send-info applicationInfo">给家长发送通知</span>
                            <!--<span class="navIco"></span>-->
                        </a>
                    </div>
                </li>
                <li>
                    <div class="applicationItme">
                        <a rel="noticetypeBtn" href="<?php echo Yii::app()->createUrl('/notice/send?noticetype=').Constant::NOTICE_TYPE_3;?>" noticetype="<?php echo Constant::NOTICE_TYPE_3;?>">
                            <span class="fleft sendPic"><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app4.png"/></span>
                            <span class="send-info applicationTitle">在校表现</span>
                            <span class="send-info applicationInfo">学生在班级的表现</span>
                            <!--<span class="navIco"></span>-->
                        </a>  
                    </div>
                </li>
                <li>
                    <div class="applicationItme">
                        <a rel="noticetypeBtn" href="<?php echo Yii::app()->createUrl('/notice/sendexam');?>" class=" " noticetype="<?php echo Constant::NOTICE_TYPE_4;?>">
                            <span class="fleft sendPic"><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app5.png"/></span>
                            <span class="send-info applicationTitle">发布成绩</span>
                            <span class="send-info applicationInfo">发布学生考试成绩</span>
                             <span class="new">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/notice/new_ioc.png"/>
                            </span>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="applicationItme">
                        <a rel="noticetypeBtn" href="<?php echo Yii::app()->createUrl('/notice/schoolnotice');?>" class="focus"  noticetype="<?php echo Constant::NOTICE_TYPE_5;?>">
                            <span class="fleft sendPic"><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app6.png"/></span>
                            <span class="send-info applicationTitle">紧急通知</span>
                            <span class="send-info applicationInfo">发送紧急短信通知</span>
                            <!--<span class="navIco"></span>-->
                        </a>
                    </div>
                </li> 
            </ul>
        </div>
        <div class="box" style="width: 760px;">
            <form method="post" action="<?php echo Yii::app()->createUrl('/notice/schoolnotice_success');?>">
            <div class="notice-suss-box">
                <h3 class="n-t-title">发送成功</h3> 
                <?php if(!empty($students)):?>
                 <p>以下学生的家长还未绑定手机号，无法接收短信。提醒一下他们吧！</p>
                 <div class="msgPsotBox" style=""> 
                     <h1 class="b-t" style="">通知家长</h1>
                     <div class="row-b">
                         <span class="b-l">收 件 人：</span>
                         <div class="b-r">
                             <?php $names=array();?>
                            <?php foreach($students as $k=>$student):?>
                                <?php $names[]=$student->name;?>
                                <input type="hidden" name="uids[]" value="<?php echo $student->sid;?>"/><?php echo (($k+1)==count($students))?$student->name:($student->name."、");?>
                            <?php endforeach;?>
                         </div>
                         <input type="hidden" name="receivername" value="<?php echo implode(',',$names);?>"/>
                         
                     </div>
                     <div class="row-b">
                         <span class="b-l">通知内容：</span>
                         <div class="b-r">
                             家长您好。有班级紧急通知需要给您发送短信,由于您还未绑定手机号，无法接收。请您尽快绑定手机号，以便接收短信通知。绑定方式：登录班班手机APP→点击“我-设置-手机”。
                         </div>  
                     </div> 
                    
                 </div>
                    <input type="hidden" name="content" value="家长您好。有班级紧急通知需要给您发送短信,由于您还未绑定手机号，无法接收。请您尽快绑定手机号，以便接收短信通知。绑定方式：登录班班手机APP→点击“我-设置-手机"/>
                 <input class="btn btn-orange" type="submit" value="立即发送" id="send"/>
                 <?php else:?>
<!--                 <div style="margin-top: 50px;">
                    <a href="" class="btn btn-default" >返回</a>
                </div>-->
                <?php endif;?>
                
            </div>
            </form>
        </div> 
    </div>
</div> 
