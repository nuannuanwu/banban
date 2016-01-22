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
		
		</style>
	</head>
	<body>
		 	
	</body>
	<script type="text/javascript">
		function IsPC()  
		{  
				   var userAgentInfo = navigator.userAgent;  
				   var Agents = new Array("Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod");  
				   var flag = true;  
				   for (var v = 0; v < Agents.length; v++) {  
					   if (userAgentInfo.indexOf(Agents[v]) > 0) { flag = false; break; }  
				   }  
				   return flag;  
		} 
		var browser=IsPC();
		if(browser){
			window.location="<?php echo Yii::app()->createUrl('gift/cost_preview'); ?>";
		}else{
			window.location="<?php echo Yii::app()->createUrl('mobile/cost_preview');?>";
		}
	</script>
</html>