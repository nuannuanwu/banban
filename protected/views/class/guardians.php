<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox">
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班 > 查看关注人
        </div>
        <div class="box">
            <nav class="navMod">
                <a href="<?php echo Yii::app()->createUrl('class/'.$action.'/'.$class->cid); ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
            </nav>
            <div class="formBox">
                <div class="classTableBox invtesBox" style="overflow: hidden; min-height: 500px;">
                    <form id="formBoxRegister" action="" method="post" onkeydown="javascript:return gosearch();">
                        <table class="tableForm" id="tableFormAdd" style="overflow: hidden;">
                            <tbody>
                                <tr  style="width:100px; ">
                                    <td style="width:100px; vertical-align: top; ">
                                        <span class="title">孩子姓名：</span>
                                    </td>
                                    <td style="width:160px;" colspan="3">
                                        <div class="inputBox">
                                            <span style="display: inline-block; height: 36px; line-height: 36px;"><?php echo $childinfo['name'];?></span>
                                            <input type="hidden" class="sm" name="cid" value="<?php echo $class->cid;?>" />
                                        </div>
                                        <span style="margin-left: 0;"class="Validform_checktip"></span>
                                    </td>
                                </tr>
                                <?php foreach($guardians as $k => $guardian):?>
                                <tr>
                                    <td style="vertical-align: top; " >
                                        <?php if($k==0):?>
                                        <span class="title">家　　长：</span>
                                        <?php else:?>
                                        <span class="title">关&nbsp;&nbsp;注&nbsp;&nbsp;人：</span>
                                        <?php endif;?>
                                    </td>
                                    <td style="width:160px;">
                                        <div class="inputBox">
                                            <?php if($k==0):?>
                                            <?php if( 0==$gtype):?><input type="text"  name="firstrole" maxlength="10" value="<?php echo $guardian->role;?>" style="width: 160px;"/><?php else: echo $guardian->role; endif;?>
                                            <input type="hidden" name="firstid" value="<?php echo $guardian->id;?>"/>
                                            <?php else:?>
                                            <?php echo $guardian->role;?>
                                            <?php endif;?>
                                        </div>
                                        <br/>
                                        <span>&nbsp;</span>
                                    </td>
                                    <td style="width:385px;">
                                        <div class="inputBox" style="width:160px;">
                                            <input type="text" readonly="readonly " value="<?php echo $guardian->guardian0->mobilephone;?>" style="width: 160px;border:none;"/>&nbsp;
                                          <!--   <span style="display:inline-block;width:165px;"><?php echo $guardian->guardian0->mobilephone;?></span> -->
                                            <?php if($k!=0):?>
                                            <!--<a href="<?php echo Yii::app()->createUrl('/class/delguardian/'.$guardian->id.'?cid='.$class->cid."&childid=".$childinfo->userid);?>">删除</a>-->
                                            <?php endif;?>
                                        </div>
                                        <br/>
                                        <span>&nbsp;</span>
                                   </td>
                                   <td></td>
                                </tr>
                                <?php endforeach;?>
                                <tr>
                                    <td></td>
                                    <td>
                                        <!--<a  href="javascript:void(0);" id="btnAdd" class="btn btn-default" >再添加一个</a>-->
                                    </td>
                                    <td>
                                        <div class="addLimit" style="display: none;"><span class="Validform_checktip Validform_wrong" >一次最多只能添加10位学生</span> </div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php if( 0==$gtype):?><a href="javascript:void(0);" rel="sendBtn" style="font-size: 16px;" class="btn btn-orange">保  存</a><?php endif;?>
                                        <!--<input type="button" rel="sendBtn" style="font-size: 16px;" class="btn btn-orange" value="保  存">-->
                                        <input type="hidden" id="guardiansLen" value="<?php echo count($guardians);?>">
                                    </td>
                                     <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="guardian-list" style="display: none;">
                            <li><span class="guardian-label">孩子姓名：</span><div style="display: inline-block;"><span style="display: inline-block;margin-top: 8px;"><?php echo $childinfo['name'];?></span></div></li>
                            <?php foreach($guardians as $k=>$guardian):?>
                            <li><?php if($k==0):?>
                                    <span class="guardian-label">家　　长：</span>
                                <?php else:?>
                                    <span class="guardian-label">关&nbsp;&nbsp;注&nbsp;&nbsp;人：</span>
                                <?php endif;?>
                                <div style="position: relative;display: inline-block;width: 380px;">
                                    <?php if($k==0):?>
                                        <span><?php echo $guardian->role;?></span><span>（<?php echo $guardian->guardian0->mobilephone;?>）</span>
                                    <?php else:?>
                                        <span class="guardian"><?php echo $guardian->role;?></span><span>（<?php echo $guardian->guardian0->mobilephone;?>）</span>
                                        <!--<a class="class-attr-edit modify" href="javascript:;"></a>-->
                                    <?php endif;?>
                                </div>
                            </li>
                            <?php endforeach;?>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modifyBox" class="modify-box noHide" style="display: none;">
    <h6 class="modify-title noHide">我是Ta的：</h6>
    <input class="modify-input noHide" name="" type="text"/>
    <div class="modify-action noHide">
        <a class="btn btn-orange doModify" href="javascript:;">确&nbsp;&nbsp;定</a>
    </div>
</div>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/placeholders.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
    $('.modify').click(function(event) {
        var _this = $(this);
        var box = $('#modifyBox');
        box.show();
        var wL = (_this.offset().left+25)+'px';
        var hT = (_this.offset().top+5)+'px';
        box.css({left:wL,top:hT});
        box.find('.modify-input').val($(this).prevAll('.guardian').text());
        event.stopPropagation();
    });
    clickTarget('.noHide' ,'#modifyBox');//用户优化体验
    $('.doModify').click(function() {
        var val = $(this).parent().prev().val();
        var urlStr="";
        $.ajax({
            url: urlStr,
            type: "POST",
            dataType: "JSON",
            success: function() {
                $(this).parents('.modify-box').addClass('hidden');
            },
            error: function() {

            }
        });
    });

    //表单验证控件
    Validform.int("#formBoxRegister");
    //初始化表单placeholders提醒
    //placeholders.int('formBoxRegister',true);
    //优化提醒
    //clickTarget('#btnAdd',".addLimit");
    function addInput(str,cuntFlag){
        var itme ='<tr><td style="vertical-align: top;"><span class="title">家　　属：</span></td><td style="width:10px;"><div class="inputBox"><input rel="name" style="width: 160px;" name="Student[name][]" maxlength="10" class="sm" type="text" placeholder="称谓" >'
                +'<br/><span class="ValidTip Validform_checktip" >&nbsp;</span></div></td>'
                +'<td style="width:325px;"><div class="inputBox"><input rel="mobile" maxlength="11" name="Student[mobile][]"  type="text" placeholder="手机号" style="width: 160px;">'
                +'&nbsp;&nbsp;<a rel="btnDele" href="javascript:void(0);">删 除</a><br/><span class="tipB Validform_checktip" >&nbsp;</span></div></td><td></td></tr>';
        $(str).parents('tr').before(itme);
        placeholders.int('formBoxRegister',true);
    }
    //添加表单
    var glen =parseInt($('#guardiansLen').val());
    var cuntFlag = 1;
    // addInput('#btnAdd',cuntFlag);
    $('#btnAdd').click(function(){
         if((cuntFlag+glen)<=5){
            addInput('#btnAdd',cuntFlag+1);
            $(".addLimit").hide();
            cuntFlag++;
            $(".addLimit").hide();
         }else{
          $(".addLimit").show();
          $(".addLimit").find('span').text('最多只能添加4位家属！');
        }
        global.resizeH();
    });

    //删除表单
    $('[rel=btnDele]').live('click',function(){
        $(this).parents('tr').remove();
        cuntFlag--;
        $(".addLimit").hide();
//        if(cuntFlag>0){
//        }else{ 
//            $(".addLimit").show();
//            $(".addLimit").find('span').text('请至少添加一位监护人！');
//        }
    });
    $('input[rel=name]').live('focusout',function(e){
         $(".addLimit").hide();
         var rel = $(this).val();
         if(rel==""){
            $(this).parents('td').find('.ValidTip').addClass('Validform_wrong').text('称谓不能为空！');
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
               $(this).parents('td').find('.ValidTip').addClass('Validform_wrong').text('称谓不能为空！');
            }else if(rel.length>10){
                fNmae++;
                $(this).parents('td').find('.ValidTip').addClass('Validform_wrong').text('称谓只能输入10个字!');
            }else{

            }
        });
        inputBox.find('input[rel=mobile]:visible').each(function(k,v){
            var rel = v.value;
            if(rel==""){
                fMobile++;
                $(this).parents('td').find('.tipB').addClass('Validform_wrong').text('手机号码不能为空！');
            }else if(eg.test(rel)&&rel.length==11){
            }else{
                fMobile++;
                $(this).parents('td').find('.tipB').addClass('Validform_wrong').text('电话号码格式不正确!');
            }
        });
        if(fNmae>0||fMobile>0){
        }else{
            $("#formBoxRegister").submit();
            //$("#formBoxRegister").submit();
        }
    });
});
</script>