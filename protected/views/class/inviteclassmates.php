<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox">
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班 > 重发邀请
        </div>
        <div class="box">
            <nav class="navMod navModDone" >
                <a href="<?php echo Yii::app()->createUrl('class/'.($type==2?'students/':'teachers/').$class->cid);?>" class="btn btn-default">
                    <img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">
                    返回
                </a>
            </nav>
            <div class="formBox">
                <h1 class="invite-head">重发邀请</h1>
                <h2 class="class-attr-head">〓 发送邀请</h2>
                <div class="invite-box">
                    <?php
                    $str = sprintf(Constant::getFrontTeacherSendPwdSms(),'***',$class->s->name,$userinfo->name,'**********','******');
                    if($type=='2'){
                       $str = sprintf(Constant::getFrontFamilySendPwdSms(),$class->s->name,$userinfo->name,'***********','******');
                    }
                    $str=str_replace("未知学校的",'',$str);
                    echo $str;
                    ?>
                </div>
                <div class="invite-action">
                    <a id="isPostBnts" tip="0" href="javascript:void(0);" url="<?php echo Yii::app()->createUrl('/class/anewpinvite?cid='.$class->cid.'&ty='.$type);?>" cid="<?php echo $class->cid;?>" class="btn btn-orange">发送邀请</a>

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

    //邀请操作
    $('#isPostBnts').click(function(){
        var tip =$(this).attr('tip');
        var url = $(this).attr('url');
        if(tip=='0'){
            var type=
            $(this).attr('tip','1');
            $(this).removeClass('btn-orange').addClass('btn-default');
            $('#rTips').show();
            window.location.href = url;
        }
    });

});
</script>
