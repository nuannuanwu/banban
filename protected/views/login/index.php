<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html style="height: 100%;margin: 0; padding: 0; border: 0;overflow-x: auto;">
<head> 
	<meta charset="UTF-8">
    <?php if('product'==BANBAN_ENVIRONMENT):?>
    <meta property="qc:admins" content="155124117662162166157" /><!-- QQ登录验证 -->
    <?php else: ?>
    <meta property="qc:admins" content="15512415605340061401170166375" /><!-- QQ登录验证 -->
    <?php endif; ?>
	<meta name="renderer" content="webkit|ie-comp">
    <title>班班 - 国内首款基于"班级"为单位，30万老师的家校沟通专属社交应用。班班客服：400 101 3838</title>
    <meta name="keywords" content="班班,班班网,班务管理,作业通知,蜻蜓校信,校信,校信通,校讯通,家校互动,家校沟通,免费校讯通,班费,教育,家校,平台,沟通,社交,班费,青豆,老师,家长">
    <meta name="description" content="班班是国内首款基于'班级'为单位，面向老师与家长之间，家长与家长之间的教育专属社交应用。班班是30万老师的家校沟通首选专属工具，比Q群、微信更实用。班班为老师家长提供一种全新的、专属的沟通和社交方式，为班级提供全新的管理增值服务方式。">
    <link rel="shortcut icon" type="image/ico" href="<?php echo Yii::app()->request->baseUrl; ?>/image/favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/login.css'); ?>">
    <script src="<?php echo MainHelper::AutoVersion('/js/banban/jquery-1.7.2.min.js'); ?>" type="text/javascript"></script> 
    
</head>
<body style="position: relative; zoom: 1;min-width:1000px;margin:0 auto;">
    <?php include('theader.php'); ?>  
    <div class="mainBox">
        <div class="banner loginBg">
            <!-- 登录前 -->
            <?php if(!$userid):?>
            <div class="loginBox" style="">
                <div class="login">
                    <div class="login-type" id="loginType">
                        <div class="login-btns">
                             <a href="javascript:;" p="o" t="c" class="click active border-right">班班登录</a>
                             <a class="line">|</a>
                             <a href="javascript:;" id="thirdBtn" p="c" t="o" class="click border-left">机构登录</a>
                        </div> 
                        <!-- 班班登录 -->
                        <div class="login-c">
                            <?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'formBoxRegister',
                                // Please note: When you enable ajax validation, make sure the corresponding
                                // controller action is handling ajax validation correctly.
                                // There is a call to performAjaxValidation() commented in generated controller code.
                                // See class documentation of CActiveForm for details on this.
                                'enableAjaxValidation'=>false,
                            )); ?>
                            <div class="loginBar ">
                                <div class="input userName">
                                    <span class="valueSpan">手机号</span>
                                    <input id="username" name="ULoginForm[username]" value="" type="text" maxlength="30" id="ContentPlaceHolder1_txtTelephone" class="textInput" size="11" autocomplete="off" value="<?php echo $model->username; ?>">
                                </div>
                                <div class="input password">
                                    <span class="valueSpan">密码</span>
                                    <input id="password" name="ULoginForm[password]" value=""  type="password" maxlength="16" id="ContentPlaceHolder1_txtPwd" class="textInput" autocomplete="off">
                                </div>
                                <div class="rememberme">
                                    <a href="<?php echo Yii::app()->createUrl('site/getpwd');?>" class="right green">忘记密码？</a>
                                    <input id="rememberme" type="checkbox" style=" display: none;" name="rememberme" >
                                    <label id="remembermeInfo" class="remembermeInfo" tip="0"><em class="unCheked"></em>下次自动登录</label>
                                    <input id="remembermeHidden" type="hidden" name="ULoginForm[rememberMe]" value="0">
                                </div>
                                <div class="clearfix errorSpan" style="">
                                    <span class="errorSpan" style="color: #EE0000;">
                                        <?php echo $form->error($model,'role',array('class'=>'error_info')); ?> 
                                        <?php echo $form->error($model,'username',array('class'=>'error_info')); ?>  
                                        <?php echo $form->error($model,'password',array('class'=>'error_info')); ?>  
                                    </span>
                                    <span class="errorSpan errorSpanTip"  style="color: #EE0000;"></span>
                                </div> 
                                <div class="botton">
                                    <a  href="javascript:;" id="lbtnLogin" class="btn loginBtn" alt="老师登录" title="家长请下载手机应用客户端登录使用">
                                        登 录
                                    </a>
                                    <a title="老师注册有大礼包赠送哦" href="<?php echo Yii::app()->createUrl('openregister/index')?>" class="btn blueBtn"style="background-color: #f9d9b0; color: #ffffff;" alt="班班注册">
                                        注  册
                                    </a>
                                </div>
                            </div>
                            <?php $this->endWidget(); ?>
                            <div class="qq-weixin-wrapper" style=" text-align: center;">
                                <div class="wtitle">其他账号登录</div>
                                <a class="qq" href="<?php echo Yii::app()->createUrl('connect/qq')?>">  
                                </a>
                                <a class="weixin" href="<?php echo $wxLoginUrl; ?>"> 
                                    
                                </a>
                            </div>
                        </div>
                        <!-- 班班登录 end -->

                        <!-- 第三方登录 --> 
                        <div class="login-o" style="display:none;"> 
                           <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'formBoxThird', 
                            // Please note: When you enable ajax validation, make sure the corresponding
                            // controller action is handling ajax validation correctly.
                            // There is a call to performAjaxValidation() commented in generated controller code.
                            // See class documentation of CActiveForm for details on this.
                            'enableAjaxValidation'=>false,
                            )); ?> 
                                <div class="other-login-type">
                                <?php foreach($loginSets as $v ):?>
                                    <a id="area_<?php echo isset($v['areaid'])?$v['areaid']:'';?>" href="javascript:;" data-url="<?php echo isset($v['loginurl'])?$v['loginurl']:'';?>" data-id="<?php echo isset($v['areaid'])?$v['areaid']:'';?>">
                                    <img src="<?php echo isset($v['logo'])?$v['logo']:''; ?>" alt="返回" />
                                    </a>
                                <?php endforeach;?>
                                </div>
                                <div class="other-login-c">
                                    <div class="navMod">
                                        <a href="javascript:;" class="btns return-btn" style=" margin-bottom: 0;" >
                                            <img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">
                                        </a>
                                        <img id="type-logo" class="typeLogo" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/loginType1.jpg" style=" width:120px; margin-left: 50px; vertical-align: middle;"/>
 
                                    </div>
                                    <div class="loginBar ">
                                        <div class="input userName">
                                            <span class="valueSpan" style=" display: block;">用户名</span>
                                            <input id="thirdUserN" name="unionAccount" type="text" maxlength="30" class="textInput"  autocomplete="off" value="<?php echo $model->username; ?>" />
                                            <input type="hidden" name="areaId" id="unionLoginId"/>
                                        </div>
                                        <div class="input password" style="margin-bottom:0;">
                                            <span class="valueSpan"> 密码</span>
                                            <input id="thirdPassword" name="unionPwds" type="password" maxlength="16" class="textInput" autocomplete="off" />
                                        </div>
                                        <div class="thirdErrorSpan thirdErrorSpanTip" style="">&nbsp;<?php echo $unionLoginError;?></div>
                                        <div class="botton" style=" padding-top: 35px;"> 
                                            <a href="javascript:;" id="thirdLoginBtn" class="btn loginBtn" title="第三方登录">
                                                登 录
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="loading" id="loading"></div>
                            <?php $this->endWidget(); ?> 
                        </div>
                        <!-- 第三方登录 end -->
                    </div> 
                     <!-- form -->
                </div>  
            </div>
            <?php else:?>
            <!-- /登录前 -->

            <!-- 登录后 -->
            <div class="userBox">
                <div class="centerBox">
                    <div class="title"> 网页版作业通知后台</div>
                    <div class="picBox">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/logo/logo200.png" />
                    </div>
                    <a href="<?php echo $noticeurl;?>" class="btns btns-orange" style=" display:block; margin-right: 0; background-color: #fbb65b;">立即进入</a>
                </div>
            </div>
            <?php endif;?>
            <!-- /登录后 -->
        </div>
        <!-- 下载方式 -->
        <div class="downloadBox" style=" width:100%; padding:120px 0;">
            <div class="downloadListBox">
                <div class="title">立即下载</div>
                <ul class="downloadList clearfix" style=" " >
                    <li style=" width: 33.3%;">
                        <div class="android">&nbsp;</div>
                        <a href="<?php echo WEB_ANDROID_MOLO_DOWNLOAD_URL;?>" target="_blank" title="班班安卓下载">Android版下载</a> 
                    </li> 
                    <li style=" width: 33.3%;">
                        <div class="ios">&nbsp;</div>
                        <a href="<?php echo WEB_IOS_DOWNLOAD_URL;?>" target="_blank" title="班班ios下载">iPhone版下载</a>  
                    </li>
                    <li style=" width: 33.3%;">
                        <div class="erweima">&nbsp;</div>  
                        <a href="javascript:;" >扫描二维码下载</a> 
                    </li> 
                </ul>
               
                <div class="msgDown">
                    <span class="label">短信下载</span>  
                    <div style=" position:relative; width:380px; margin-left: 120px; "> 
                        <form style="width: 100%; margin-top: 2px; "> 
                            <div class="input sendPhoneCode" style=" position: relative; background:#ffffff url('/image/banban/login/imgs/slipt.png') no-repeat -62px -10px;  width: 284px; height: 50px;">
                                <span class="valueSpan" style="display: block;  position: absolute;  left: 10px;  top: 0; font-size: 18px; height: 50px;  line-height: 50px; z-index: 5; color: rgb(153, 153, 153); border: none;">请输入手机号</span>
                                <input id="sendPhoneCode" class="textInput" url="<?php echo Yii::app()->createUrl('ajax/sendsmsbydownload');?>"  type="text" maxlength="11" style="display: block; position: absolute; top:0; left:10px; height: 48px; font-size: 18px; color: rgb(90, 90, 90); border: none;" onkeyup="this.value=this.value.replace(/\D/g,'')"  onafterpaste="this.value=this.value.replace(/\D/g,'')" value=""/>
                             </div> 
                             <a href="javascript:;" id="sendPhoneBtn" class="btns btns-orange" style=" position: absolute; right:0; top:1px;  text-decoration: none; margin-right: 5px;  padding: 10px 15px;">发送</a>
                        </form>
                    </div>
                    <div id="senPhoneTip" class="colorS" style="font-size:13px; text-align: left; color: #EE0000;"></div>
                </div> 
            </div>
        </div>
        <!-- /下载方式 -->

        <!-- 介绍图 -->
        <div class="exhibition"> 
            <div class="example c_1">
                <div class="imgBox ">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/imgs/1.jpg" alt="">
                </div>
            </div>
            <div class="example c_2">
                <div class="imgBox ">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/imgs/2.jpg" alt="">
                </div>
            </div>
            <div class="example c_3">
                <div class="imgBox ">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/imgs/3.jpg" alt="">
                </div>
            </div>
            <div class="example c_4">
                <div class="imgBox">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/imgs/4.jpg" alt="">
                </div>
            </div>
             
        </div>
        <!-- /介绍图 -->
   </div> 
   <input id="thirdInput" type="hidden" value="<?php echo (int)Yii::app()->request->getParam('areaId')?>" />
    <!-- footer -->
    <?php include('tfooter.php'); ?>  
    <!-- /footer --> 
</body>
</html> 
