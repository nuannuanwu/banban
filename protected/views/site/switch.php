<style type="text/css"> 
        #swithIdentity_1{ overflow: hidden; }
        #swithIdentity_1 .switchBox{ text-align:center; margin: 0 auto; margin-top: 6%; }
        #swithIdentity_1 .switchBox .title{ text-align: center; font-size: 16px; margin-bottom: 60px;}
        #swithIdentity_1 .switchBox a{color:#000000; display: inline-block;text-align: center; border-radius: 10px; padding: 25px 50px 25px; background-color: #f5f4eb; border: 2px solid #c6c4b3; }
        #swithIdentity_1 .switchBox a:hover{border: 2px solid #f59201;}
        #swithIdentity_1 .switchBox img{ display: inline; }
        #swithIdentity_1 .switchBox a.mr80{ margin-right: 75px; }
        #swithIdentity_1 .switchBox a p{ margin-top: 10px; font-size: 16px;  } 
        
        #swithIdentity_2 .switchBox{ text-align:center; margin: 0 auto; margin-top: 6%; }
        #swithIdentity_2 .switchBox .title{ text-align: center; font-size: 20px; margin-bottom: 35px; color: #f59201;} 
        #swithIdentity_2 .switchBox p{ margin-top: 10px; font-size: 14px;  }
        #swithIdentity_2 .switchBox p span{ color: #993300; margin-left: 5px; }
        #swithIdentity_2 .identityBox img{ display: inline; }
        #swithIdentity_2 .switchBox a.mr80{ margin-right: 25px; } 
        #swithIdentity_2 .identityBox p{ margin-bottom: 30px; font-size: 16px;  }
        #swithIdentity_2 .identityBox{ width: 520px; *width: 402px; background: #FFFFFF; border: 2px  dotted #d2d2d2; margin: 0 auto; margin-top: 40px; border-radius: 15px; padding: 60px 60px 30px 60px; position: relative; }
       .identityBox ul { overflow: hidden; }
       .identityBox ul  li{ float: left; width: 136px; text-align: center; }
       .identityBox ul  li a.btn{ margin-right: 0; }
       .imgBox{ width: 98px; height: 98px;  display: inline-block; margin-bottom: 30px;  }
       .titLable{ position: absolute; width: 146px; height: 38px; text-align: center; line-height: 38px; top:-20px; left:176px; background: #f5f4eb; border: 2px  dotted #d2d2d2; border-radius: 15px; }
</style>
    <div id="mainBox" class="mainBox" style=" background-color: #e5e4da;">
    <div id="contentBox" class="cententBox"> 
        <div class="box" style=" padding: 0;">
            <div style=" background-color: #e5e4da; margin: 0 auto; overflow: hidden;"> 
                <div id="swithIdentity_2" style=" overflow: hidden; zoom: 1;">
                    <div class="switchBox">
                        <div class="title">欢迎您使用班班！</div>
                        <p>班班是以“班级”为单位的家校沟通平台，使用前需要先添加班级。</p>
                        <div class="identityBox" >
                            <div class="titLable">身份选择</div>
                            <ul>
                                <?php $user=Yii::app()->user->getInstance();?>
                                <li style=" margin:0 46px 0 16px;">
                                    <p>我是<span>班主任</span></p>
                                    <div class="imgBox"><img width="98px;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/teacherP_ico.png" /></div>
                                    <?php if($user&&!empty($user->mobilephone)):?>
                                    <a class="btn btn-orange"  href="<?php echo Yii::app()->createUrl('class/create', array('tmpIdentity'=>Constant::TEACHER_IDENTITY)); ?>">创建班级 </a>
                                    <?php elseif($user&&empty($user->mobilephone)):?>
                                        <a class="btn btn-orange"  onclick="showPromptPush('#changeMobilePhone')" href="javascript:;" data-href="<?php echo Yii::app()->createUrl('class/create', array('tmpIdentity'=>Constant::TEACHER_IDENTITY)); ?>">创建班级 </a>
                                    <?php else:?>
                                      &nbsp;
                                    <?php endif;?>
                                </li> 
                                <li style="margin:0 16px 0 46px;"> 
                                    <p>我是<span>任课老师</span></p>
                                    <div  class="imgBox"><img width="98px;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/teacher_ico.png" /></div>
                                    <?php if($user&&!empty($user->mobilephone)):?>
                                    <a class="btn btn-orange" href="<?php echo Yii::app()->createUrl('class/chooseclass', array('tmpIdentity'=>Constant::TEACHER_IDENTITY, 'ty'=>'t')); ?>">加入班级</a>
                                    <?php elseif($user&&empty($user->mobilephone)):?>
                                        <a class="btn btn-orange"  onclick="showPromptPush('#changeMobilePhone')" href="javascript:;" data-href="<?php echo Yii::app()->createUrl('class/chooseclass', array('tmpIdentity'=>Constant::TEACHER_IDENTITY, 'ty'=>'t')); ?>">加入班级 </a>
                                    <?php else:?>
                                        &nbsp;
                                    <?php endif;?>
                                </li>
                            </ul> 
                        </div>
                    </div>
                    
                </div> 
                <div style=" text-align: center; font-size: 15px; margin-top: 30px;">
                    家长请下载<a target="_blank" href="<?php echo Yii::app()->createUrl('site/app');?>" style=" color:#A04721; vertical-align: baseline;">手机应用客户端</a>登录使用
                </div>
            </div> 
        </div>
    </div>
</div>

<div id="changeMobilePhone" class="popupBox" style="width: 400px;">
    <div class="header">提醒<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#changeMobilePhone')" > </a></div>
    <div class="box">
        <div class="remindInfo  setTime" style=" font-size: 14px; padding: 20px;" >
            请先绑定手机号，才能创建或加入班级。
        </div>
        <div style="text-align: center; padding: 20px 0;">
            <a href="javascript:showPromptPush('#bindMobilePhone');hidePormptMaskWeb('#changeMobilePhone');" class="btn btn-orange">绑定手机号</a>
            <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#changeMobilePhone')" class="btn btn-default">取消</a>
        </div>
    </div>
</div>
<div id="bindMobilePhone" class="popupBox" style="width: 590px;">
    <div class="header">绑定手机<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#bindMobilePhone')" > </a></div>
    <div class="remindInfo  setTime" style=" padding: 10px 0;" >  
        <div class="formBox" style=" margin-left: 50px;" > 
            <form id="formBoxbindMobile" action="<?php echo  Yii::app()->createUrl('site/bindmobile');?>" method="post">
                <table id="verifyMobileF" class="tableForm">
                    <tbody>
                        <tr>
                            <td>
                                <span class="inputTitle">手机号：</span>
                                <div class="inputBox">
                                    <input rel="mobile" style="width:228px;" id="bindMobile" class="mediumL" type="text" maxlength="11" placeholder="请输入手机号" name="bindmobile" datatype="phone"   nullmsg="请输入手机号！" errormsg="请输入正确的手机号！" onkeyup="this.value=this.value.replace(/^ +| +$/g,'')" />
                                </div>
                                <span class="Validform_checktip tipN"></span> 
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                <span class="inputTitle">短信验证：</span>
                                 <div class="inputBox">
                                    <input class="mediumL" style="width:160px;" rel="code" id=" " type="text" name="bindcode" placeholder="请输入验证码"  datatype="*"   nullmsg=" 验证码不能为空！" errormsg="" onkeyup="this.value=this.value.replace(/^ +| +$/g,'')"/>
                                    <a rel="bindVerifyCode" tid="0" class="btn btn-default bindVerifyCode" href="javascript:void(0);" style="padding:6px 8px; margin-right: 5px;">发送验证短信</a>
                                </div>
                                <span class="Validform_checktip" ></span>
                                <div id="bindMobileTip" class="Validform_checktip Validform_wrong" style="display: none;margin-left:74px;" ></div>
                                <div style="padding-left: 75px; margin-top: 5px; color: #999999;">验证码30分钟内有效</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="inputTitle">登录密码：</span>
                                <div class="inputBox">
                                    <input style="width:228px;"  class="mediumL" type="text"   placeholder="请输入登录密码" name="bindpassword" datatype="*6-16,pwd"   nullmsg="请输入新密码！" errormsg="密码由6-16位数字、字母或组合！"  onkeyup="this.value=this.value.replace(/^ +| +$/g,'')"/>
                                </div>
                                <span class="Validform_checktip tipN"></span> 
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <span class="inputTitle">确认密码：</span>
                                <div class="inputBox">
                                    <input style="width:228px;" rel="mobile" id=" " class="mediumL" type="text"  placeholder="请再次输入新密码" name="bindconfirmpassword" datatype="*" recheck="bindpassword"   nullmsg="请再次输入新密码！" errormsg="您两次输入的账号密码不一致！"/>
                                </div>
                                <span class="Validform_checktip tipN"></span> 
                            </td>
                        </tr>
                         <tr>
                            <td> 
                                <span class="inputTitle" style="margin-left: 5px;"></span>
                                <input id="bindType" type="hidden" value="0">
                                <input name="switch" type="hidden" value="1">
                                <a rel="saveBindMobilePhone" tid="0" href="javascript:void(0);" class="btn btn-orange">完 &nbsp; 成</a>
                                <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#bindMobilePhone')" class="btn btn-default">取消</a>
                            </td> 
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </form> 
        </div>
    </div>
</div>

<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/> 
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    Validform.int("#formBoxbindMobile");
    
    //发请求获取验证码
    function ajaxPost(url,ty,mobile,code){
        var str ="";
        $.ajax({  
            url:url,   
            type : 'POST',
            data : {ty:ty,mobile:mobile,code:code},
            dataType : 'text',  
            contentType : 'application/x-www-form-urlencoded',  
            async : false,  
            success : function(mydata) {
                str = mydata; 
            },  
            error : function() {  
                // alert("calc failed");  
                str = "系统繁忙,请稍后再试";
            }  
        });
        return str;
    }
     //计时器
    var countdown = 60;
    var off =true;
    function settime(val) { 
        if(!off){
          return;
        }
        if (countdown == 0) {  
            //val.removeAttribute("disabled");
            val.css({background:'#ffffff',color:"#333333"});  
            val.text("重新获取验证码"); 
            countdown = 60; 
            return;
        } else { 
            val.css({background:'#cccccc',color:"#ffffff",cursor: "default",borderColor:'#adadad'}); 
            //val.setAttribute("disabled", true); 
            val.text("（" + countdown + "s）后再次发送"); 
            countdown--; 
        } 
        setTimeout(function() { 
            settime(val);
        },1000); 
    } 
    $('input[rel=mobile],input[rel=code]').live('focus',function(e){ 
        $('#bindMobileTip').hide(); 
    });
    //第三方绑定手机 //发送验证码
    $('[rel=bindVerifyCode]').click(function(){  
        if(parseInt(countdown)==60){
            off =true;
            var sendurl = "<?php echo Yii::app()->createUrl('ajax/sendmobilecode');?>";
            var eg =/^((1)+\d{10})$/;
            var mobile = $('#bindMobile').val();
            if(mobile==""){
                $('#bindMobile').focus().focusout(); 
             }else if(eg.test(mobile)&&mobile.length==11){
                var code = ajaxPost(sendurl,'3',mobile,'');
                if(code=='1'){
                    settime($(this));
                }else if(code=="2"){
                    $('#bindMobileTip').text("发送次数已超上限").show();
                }else if(code=="3"){
                    $('#bindMobileTip').text("手机号已绑定").show();
                }else{
                }

             } 
        } 
   });
   //第三方登录绑定手机  提交，适用于第三方登陆后无手机号
   $('[rel=saveBindMobilePhone]').click(function(){
//       var url="<?php echo Yii::app()->createUrl('site/bindmobile');?>"; 
//       var checkcode=$("input[name=bindcode]").val();
//       var mobile=$("#bindMobile").val();
//       var password=$("input[name=bindpassword]").val();
//       var newpassword=$("input[name=bindconfirmpassword]").val();
//       $.post(url,{bindcode:checkcode,bindmobile:mobile,bindpassword:password,bindconfirmpassword:newpassword,ajax:1},function(data){
//            if(data&&data.status=='1'){
//                window.location.reload();
//            }else{
//                //show显示 data.msg,错误原因 
//
//            }
//       });
//     
        var tV = $('#bindType').val();
        if(tV== '0'){
            $('#formBoxbindMobile').submit();
        }else{
            $('#bindMobileTip').show();
        }
            

   });
</script>
     