<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox">
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班 > 班级属性
        </div>
        <div class="box">
            <nav class="navMod navModDone" >
                <a href="<?php echo Yii::app()->createUrl('class/'.($type==1?'students/':'teachers/').$class->cid); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
            </nav>
            <div class="formBox">
                <h1 class="invite-head">批量导入<?php echo $type==1?'学生':'老师';?></h1>
                <h2 class="class-attr-head">〓 发送邀请</h2>
                <div class="invite-box">
                    <?php
                    $str = sprintf(Constant::getFrontTeacherSendPwdSms(),'***',$class->s->name,$userinfo->name,'**********','******');
                    if($type=='1'){
                       $str = sprintf(Constant::getFrontFamilySendPwdSms(),$class->s->name,$userinfo->name,'***********','******');
                    }
                    $str=str_replace("未知学校的",'',$str);
                    echo $str;
                    ?>
                </div>
                <div class="invite-action">
                    <a id="isPostBnts" tip="0" href="javascript:void(0);" url="/index.php/class/sendpwd" cid="<?php echo $class->cid;?>" ecid="<?php echo BaseUrl::encode($class->cid);?>" class="btn btn-orange">发送邀请</a>
                    <a id="delayPostBtn" href="<?php echo Yii::app()->createUrl('class/'.($type==1?'students':'teachers').'/'.$class->cid);?>" class="btn btn-default">稍后发送</a>
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
        var cid = $(this).attr('cid');
        var encodeCid = $(this).attr('ecid');
        
        if(tip=='0'){
            var type=
            $(this).attr('tip','1');
            $(this).removeClass('btn-orange').addClass('btn-default');
            $('#rTips').show();
            window.location.href = url+"?cid="+encodeCid+"&importType=1&type="+"<?php echo $type;?>";
            /*
            $.ajax({
                url:url,
                type : 'POST',
                data:{cid:cid,importType:'1'},
                dataType : 'json',
                contentType : 'application/x-www-form-urlencoded',
                async : false,
                success : function(mydata) {
                    var data =mydata;
                     if(data.status=="1"){
                        var urlstr = '<?php echo Yii::app()->createUrl('class/students/'.$class->cid);?>';
                        window.location.href = urlstr;
                    }
                },
                error : function() {
                    //str = "系统繁忙,请稍后再试";
                }
            });
            */
        }
    });

});
</script>
