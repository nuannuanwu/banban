<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/inbox.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/commentStyle.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/phpemoji/emoji.css'); ?>">
<style type="text/css">
    .details-c span{
        text-indent: 2em;
    }
    .read{
        color:blue!important;
    }
</style> 
<?php if(!function_exists('emoji_unified_to_html')){
    require_once('protected/extensions/PHPEmoji/emoji.php');
} ?>
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox">
    	<!-- 老师区域 -->
        <div class="titleHeader bBttomT">
            <span class="icon icon2"></span>已发送<!--（46条）-->
        </div>
        <div class="box">
            <nav class="navMod">
                <a href="<?php echo $returnurl?$returnurl:Yii::app()->request->urlReferrer; ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
            </nav>
            <div class="envelopeBox">
                <div class="envelopeHeader">
                    <!--<i class="l_t"></i> <i class="l_b"></i> <i class="t_t"></i> <i class="r_t"></i> <i class="r_b"></i> <i class="b_b"></i> <i class="l_l"></i> <i class="r_r"></i>-->
                    <div class="center">
                        <!--<div class="addresseeBox" style="overflow: hidden;  word-wrap: break-word;  word-break: normal;">收件人: <?php echo emoji_unified_to_html($noticeinfo['receivename']); //$noticeinfo['schoolname'].'&nbsp;&nbsp;'. ?></div>-->
                        <div class="envelopePicBox ">
                            <!--<span class="icon <?php echo $noticeinfo['showclass'];?>"></span>-->
                            <p class="picTitle"><?php echo $noticeinfo['typedesc'];?></p> 
                            <p class="infTitle" style="overflow: hidden;  word-wrap: break-word;  word-break: normal;">
                                <span>收件人：</span><span style="color:#f59201;"><?php echo emoji_unified_to_html($noticeinfo['receivename']); //$noticeinfo['schoolname'].'&nbsp;&nbsp;'. ?> </span>
                            </p>
                            <p class="infTitle" style="overflow: hidden;  word-wrap: break-word;  word-break: normal;">
                                <span>时&nbsp;&nbsp;&nbsp;间：</span><?php echo $noticeinfo['showtime'];?>
                            </p>
                        </div> 
                    </div>  
                </div>
                <div class="envelopeCenterBox">
                    <div class="box <?php if($noticeinfo['noticetype']==1 ||$noticeinfo['noticetype']==2||$noticeinfo['noticetype']==3):?> <?php endif;?>" style=" padding: 0 15px;" >
                        <div style="overflow: hidden; word-wrap: break-word; word-break: normal; margin-bottom: 15px; font-size: 16px; color: #3e3a39;" >
                            <!-- 	<div class="title"><?php echo $noticeinfo['receivertitle'];?>：</div> -->
                            <?php if($noticeinfo['noticetype']==5):?>
                            <?php echo emoji_unified_to_html($noticeinfo['content']);?>
                            <?php else:?>
                                <p><?php echo emoji_unified_to_html($noticeinfo['content']);?></p>
                            <?php endif;?>
                        </div>
                        <!-- 图片-->
                        <div class="detailsImgBox"> 
                            <?php if(isset($noticeinfo['images'])&&is_array($noticeinfo['images'])&&!empty($noticeinfo['images'])):?>
                                <?php foreach($noticeinfo['images'] as $img):?>
                                    <a href="javascript:;" rel="imgPreview" data-img="<?php echo $img.'?imageView2/2/w/600';?>" style="width:120px;height:110px;overflow:hidden;display: inline-block;text-align:center;border:1px solid #d9d9d9;margin-right:10px; margin-bottom: 15px; ">
                                        <img style="width:120px;" src="<?php echo $img.'?imageView2/1/w/120/h/110';?>"/>
                                    </a>
                                <?php endforeach;?>
                            <?php endif;?>
                        </div>
                    <!-- /图片--> 
                    </div>
                    <?php $isHidden=!($noticeinfo['noticetype']==1 ||$noticeinfo['noticetype']==2||$noticeinfo['noticetype']==3);
                          $hiddenClass=$isHidden?'display:none;':'';
                    ?>

                    <div class="box "> </div>
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


<script src="<?php echo MainHelper::AutoVersion('/js/api/require.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/api/echart/echarts.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script type="text/javascript"> 
     $('[rel=imgPreview]').click(function(){
            var imgUrl = $(this).data('img'); 
            var img ='<img style="max-height:600px;"  src="'+imgUrl+'">'; 
            $("#imgPBox").empty();
            $("#imgPBox").append(img);
            showPromptsImg('#imgPreview');
        }); 


</script>