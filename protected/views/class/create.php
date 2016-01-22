<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
           <span class="icon icon1"></span>我的班班 > 创建新班级
        </div>
        <div class="box"> 
            <div class="listTopTite bBottom">
                 <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/class_step1_1.png">
            </div> 
            <div class="formBox" style="">
                <form id="formBoxRegister" action="" method="post">
                    <table class="tableForm">
                        <tbody> 
                            <tr>
                                <td>
                                    <span class="inputTitle" style=" float: left; color: #000000; font-weight: 700; margin-top: 7px;">班级名称：</span>
                                    <div style=" margin-left:70px;">
                                        <div class="inputBox" style="display: inline-block; *display: inline; width: 430px; position: relative;">
                                            <input id="className" style="width:410px; *vertical-align: top;" url="<?php echo Yii::app()->createUrl('class/classexist');?>" name="Class[name]"  placeholder="请输入班级名称" value="" maxlength="20"  type="text"  datatype="*1-20,namestr" nullmsg="请输入班级名称！" errormsg="只允许中英文数字以及()_-.和空格组成！" />
                                            <span style=" *display: inline-block; color: red; *line-height: 32px;" > * </span> 
                                            <div class="info" style=" display: none; position: absolute; right: -312px;background:#fff;">班级名称不能超过10个汉字（或20个英文字符）<span class="dec" style="*top:8px;"><s class="dec1">◆</s><s class="dec2">◆</s></span></div>
                                        </div> 
                                        <span id="tipCheck" class="Validform_checktip" style=" margin-left: 0;"></span> 
                                        <span id="tipChecks" class="Validform_checktip" style="display: none; margin-left: 0;"> </span>  
                                        <input id="isOkType" type="hidden" value="1">
                                    </div>
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                    <table class="tableForm">
                        <tbody> 
                            <tr>
                                 <td>  
                                    <a id="submitBtn" href="javascript:;" class="btn btn-orange">下一步</a>
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
    $('input[type=text]').keypress(function(){
            $('#tipChecks').hide().addClass('Validform_wrong');
            $('#tipCheck').show();
        });
    $('input[type=text]').focus(function(){ 
        $('#tipChecks').hide().removeClass('Validform_wrong');
        $('#tipCheck').show(); 
    });
    $('input[type=text]').focusout(function(){
        var name = $(this).val(); 
        if(getByteLen(name)<=20&&getByteLen(name)>0){ 
            $('#tipChecks').hide().removeClass('Validform_wrong');;
            $('#tipCheck').show();
       }else{
            if(name==""){ 
                $('#tipChecks').hide();
                $('#tipCheck').show(); 
            }else{ 
                $('#tipCheck').hide();
                $('#tipChecks').text('班级名称不能超过10个汉字（或20个英文字符）!').show().addClass('Validform_wrong'); 
            } 
        } 
   });
    //提交
    $('#submitBtn').click(function(){
        var name = $('#className').val(); 
        $('#tipChecks').hide();
        if(getByteLen(name)<=20){  
            $("#formBoxRegister").submit();
            $('#tipCheck').show(); 
        }else{ 
            if(name==""){ 
                $("#formBoxRegister").submit();
                $('#tipCheck').show(); 
            }else{ 
                $('#tipCheck').hide();
                $('#tipChecks').text('班级名称不能超过10个汉字（或20个英文字符）!').show().addClass('Validform_wrong'); 
            }
        }
        //$("#formBoxRegister").submit();
    });
    /** 
    * 计算字符串的字节数 
    * @param {Object} str 
    */   
   function  getByteLen(str){   
       var l=str.length;   
       var n = l;   
       for ( var i=0;i <l;i++){  
           if( str.charCodeAt(i) <0 ||str.charCodeAt(i)> 255){  
               n++;   
           }   
       }   
       return n;   
   }

   $('#optional').click(function() {
       var attributeBox = $('#attributeBox');
       if (attributeBox.hasClass('hidden')) {
           attributeBox.removeClass('hidden');
           $(this).children('span').addClass('off').removeClass('on');
       } else {
           attributeBox.addClass('hidden');
           $(this).children('span').removeClass('off').addClass('on');
       }
   });
});
</script>
