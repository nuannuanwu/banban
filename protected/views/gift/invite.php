<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/inbox.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon3"></span>我的礼包
        </div>
        <div class="box" style="padding:15px 25px 50px;">
        	<div class="share">
        		<div class="tit">“邀请推荐” 奖励领取</div> 
        		<div class="step " id="secendStep" >
		            <h1 style="font-size: 21px; color: #ooo; margin-top: 20px; ">输入充值号码</h1>
        			<p class="p2">恭喜您可以领取30元手机话费了，您只需要输入将要充值的手机号，点击“领取”，工作人员将在一个工作日内充值到该手机号上，请注意查收充值成功短信。感谢您对班班的推荐，我们将一如既往提供更好的服务。</p>
					<div class="select-type">
						<form  method="post" id="formBoxRegister">
	              		 	<table class="tableForm">
	                            <tbody>                           
		                            <tr>
		                                <td>
		                                    <span class="inputTitle" style="width:120px;">充值号码：</span>
		                                    <div class="inputBox"><input value="" class="mediumL" type="text" datatype="phone" id="phone" maxlength="11"></div>
		                                    <span class="ValidformTip Validform_checktip" ></span>
		                                </td>
		                            </tr>
		                            <tr>
		                                <td>
		                                    <span class="inputTitle" style="width:120px">再次确认充值号码：</span>
		                                    <div class="inputBox"><input value="" class="mediumL" type="text" id="checkPhone" maxlength="11"></div>
		                                    <span class="ValidformTip Validform_checktip" id="checkTip"><span class="Validform_checktip " ></span></span>
		                                </td>
		                            </tr>
		                            <tr>
		                                <td > 
		                                    <a id="paySubmit" href="javascript:;" class="btn btn-orange">领取</a>
		                                </td> 
		                            </tr>
	                            </tbody>
	                        </table>
                        </form>
					</div>
        			
        		</div>
				
            </div>
        </div> 
    </div>
</div>
<div id="giftBox" class="popupBox" style=" font-size:14px;">

    <div class="header">兑换成功<a href="javascript:void(0);" class="close" onclick="location.href='<?php echo Yii::app()->createUrl('gift/index');?>'" > </a></div>
    <div class="remindInfo  setTime" style=" padding:30px 20px;" > 
        兑换成功！<br/>      
若超过一个工作日后未收到话费充值，请联系客服：<br/>400101-3838
咨询。
    </div>
    <div class="popupBtn" style="text-align: center;">
        <a href="javascript:void(0);"  class="btn btn-orange" onclick="location.href='<?php echo Yii::app()->createUrl('gift/index');?>'" >确定</a>
    </div>
</div> 


<div id="failBox" class="popupBox" style=" font-size:14px;">

    <div class="header">兑奖提示<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#failBox')" > </a></div>
    <div class="remindInfo  setTime" style=" padding:30px 20px;" > 
        兑换失败！
    </div>
    <div class="popupBtn" style="text-align: center;">
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#failBox')" class="btn btn-orange">确认</a>
    </div>
</div>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script>
	//判断手机号码是否一致 
	var checkPhone=function(){
		var rPhone=$('#checkPhone'),
			reg=/^((1)+\d{10})$/;
		rPhone.on('blur',function(){
			var rPhoneVal=$.trim(rPhone.val()),
				firstP=$.trim($('#phone').val());
			if (rPhoneVal!='') {
				if (!reg.test(rPhoneVal)) {
					$('#checkTip').find('.Validform_checktip').addClass('Validform_wrong').removeClass('Validform_right').text('请输入正确的手机号码！');
				}else{
					if (rPhoneVal == firstP) {
						$('#checkTip').find('.Validform_checktip').addClass('Validform_right').removeClass('Validform_wrong').text('通过信息验证！');
					}else{
						$('#checkTip').find('.Validform_checktip').addClass('Validform_wrong').removeClass('Validform_right').text('请输入相同的手机号码！');
					}
				}
			}else{
				$('#checkTip').find('.Validform_checktip').addClass('Validform_wrong').removeClass('Validform_right').text('请填写信息！');
			}
		})
	}
	$(function(){	
		 Validform.int("#formBoxRegister");
		 checkPhone();
		 $('#paySubmit').click(function(){
		 	var rPhone=$('#checkPhone'),
		 	    ty = '<?php echo $ty;?>',
		 	    id = '<?php echo $id;?>',
		 		rPval=$.trim(rPhone.val()),
		 		firstP=$.trim($('#phone').val()),
				reg=/^((1)+\d{10})$/;
				if (rPval!='') {
					if (!reg.test(rPval)) {
						$('#checkTip').find('.Validform_checktip').addClass('Validform_wrong').removeClass('Validform_right').text('请输入正确的手机号码！');
					}else{
						if (rPval == firstP) {
							// $('#formBoxRegister').submit();
							var url = '<?php echo Yii::app()->createUrl('ajax/exchange');?>';

							$.ajax({  
				                url : url,   
				                type : 'POST', 
				                dataType : 'JSON',       
				                data : {'phone':rPval, 'ty':ty, 'id':id},       
				                contentType : 'application/x-www-form-urlencoded',  
				                async : false,  
				                success : function(mydata) {	
				                    if(mydata.status == 1){           
				                    	showPromptPush('#giftBox');
				                    }else{
				                    	showPromptPush('#failBox');
				                    }
				                },  
				                error : function() { 
				                    showPromptPush('#failBox');
				                }  
				            });
							
						}else{
							$('#checkTip').find('.Validform_checktip').addClass('Validform_wrong').removeClass('Validform_right').text('请输入相同的手机号码！');
						}
					}
				}else{
					$('#checkTip').find('.Validform_checktip').addClass('Validform_wrong').removeClass('Validform_right').text('请填写信息！');
				}
		 })
	})
	
</script>