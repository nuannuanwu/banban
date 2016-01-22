<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班
        </div>
        <div class="box">
            <nav class="navMod">
                <a href="<?php echo Yii::app()->createUrl('class/index'); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
                <a href="<?php echo Yii::app()->createUrl('class/classinfo',array('cid'=>$class->cid,'ac'=>'guardianteachers'));?>" class="btn btn-default">班级属性</a>
                <div class="bdsharebuttonbox" style="display: inline-block; *display: inline;" data-tag="share_1">
                 
                    <a  href="javascript:;" style=" background-image: none;" rel="shareShow" tip="0" class="btn btn-default" data-cmd="sqq">分享班级信息</a>
                   
                </div>
                <a rel="disbandBtn" url="<?php echo Yii::app()->createUrl('class/leaveclass').'?cid='.$class->cid.'&type=1&studentid='.$studentId; ?>" href="javascript:;" class="btn btn-default">退出班级</a>
            </nav>

            <div class="classTitle"><?php echo $class->name; ?><span class="sName"> -- <?php echo $schoolname; ?></span></div>
            <div class="titleBox">
                <ul class="titleTable"> 
                    <li><a href="<?php echo Yii::app()->createUrl('/class/guardianstudents/'.$class->cid);?>">学生</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('/class/guardianteachers/'.$class->cid);?>" class="focus">老师</a></li>
                </ul> 
            </div> 
            <div class="classMemberBox" >
                <?php if($newteachers): ?>
                        <div class="memberListBox"><?php echo $newteachers;?></div>
                <?php else: ?> 
                    <div class="noContent" style="background: #FFF; padding-bottom: 20px;"> 
                        <span ><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/tip.png"></span>
                        <p>空空如也</p>
                    </div> 
                <?php endif; ?> 
            </div> 
        </div> 
    </div>
</div>
<div id="disbandBox" class="popupBox">
    <div class="header">退出班级<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#disbandBox')"> </a></div>
    <div class="remindInfo">
        <div id="remindText" class="centent">退出班级后，您将不能发送作业，通知等消息给该班级。</div>
    </div>
    <div class="popupBtn">
        <a id="disbandLink" href=""  class="btn btn-orange">确 定</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="hidePormptMaskWeb('#disbandBox')" class="btn btn-default">取 消</a>
    </div>
</div>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/shaerclass.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){ 
        //退出班级
        $('[rel=disbandBtn]').click(function(){
            var url = $(this).attr('url');
            $('#disbandLink').attr('href',url);
            showPromptsRemind('#disbandBox');
        });
         
    });
     var shareUrl = '<?php echo Yii::app()->createAbsoluteUrl('mobile/classintro', array('classid'=>$class->cid,'uid'=>Yii::app()->user->id,'role'=>'3'));?>';
    var bdTexts ='我加入了“<?php echo $class->name ? $class->name : '';?>”，欢迎您加入！';
    var bdDescs =  '为了更好的进行班级沟通，我在“班班”加入了我们的班级（<?php echo $class->name?$class->name:'';?>），班级代码为<?php echo $class->classcode ? $class->classcode : '';?>。班班是免费家校平台，方便我们班的家长老师快捷联络、收发孩子通知作业，注册后输入班级代码加入我们的班集体！我们都在等着你！';
    ShareClass.int(shareUrl,bdTexts,bdDescs);
    with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
</script>