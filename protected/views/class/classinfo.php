<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
           <span class="icon icon1"></span>我的班班 > 班级属性
        </div>
        <div class="box"> 
        <nav class="navMod navModDone" >
            <a href="<?php echo Yii::app()->createUrl('class/'.$from.'/'.$class->cid); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
        </nav>
            <div class="class-attr">
                <h2 class="class-attr-head">〓 班级基本信息</h2>
                <ul class="class-attr-list">
                    <li><span class="attr-label">班级代码：</span><span class="class-attr-orange"><?php echo $class->code?>&nbsp;</span></li>
                    <li><span class="attr-label">班&nbsp;&nbsp;主&nbsp;任：</span><?php echo $class->masterName;?>&nbsp;
                        <?php if($isMaster):?>
                        <a href="<?php echo Yii::app()->createUrl('class/mastersetting/'.$class->cid.'?ac='.$ac);?>" class="colorLink">（转让）</a>
                        <?php endif;?>
                    </li>
                    <li><span class="attr-label">学&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;生：</span><?php echo $class->studentTotal;?>&nbsp;</li>
                    <li><span class="attr-label">老&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;师：</span><?php echo $class->teacherTotal;?>&nbsp;</li>
                </ul>
                <h2 class="class-attr-head">〓 名称</h2>
                <ul class="class-attr-list">
                    <li><span class="attr-label">班级名称：</span><b><?php echo $class->name;?></b><span class="attr-mark-text">（<?php echo $gradeStypeStr;?>）</span>
                        <?php if($isMaster):?>
                        <a class="class-attr-edit" href="<?php echo Yii::app()->createUrl('class/gradesetting', array('cid'=>$class->cid, 'ac'=>$ac));?>" title="编辑"></a>
                        <?php endif;?>
                    </li>
                    <li><span class="attr-label">学校名称：</span><b><?php echo $schoolInfo['name'] == '未知学校'?'':$schoolInfo['name'];?></b><span class="attr-mark-text">（<?php echo $areaStr;?>）</span>
                        <?php if($isMaster):?>
                        <a class="class-attr-edit" href="<?php echo Yii::app()->createUrl('class/schoolsetting', array('cid'=>$class->cid, 'ac'=>$ac));?>" title="编辑"></a>
                        <?php endif;?>
                    </li>
                </ul>
                <h2 class="class-attr-head">〓 权限</h2>
                <ul class="class-attr-list">
                    <li><span class="attr-label">班级设置：</span><?php echo MClass::getInclassShowStr()[$class->joinverify];?>
                        <?php if($isMaster):?>
                        <a class="class-attr-edit" href="<?php echo Yii::app()->createUrl('class/inclasssetting', array('cid'=>$class->cid, 'ac'=>$ac));?>" title="更改设置"></a>
                        <?php endif;?>
                    </li>
                </ul>
                <h2 class="class-attr-head">〓 班级规则</h2>
                 <ul class="class-attr-list">
                    <li>
                        <span class="class-info">班级人数：学生总人数不得超过100人</span> 
                    </li>
                    <li>
                        <span  class="class-info">班主任：老师创建班级后默认成为该班级班主任，创建后可更换班主任身份给其它老师；一个老师最多只能同时担任三个班级的班主任。</span> 
                    </li>
                    <li>
                        <span class="class-info">解散班级：只有当前班级学生加老师人数少于15人时，班主任才可以解散班级。</span> 
                    </li> 
                </ul>
            </div>
            <!--班级学生少于15个才允许解散 -->
            <?php if($isMaster):?>
                <?php if($studentnum<15):?>
                    <a href="javascript:;" rel="leavebandBtn" url="<?php echo Yii::app()->createUrl('/class/depart/'.$class->cid);?>" dtxt="解散班级后，班内所有的通知、班费等信息将全部消失，确定要这么做吗?" class="btn btn-orange">解散班级</a>
                <?php else:?>
                    <a href="javascript:;"  rel="leavebandBtns"  dtxt="只有当前班级学生加老师人数少于15人时，班主任才可以解散班级。" class="btn btn-default">解散班级</a>
                <?php endif;?> 
            <?php else:?>
                <a rel="leavebandBtn" url="<?php echo Yii::app()->createUrl('class/leaveclass').'?cid='.$class->cid; ?>" dtxt="退出班级后，你将不能发送作业、通知等消息给当前班级，你确定这样做吗？" href="javascript:;" class="btn btn-orange">退出班级</a>
            <?php endif;?>
        </div> 
    </div> 
</div>

<div id="leavebandBtn" class="popupBox">
    <div class="remindInfo">
        <div id="remindText" class="centent">是否解散当前班级？</div>
    </div>
    <div class="popupBtn">
        <a id="leavebandLink" href=""  class="btn btn-orange">确 定</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="hidePormptMaskWeb('#leavebandBtn')" class="btn btn-default">取 消</a>
    </div>
</div> 
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    //非班主任退出班级
    $('[rel=leavebandBtn]').click(function(){
        var url = $(this).attr('url');
        var txt = $(this).attr('dtxt');
        $('#remindText').text(txt);
        $('#leavebandLink').attr('href',url);
        showPromptsRemind('#leavebandBtn');
    });
</script>
