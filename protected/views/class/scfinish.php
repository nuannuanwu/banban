<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班 > <?php echo $class->name; ?>
        </div>
        <div class="box"> 
            <div class="listTopTite bBottom">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/xiaoxin/class_step_3.png">
            </div> 
            <div class="formBox">
                <div class="classTableBox invtesBox" style="text-align: center;">
                    <h2>操作成功</h2>
                    <p>你已成功添加<?php echo $addStudentNum;?></span>位学生
                       <?php if($isinvite):?>
                        成功邀请<?php echo $inviteNum;?>位学生
                        <?php endif;?>
                    </p>
<!--                    <div class="btnBox">
                        <a href="<?php echo Yii::app()->createUrl('class/create?sid=' . $class->s->sid);?>" class="btn btn-raed" >重新创建</a>&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo Yii::app()->createUrl('class/pinvite/' . $class->cid);?>" class="btn btn-default" >添加老师</a>&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo Yii::app()->createUrl('class/students/'.$class->cid);?>" class="btn btn-default" >查看班级成员</a>
                    </div>-->
                </div>
            </div>
        </div> 
    </div>
</div>  
