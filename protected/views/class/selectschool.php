<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox">
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span> 我的班班 > 新建班级
        </div>
        <div class="box">
            <div class="listTopTite bBottom">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/xiaoxin/class_step_1.png">
            </div>
            <div class="formBox">
                <form id="formBoxRegister" action="" method="post">
                    <table class="tableForm">
                        <tbody>
                        <tr>
                            <td>
                                <span class="inputTitle">城　　市：</span>
                                <div class="inputBox"><input id="city"  name="city"  placeholder="请输入城市名称" value="" maxlength="20" class="lg" type="text" datatype="*1-20" nullmsg="请输入城市名称！" errormsg="城市名称不能大于20个字!"></div>
                                <span id="tipCheck" class="Validform_checktip"></span>
                                <div class="info" style="display: none;">城市名称不能大于20个字!<span class="dec"><s class="dec1">◆</s><s class="dec2">◆</s></span></div>
                                <input id="isOkType" type="hidden" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="inputTitle">学校名称：</span>
                                <div class="inputBox"><input id="schoolname" name="schoolname"  placeholder="请输入学校名称" value="" maxlength="20" class="lg" type="text" datatype="*1-20" nullmsg="请输入学校名称！" errormsg="学校名称不能大于20个字!"></div>
                                <span id="tipCheck" class="Validform_checktip"></span>
                                <div class="info" style="display: none;">学校名称不能大于20个字!<span class="dec"><s class="dec1">◆</s><s class="dec2">◆</s></span></div>
                                <input id="isOkType" type="hidden" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="inputTitle">类　　型：</span>
                                <div class="inputBox">
                                    <?php $i=0; foreach($schooltype as $val):?> 
                                    <input rel="schooltypeCheck" stid="<?php echo $val->stid;?>"  id="checkbox_<?php echo $i;?>"  name="stid[]" value="<?php echo $val->stid;?>" type="checkbox"><label for="checkbox_<?php echo $i;?>"><?php echo $val->name;?></label>
                                    <?php $i++; endforeach;?> 
                                </div>
                                <span class="Validform_checktip" ></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="gradesClass" >
                                <span class="inputTitle">年　　级：</span>
                                <div class="inputBox"> 
                                    <?php $i=0; foreach($grades as $val):?>
                                    <input id="grades_<?php echo $i;?>" style="display:none;" class="grades_<?php echo $val->stid;?>" stid="<?php echo $val->stid;?>" value="<?php echo $val->gid;?>" type="radio" name="grade"><label style="display:none;" class="grades_<?php echo $val->stid;?>" for="grades_<?php echo $i;?>"><?php echo $val->name;?></label>
                                    <?php $i++;endforeach;?> 
                                </div>
                                <span class="Validform_checktip" ></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <!--<span class="inputTitle" style="margin-left: 69px;"></span>-->
                                <a id="submitBtn" href="javascript:;" class="btn btn-orange">下一步</a>
                                <!--<a id="submitBtn" href="javascript:;" class="btn btn-orange">下一步</a>-->
                                <!--<input type="submit" class="btn btn-raed"  value="下一步">-->
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
    $(function() {
        //表单验证控件
        //Validform.int("#formBoxRegister");
        $('#className').keydown(function(){
            $('#tipCheck').removeClass('Validform_wrong').text('');
        });
        
        //显示年级
        $('[rel=schooltypeCheck]').change(function(){
            var _this=$(this),stid =_this.attr('stid');
            if(_this.attr('checked')=="checked"){ 
                $('.grades_'+stid).show();
            }else{
                $('.grades_'+stid).hide();
            }
        });
        //提交
        $('#submitBtn').click(function(){
            var cname = $.trim($('#city').val());
            var schoolname = $('#schoolname').val();
            if(cname!=''){
                if(schoolname!=''){ 
                    $("#formBoxRegister").submit();
                }else{
                    $('#tipCheck').removeClass('Validform_right').addClass('Validform_wrong').text('请从输入学校名称');
                }
            }else{
                $('#tipCheck').removeClass('Validform_right').addClass('Validform_wrong').text('请输入城市名称');
            }
        });

        $("#class_school").change(function(){
            $("#school_grade").html("<option value=''>--选择年级--</option>");
            var sid = $(this).val();
            var url = $(this).attr("rel");
            if(sid){
                $.ajax({
                    url:url,
                    type : 'POST',
                    data : {sid:sid},
                    dataType : 'text',
                    contentType : 'application/x-www-form-urlencoded',
                    async : false,
                    success : function(mydata) {
                        var show_data =mydata;
                        $("#school_grade").html(show_data);
                    },
                    error : function() {
                        // alert("calc failed");
                    }
                });
            }
        });

    });
</script>
