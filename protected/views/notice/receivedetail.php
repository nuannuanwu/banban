<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/inbox.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/commentStyle.css'); ?>">
<style type="text/css">
    .details-c span{
        text-indent: 2em;
    } 
</style>
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 

    	<!-- 老师区域 -->
        <div class="titleHeader bBttomT">
            <span class="icon icon2"></span>收件箱<!--（46条）-->
        </div>
        <div class="box">
            <nav class="navMod">
                <a href="<?php echo $returnurl?$returnurl:Yii::app()->request->urlReferrer; ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
            </nav>
            <div class="envelopeBox">
                <div class="envelopeHeader"> 
                    <div class="center">
<!--                        <div class="addresseeBox" style="visibility:hidden;">
                            收件人:
                            <?php
                              // echo  $msginfo['receivertitle'];
                              echo "&nbsp;";
                            ?>
                        </div>-->
                        <div class="envelopePicBox"> 
                            <!--<span class="icon <?php echo $msginfo['showclass'];?>"></span>-->
                            <p class="picTitle"><?php echo $msginfo['typedesc'];?> </p>
                            <p class="infTitle" style="overflow: hidden;  word-wrap: break-word;  word-break: normal;">
                                <span>发件人：</span><span style="color:#f59201;"><?php echo $msginfo['sendertitle'];
//                                if($noticeinfo['noticetype']==4){
//
//                                   echo $noticeinfo['sendertitle'];// $noticeinfo['schoolname'].'&nbsp;&nbsp;'.($noticeinfo['schoolname']==$noticeinfo['sendertitle']?'':$noticeinfo['sendertitle']);
//                                }else{
//                                    echo $sendinfo->userid==101?$sendinfo->name:($sendinfo->name.'老师');
//                                }
                                ?></span>
                                
                            
                            </p> 
                            <p class="infTitle" style="overflow: hidden;  word-wrap: break-word;  word-break: normal;">时&nbsp;&nbsp;间：<?php echo $msginfo['showtime'];?></p>
                        </div> 
                    </div> 
                </div>
                <div class="envelopeCenterBox">
                    <div class="box" style=" padding: 0 15px;">
                        <div style="overflow: hidden; word-wrap: break-word; word-break: normal; font-size: 16px; color: #3e3a39;">
                            <!-- 	<div class="title"><?php echo $msginfo['receivertitle'];?>：</div> -->
                            <?php if($msginfo['noticetype']==5):?>
                            <?php echo $msginfo['content'];?>
                            <?php else:?>
                                <p><?php echo $msginfo['content'];?></p>
                            <?php endif;?>
                        </div>
                        <!-- 图片-->
                        <div class="detailsImgBox"> 
                            <?php if(isset($msginfo['images'])&&is_array($msginfo['images'])&&!empty($msginfo['images'])):?>
                               <?php foreach($msginfo['images'] as $img):?>
                                   <a href="javascript:;" rel="imgPreview" data-img="<?php echo $img;?>" style="width:160px;height:110px;overflow:hidden;display: inline-block;text-align:center;border:1px solid #d9d9d9;margin-right:10px;">
                                       <img style="max-width:160px;" src="<?php echo $img.'?imageView2/3/w/160/h/110';?>"/>
                                   </a>
                               <?php endforeach;?>
                           <?php endif;?>
                        </div> 
                        <!-- /图片-->  
                    </div>
                </div>
            </div>  
        </div> 
		<!-- 老师区域 end-->

		<!-- 家长区域 -->
        <!--
		 <div class="box">
		 		<div class="tip">
		 			<p class="p-img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/tip.png" alt=""></p>
		 			<p>提醒：发送消息功能暂时只开放给老师身份使用，如果您是老师，请在登录后选择老师身份进入。</p>
		 		</div>
		 </div>
		 -->
		<!-- 家长区域 end--> 
    </div>
</div>
<div id="PreviewBox">
    <div id="imgPreview" class="popupBox" style=" ">
        <div class="header " style="">&nbsp;<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#imgPreview')" > </a></div>
        <div id="imgPBox" class="imgbox" style="padding: 10px 40px;">
            <p>正在加载...</p>
        </div>
    </div>
</div>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script type="text/javascript"> 
    $(function(){
        $('[rel=imgPreview]').click(function(){
            var imgUrl = $(this).data('img'); 
            var img ='<img style="max-height:600px;"  src="'+imgUrl+'">'; 
            $("#imgPBox").empty();
            $("#imgPBox").append(img);
            showPromptsImg('#imgPreview');
        });
        //发表评论
//        $('#btn_reply').click(function(){
//            var did = $(this).data('did');
//            var msgid = $(this).attr('msgid')||0;
//            var num = $(this).data('num');
//            var contentS = $("#textareaText").val();
//            if(contentS!=""&&contentS.length<=100){
//                $.post("/index.php/notice/reply",{msgid:msgid,content:contentS,noticeId:did},function(data)  //回复评论
//                {
//                    if(data&&data.status==='1'){
//                        location.reload(true);
//                    }
//                },'json');
//
//            }else{
//                $(this).parents('.commentsBox').find('.inputRedinfo').show();
//            }
//        });
    })

</script>