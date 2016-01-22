<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<style>
    #getValidateCode {
        position: absolute;
        top: 1px;
        right: 1px;
        width: 40%;
        height: 34px;
        text-align: center;
        line-height: 36px;
        color: #3a3a3a;
        border-bottom-right-radius: 3px;
        border-top-right-radius: 3px;
        background-color: #f5f4eb;
        border-left: 1px solid #d8d8d8;
    }
    a#getValidateCode:hover {
        background-color: #ecebee;
    }
    /*a#getValidateCode:active {
        background-color: #eebf94;
    }*/
    .third-info-step {
        border-bottom: 1px solid #DDDDDD;
    }
    .third-info-step .step {
        width: 33.3333333333%;
        padding: 20px 0;
        float: left;
        font-size: 1.2857em;
    }
    .third-info-step .step-1 {
        text-align: right;
        padding-right: 30px;
    }
    .third-info-step .step-3 {
        padding-left: 30px;
    }
    .third-info-step .active {
        color: #ff9d19;
    }
    .tableForm .inputBox, table .inputBox {
        display: inline-block;
    }
    ._validform_wrong {
        color: red;
        padding-left: 20px;
        white-space: nowrap;
        background: url(/js/banban/Validform/images/error.png) no-repeat left center;
    }
</style>
<div id="mainBox" class="mainBox"> 
    <div id="contentBox" class="cententBox">
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班
        </div>
        <div class="box">
              <div class="listTopTite bBottom">
                 <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/class_step_1.png">
            </div> 
            <div class="formBox">
                <form id="formBoxThirdinfo" action="" method="post">
                    <table class="tableForm">
                        <tbody>
                        <tr>
                            <td>
                                <span style="font-size: 16px; color: #666666;">请完善基础信息</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="inputTitle">姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：</span>
                                <div class="inputBox"><input id="name" url="<?php echo Yii::app()->createUrl('class/classexist');?>" name="third[name]" value="" maxlength="20" class="lg" type="text" datatype="s2-20" nullmsg="请输入姓名！" errormsg="姓名不规范 !"></div>
                                <span id="tipCheck" class="Validform_checktip"></span>
                                <div class="info" style="display: none;">请输入您的姓名!<span class="dec"><s class="dec1">◆</s><s class="dec2">◆</s></span></div>
                                <input id="isOkType" type="hidden" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="inputTitle">手 机 号：</span>
                                <div class="inputBox"><input id="phone" url="<?php echo Yii::app()->createUrl('class/classexist');?>" name="third[phone]" value="" maxlength="20" class="lg" type="text" datatype="phone" nullmsg="手机号！" errormsg="手机号码格式不正确!"></div>
                                <span id="tipCheck" class="Validform_checktip"></span>
                                <div class="info" style="display: none;">输入正确的手机号!<span class="dec"><s class="dec1">◆</s><s class="dec2">◆</s></span></div>
                                <input id="isOkType" type="hidden" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td style="position: relative">
                                <span class="inputTitle">验 证 码：</span>
                                <div class="inputBox" style="position: relative">
                                    <input id="className" url="<?php echo Yii::app()->createUrl('class/classexist');?>" name="third[code]" value="" maxlength="20" class="lg" type="text" datatype="*1-20" nullmsg="请输入验证码！" errormsg="验证码格式不正确!">
                                    <a id="getValidateCode" data-status="0" href="javascript:;">获取验证码</a>
                                </div>
                                <span id="tipCheck" class="Validform_checktip"></span>
                                <div class="info" style="display: none;">请输入获取的验证码!<span class="dec"><s class="dec1">◆</s><s class="dec2">◆</s></span></div>
                                <input id="isOkType" type="hidden" value="1">
                                <span id="validateError" class="_validform_wrong" style="display: none;"></span>
                            </td>
                        </tr>
                        <!--<tr><td></td></tr>-->
                        <tr>
                            <td>
                                <a id="submitBtn" href="javascript:;" class="btn btn-orange">下一步</a>
                                <!--<input type="submit" class="btn btn-orange"  value="下一步">-->
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div> 
    </div>
 </div>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){ 
        //计时器
        var countdown = 60;
        function setTime(val) {
            if (countdown == 0) {
                val.css({background:'#f5f4eb', color:"#3a3a3a", cursor: "pointer"});
                val.text("获取验证码");
                countdown = 60;
                val.attr("data-status", "0");
                return;
            } else {
                val.css({background:'#cccccc', color:"#ffffff", cursor: "default"});
                val.text("（" + countdown + "）后再次获取验证码");
                countdown--;
            }
            setTimeout(function() {
                setTime(val);
            }, 1000);
        }

        Validform.int("#formBoxThirdinfo");

        $('#getValidateCode').click(function() {
            var that = $(this);
            if ($('#phone').val() === '')
                return false;
            if ($(this).attr("data-status") == "1")
                return false;
            if (!/^((1)+\d{10})$/.test($('#phone').val())) {
                return false;
            }
            $(this).attr("data-status", "1");
            $.getJSON("<?php echo Yii::app()->createUrl('ajax/sendthird');?>?phone=" + $('#phone').val(), function(data){
                if (data && data.status == 1) {
                    setTime(that);
                } else if (data && data.status == 0) {
                    $('#validateError').text(data.msg).show();
                    that.attr("data-status", "0");
                } else {
                    //todo
                }
            });
        });

        $('#className').on('focus',function(){
            $('#validateError').hide();
        })
        //提交
        $('#submitBtn').click(function(){
            $("#formBoxThirdinfo").submit();
        });
    });
</script>