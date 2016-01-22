<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/inbox.css'); ?>">
<?php $domain = Yii::app()->request->hostInfo; ?>
<style>
    #bdshare{
        display: inline-block;
        *display: inline;
        *_zoom: 1; 
        font-size: 0px;
        float:none!important;
        padding:0;
        z-index: 1;
        vertical-align:top;
    }
    /*.tableForm{
        display:block;
    }*/
    .tableForm .inputTitle{
        margin-right: 10px;
        width: 185px;
        text-align: right;
    }
    .Validform_checktip{
        margin-left: 0!important;
    }
    .formBox .codeBnt{ width: 130px; text-decoration: none; color: #333333; background-color: #E7E7E7; text-align: center; display: inline-block; padding: 8px 0px; margin-bottom: 0; font-size: 13px; font-weight: normal;  text-align: center; white-space: nowrap; vertical-align: middle; cursor: pointer; background-image: none; border: 1px solid #e2e2e2; border-radius: 3px; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; -o-user-select: none; user-select: none; outline: none;}
    .formBox .codeBnt:hover{ opacity: 0.8;}
</style>
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon3"></span>我的班班 > 班费卡转出
        </div>

        <div class="box" style="padding:15px 25px;">
            <nav class="navMod">
                <a href="<?php echo Yii::app()->createUrl('expense/index/', array('authority'=>$authority)); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
            </nav>
            <!--<div class="payment">
               <div class="pay-type">
                      <a href="javascript:;"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/pay1.jpg" alt=""></a>
                      <a href="javascript:;" class="last"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/pay2.jpg" alt=""></a>
               </div>
            </div> -->
            <div class="pay-form" >
                <form class="transfer-form" action="" method="post" id="formBoxRegister" name="" onkeydown="if (event.keyCode == 13) {return false;}">
                    <table class="tableForm">
                        <tbody>
                            <tr>
                                <td><p class="table-head">1.验证当前用户</p></td>
                            </tr>
                            <tr class="tr-bb">
                                <td>
                                    <span class="inputTitle">手机号：</span>
                                    <div class="inputBox"><span class="stress-text"><?php echo Yii::app()->user->getInstance()->mobilephone; ?></span></div>
                                    <span class="ValidformTip Validform_checktip" ></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="formBox">
                                    <span class="inputTitle">验证码：</span>
                                    <div class="inputBox">
                                        <input class="code border" style="width:100px;" onkeyup="this.value = this.value.replace(/\D/g, '')" onafterpaste="this.value=this.value.replace(/\D/g,'')" maxlength="6" autocomplete="off" type="text" name="Tenpay[code]" value="<?php echo isset($tenpay['code']) ? $tenpay['code'] : ''; ?>" rel="code" id="verifyCode"></div>
                                    <a href="javascript:;" rel="postVerifyCode" class="codeBnt">获取验证码</a>
                                    <span class="tipB Validform_checktip" style="margin-left:84px;display:none;"></span> 
                                    <span id="verifyCodeTip" style="display: none;" class="Validform_checktip Validform_wrong" >验证码不正确！</span>
                                    <input type="hidden" id="codeErrorMsg" value="<?php echo isset($codeErrorMsg) && $codeErrorMsg ? '1' : '0'; ?>" />                              
                                </td>
                            </tr>
                            <tr>
                                <td><p class="table-head">2.选择收款账户信息</p></td>
                            </tr>
                            <tr class="tr-bb">
                                <td>
                                    <input type="hidden" id="btypehidden" value="<?php echo isset($tenpay['bank_type']) ? $tenpay['bank_type'] : ''; ?>"/>
                                    <span class="inputTitle">银行类型：</span>
                                    <div class="inputBox">
                                        <select class="mediumM" id="bankType" name="Tenpay[bank_type]" datatype="*">
                                            <option value="">请选择</option>
                                            <option value="1001" <?php echo ($previnfo && isset($previnfo->banktype) && $previnfo->banktype == 1001) ? 'selected' : '';?>>招商银行</option>
                                            <option value="1002" <?php echo ($previnfo && isset($previnfo->banktype) && $previnfo->banktype == 1002) ? 'selected' : '';?>>中国工商银行</option>
                                            <option value="1003" <?php echo ($previnfo && isset($previnfo->banktype) && $previnfo->banktype == 1003) ? 'selected' : '';?>>中国建设银行</option>
                                            <option value="1004" <?php echo ($previnfo && isset($previnfo->banktype) && $previnfo->banktype == 1004) ? 'selected' : '';?>>上海浦东发展银行</option>
                                            <option value="1005" <?php echo ($previnfo && isset($previnfo->banktype) && $previnfo->banktype == 1005) ? 'selected' : '';?>>中国农业银行</option>
                                            <option value="1009" <?php echo ($previnfo && isset($previnfo->banktype) && $previnfo->banktype == 1009) ? 'selected' : '';?>>兴业银行</option>
                                            <option value="1032" <?php echo ($previnfo && isset($previnfo->banktype) && $previnfo->banktype == 1032) ? 'selected' : '';?>>北京银行</option>
                                            <option value="1022" <?php echo ($previnfo && isset($previnfo->banktype) && $previnfo->banktype == 1022) ? 'selected' : '';?>>中国光大银行</option>
                                            <option value="1006" <?php echo ($previnfo && isset($previnfo->banktype) && $previnfo->banktype == 1006) ? 'selected' : '';?>>中国民生银行</option>
                                            <option value="1021" <?php echo ($previnfo && isset($previnfo->banktype) && $previnfo->banktype == 1021) ? 'selected' : '';?>>中信实业银行</option>
                                            <option value="1027" <?php echo ($previnfo && isset($previnfo->banktype) && $previnfo->banktype == 1027) ? 'selected' : '';?>>广东发展银行</option>
                                            <option value="1010" <?php echo ($previnfo && isset($previnfo->banktype) && $previnfo->banktype == 1010) ? 'selected' : '';?>>平安银行(含深发展)</option>
                                            <option value="1026" <?php echo ($previnfo && isset($previnfo->banktype) && $previnfo->banktype == 1026) ? 'selected' : '';?>>中国银行</option>
                                            <option value="1020" <?php echo ($previnfo && isset($previnfo->banktype) && $previnfo->banktype == 1020) ? 'selected' : '';?>>中国交通银行</option>
                                            <option value="1066" <?php echo ($previnfo && isset($previnfo->banktype) && $previnfo->banktype == 1066) ? 'selected' : '';?>>中国邮政储蓄银行/邮政储汇</option>
                                            <option value="1099" <?php echo ($previnfo && isset($previnfo->banktype) && $previnfo->banktype == 1099) ? 'selected' : '';?>>其他银行</option>
                                        </select>
                                    </div>
                                    <span class="ValidformTip Validform_checktip" ></span>
                                </td>
                            </tr>
                            <tr class="tr-bb">
                                <td>
                                    <input type="hidden" id="areahidden" value="<?php echo isset($tenpay['area']) ? $tenpay['area'] : ''; ?>"/>
                                    <input type="hidden" id="cityhidden" value="<?php echo isset($tenpay['city']) ? $tenpay['city'] : ''; ?>"/>
                                    <span class="inputTitle">开户地区：</span>
                                    <div class="inputBox">
                                        <select class="mediumM" id="prov" name="Tenpay[area]" datatype="*" nullmsg="请选择地区!"  style="width:80px;">
                                            <option value="">请选择</option>
                                            <?php $provs = TenpayHelper::getProvs(); ?>
                                            <?php foreach ($provs as $key => $item): ?>
                                                <option value="<?php echo $key; ?>" <?php echo ($previnfo && isset($previnfo->area) && $previnfo->area == $key) ? "selected" : "";?>><?php echo $item; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <select class="mediumM" id="city" name="Tenpay[city]" datatype="*" nullmsg="请选择城市!" style="width:155px;">
                                            <option value="">请选择</option>
                                            <?php if(isset($prevcitys) && !empty($prevcitys)):?>
                                            <?php foreach ($prevcitys as $key=>$city):?>
                                            <option value="<?php echo $key;?>" <?php echo ($previnfo && isset($previnfo->city) && $previnfo->city == $key) ? "selected" : "";?>><?php echo $city;?></option>
                                            <?php endforeach;?>
                                            <?php endif;?>
                                        </select>
                                    </div>
                                    <span class="ValidformTip Validform_checktip" ></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="inputTitle">支行名称：</span>
                                    <div class="inputBox"><input placeholder="务必填写准确的支行名称" name="Tenpay[subbank_name]" value="<?php echo isset($tenpay['subbank_name']) ? $tenpay['subbank_name'] : ($previnfo && isset($previnfo->subbankname) && !empty($previnfo->subbankname) ? $previnfo->subbankname : ''); ?>" class="mediumM" type="text" datatype="*" style="width: 430px;"></div>
                                    <span class="ValidformTip Validform_checktip" ></span>
                                </td>
                            </tr>
                            <tr>
                                <td><p class="table-head">3.请填写收款人信息</p></td>
                            </tr>
                            <tr class="tr-bb">
                                <td>
                                    <span class="inputTitle">收款人账户名：</span>
                                    <div class="inputBox"><span style="font-weight:700;"><?php echo Yii::app()->user->getRealname();?></span><span style="color: #999;">（收款人必须为自己。如果您的注册姓名与真实姓名不一致，请在设置的基本信息项里更改注册姓名）</span></div>
                                    <input id="rec_name" name="Tenpay[rec_name]"  class="mediumM" type="hidden" value="<?php echo Yii::app()->user->getRealname();?>">
                                </td>
                            </tr>
                            <tr class="tr-bb">
                                <td>
                                    <span class="inputTitle">收款人账号：</span>
                                    <span class="inputBox"><input id="account" class="mediumM" name="Tenpay[rec_bankacc]" value="<?php echo isset($tenpay['rec_bankacc']) ? $tenpay['rec_bankacc'] : ''; ?>" type="text" datatype="*" onafterpaste="this.value=this.value.replace(/\D/g,'')"></span>
                                    <span class="ValidformTip Validform_checktip" ></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="inputTitle">收款人身份证号：</span>
                                    <span class="inputBox"><input  class="mediumM" name="Tenpay[idcard]" value="<?php echo isset($tenpay['idcard']) ? $tenpay['idcard'] : ''; ?>" type="text" datatype="idcard" nullmsg="请填写身份证号码！" errormsg="您填写的身份证号码不对！" placeholder="为了确保顺利转出，请务必填写本人的身份证号码" style="width: 310px;"></span>
                                    <span class="ValidformTip Validform_checktip"></span>
                                </td>
                            </tr>
                            <tr>
                                <td><p class="table-head">4.请填写转出金额相关信息</p></td>
                            </tr>
                            <tr class="tr-bb">
                                <td>
                                    <span class="inputTitle">转出金额（元）：</span>
                                    <div class="inputBox"><span class="stress-text"><?php echo $transferInfo['amt']; ?></span></div>
                                    <span class="ValidformTip Validform_checktip"></span>
                                </td>
                            </tr>
                            <tr class="tr-bb">
                                <td>
                                    <span class="inputTitle">转出说明：</span>
                                    <div class="inputBox">
                                        <textarea name="Tenpay[desc]" ignore="ignore" datatype="*1-50"  style="height:100px;width:400px;"  errormsg="转出说明只能输入50个字!" ><?php echo isset($tenpay['desc']) ? $tenpay['desc'] : ''; ?></textarea>
                                    </div>
                                    <span class="ValidformTip Validform_checktip" ></span>
                                </td>
                            </tr>                            
                            <tr>
                                <td style=" position: relative;"> 
                                    <input type="hidden" name="transRst" msg="<?php echo isset($errorMsg)?$errorMsg:'';?>" id="transRst" value="<?php echo isset($transRst) && $transRst ? $transRst : '0'; ?>"/>
                                    <span class="inputTitle" style="margin-left: 0;*display:none;"></span>
                                    <!-- <a id="paySubmit" href="javascript:void(0);" class="btn btn-orange"  onclick="showPromptPush('#isLeavePopupBox')">保存</a> -->
                                    <a id="paySubmit" href="javascript:void(0);" class="btn btn-orange">提交申请</a> 
                                    <p  style=" margin-top: 10px; margin-left: 200px; color: red;">
                                        提示：班费卡转出申请提交之后，将会自动到达银行进行转账处理。<br/>具体到账情况，班班会在第一时间以手机短信的方式反馈给您。</p>
                                </td> 
                            </tr>
                        </tbody>
                    </table>  
                </form>
            </div>
        </div> 
    </div>
</div> 
<div id="sharePopupBox" class="popupBox" style="width: 500px; height: 260px;"> 
    <div id="shareBox" class="share shareBox">
        <div class="step">
            <p class="p2"></p>
            <div class="select-type">
                <span>点击你希望分享的平台：</span>
                <div class="bdsharebuttonbox" data-tag="share_1">
                    <a class="sqq" data-cmd="sqq"></a>
                    <a class="qzone" data-cmd="qzone" href="#"></a>
                    <a class="sina last" data-cmd="tsina"></a> 
                </div>
            </div>
        </div>
    </div>
</div>
<div id="isLeavePopupBox" class="popupBox" style="width: 428px; height: 260px;"> 
    <div class="header"><span id="boxtitle">转出成功</span><a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#isLeavePopupBox')" > </a></div>
    <div class="remindInfo  setTime" style=" padding:60px 40px;" > 
        提示：预计三个工作日内到账，届时会有短信通知。
    </div>
    <div class="popupBtn" style="text-align: center;">
        <a id="boxconfirm" href="javascript:void(0);"  class="btn btn-orange" data-val="" >确　定</a>
    </div>
</div>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script>
        $('#account').keyup(function() {
            var value = $(this).val().replace(/\s/g, '').replace(/\D/, '').replace(/(\d{4})(?=\d)/g, "$1 ");
            $(this).val(value)
        }); //onkeyup="this.value = this.value.replace(/\D/g, '')"

        function ajaxPost(url, ty, mobile, code) {
            var str = "";
            $.ajax({
                url: url,
                type: 'POST',
                data: {ty: ty, mobile: mobile, code: code},
                dataType: 'text',
                contentType: 'application/x-www-form-urlencoded',
                async: false,
                success: function (mydata) {
                    str = mydata;
                },
                error: function () {
                    // alert("calc failed");  
                    str = "系统繁忙,请稍后再试";
                }
            });
            return str;
        }

        $(function () {
            $('#verifyCode').keydown(function () {
                $('#verifyCodeTip').hide();
            });

            ValidformNew.int("#formBoxRegister");
            $('#paySubmit').click(function () {
                var checkurl = "<?php echo Yii::app()->createUrl('ajax/checkmobilecode'); ?>";
                var mobile = '<?php echo Yii::app()->user->getInstance()->mobilephone; ?>';
                var verifyCode = $('#verifyCode').val();
                if (mobile != "") {
                    var eg = /^((1)+\d{10})$/;
                    if (eg.test(mobile) && mobile.length == 11) {
                        if (verifyCode != "") {
                            //原来的校验验证码失效（改接口发送验证码后不能实时校验）
                            var codeS = ajaxPost(checkurl, '5', mobile, verifyCode);
                            if (codeS == '1') {
                                off = false;
                                countdown = 60;
                                $('#verifyCodeTip').hide();
                                $("#formBoxRegister").attr('name', 'issubmit');
                                $("#formBoxRegister").submit();
                           } else {
                               $('#verifyCodeTip').text('' + codeS).show();
                           }
                        } else {
                            $('#verifyCodeTip').text('请输入验证码验证！').show();
                        }
                    } else {
                        $('#verifyCodeTip').text("电话号码格式不正确!").show();
                    }
                    $('.tipB').hide();
                } else {
                    $('#verifyCodeTip').text('请输入手机号获取验证码！').show();
                }

            });

            //计时器
            var countdown = 60;
            var off = true;
            function settime(val) {
                if (!off) {
                    return;
                }
                if (countdown == 0) {
                    //val.removeAttribute("disabled");
                    val.css({background: '#ffffff', color: "#333333"});
                    val.text("重新获取验证码");
                    countdown = 60;
                    return;
                } else {
                    val.css({background: '#cccccc', color: "#ffffff", cursor: "default", borderColor: '#adadad'});
                    //val.setAttribute("disabled", true); 
                    val.text("（" + countdown + "s）后再次发送");
                    countdown--;
                }
                setTimeout(function () {
                    settime(val);
                }, 1000);
            }

            //手机发送验证码请求
            $('[rel=postVerifyCode]').click(function () {

                if (parseInt(countdown) == 60) {
                    var sendurl = "<?php echo Yii::app()->createUrl('ajax/sendmobilecode'); ?>";
                    var eg = /^((1)+\d{10})$/;
                    var mobile = '<?php echo Yii::app()->user->getInstance()->mobilephone; ?>';
                    if (mobile == "") {
                        $('#verifyCodeTip').text('电话号码不能为空！').show();
                    } else if (eg.test(mobile) && mobile.length == 11) {

                        $('#verifyCodeTip').text('').hide();
                            var code = ajaxPost(sendurl, '5', mobile, '');
                            if (code == '1') {
                                settime($(this));
                            }else if(code=="2"){
                                $('#verifyCodeTip').text("发送次数已超上限").show();
                            }else if(code=="3"){
                                $('#verifyCodeTip').text("手机号已绑定").show();
                            }
                            else {
                                $('.tipB').hide();
                                $('#verifyCodeTip').text(code).show();
                            }
                        } else {
                        $('.tipB').hide();
                        $('#verifyCodeTip').text('电话号码格式不正确！').show();
                    }
                } else {
                }
            });


            $("#pay_amt").blur(function () { 
                var outfee = $(this).val();
// 	    	var totalfee = $("#totalFeeHidden").val();
// 	    	if(outfee && outfee > 0 && totalfee > 0){
// 	    		  if(parseInt(outfee) > parseInt(totalfee)){
// 	    			  var t = $(this).parent().next().find(".Validform_checktip");
// 	    			  t.addClass("Validform_wrong").removeClass("Validform_right").text("班费卡余额不足！");
// 	    		  }
// 	    	}

                if (outfee) { 
                    var checkexpenseurl = "<?php echo Yii::app()->createUrl('ajax/checkmonthquota'); ?>";
                    var amt = $.trim($("#pay_amt").val());
                    var uname = $.trim($("#rec_name").val());
                    var cid = '0';
                    var ty = 2; //检测余额，月上限

                    var t = $(this).parent().next().find(".Validform_checktip");

                    $.post(checkexpenseurl, {'cid': cid, 'amt': amt, 'uname': uname, 'ty': ty}, function (data) {
                        if (data.status != 1) {
                            t.addClass("Validform_wrong").removeClass("Validform_right").text(data.msg);
                            $("#pay_amt").val('');
                            $("#pay_amt").focus();
                        }
                    }, 'JSON');

                }

            });

            $("#prov").change(function () {
                var provid = $(this).val();
                var url = '<?php echo Yii::app()->createUrl('ajax/getcitys'); ?>';
                $.post(url, {provid: provid}, function (data) {
                    if (data) {
                        var htmlStr = '<option value="">请选择</option>';
                        $.each(data, function (i, n) {
                            htmlStr += '<option value="' + i + '">' + n + '</option>';
                        });
                        $("#city").html(htmlStr);
                        var city = $("#cityhidden").val();
                        if (city && city != '') {
                            $("#city").val(city);
                        }
                        $("#city").focus();
                    }
                }, 'json');
            });

            var btypehidden = $("#btypehidden").val();
            if (btypehidden && btypehidden != '') {
                $("#bankType").val(btypehidden);
            }

            var area = $("#areahidden").val();
            if (area && area != '') {
                $("#prov").val(area);
                $("#prov").change();

                var codeErrorMsg = $("#codeErrorMsg").val();
                if (codeErrorMsg == 1) {
                    $('#verifyCodeTip').text('请输入验证码验证！').show();
                    var c = $("#verifyCode").val();
                    $("#verifyCode").val("").focus().val(c);
                } else {
                    //var t = $("#pay_amt").val();
                    // $("#pay_amt").val("").focus().val(t);
                }
            }

            var transRst = $("#transRst").val();
            var errorMsg = $("#transRst").attr("msg")||'';
            if (transRst && transRst != '') {
                var t = $("#pay_amt").parent().next().find(".Validform_checktip");
                if (parseInt(transRst) == 1) {
                    $("#boxtitle").text('提交成功');
                    $("#isLeavePopupBox .remindInfo").html('提交成功！共转出' +<?php echo isset($tenpay['pay_amt']) ? $tenpay['pay_amt'] : 0; ?> + '元，当前班费卡余额' +<?php echo isset($totalFee) ? $totalFee : 0; ?> + '元，预计三个工作日内到账，届时会有短信通知。');
                    showPromptPush('#isLeavePopupBox');
                } else if (parseInt(transRst) == 2) {
                    $("#boxtitle").text('提交失败');
                    $("#isLeavePopupBox .remindInfo").html('班费卡提交失败，请重新填写。'+errorMsg);
                    showPromptPush('#isLeavePopupBox');
                    t.addClass("Validform_wrong").removeClass("Validform_right");
                    //.text("班费卡提交失败，请重新填写。")
                } 
            }

            $("#boxconfirm").click(function () {
                var transRst = $("#transRst").val();
                if (parseInt(transRst) == 1 || parseInt(transRst) == 2) {
                    location.href = "<?php echo Yii::app()->createUrl('expense/index/'); ?>";
                    hidePormptMaskWeb('#isLeavePopupBox');
                } else {
                    hidePormptMaskWeb('#isLeavePopupBox');
                }

            });
        })

</script>

<script>
    //判断手机号码是否一致
    var shareUrl = '<?php echo Yii::app()->createAbsoluteUrl('mobile/cost_preview', array('classid'=>0,'uid'=>Yii::app()->user->id));?>';
    window._bd_share_config = {
        common: {
            bdText: '晒班费卡啦~我们班已经赚了<?php echo $totalFee; ?>元啦！',
            bdDesc: '动动小手，班费卡到手。把你们班费卡晒出来看看吧~',
            bdUrl: shareUrl,
            bdPic: '<?php echo $domain = Yii::app()->request->hostInfo; ?>/image/banban/login/logo2.png',
            onBeforeClick: function (cmd, config) {
//                if(cmd=='sqq'){ 
//                }else if(cmd=='qzone'){ 
//                }else if(cmd=='tsina'){ 
//                }
               // return {bdDesc: '我在班班支取了' + $("#pay_amt").val() + '元班费卡。发通知、发作业，手机轻松玩转家校沟通，动动手指还能挣班费卡！我们班已经挣了元了，你也快来一起为班级挣福利吧！'};
            },
            onAfterClick: function (cmd, config) {
                $("#formBoxRegister").attr('name', 'issubmit');
                $("#formBoxRegister").submit();
            }
        },
        share: [{
                "bdSize": 32
            }]
    }
    with (document)
        0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion=' + ~(-new Date() / 36e5)];
</script>
