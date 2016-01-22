<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班 > <?php echo $class->name; ?> > 添加学生
        </div>
        <div class="box"> 
            <div class="listTopTite bBottom">添加学生</div> 
            <div class="formBox">
                <div class="classTableBox invtesBox"> 
                    <form id="formBoxRegister" action="" method="post">
                        <table class="tableForm" id="tableFormAdd">
                            <tbody>
                                <tr>
                                    <td style="width:160px;">
                                        <div class="classInfoTitle" >
                                        〓 基本信息
                                        </div>
                                    </td>
                                    <td style="width:385px;"></td>
                                    <td></td>
                                </tr> 
                                <tr>
                                    <td> 
                                        <a  href="javascript:void(0);" id="btnAdd" class="btn btn-default" >再添加一个</a>  
                                    </td>
                                    <td><div class="addLimit" style="display: none;"><span class="Validform_checktip Validform_wrong" >一次最多只能添加10位学生</span> </div></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="tableForm">
                            <tbody> 
                                <tr>
                                    <td>
                                        <div class="classInfoTitle bTop" style="padding-top:10px; line-height: 40px; height: 40px; ">
                                        〓 说点什么
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="inputBox">
                                            <textarea placeholder="对学生说点什么吧" maxlength="110" datatype="*1-100" nullmsg="信息不能为空！" errormsg="信息不能大于100个字！" style="width: 486px; height: 98px;" name="Student[desc]">欢迎加入<?php echo $class->name; ?></textarea>
                                        </div>
                                        <span class="Validform_checktip" ></span>
                                    </td>&nbsp;&nbsp;
                                </tr>
                                <tr>
                                    <td> 
                                        <input type="button" rel="sendBtn" class="btn btn-orange" value="保  存">
                                        <!--<input class="btn btn-raed" type="submit" value="send">--> 
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
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/placeholders.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
    //表单验证控件
    Validform.int("#formBoxRegister");
    //初始化表单placeholders提醒
    //placeholders.int('formBoxRegister',true); 
    //优化提醒
    //clickTarget('#btnAdd',".addLimit");
    function addInput(str){
        var itme ='<tr><td style="width:10px;"><div class="inputBox"><input rel="name" name="Student[name][]" maxlength="10" class="sm" type="text" placeholder="输入姓名" >'
                +'<br/><span class="ValidTip Validform_checktip" >&nbsp;</span></div></td>'
                +'<td style="width:325px;"><div class="inputBox"><input rel="mobile" maxlength="11" name="Student[mobile][]" class="mediumL" type="text" placeholder="输入电话">'
                +'&nbsp;&nbsp;<a rel="btnDele" href="javascript:void(0);">删 除</a><br/><span class="tipB Validform_checktip" >&nbsp;</span></div></td><td></td></tr>';
        $(str).parents('tr').before(itme); 
        placeholders.int('formBoxRegister',true);
    } 
    //添加表单
    addInput('#btnAdd');
    var cuntFlag = 1;
    $('#btnAdd').click(function(){
        if(cuntFlag<10){ 
            addInput('#btnAdd'); 
            $(".addLimit").hide();
            cuntFlag++;
            $(".addLimit").hide();
        }else{
          $(".addLimit").show();
          $(".addLimit").find('span').text('一次最多只能添加10位学生！');
        }
        global.resizeH();
    });
    //删除表单
    $('[rel=btnDele]').live('click',function(){
        $(this).parents('tr').remove();
        cuntFlag--;
        $(".addLimit").hide();
        if(cuntFlag>0){
        }else{ 
            $(".addLimit").show();
            $(".addLimit").find('span').text('请至少添加一位学生！');
        }
    });
    $('input[rel=name]').live('focusout',function(e){
         $(".addLimit").hide();
         var rel = $(this).val(); 
         if(rel==""){
            $(this).parents('td').find('.ValidTip').addClass('Validform_wrong').text('姓名不能为空！');
         }else if(rel.length>10){ 
             $(this).parents('td').find('.ValidTip').addClass('Validform_wrong').text('只能输入10个字!'); 
         }else{
             $(this).parents('td').find('.ValidTip').removeClass('Validform_wrong').text('') ;
         } 
    });
    $('input[rel=mobile]').live('focusout',function(e){
         var rel = $(this).val();
         $(".addLimit").hide();
         //var eg =/^(\d{3})?\d{8}$/;
         var eg =/^((1)+\d{10})$/; 
         if(rel==""){
            $(this).parents('td').find('.tipB').addClass('Validform_wrong').text('电话号码不能为空！'); 
         }else if(eg.test(rel)&&rel.length==11){ 
            $(this).parents('td').find('.tipB').removeClass('Validform_wrong').text(''); 
         }else{ 
            $(this).parents('td').find('.tipB').addClass('Validform_wrong').text('电话号码格式不正确!'); 
         } 
    });
    $('[rel=sendBtn]').click(function(){
        var inputBox = $('#tableFormAdd');
        var eg =/^((1)+\d{10})$/;
        //var eg =/^(((13[0-9]{1})|159|153|156|186|(18[0-9]{1}))+\d{8})$/;
        var fNmae=0,fMobile=0;
        inputBox.find('input[rel=name]:visible').each(function(k,v){
            var rel = v.value; 
            if(rel==""){
                fNmae++;
               $(this).parents('td').find('.ValidTip').addClass('Validform_wrong').text('姓名不能为空！');
            }else if(rel.length>10){ 
                fNmae++;
                $(this).parents('td').find('.ValidTip').addClass('Validform_wrong').text('用户名只能输入10个字!'); 
            }else{
                 
            } 
        });
        inputBox.find('input[rel=mobile]:visible').each(function(k,v){
            var rel = v.value; 
            if(rel==""){
                fMobile++;
                $(this).parents('td').find('.tipB').addClass('Validform_wrong').text('电话号码不能为空！');
            }else if(eg.test(rel)&&rel.length==11){ 
            }else{
                fMobile++;
                $(this).parents('td').find('.tipB').addClass('Validform_wrong').text('电话号码格式不正确!');
            } 
        });
        if(fNmae>0||fMobile>0){ 
        }else{
            if(inputBox.find('input[rel=mobile]').length>0){
                $("#formBoxRegister").submit();
            }else{
               $(".addLimit").show();
               $(".addLimit").find('span').text('请至少添加一位学生！');
            }
            //$("#formBoxRegister").submit(); 
        } 
    }); 
 
});
</script>