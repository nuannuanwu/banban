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
		<title>"班班"千万红包免费送,注册建班即送50元话费红包</title>
		<style>
			.containter{
				max-width:640px;
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
		 	<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/img7.jpg"/>
		 	<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/img8.jpg"/>
		 	<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/img9.jpg"/>
		 	<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/img10.jpg"/>
		 	<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/img11.jpg"/>
		 	<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/img12.jpg"/>
		 	<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/img13.jpg"/>
		 	<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/img14.jpg"/>
		 </div>
		<div class="scroll" id="scroll" style="display: none;">
	        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/top.png"/>
	    </div>
	   	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/banban/jquery-1.7.2.min.js" type="text/javascript"></script>
	    <script type="text/javascript">
			$(function(){
				showScroll();
				function showScroll(){
					$(window).scroll( function() { 
						var scrollValue=$(window).scrollTop();
						scrollValue > 100 ? $('div[class=scroll]').fadeIn():$('div[class=scroll]').fadeOut();
					} );	
					$('#scroll').click(function(){
						$("html,body").animate({scrollTop:0},200);	
					});	
				}

					
			})
		</script>
	</body>
</html>