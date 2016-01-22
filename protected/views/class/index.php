<link rel="stylesheet" type="text/css" href ="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox">
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班
        </div>
        <div class="box">
            <nav class="navMod" fa="<?php echo $mymasternum;?>" style="position: relative; z-index: 10; zoom: 1;"><!--家长不要显示创建班级按niu-->
                <a rel="addClassBtnPup" href="javascript:;" class="btn btn-default">添加班级</a>
                <?php if(Yii::app()->user->getCurrIdentity()->isMaster):?>
                <a rel="inClassBtnPup" href="<?php echo Yii::app()->createUrl('class/applylist'); ?>" class="btn btn-default join-class-btn">进班申请消息<?php if( true == $newHint ):?><i class="new"></i><?php endif;?></a>
                <?php endif;?>
                <div id="createBtnPup" class="createBtnPup">
                    <ul class="listBox">
                        <li>
                            <?php if($mymasternum>=3):?>
                            <a rel="addClass" href="javascript:;">我是<b class="color">班主任</b>，我要：<b>创建班级</b></a>
                            <?php else:?>
                                <?php if($userinfo&&!empty($userinfo->mobilephone)):?>
                                    <a href="<?php echo Yii::app()->createUrl('class/create'); ?>">我是<b class="color">班主任</b>，我要：<b>创建班级</b></a>
                                 <?php elseif($userinfo&&empty($userinfo->mobilephone)):?>
                                    <a onclick="showPromptPush('#changeMobilePhone')" href="javascript:;" data-href="<?php echo Yii::app()->createUrl('class/create', array('tmpIdentity'=>Constant::TEACHER_IDENTITY)); ?>">我是<b class="color">班主任</b>，我要：<b>创建班级</b></a>
                                  <?php else:?>

                                   <?php endif;?>
                            <?php endif;?>
                        </li>
                        <li>
                            <?php if($userinfo&&!empty($userinfo->mobilephone)):?>
                                <a href="<?php echo Yii::app()->createUrl('class/chooseclass', array('ty'=>'t')); ?>">
                                     我是<b class="color">任课老师</b>，我要：<b>加入班级</b>
                                </a>
                            <?php elseif($userinfo&&empty($userinfo->mobilephone)):?>
                               <a onclick="showPromptPush('#changeMobilePhone')" href="javascript:;" data-href="<?php echo Yii::app()->createUrl('class/chooseclass', array('ty'=>'t')); ?>">我是<b class="color">任课老师</b>，我要：<b>加入班级</b></a>
                            <?php else:?>

                            <?php endif?>
                        </li>
                      
                    </ul>
                </div>
            </nav>
            <div class="classBox">
                <div class="schoolItme">
                    <?php if(isset($classTeacherList) && count($classTeacherList)): ?>
                    <h1 class="school-item-head">我<span class="stress">教学</span>的班级</h1>
                    <ul class="classListBox">
                        <?php foreach($classTeacherList['classes'] as $val):?>
                        <li>
                             <a href="<?php echo Yii::app()->createUrl('class/students').'/'.BaseUrl::encode($val['cid'])."?ac=".BaseUrl::encode($val['ismaster']==1?1:2);?>" class="" sid="" cid=" ">

                                <?php if(isset($val['childname'])&&$val['childname']):?>
<!--                                    <div class="isMyChild">
                                        您的孩子<?php echo $val['childname'];?>，在该班级
                                    </div>-->
                                <?php endif;?>

                                    <div class="class-name class-teacher">
                                    <?php if($val['master']== 1): ?>
                                        <span  class=" class-icon class-icon-logo"></span>
                                    <?php endif;?> 
                                        <?php if(isset($val['childname'])&&$val['childname']):?>
                                            <h3 class="name" title="<?php echo $val['name'];?>"><?php echo $val['name'];?></h3>
                                        <?php else:?>
                                            <h3 class="name " title="<?php echo $val['name'];?>"><?php echo $val['name'];?></h3>
                                        <?php endif;?>
                                        <p title="<?php echo $val['sname'];?>"><?php echo $val['sname'];?></p>
                                    </div>
                                    <div class="classInfo">
                                        <span title="" class="class-icon-tag"></span>
                                        <p class="infos"><span class="tit">代码：</span><span class="code"><b><?php echo $val['classCode'];?></b></span></p>
                                        <p class="infos ipic_1">老师：<?php echo $val['teachers_num'];?>人</p>
                                        <p class="infos ipic_2">学生：<?php echo $val['total'];?>人</p>
                                    </div>
                               </a>
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <?php endif;?>
                    
                    
                   <?php if( !isset($classTeacherList) && !count($classTeacherList) ): ?>
                               <?php if ($identity->isTeacher):?>
                               <p style="margin-top: 15px;">
                                    快来添加自己的班级哦！
                               </p>
                               <?php else:?>
                           <!--
                                <p style="margin-top: 15px;">
                                    您还没有被邀请加入任何班级！
                                </p>
                                -->
                              <?php endif;?>
                  <?php endif;?>
                </div>
            </div>
        </div>
    </div>
 </div>
<div id="isLeavePopupBox" class="popupBox" style="width: 428px; min-height: 300px;">
    <div class="header">创建失败<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#isLeavePopupBox')" > </a></div>
    <div class="remindInfo  setTime" style="line-height: 22px;" >
        您已经是三个班级的班主任。请将已有班级的班主任身份更换给其它老师，再创建新班级。
        <div style="color: #999999; margin-top: 15px; ">
            <p>规则：</p>
            1.老师创建班级后默认成为该班级班主任，创建后可更换班主任身
            份给其它老师。<br/>
            2.一个老师最多只能同时担任三个班级的班主任。
        </div>
    </div>
    <div class="popupBtn" style="text-align: center;">
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#isLeavePopupBox')" class="btn btn-orange">　确　定　</a>
    </div>
</div>
<?php if(isset($ac) && !empty($ac)):?>
    <div id="isLeavePopupBox2" class="popupBox" style="width: 428px; min-height: 300px;">
    <div class="header">创建失败<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#isLeavePopupBox2')" > </a></div>
    <div class="remindInfo  setTime" style="line-height: 22px;" >
        您已经是三个班级的班主任。请将已有班级的班主任身份更换给其它老师，再创建新班级。
        <div style="color: #999999; margin-top: 15px; ">
            <p>规则：</p>
            1.老师创建班级后默认成为该班级班主任，创建后可更换班主任身
            份给其它老师。<br/>
            2.一个老师最多只能同时担任三个班级的班主任。
        </div>
    </div>
    <div class="popupBtn" style="text-align: center;">
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#isLeavePopupBox2')" class="btn btn-orange">　确　定　</a>
    </div>
</div>
<?php endif;?>
<div id="changeIdentityPopupBox" class="popupBox" style="width: 408px; min-height: 260px;">
    <div class="header">更换用户身份<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#changeIdentityPopupBox')" > </a></div>
    <div class="remindInfo  setTime" style="line-height: 22px; height: 120px; margin-top: 25px;" >
        您现在使用的是班班家长端，创建班级需要更换至班班老师端。是否继续创建班级
    </div>
    <div class="popupBtn" style="text-align: center;">
        <a class="btn btn-orange" href="<?php echo Yii::app()->createUrl('site/changeLogin', array('ty'=>'create'));?>" >继续创建</a>
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#changeIdentityPopupBox')" class="btn btn-default">　取 消　</a>
    </div>
</div>
<div id="changeIdentity2PopupBox" class="popupBox" style="width: 408px; min-height: 260px;">
    <div class="header">更换用户身份<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#changeIdentity2PopupBox')" > </a></div>
    <div class="remindInfo  setTime" style="line-height: 22px; height: 120px; margin-top: 25px;" >
        您现在使用的是班班家长端，任课老师添加班级需要更换至班班老师端。是否继续加入班级
    </div>
    <div class="popupBtn" style="text-align: center;">
        <a class="btn btn-orange" href="<?php echo Yii::app()->createUrl('site/changeLogin', array('ty'=>'tadd'));?>" >继续加入</a>
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#changeIdentity2PopupBox')" class="btn btn-default">　取 消　</a>
    </div>
</div>
<div id="changeIdentity3PopupBox" class="popupBox" style="width: 408px; min-height: 260px;">
    <div class="header">更换用户身份<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#changeIdentity3PopupBox')" > </a></div>
    <div class="remindInfo  setTime" style="line-height: 22px; height: 120px; margin-top: 25px;" >
        您现在使用的是班班老师端，家长添加班级需要更换至班班家长端。是否继续加入班级
    </div>
    <div class="popupBtn" style="text-align: center;">
        <a class="btn btn-orange" href="<?php echo Yii::app()->createUrl('site/changeLogin', array('ty'=>'gadd'));?>" >继续加入</a>
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#changeIdentity3PopupBox')" class="btn btn-default">　取 消　</a>
    </div>
</div>

<!--创建班级时，验证是否已绑定手机-->

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
                                <input name="switch" type="hidden" value="2">
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

<!--创建班级时，验证是否已绑定手机结束-->

<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<?php if(isset($ac) && !empty($ac)):?>
<script type="text/javascript">
showPromptPush('#isLeavePopupBox2');
</script>
<?php endif;?>
<script type="text/javascript">
    $(function(){
        //
        $('[rel=addClass]').click(function(){
            showPromptPush('#isLeavePopupBox');
        });
        //
        $('[rel=addClassBtnPup]').click(function(){
            $('.createBtnPup').show();
        });
        clickTarget('[rel=addClassBtnPup]',"#createBtnPup");

       //更换身份提醒
        $('[rel=changeUserByCreate]').click(function(){
            showPromptPush('#changeIdentityPopupBox');
        });
        //更换身份提醒
        $('[rel=changeUserByTAdd]').click(function(){
            showPromptPush('#changeIdentity2PopupBox');
        });
        //更换身份提醒
        $('[rel=changeUserByGAdd]').click(function(){
            showPromptPush('#changeIdentity3PopupBox');
        });
    });
</script>

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
        //var url="<?php echo Yii::app()->createUrl('site/bindmobile');?>";
        /// alert(url);
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
        var tV =$('#bindType').val();
        if(tV== '0'){
            $('#formBoxbindMobile').submit();
        }else{
            $('#bindMobileTip').show();
        }

    });
</script>