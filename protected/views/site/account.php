<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/site.css'); ?>">
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon9"></span>设置
        </div>
        <div class="box">
<!--            <div class="titleBox">
                <ul class="titleTable"> 
                    <li><a href="<?php echo Yii::app()->createUrl('site/account');?>" class="focus">基本信息</a></li>
                    <?php if($user&&$user->mobilephone):?>
                    <li><a href="<?php echo Yii::app()->createUrl('site/password');?>">修改密码</a></li>
                    <?php endif;?>
                    <li><a href="<?php echo Yii::app()->createUrl('site/invitelist');?>">邀请人</a></li>
                </ul>
            </div>-->
            <div class="formBox">
                <div class="box"> 
                        <table class="tableForm">
                            <tbody>
                                <tr>
                                <td>
                                    <span class="inputTitle">头像：</span>
                                    <div class="inputBox">
                                        <div class="i-box" style=" display: inline-block; width: 70px; height: 70px;">
                                            <img class="pic" src="<?php echo $icon;?>" onerror="javascript:this.src='<?php echo Yii::app()->request->baseUrl . '/image/banban/mobile/ico_user.png';?>'" />
                                            <?php $userinfo=Yii::app()->user->getInstance();?> 
                                            <?php if($userinfo&&$userinfo->teacherauth==2):?>
                                            <img class="v-ico" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/v.png" title="认证老师" />
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="inputTitle">班班号：</span>
                                    <div class="inputBox">
                                        <?php echo $banban?$banban:'未设置';?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="inputTitle">姓名：</span>
                                    <div class="inputBox">
                                        <?php echo $user->name; ?>
                                        <a class="s-ioc ioc-1" href="javascript:;" onclick="showPromptPush('#siteNameBox')"></a> 
                                    </div>
                                    <span class="Validform_checktip"></span>
                                </td>
                            </tr>
                            <tr> 
                                <td><span class="inputTitle" style=" *float: left; *margin-top: 8px;">性别：</span>
                                    <div class="inputBox radioBox" >
                                        <?php $arr=array('1'=>'男','2'=>'女','0'=>'保密');echo isset($arr[$user->sex])? $arr[$user->sex]: '未设置';?>
                                        <a class="s-ioc ioc-1" href="javascript:;" onclick="showPromptPush('#siteSexBox')" ></a>
                                    </div>
                                </td>
                            </tr>
                            <tr> 
                                <td><span class="inputTitle" style=" *float: left; *margin-top: 8px;">城市：</span>
                                    <div class="inputBox radioBox" >
                                        <?php echo $cityname;?> <a class="s-ioc ioc-1" href="javascript:;" onclick="showPromptPush('#siteCityBox')"></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="inputTitle">手机号：</span>
                                    <div class="inputBox">
                                        <?php echo $user->mobilephone?$user->mobilephone:'未绑定';?>&nbsp;&nbsp;&nbsp;
                                        <?php if($user&&$user->mobilephone):?>
                                        <a rel="changeMobilePhone" onclick="showPromptPush('#changeMobilePhone');" href="javascript:;" class="s-ioc ioc-1" title="更换手机"></a>
                                        <?php else:?>
                                        <a rel="changeMobilePhone" onclick="showPromptPush('#bindMobilePhone');" href="javascript:;" class="s-ioc ioc-1" title="绑定手机"></a>
                                        <?php endif;?>
                                        <a rel="pupSetpassword" onclick="showPromptPush('#pupSetpassword');" href="javascript:;" class="s-ioc ioc-2" title="修改密码"></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="inputTitle">QQ账号：</span>
                                    <div class="inputBox">
                                        <?php echo $qq?$qq->threeusername:'未绑定';?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="inputTitle">微信账号：</span>
                                    <div class="inputBox">
                                        <?php echo $weixin?$weixin->threeusername:'未绑定';?>
                                    </div>
                                </td>
                            </tr>
                             <tr>
                                <td> 
                                    <span class="inputTitle" style="margin-left: 0;"></span>
                                    <!--<input type="submit" class="btn btn-raed"  value="确认修改">-->
                                   <!--<input type="submit" class="btn btn-orange" value=" 保 存 " >-->
                                </td> 
                            </tr>
                          
                            </tbody>
                        </table>  
                </div>
            </div>
        </div> 
    </div>
</div>

<div id="changeMobilePhone" class="popupBox" style="width: 600px;">
    <div class="header">更换手机绑定<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#changeMobilePhone')" > </a></div>
    <div class="remindInfo  setTime" style=" padding: 10px;" >  
        <div class="formBox" >
            <div class="box" style="padding: 15px 25px;">
                <form id="formBoxRegisterPopup" action="" method="post">
                    <table id="verifyMobileF" class="tableForm">
                        <tbody>
                        <tr>
                            <td>
                                <span class="inputTitle">原手机号：</span>
                                <div class="inputBox">
                                    <span > </span>
                                    <!-- <input id="passwordF" rel="mobile" class="mediumL" type="text" value="" name="password" datatype="*s6-18" nullmsg="请输入当前手机号！" maxlength="11" errormsg="请输入正确的手机号！" placeholder="请输入当前手机号"/> -->
                                    <input type="text"  readonly="true" style="border:none;" id="passwordF" value="<?php echo $user->mobilephone;?>" placeholder="请输入原手机号">
                                    <!--<a href="javascript:;" style="cursor:default;"class="messageLink" title="请打客服电话：400 101 3838">号码丢失</a>-->
                                </div>
                              
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="inputTitle">新手机：</span>
                                <div class="inputBox">
                                    <input style="width:228px;" rel="mobile" id="AccountF" class="mediumL" type="text" maxlength="11" placeholder="请输入新手机号" name="Account[mobile]" datatype="*" recheck="userpassword" nullmsg="请输入新手机号！" errormsg="请输入正确的手机号！"/>
                                </div>
                                <span class="Validform_checktip tipN"></span>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <span class="inputTitle">短信验证：</span>
                                <div class="inputBox">
                                    <input class="mediumL" style="width:230px;" rel="code" id="verifyCode" type="text" name="userpassword" placeholder="请输入验证码"    nullmsg=" 验证码不能为空！" errormsg=""/>
                                    <a rel="postVerifyCode" tid="0" mph="<?php echo $user->mobilephone;?>" class="btn btn-default" href="javascript:void(0);" style="padding:6px 8px;">发送验证短信</a>
                                </div>
                                <span class="tipB Validform_checktip" style="margin-left:74px;display:none;"></span>
                                <div style="padding-left: 74px; margin-top: 5px; color: #999999;">验证码30分钟内有效</div>
                                <span id="verifyCodeTipN" style="display: none;margin-left:74px;" class="Validform_checktip Validform_wrong" >验证码不正确！</span>
                                
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                <span class="inputTitle" style="margin-left: 5px;"></span>
                                <input id="userVerifyCodeN" type="hidden" value="">
                                <a rel="revampOK" tid="0" href="javascript:void(0);" class="btn btn-orange">完 &nbsp; 成</a>
                                <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#changeMobilePhone')" class="btn btn-default">取消</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
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
                                    <input class="mediumL" style="width:180px;" rel="code" id=" " type="text" name="bindcode" placeholder="请输入验证码"  datatype="*"   nullmsg=" 验证码不能为空！" errormsg="" onkeyup="this.value=this.value.replace(/^ +| +$/g,'')"/>
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
<div id="siteNameBox" class="popupBox" style="width: 450px;">
    <div class="header">修改姓名<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#siteNameBox')" > </a></div>
    <div class="remindInfo  setTime" style=" padding: 10px 0;" >  
        <div class="formBox" style=" margin-left: 50px;">
            <form id="form1" action="" method="post">
                <table class="tableForm">
                    <tr>
                        <td>
                            <span class="inputTitle" style=" float: left; width: 40px; margin-top: 6px;">姓名：</span>
                            <div style=" margin-left:45px;">
                                 <div class="inputBox" > 
                                    <input name="Account[name]" value="<?php echo $user->name; ?>" class="mediumL" type="text" maxlength="15" datatype="*1-10" nullmsg="请输入您的姓名！" data-limit="20"  data-wrong="姓名" errormsg="姓名不能大于10个字！"/>
                                </div>
                                <span id="areaTip" style=" display: block;" class="Validform_checktip"></span>
                                <input type="hidden" name="Account[type]" value="2"/> 
                             </div>
                        </td>
                    </tr>
                    <tr><td></td></tr>
                    <tr>
                        <td> 
                            <span class="inputTitle" style="margin-left: 0; width: 40px;"></span> 
                            <input type="submit" class="btn btn-orange" value="保 存" />
                            <!--<a id="" onclick="document.forms['form1'].submit();" href="javascript:void(0);" class="btn btn-orange">保 存</a>-->
                            <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#siteNameBox')"  class="btn btn-default">取 消</a>
                        </td> 
                    </tr>
                    <tr><td></td></tr>
                </table>
            </form>
        </div>
    </div>
</div>
<div id="siteCityBox" class="popupBox" style="width: 450px;">
    <div class="header">设置城市<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#siteCityBox')" > </a></div>
    <div class="remindInfo  setTime" style=" padding: 10px 0;" >  
        <div class="formBox" style=" margin-left: 50px;">
            <form id="form2" action="" method="post">
                <table class="tableForm">
                    <tr>
                        <td>
                            <span class="inputTitle" style=" float: left; width: 40px; margin-top: 6px;">城市：</span>
                            <div style=" margin-left:45px;">
                                <div class="inputBox">
                                    <select id="selectProvinces" name="Account[pid]" url="<?php echo Yii::app()->createUrl('ajax/getcity');?>" class="sx" next="selectCity" >
                                        <option value="0">请选择</option>
                                        <?php foreach($province_list as $province):?>
                                        <option <?php if ( $province['aid'] == $provinceId) echo 'selected'; ?> value="<?php echo $province['aid'];?>"><?php echo $province['name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                   
                                    <select id="selectCity" name="Account[aid]"  <?php if(empty($city_list)):?> style="display: none;" <?php endif;?>  url="<?php echo Yii::app()->createUrl('ajax/getcity');?>" class="sx" next="selectAreas">
                                        <option value="0">请选择</option>
                                        <?php foreach($city_list as $city_item):?>
                                        <option <?php if ( $city_item['aid'] == $user->addressId) echo 'selected'; ?> value="<?php echo $city_item['aid'];?>"><?php echo $city_item['name'];?></option>
                                        <?php endforeach;?>
                                    </select> 
                                </div>
                                <span id="areaTip" class="Validform_checktip">&nbsp;</span>
                                <input type="hidden" name="Account[type]" value="8"/> 
                             </div>
                        </td>
                    </tr>
                    <tr><td></td></tr>
                    <tr>
                        <td> 
                            <span class="inputTitle" style="margin-left: 0;"></span> 
                            <input type="submit" class="btn btn-orange" value="保 存" />
                            <!--<a id=""  onclick="document.forms['form2'].submit();" href="javascript:void(0);" class="btn btn-orange">保 存</a>-->
                            <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#siteCityBox')"  class="btn btn-default">取 消</a>
                        </td> 
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<div id="siteSexBox" class="popupBox" style="width: 450px;">
    <div class="header">设置性别<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#siteSexBox')" > </a></div>
    <div class="remindInfo  setTime" style=" padding: 10px 0;" >  
        <div class="formBox" style=" margin-left: 50px;">
            <form id="form3" action="" method="post">
                <table class="tableForm">
                    <tr>
                        <td>
                            <span class="inputTitle" style=" float: left; width: 40px; margin-top: 2px;">性别：</span>
                            <div style=" margin-left:45px;">
                                 <div class="inputBox radioBox" > 
                                        <input id="radioSex1" type="radio" value="1" <?php echo $user->sex == 1 ? 'checked' : '';?> name="Account[sex]"><label for="radioSex1">男</label>
                                        <input id="radioSex2" type="radio" name="Account[sex]" value="2" <?php echo $user->sex == 2 ? 'checked' : '';?>><label for="radioSex2">女</label> 
                                        <input id="radioSex0" type="radio" name="Account[sex]" value="0" <?php echo $user->sex == 0 ? 'checked' : '';?>><label for="radioSex0">保密</label>
                                </div>
                                <span id="areaTip" class="Validform_checktip"></span>
                                <input type="hidden" name="Account[type]" value="4"/>
                             </div>
                        </td>
                    </tr>
                    <tr><td></td></tr>
                    <tr>
                        <td> 
                            <span class="inputTitle" style="margin-left: 0;"></span> 
                            <input type="submit" class="btn btn-orange" value="保 存" />
                            <!--<a id="" onclick="document.forms['form3'].submit();" href="javascript:void(0);" class="btn btn-orange">保 存</a>-->
                            <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#siteSexBox')"  class="btn btn-default">取 消</a>
                        </td> 
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<div id="pupSetpassword" class="popupBox" style="width: 450px;">
    <div class="header">修改密码<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#pupSetpassword')" > </a></div>
    <div class="remindInfo  setTime" style=" padding: 10px 0;" >  
        <div class="formBox" style=" margin-left: 50px;">
            <form id="formSetpassword" action="<?php echo Yii::app()->createUrl('site/password');?>" method="post">
                <table class="tableForm">
                    <tbody> 
                        <tr>
                            <td style=" height: 66px; padding: 3px 0;">
                                <span class="inputTitle">原始密码：</span>
                                <div class="inputBox">
                                    <input id="oldPwd" class="mediumL" type="password" name="UChangePasswordForm[currentPassword]" placeholder="请输入当前密码" datatype="*" nullmsg="请输入当前密码！" errormsg="请输入当前密码">
                                </div>
                                <span class="ValidformTip Validform_checktip" style="display: inline-block; margin-left: 70px; vertical-align:-5px ">&nbsp;</span>
                                <span class="errorTip errorTipOldPwd" style=" display: none;  margin-left: 70px;" ></span>  
                                <span  class="infoTip" style=" margin-left: 70px;"> </span>
                            </td>
                        </tr>
                        <tr>
                            <td style=" height: 66px; padding: 3px 0;">
                                <span class="inputTitle">&nbsp;新 密 码：</span>
                                <div class="inputBox"><input id="Pwd" maxlength="16" class="mediumL" type="password" name="UChangePasswordForm[newPassword]" placeholder="6-16位数字、字母或两者组合" datatype="*6-16,pwd"   nullmsg="请输入新密码！" errormsg="密码由6-16位数字、字母或两者组合！"  onkeyup="this.value=this.value.replace(/^ +| +$/g,'')"></div>
                                <span class="ValidformTip Validform_checktip" style="display: inline-block;  margin-left: 70px;">&nbsp;</span>
                                <span class="errorTip errorTipPwd" style=" display: none; margin-left: 70px;"></span>  
                            </td>
                        </tr>
                        <tr>
                            <td style=" height: 66px; padding: 3px 0;">
                                <span class="inputTitle">确认密码：</span>
                                <div class="inputBox"><input id="newPwd" maxlength="20" class="mediumL" type="password" name="UChangePasswordForm[newPassword_repeat]" datatype="*" recheck="UChangePasswordForm[newPassword]"  placeholder="请再次输入新密码" nullmsg="请再次输入新密码！" errormsg="您两次输入的账号密码不一致！"></div>
                                <span class="ValidformTip Validform_checktip" style="display: inline-block;  margin-left: 70px;">&nbsp;</span>
                                <span class="errorTip errorTipNewPwd" style=" display: none; margin-left: 70px;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td style=" height: 66px; padding: 3px 0;"> 
                                <span class="inputTitle" style="margin-left: 0;"></span>
                                <!--<input type="submit" class="btn btn-raed"  value="确认修改">-->
                                <a id="btnEditPwd" href="javascript:void(0);" class="btn btn-orange">保 存</a>
                                <a href="javascript:void(0);" rel="resetBtn" class="btn btn-default">取 消</a>
                                <input type="reset" id="resetInput" value="" name="resetInput" style="display: none;" />
                            </td> 
                        </tr>
                    </tbody>
                </table> 
            </form>
        </div>
    </div>
</div>

<style>
    .moxie-shim-flash{
        background:red;
        width:100px;
        height:50px;
        display:block;
    }
</style>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/xiaoxin/placeholders.js'); ?>" type="text/javascript"></script>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="<?php echo MainHelper::AutoVersion('/js/xiaoxin/qiniu/main.css'); ?>">
<link rel="stylesheet" href="<?php echo MainHelper::AutoVersion('/js/xiaoxin/qiniu/js/highlight/highlight.css'); ?>">
<!--<link href="<?php //echo Yii::app()->request->baseUrl; ?>/js/xiaoxin/uploadify/uploadify.css" rel="stylesheet" type="text/css"/>
<script src="<?php //echo Yii::app()->request->baseUrl; ?>/js/xiaoxin/uploadify/jquery.uploadify.min.js?ver=<?php //echo rand(0,9999);?>" type="text/javascript"></script>-->
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<!--<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/xiaoxin/qiniu/bootstrap/js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="<?php echo MainHelper::AutoVersion('/js/xiaoxin/qiniu/js/plupload/plupload.full.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo MainHelper::AutoVersion('/js/xiaoxin/qiniu/js/plupload/i18n/zh_CN.js'); ?>"></script>
<script type="text/javascript" src="<?php echo MainHelper::AutoVersion('/js/xiaoxin/qiniu/js/ui.js'); ?>"></script>
<script type="text/javascript" src="<?php echo MainHelper::AutoVersion('/js/xiaoxin/qiniu/js/qiniu.js'); ?>"></script>
<script type="text/javascript" src="<?php echo MainHelper::AutoVersion('/js/xiaoxin/qiniu/js/main.js'); ?>"></script>
<script type="text/javascript">
$(function() {
   //表单验证控件
    Validform.int("#formBoxRegister,#formBoxbindMobile,#formSetpassword,#form1");
    $("#oldPwd").val('');
    $("#selectProvinces").change(function(){
        var val=$(this).val(),
            url=$(this).attr("url"),
            str="<option value='0'>请选择</option>"; 
            if(val&&url){
            $.getJSON(url,{id:val},function(data){
               if(data&&data.status=='1'){  
                   if(data.data.length!=0){ 
                        $.each(data.data,function(i,v){
                            str+='<option value="'+ v.aid+'">'+ v.name+'</option>';
                        });
                        $("#selectCity").show();
                   }else{
                       $("#selectCity").hide();
                   }
                   $("#selectCity").html(str);
               }
            });
        }else{
            $("#selectCity").show();
            $("#selectCity").html(str);  
        }
    });
//    updataLoadImg(); //上传头像 
    //表单验证控件
    //Validform.int("#formBoxRegister");
    //inoput 表单placeholder 提醒
    placeholders.int('formBoxRegisterPopup',true);
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
    
    $('[rel=resetBtn]').click(function(){
         hidePormptMaskWeb('#pupSetpassword');
        $('#resetInput').click(); 
         
    });
    $('input[rel=mobile],input[rel=code]').live('focus',function(e){
        $('#verifyCodeTip').hide();
        $('#verifyCodeTipN').hide();
        $('#bindMobileTip').hide();
        
    });
    $('input[rel=mobile]').live('focusout',function(e){
         var rel = $(this).val();
         //var eg =/^(((13[0-9]{1})|159|153|156|186|(18[0-9]{1}))+\d{8})$/;
         var eg = /^((1)+\d{10})$/; 
         if(rel==""){
            $(this).parents('td').find('.tipB').addClass('Validform_wrong').text('电话号码不能为空！').show();
         }else if(eg.test(rel)&&rel.length==11){
             $(this).parents('td').find('.tipB').removeClass('Validform_wrong').text('').show() ; 
         }else{
            $(this).parents('td').find('.tipB').addClass('Validform_wrong').text('电话号码格式不正确').show(); 
         } 
    });
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
   //更换手机发送验证码请求 ，发到新手机
   $('[rel=postVerifyCode]').click(function(){ 
        var mobile = $('#AccountF').val();
        var mph = $(this).attr('mph');
        if(mobile==mph){
            $('#verifyCodeTipN').text('电话号码不能和原来的一样！').show();
        }else{
            if(parseInt(countdown)==60){ 
                var sendurl = "<?php echo Yii::app()->createUrl('ajax/sendmobilecodenew');?>";
                var eg =/^((1)+\d{10})$/;
               
                if(mobile==""){
                    $('#verifyCodeTipN').text('电话号码不能为空！').show(); 
                }else if(eg.test(mobile)&&mobile.length==11){
                    $('#verifyCodeTipN').text('').hide(); 
                    var code = ajaxPost(sendurl,'3',mobile,'');
                    var codestr=code.split("--");
                    if(codestr[0]=='0'){
                        settime($(this));
                    }else{
                        $('.tipB').hide();
                        $('#verifyCodeTipN').text(codestr[1]).show();
                    }  
                }else{
                    $('.tipB').hide();
                    $('#verifyCodeTipN').text('电话号码格式不正确！').show(); 
                }
            }//
        }//  
    });

    

   //更换手机提交
   $('[rel=revampOK]').click(function(){
        var checkurl = "<?php echo Yii::app()->createUrl('ajax/sendmobilecode');?>";
        var verifyCodeN = $('#verifyCode').val();
        var mobile = $('#AccountF').val(); //新手机
        var oldmobile =$('#passwordF').val(); //旧手机
        if(mobile==""){ 
            $('#verifyCodeTipN').text('请输入手机号发送验证码验证！').show();
            $('.tipN').hide();
        }else{
            var eg =/^((1)+\d{10})$/;
            if(eg.test(mobile)&&mobile.length==11){
                if(verifyCodeN!=""){
                       $('#verifyCodeTipN').hide();
                           var changeUrl = '<?php echo Yii::app()->createUrl('site/changemobile');?>';
                            var str ="";
                            $.ajax({
                                url:changeUrl,
                                type : 'POST',
                                data : {ty:3,mobile:mobile,code:verifyCodeN,'oldmobile':oldmobile},
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
                           if(str == 'success'){
                                window.location="<?php echo Yii::app()->createUrl('site/account');?>";
                           }else{
                        	   $('#verifyCodeTipN').text(str).show();
                           }
                }else{
                    $('#verifyCodeTipN').text('请输入验证码验证！').show();
                }
            }else{ 
                $('#verifyCodeTipN').text("电话号码格式不正确！").show();
            }
            $('.tipN').hide();
        } 
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
        var tV =$('#bindType').val();
        if(tV== '0'){
            $('#formBoxbindMobile').submit();  
        }else{
            $('#bindMobileTip').show();
        }
        
   });
   
    //修改密码 操作js
    $('input[type=password]').focus(function(){
        $('.infoTip').hide();
        $('.errorTip').removeClass('Validform_wrong').hide(); 
    });
    //修改密码
    $('#btnEditPwd').click(function(){ 
       $('#formSetpassword').submit();
    });
    //修改密码enter   
    $('#newPwd').keydown(function(){
       var event=arguments.callee.caller.arguments[0]||window.event;//消除浏览器差异  
       if (event.keyCode == 13){
           //setPwds(); 
           $('#formSetpassword').submit();
       }
    });
   
});
</script>