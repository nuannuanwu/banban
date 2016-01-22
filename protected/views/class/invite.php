<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
           <span class="icon icon1"></span>我的班班 > 班级属性
        </div>
        <div class="box"> 
        <nav class="navMod navModDone" >
                <a href="<?php echo Yii::app()->createUrl('class/classinfo'); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
            </nav>
            <div class="formBox">
                <h1 class="invite-head">批量导入学生</h1>
                <h2 class="class-attr-head">〓 发送邀请</h2>
                <div class="invite-box">
                    家长您好：我是中国广东省深圳市南山区高级刺杀学校9分校的萝卜特老师，邀请您使用免费家校沟通平台“班班”，接收您孩子的学校通知、作业及联系老师。点击 http://t.cn/RwU3di3 下载即可使用，动动手指还可以挣班费！您的帐号：***********，初始密码：******。登录后建议修改密码。咨询电话4001013838。
                </div>
                <div class="invite-action">
                    <a id="isPostBnts" tip="0" href="javascript:void(0);" url="/index.php/class/sendpwd" cid="922701" class="btn btn-orange">发送邀请</a>
                    <a id="delayPostBtn" href="/index.php/class/students/922701" class="btn btn-default">稍后发送</a>
                </div>
            </div>
        </div> 
    </div>
</div>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/stcombobox/index.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/stcombobox/stcombobox.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/stcombobox/stcombobox.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
     //提交
    $('#submitBtn').click(function() {
        $("#formBoxRegister").submit();
    });
});
</script>
