<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<meta http-equiv="cleartype" content="on">
        <link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/mobile.css'); ?>">
		<title>班班，免费家校沟通新模式！</title>
		<style>
			.containter{
				max-width:712px;
				margin:0 auto;
				overflow:hidden;
			}
			.containter img{
				max-width:100%;
				vertical-align:middle;
			}
			.scroll{
				position: fixed;
				right: 10px;
				bottom: 50px;
				cursor: pointer;
			}
		</style>
	</head>
	<body >
		 <div class="containter">
             <div class="shareBox" style=" background-color: #F6F1DE;">
                 <div class="imgBox" style=" width: 712px;">
                     <div style=" padding: 20px; background:url(/image/banban/share/bg_web.png) repeat-y; overflow: hidden;">
                        <div class="pic" style=" float: left; width: 76px;">
                            <img class="return" src="<?php echo $user->photo?$user->photo:Yii::app()->request->baseUrl.'/image/banban/share/pic_web.png';?>"  onerror="javascript:this.src='<?php echo Yii::app()->request->baseUrl.'/image/banban/share/pic_web.png'; ?>';" alt=""> 
                        </div>
                         <div style=" margin-left: 90px; ">
                             <div style=" font-size: 25px; color: #808080; margin-bottom: 10px;"><?php echo $user->name; ?></div>
                             <div style="background:url(/image/banban/share/msBg_web.png) no-repeat; width: 508px; height: 121px;">
                                 <div style=" font-size: 24px; color: #000000; padding: 5px 15px 15px 45px; line-height: 38px;">
                                     大家好！我在班班<?php if($role=='1'):?>创建了<?php else: ?>加入了<?php endif;?>“<span style=" color: #f59201;"><?php echo $class->name; ?></span>” 快来一同加入吧。
                                 </div>
                             </div>
                        </div>
                     </div> 
                 </div>
                 <div class="imgBox" style=" position: relative;">
                     <div style=" position: absolute; color: #674f0d; font-size: 60px; top:78px;  width: 100%; text-align: center;"><?php echo ($class->classcode ? $class->classcode : "未分配"); ?></div>
                     <img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/share/coede_web.jpg" alt=""> 
                 </div>
                 <div class="imgBox" style=" position: relative;">
                     <div style=" width: 100%; text-align: center;  position: absolute; color: #674f0d; font-size: 22px; left:0; top:0%;"> 
                         <div style=" width: 438px; display: inline-block;">加入班级时，输入<span style=" color: #f59201;">班级代码</span>或<span style=" color: #f59201;"><?php if($role=='1'):?>我的手机号<?php else: ?>班主任手机号<?php endif;?></span> ， 就可以加入“<span style=" color: #f59201;"><?php echo $class->name; ?></span>” </div>  
                     </div>
                     <img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/share/join_web.jpg" alt=""> 
                 </div>
                 <div class="imgBox">
                     <img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/share/join1_web.jpg" alt=""> 
                 </div>
                 <div class="imgBox">
                     <img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/share/explain_web.jpg" alt=""> 
                 </div>
                 <div class="imgBox">
                     <img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/share/function_web.jpg" alt=""> 
                 </div> 
             </div>
		 </div> 
	</body>
</html>