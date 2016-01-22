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
            <title>班费介绍</title>
            <style>
            .cost-help{
                display:none;
            }
           
            .containter{
                max-width:750px;
                margin:0 auto;
                overflow:hidden; 
            }
            .containter .imgBox{
                position: relative;
                width: 100%; 
                text-align: center; 
            }
            .containter .textBox{
                position: absolute; 
                width: 100%;
                left: 0;
                color: #2c2012; 
            } 
            .textBox .text{ 
                color: #ffffff;
                font-size: 14px;
                line-height: 25px; 
                margin-bottom: 10px;
            }
            .textBox  span{ float: left; }
            .containter .imgBox img{ 
                max-width:100%;
                vertical-align:middle;
                display: inline-block;
            }
            .scroll{
                position: fixed;
                right: 10px;
                bottom: 50px;
                cursor: pointer;
            } 
            @media screen and (max-width: 320px) { /*当屏幕尺寸小于600px时，应用下面的CSS样式*/
                .containter .textBox .text {
                    font-size: 15px;
                    line-height: 20px; 
                }
          }
            </style>
	</head>
	<body class="bg">
        <div class="containter">
            <div class="imgBox" style=" min-height: 100px;">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/expense/c_l_01.jpg"/>
            </div>
            <div class="imgBox" style=" min-height: 70px; z-index: 5;">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/expense/c_l_02.jpg"/>
                <div class="textBox" style=" top:10%; " >
                    <div class="text" style="width: 60%; margin: 0 auto;">
                        <p> 班费是每个班班班级所拥有的公共钱款费用，</p>
                        <p>班费是由班级成员通过平台赚取或捐赠而来。</p>
                        <p>班费可由指定用户进行提现。</p>
                    </div> 
                </div>
            </div>
            
            <div class="imgBox center" style=" min-height: 100px; z-index: 1;">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/expense/c_l_03.jpg"/>
            </div> 
            <div class="imgBox" style=" min-height: 80px; z-index: 5;">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/expense/c_l_04.jpg"/>
                <div class="textBox" style=" top:11%; " >
                    <div class="text" style="width: 65%; margin: 0 auto;">
                        班费卡是班费的一种承载形式，每位班班用户都可以赚取班费卡，并且可以将班费卡捐赠给指定的班级。用户个人班费卡不可转赠其他用户也不可提现。
                    </div> 
                </div>
            </div> 
             <div class="imgBox center" style=" min-height: 100px;">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/expense/c_l_05.jpg"/>
            </div> 
            <div class="imgBox center" style=" min-height: 80px;  z-index: 0;">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/expense/c_l_06.jpg"/>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/expense/c_l_07.jpg"/>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/expense/c_l_08.jpg"/>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/expense/c_l_09.jpg"/>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/expense/c_l_10.jpg"/>
                <div class="textBox" style=" top:0%; " >
                     <div class="text" style=" position: relative; width: 65%; padding-left: 8%; margin: 0 auto; margin-bottom: 5%; text-align: left;">
                        <span style=" position: absolute; left: 3%; top:-1%; color: #64aaff; font-size: 36px;">&bull;</span>
                       通过参与班班手机应用里的“挣班费”活动，可给班级挣班费：对于调查问卷类的广告，每个调查问卷首次填写完成奖励0.5元班费，之后再次查看或填写该调查问卷不再奖励班费。对于浏览类的广告，每天首次点击浏览，随机奖励0.1元或0.2元班费，每天只奖励一次。
                    </div>
                    <div class="text" style=" position: relative; width: 65%; padding-left: 8%; margin: 0 auto; margin-bottom: 5%; text-align: left;">
                        <span style=" position: absolute; left: 3%; top:-1%; color: #64aaff; font-size: 36px;">&bull;</span>  通过注册班班账号，或用第三方（QQ、微信）登录后首次绑定手机号码，即可获得0.5~10元范围内随机金额的班费卡一张。
                    </div>  
                     <div class="text" style=" position: relative; width: 65%; padding-left: 8%; margin: 0 auto; margin-bottom: 5%; text-align: left;">
                        <span style=" position: absolute; left: 3%; top:-1%; color: #64aaff; font-size: 36px;">&bull;</span> 邀请他人成功注册成为班班用户，邀请人将可获得0.5~10元范围内随机金额的班费卡一张。若受邀注册用户同时还通过了教师认证，则邀请人还可再获得一张10元班费卡
                    </div>  
                    <div class="text" style=" position: relative; width: 65%; padding-left: 8%; margin: 0 auto; margin-bottom: 5%; text-align: left;">
                        <span style=" position: absolute; left: 3%; top:-1%; color: #64aaff; font-size: 36px;">&bull;</span> 参与班班平台举行的活动可赚取班费或班费卡，具体赚取方式和金额，以活动公布为准；
                    </div> 
                </div> 
            </div> 
            <div class="imgBox center" style=" min-height: 60px;">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/expense/c_l_11.jpg"/>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/expense/c_l_12.jpg"/>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/expense/c_l_13.jpg"/>
                <?php if($identity->isTeacher): ?>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/expense/c_l_14.jpg"/>
                <?php else: ?>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/expense/c_l_14_r.jpg"/>
                <?php endif; ?>
                <div class="textBox" style=" top:-5%;">
                    <div class="text" style=" position: relative; width: 65%; padding-left: 8%; margin: 0 auto; margin-bottom: 5%; text-align: left;">
                        <span style=" position: absolute; left: 3%; top:-1%; color: #64aaff; font-size: 36px;">&bull;</span>
                        用户所拥有的班费卡可自由捐赠给自己所加入的班级。
                    </div>  
                     <div class="text" style=" position: relative; width: 65%; padding-left: 8%; margin: 0 auto; margin-bottom: 5%; text-align: left;">
                        <span style=" position: absolute; left: 3%; top:-1%; color: #64aaff; font-size: 36px;">&bull;</span> 
                         所在班级的班费可以由通过教师认证的班主任在班班网页端进行转出提现、或发“紧急通知”时使用。班费转出申请提交之后，需要班班审核通过方能转出，审核结果会在3个工作日内以手机短信的方式反馈给您。
                    </div>  
                     <div class="text" style=" position: relative; width: 65%; padding-left: 8%; margin: 0 auto; margin-bottom: 5%; text-align: left;">
                        <span style=" position: absolute; left: 3%; top:-1%; color: #64aaff; font-size: 36px;">&bull;</span> 
                          班班平台每日可转出名额为1000人。
                    </div> 
                    <div class="text" style=" position: relative; width: 65%; padding-left: 8%; margin: 0 auto; margin-bottom: 5%; text-align: left;">
                        <span style=" position: absolute; left: 3%;  top:-1%; color: #64aaff; font-size: 36px;">&bull;</span> 
                        认证老师的个人班费卡可兑换成青豆，在手机客户端的“青豆派兑”页面购买商品。 
                    </div>  
                    <div class="text" style=" position: relative; width: 65%; padding-left: 8%; margin: 0 auto; margin-bottom: 5%; text-align: left;">
                        <span style=" position: absolute; left: 3%; top:-1%; color: #64aaff; font-size: 36px;">&bull;</span> 
                            <?php if($identity->isTeacher): ?> 每个班主任（不区分班级）每月只能转出一次班费，当班费余额大于等于200元才可转出，且转出金额最高为800元。<?php endif; ?>
                     </div> 
                 </div>
            </div> 
            <div class="imgBox center" style=" min-height: 100px;">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/expense/c_l_15.jpg"/>
                <div class="textBox" style=" bottom: 0; font-size: 16px;">
                    <div class="text" style="width: 88%; margin: 0 auto; text-align: left;">
                        <p style="text-align: center; padding-bottom: 3%;">其他说明</p>
                    </div>
                </div>
            </div> 
            <div class="imgBox center" style=" min-height: 100px;">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/expense/c_l_16.jpg"/>
                 <div class="textBox" style=" top:5%; font-size: 16px;">
                    <div class="text" style="width: 88%; margin: 0 auto; text-align: left;"> 
                        <p>秉承公平公正的原则，班班平台将严厉打击刷班费的行为，一旦有用户被界定存在违规刷班费行为，班班平台将有权回收班费和对相应用户账户进行封号处理，并要保留追究法律责任的权利。</p> 
                        <p style=" padding-top: 3%;">班班的班费解释权归蜻蜓互动所有。</p>
                    </div> 
                </div> 
            </div>  
	</body>
</html>