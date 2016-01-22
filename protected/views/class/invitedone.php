<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
           <span class="icon icon1"></span>我的班班 > 班级属性
        </div>
        <div class="box"> 
        <nav class="navMod navModDone" >
                <a href="<?php echo Yii::app()->createUrl('class/students/'.$class->cid); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
            </nav>
            <div class="formBox">
                <h1 class="invite-head">批量导入学生</h1>
                <h2 class="invite-done-head">已成功发送“注册邀请短信”23名！</h2>
                <h3 class="uninvite-head">以下用户已注册，不发送短信（3）！</h3>
                <table class="uninvite-table">
                    <tr>
                        <td class="name">刘水玲</td>
                        <td class="phone">13790512465</td>
                    </tr>
                    <tr>
                        <td class="name">刘水玲</td>
                        <td class="phone">13790512465</td>
                    </tr>
                    <tr>
                        <td class="name">刘水玲</td>
                        <td class="phone">13790512465</td>
                    </tr>
                    <tr>
                        <td class="name">刘水玲</td>
                        <td class="phone">13790512465</td>
                    </tr>
                </table>
                <h3 class="uninvite-head">以下用户已接受3次邀请而还未注册，不发送短信（4）！</h3>
                <table class="uninvite-table">
                    <tr>
                        <td class="name">刘水玲</td>
                        <td class="phone">13790512465</td>
                    </tr>
                    <tr>
                        <td class="name">刘水玲</td>
                        <td class="phone">13790512465</td>
                    </tr>
                    <tr>
                        <td class="name">刘水玲</td>
                        <td class="phone">13790512465</td>
                    </tr>
                </table>
                <div class="invite-action">
                    <a class="btn btn-orange" href="">返回“测试一班”</a>
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
