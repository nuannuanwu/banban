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
     <title>我的青豆</title> 
</head>
<body>

<div class="cost-help bean">
    <div class="touxiang">
            <div class="left" style=" position: relative;">
                <img src="<?php echo STORAGE_QINNIU_XIAOXIN_TX.$user->icon; ?>" onerror="javascript:this.src='<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/touxiang.jpg'"/>
               <?php if($user&&$user->teacherauth==2):?>
                <div class="v-ap">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/posts/v.png"/>
                </div>
                <?php endif;?>
            </div>
           <div class="right">
                  <p class="name"><?php echo $uname ? $uname : '李小萌';?></p>
                  <p class="score"><?php echo $beans;?><span>青豆</span></p>
           </div>
           <div style="clear:both;"></div>
    <!-- 	<a href="http://shop.qtxiaoxin.com/api.aspx?uid=<?php //echo $uid;?>" class="change">兑换</a> -->
    </div>
    <div class="cost-help-c">
        <h2>*  什么是青豆？ </h2>
         <div style=" font-size: 16px; line-height: 24px; margin-left: 4%; padding: 10px 0 10px 0px;color: #777777;">
            青豆是对使用班班APP的用户进行奖励的载体，青豆可在班班APP内兑换对应的礼品。
        </div>
        <div style=" width: 100%; height: 20px;"></div>
        <h2>*  青豆的奖励规则是什么？青豆获取途径有哪些？</h2>  
        <ul class="decimal">
               <li>用户只有使用班班APP或者参与班班官网指定的活动才可以获得青豆；</li>
               <li>用户每天登录班班可一次性获得2个青豆，重复登录也只能获得一次；</li>
               <li>用户每天晒一次班费，可以获得5个青豆。</li>
               <!-- <li>用户在话题下每发布一个帖子可获得3个青豆，每天最多可获得6个青豆；</li>
               <li>用户每回复一个已发布的帖子可获得1个青豆，每天最多可获得2个青豆；</li> -->
               <?php if($identity->isTeacher):?>
               <li>每位班级成员读取未读消息，发通知的老师将获得3个青豆奖励，每天最多可获得300个青豆； </li> 
               <?php endif; ?>
        </ul> 
        <h2>*  怎样使用青豆？</h2>
        <div style=" font-size: 16px; line-height: 24px; margin-left: 4%; padding: 10px 0 10px 0px;color: #000;">
            目前可通过“青豆派兑”将青豆兑换成相应的礼品，具体礼品及礼品兑换方式以“青豆派兑”为准。 
        </div>
        <!--<h2>*  其他说明</h2>-->
        <ul class="decimal">
            <li>秉承公平公正的原则，班班平台将严厉打击刷青豆的行为，一旦有用户被界定存在违规刷青豆行为，班班平台将有权回收青豆和对相应用户账户进行封号处理，并保留追究法律责任的权利。</li>
            <li>班班青豆的解释权归蜻蜓互动所有。</li> 
        </ul> 
    </div>
</div>
<!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/banban/zepto.min.js"></script>-->
<script>
//    $(function(){
//           var ua = navigator.userAgent.toLowerCase();
//           var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
//           if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
//                  $('.ios').show();
//           }else{
//
//                  $('.android').show();
//           }
//    });
</script>
	</body>
</html>