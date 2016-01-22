<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/inbox.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon3"></span>班费分享
        </div>
        <div class="box" style="padding:15px 25px 50px;">
        	<div class="share">
        		<div class="tit">'注册建班大礼包' 兑换</div>
        		<div class="step">
        			<p class="p1">第一步：分享礼包</p>
        			<p class="p2">兑换前，请先将本次活动礼包分享给您的同事和朋友，邀请他们一同注册建班，获得礼包，共享班班送给大家的这份喜悦！</p>
					<div class="select-type">
						<span>选择分享平台</span>
						<div class="bdsharebuttonbox" data-tag="share_1">
							<a class="sqq" data-cmd="sqq"></a>
		                	<a class="qzone" data-cmd="qzone" href="#"></a>
		                	<a class="sina" data-cmd="tsina"></a>
		                	
		                </div>
					</div>
        			
        		</div>
        		<div class="step " id="secendStep" style="display:none;">
        			<p class="p1">第二步：输入充值号码</p>
        			<p class="p2">现在，您可以用500青豆兑换50元手机话费了，您只需要输入将要充值的手机号，兑换成功后，将在一个工作日内，自动充值到该手机号上，请注意查收充值成功短信。
<span class="orange">（兑换后您的青豆数量将扣除500）</span></p>
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
		                                    <a id="paySubmit" href="javascript:;" class="btn btn-orange">兑换</a>
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
				                data : {'phone':rPval, 'ty':ty},       
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

	var shareUrl = "<?php echo Yii::app()->createAbsoluteUrl('mobile/cost_preview');?>";
	window._bd_share_config = {
		common : {
			bdText : '用“班班”注册建班送大礼！',	
			bdDesc : '我刚在“班班”兑换了50元充值卡！免费使用还送礼！注册就兑了！ 班班是国内首款基于“班级”为单位，面向老师和家长之间的教育专属沟通工具。一同来注册享受好礼吧！',	
			bdUrl : shareUrl,
			bdPic : 'http://www.banban.im/image/banban/login/logo1.png',
			onAfterClick : function(){
				$('#secendStep').show().siblings('.step').hide();
			}
		},
		share : [{
			"bdSize" : 32
		}]
	}
	with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
</script>