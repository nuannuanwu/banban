<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
           <span class="icon icon1"></span> 我的班班
        </div>
        <div class="box"> 
            <div class="formBox" style="">
                <form id="formBoxRegister" action="<?php echo Yii::app()->createUrl('class/setrealname');?>" method="post">
                    <input type="hidden" name="ty" id="ty" value="<?php echo $ty?$ty:'';?>" />
                    <input type="hidden" name="identity" id="identity" value="<?php echo $identity?$identity:'';?>" />
                    <table class="tableForm">
                        <tbody> 
                            <tr>
                                <td>
                                    作为班主任或任课老师，需要您先设置真实姓名，方便与学生家长沟通。请填写您的真实姓名：
                                </td>
                            </tr>
                            <tr>                                
                                <td>
                                    <span class="inputTitle"style=" float: left; color: #000000; margin-top: 7px; width: 40px">姓名：</span>
                                    <div style=" margin-left:50px;">
                                        <div class="inputBox"><input id="realname"  name="realname"  placeholder="真实姓名" value="" maxlength="20" class="mediumLx" type="text" datatype="*" ignore="ignore" style="width: 290px;" nullmsg="请输入真实姓名" errormsg="姓名只允许中英文数字以及()_-.和空格组成。" >
                                            <span style=" color: red;"> * </span></div>
                                        <!--<span id="tipCheck" class="Validform_checktip"></span>-->
                                        <span id="tipChecks" class="Validform_checktip" ></span>  
                                        <div class="info" style="display: none;">请填写真实姓名!<span class="dec"><s class="dec1">◆</s><s class="dec2">◆</s></span></div>
                                        <input id="isOkType" type="hidden" value="1">
                                    </div>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                    
                    <table class="tableForm" >
                        <tbody> 
                            <tr>
                                 <td>  
                                    <a id="submitBtn" href="javascript:;" class="btn btn-orange">保存</a>
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                </form>
            </div>
        </div> 
    </div>
</div>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/stcombobox/index.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/stcombobox/stcombobox.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/stcombobox/stcombobox.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
    //表单验证控件
    Validform.int("#formBoxRegister");
    $('#realname').focusout(function(){
        var strNmane = $(this).val();
        var egt =/^[a-zA-Z0-9\u4e00-\u9fa5\(\)\（\）\-\_\.\s]+$/;
        if(strNmane!=""){
            if(byteLength(strNmane)<=20&&byteLength(strNmane)>0){ 
                if(strNmane.match(egt) !== null){ 
                     $('#tipChecks').text('').removeClass('Validform_wrong');
                }else{
                   $('#tipChecks').text('姓名只允许中英文数字以及()_-.和空格组成。').addClass('Validform_wrong');  
                } 
            }else{ 
                $('#tipChecks').text('姓名不能超过10个汉字（或20个英文字符）').addClass('Validform_wrong');
            }
        }else{
            $('#tipChecks').text('请输入姓名').addClass('Validform_wrong');
        }
    });
    //提交
    $('#submitBtn').click(function(){ 
        var strNmane = $('#realname').val(); 
       var egt =/^[a-zA-Z0-9\u4e00-\u9fa5\(\)\（\）\-\_\.\s]+$/;
        if(strNmane!=""){
            if(byteLength(strNmane)<=20&&byteLength(strNmane)>0){ 
                if(strNmane.match(egt) !== null){ 
                    $("#formBoxRegister").submit(); 
                    $('#tipChecks').text('').removeClass('Validform_wrong');
                }else{
                   $('#tipChecks').text('姓名只允许中英文数字以及()_-.和空格组成。').addClass('Validform_wrong');  
                } 
            }else{ 
                $('#tipChecks').text('姓名不能超过10个汉字（或20个英文字符）').addClass('Validform_wrong');
            }
        }else{
            $('#tipChecks').text('请输入姓名').addClass('Validform_wrong');
        } 
    });
    function byteLength(str) {
        var byteLen = 0, len = str.length;
        if( !str ) return 0;
        for( var i=0; i<len; i++ )
            byteLen += str.charCodeAt(i) > 255 ? 2 : 1;
        return byteLen;
    }

});
</script>
