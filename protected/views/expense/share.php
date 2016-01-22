<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/inbox.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon3"></span>我的班费
        </div>
        <div class="box" style="padding:15px 25px 50px;">
              <nav class="navMod">
        		<a href="<?php echo Yii::app()->createUrl('expense/expdetail/'.$cid);?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
            </nav>
        	<div class="share">
        		<div class="tit">转出班费</div>
        		<div class="step">
        			<p class="p1"></p>
        			<p class="p2">要转出班费了，先分享给您的同事和朋友，邀请他们一同注册建班，也为他们的班级挣班费吧！</p>
					<div class="select-type">
						<span>点击你希望分享的平台：</span>
						<div class="bdsharebuttonbox" data-tag="share_1">
							<a class="sqq" data-cmd="sqq"></a>
		                	<a class="qzone" data-cmd="qzone" href="#"></a>
		                	<a class="sina" data-cmd="tsina"></a>
		                	
		                </div>
					</div>
        			
        		</div>		
            </div>
        </div> 
    </div>
</div>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script>
	//判断手机号码是否一致
	
	window._bd_share_config = {
		common : {
			bdText : '我支取了***元班费，免费家校沟通，还能轻松挣班费。动动手指就够了！',	
			bdDesc : '动动手指轻松挣班费！',	
			bdUrl : 'http://www.banban.im/', 	
			bdPic : 'http://www.banban.im/image/banban/login/logo1.png',
			onAfterClick : function(){
				location.href="<?php echo Yii::app()->createUrl('expense/transfer', array('cid'=>$cid));?>";
			}
		},
		share : [{
			"bdSize" : 32
		}]
	}
	with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
</script>