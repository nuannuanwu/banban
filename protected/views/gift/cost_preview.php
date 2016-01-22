<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<meta http-equiv="cleartype" content="on">
		<title>"班班"千万红包免费送,注册建班即送50元话费红包</title>
		<style>
			@charset "UTF-8";
			body, a, p, input, h1, h2, h3, h4, h5, h6, ul, li, dl, dt, dd, form { margin: 0; padding: 0; list-style: none; vertical-align: middle }
			body { background-color: #f9f8f8; font-family: "\5FAE\8F6F\96C5\9ED1", "微软雅黑", helvetica, arial; color: #000; font-size: 13px }
			header, section, footer, img { display: block; margin: 0; padding: 0 }
			img { border: 0 }
			* { padding: 0; outline: 0; border: 0; }
			a { outline: 0; noFocusLine: expression(this.onFocus = this.blur()); }
			a:focus { outline: 0; }
			img { border: none; line-height: 0; }
			a img { border-width: 0; vertical-align: middle; outline: none; }
			ul, li { border: 0; margin: 0; padding: 0; list-style: none; }
			input[type=text]:focus, input[type=password]:focus, textarea:focus { outline: none; }
			input { margin-right: 3px; vertical-align: middle; }
			label { font-family: Tahoma; vertical-align: middle; }
			table { border-collapse: collapse; border-spacing: 0; }
			h1, h2, h3, h4, h5, h6 { font-size: 100%; font-weight: normal; }
            .containter{
                width:60%;
        		text-align: center;
        		margin:0 auto;
        		overflow:hidden;
                font-size: 0;
        	}
        	.containter img{
        		width:100%;
                vertical-align: bottom;
                display: block;
        	}
            .containter .boxCenter{  
                text-align: center;
                margin: 0 auto;
                border: none;
            }
            .containter .boxCenter a{ display: block; }  
        	.containter .header{
        		display: block;
        		position:relative;
                margin: 0 auto;
        		padding: 0px;
        	}
			.containter .header .register{
				position:absolute;
				top:80%;
				left: 870px;
			}
			.scroll{
				position: fixed;
				right: 30px;
				bottom: 50px;
				cursor: pointer;
			}
		</style>
	</head>
	<body >
		 <div class="containter">
		 	   <div class="header boxCenter">
                   <a href="<?php echo Yii::app()->createUrl('openregister/index'); ?>" title="点击注册" >
                        <img class="mgbox" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/img4.jpg" usemap="#planetmap" /> 
                    </a>  
		 	   </div>
		 	   <div class="center boxCenter">
		 	   		<img class="mgbox" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/img5.jpg"/>
		 	   </div>
		 	   <div class="footer boxCenter">
		 	   		<img class="mgbox" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/img6.jpg"/>
		 	   		<img class="mgbox" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/img7.jpg"/>
		 	   </div>
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