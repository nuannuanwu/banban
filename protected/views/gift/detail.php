<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/inbox.css'); ?>">
<style>	
	.containter{
/* 		width:1183px; */
		text-align: center;
		margin:0 auto;
		overflow:hidden;
	}
	.containter img{
		max-width:70%;
		display: inline;
	}
	.containter .header{
		position:relative;
	}
	.containter .header .register{
		position:absolute;
		top: 451px;
		left: 500px;
	}
	.scroll{
		position: fixed;
		right: 30px;
		bottom: 50px;
		cursor: pointer;
	}
</style>
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon5"></span>礼包详情
        </div>
        <div class="box">
            	<div class="containter">
		 	  
		 	   		<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/img4.jpg"/>

		 	   		<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/img5.jpg"/>
		 
		 	   		<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/img6.jpg"/>
		 	   		
		 	   		<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/img7.jpg"/>
		 </div>
        </div> 
    </div>
</div>
<div class="scroll" id="scroll" style="display: none;">
	        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/top.png"/>
</div>
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