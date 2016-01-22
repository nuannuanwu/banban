<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班 > 加班班级
        </div>
        <div class="box"> 
            <div class="listTopTite bBottom">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/class/set_3.png">
            </div> 
            <div class="formBox">
                <?php if($joinverify == 0&&$type==1):?>
                <div class="classTableBox invtesBox" style="text-align: center;">
                    <div class="classTableBox invtesBox" style="text-align: center;">
                        <div style="width: 98px; margin: 30px auto;">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/tipSussess.png">
                        </div>
                        <h2 style="margin: 20px 0 30px 0;">加入成功</h2>
                        <p class="" style="font-size: 14px;color: #000;">
                            您已成为 <span style="color: #F59201;"><?php echo $className;?></span> 班级成员
                        </p>
                        <p style=" margin-top: 20px;">
                            <a id="linkBtn" href="<?php echo Yii::app()->createUrl('class/index');?>" class="btn btn-orange" style="margin-right: 0;">返回"我的班班"（5）</a>
                        </p>
                    </div>
                    <?php else:?>
                    <div class="classTableBox invtesBox" style="text-align: center;">
                        <div style="width: 98px; margin: 30px auto;">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/tipSussess.png">
                        </div>
                        <h2 style="margin: 20px 0 30px 0;">等待班主任验证</h2>
                        <p class="" style="font-size: 14px;color: #000;">
                            您的入班申请已发送，需等待班主任验证通过，方能加入。
                        </p>
                        <p style=" margin-top: 20px;">
                            <a id="linkBtns" href="<?php echo Yii::app()->createUrl('class/index');?>" class="btn btn-orange" style="margin-right: 0;">返回"我的班班"</a>
                        </p>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div> 
    </div>
</div>
<script type="text/javascript">
    $(function(){
        if($('#linkBtn').length>0){ 
            settime($('#linkBtn'));
        }
    });
         //计时器
    var countdown = 5;
    var off =true;
    function settime(val) {
        if(!off){
          return;
        }
        if (countdown == 0) {
            ///val.removeAttribute("disabled");
            //val.css({background:'#ffffff',color:"#333333"});
            val.text('返回"我的班班"');
            //countdown = 5;
            window.location.href="<?php echo Yii::app()->createUrl('class/index');?>";
            return;
        } else {
            //val.css({background:'#cccccc',color:"#ffffff",cursor: "default",borderColor:'#adadad'});
            val.text('返回"我的班班"（'+countdown+'）');
            countdown--;
        }
        setTimeout(function() {
            settime(val);
        },1000);
    }
</script>
