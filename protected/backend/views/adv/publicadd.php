<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/business/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/business/textareas.js"></script>
<div class="box">
    <div class="form tableBox">
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'business-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation'=>false,
            'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    )); ?> 
        <?php echo $form->errorSummary($model); ?>
        <table class="tableForm"> 
            <tbody>
                <tr>
                    <td class="td_label" style="width: 20px;">广告标题* ：</td>
                    <td>
                        <div style="display: inline;"> 
                            <?php echo $form->textField($model,'title',array('size'=>25,'maxlength'=>30,'datatype'=>'*1-30','nullmsg'=>'广告标题不能为空！','errormsg'=>'广告标题不能超过30个字！')); ?>
                            <?php echo $form->error($model,'title'); ?>
                        </div>
                        <span class="Validform_checktip ">此处限制30字以内</span>
                    </td>
                </tr>
                <tr>
                    <td class="td_label">广告摘要 ：</td>
                    <td>
                        <div style="display: inline;"> 
                            <?php echo $form->textField($model,'summery',array('size'=>20,'maxlength'=>256,'ignore'=>'ignore','datatype'=>'*1-30','nullmsg'=>'广告摘要不能为空！','errormsg'=>'广告摘要不能超过30个字！')); ?>
                            <?php echo $form->error($model,'summery'); ?>
                        </div>
                        <span class="Validform_checktip ">此处限制30字以内</span>
                    </td>
                </tr>
                <tr>
                    <td class="td_label">外链地址*：</td>
                    <td>
                        <div style="display: inline;"> 
                            <?php echo $form->textField($model,'url',array('size'=>30,'maxlength'=>256,'datatype'=>'url', 'nullmsg'=>'链接地址不能为空！','errormsg'=>'请输入正确的链接地址！')); ?>
                            <?php echo $form->error($model,'url'); ?>
                        </div>
                        <span class="Validform_checktip"></span>
                    </td>
                </tr>
                <tr>
                    <td class="td_label">起止日期* ：</td>
                    <td>
                        <input rel="datatimeinput" readonly="readonly"   onclick="WdatePicker({maxDate:&quot;#F{$dp.$D('Advertisement_enddate')||'2080-10-01'}&quot;,dateFmt:&quot;yyyy-MM-dd&quot;})" style="width: 180px; height:auto;" class="Wdate" name="Advertisement[startdate]" id="Advertisement_startdate" type="text"> 
                                                            &nbsp;至&nbsp;
                        <input rel="datatimeinput" readonly="readonly"   onclick="WdatePicker({minDate:&quot;#F{$dp.$D('Advertisement_startdate')}&quot;,maxDate:&quot;2080-10-01&quot;,dateFmt:&quot;yyyy-MM-dd&quot;})" style="width: 180px; height:auto;" class="Wdate" name="Advertisement[enddate]" id="Advertisement_enddate" type="text">                                 
                    </td>
                </tr>
                <tr>
                    <td class="td_label">点击上限* ：</td>
                    <td>
                        <div style="display: inline;"> <input name="Advertisement[click]" id="Advertisement_click"  datatype="numb11" nullmsg='点击上限不能为空！' errormsg='点击上限不能超过11位数且只能为正整数' type="text" value="<?php echo isset($data['click'])?$data['click']:''; ?>"></div>
                        <span class="Validform_checktip"></span>
                    </td>
                </tr>
                <tr>
                    <td  class="td_label">广告图片* ：</td>
                    <td>
                        <div style="display: inline;">
                            <?php if(!$model->isNewRecord){ ?>
                                <!-- 编辑 修改-->
                                  <div class="userPic fleft " style="width:90px;height:72px;vertical-align: middle;text-align: center;border: 1px solid #DBDBDA;">
                                    <img style="vertical-align: middle;width:90px;height:72px;" id="uploadImg" src="<?php echo $model->image;?>"  /><i style="display:inline-block;height:100%; vertical-align:middle;"></i>
                                </div>   
                             <?php }else{ ?>
                                 <div class="userPic fleft " style="width:90px;height:72px;vertical-align: middle;text-align: center;border: 1px solid #DBDBDA;">
                                    <img style="vertical-align: middle;width:90px;height:72px;" id="uploadImg" src=""  /><i style="display:inline-block;height:100%; vertical-align:middle;"></i>
                                </div>
                            <?php }?>
                          
                        </div>
                        
                        <div class="userBtnBox" style="margin-left: 100px;">
                         <!--    <p>你可以选择一张png/jpg图片（180*180）作为头像</p>
                            <div id="filePopule">
                                <input type="file" name="Account[phototmp]" id="fileUserPic" class="btn" value="相册选择">
                            </div> -->
                            <div id="container" >
                                <p>仅支持JPG，PNG格式上传（16:9）<span id="mce-tip" class="Validform_checktip Validform_wrong" style="display:none;"></span></p>
                                <input type="hidden" id="domain" value="<?php echo STORAGE_QINNIU_XIAOXIN_TX; ?>">
                                <input type="hidden" id="uptoken_url"  value="<?php echo Yii::app()->request->baseurl;?>/index.php/ajax/gettoken?type=tx">
                                <a class="btn btn-default" id="pickfiles" href="#" >                                    
                                    <i class="glyphicon glyphicon-plus"></i>
                                    <sapn>选择文件</sapn>
                                </a>
                            </div>
                            <input type="hidden" name="Advertisement[image]" id="file_upload_tmp" value='' data-val="<?php echo $imageFlag;?>" >
                        </div>
                    </td> 
                </tr>
                <tr>
                    <td  class="td_label">内容 ：</td>
                    <td>
                        <div style="display: inline;">
                            <?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50,'nullmsg'=>'内容不能为空！','errormsg'=>'')); ?>
                            <?php echo $form->error($model,'text'); ?>
                        </div>
                        <span class="Validform_checktip "></span>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td> 
                        <a href="javascript:void(0);" id="sub_from" class="btn btn-primary">创 建</a>
                        <?php //echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存',array('class'=>'btn btn-primary')); ?>
                        <?php if(!$model->isNewRecord){ ?>
                            &nbsp;&nbsp;&nbsp;<a class="btn btn-default" rel="deleLink" href="javascript:void(0);" data-href="<?php echo Yii::app()->createUrl('business/delete/'.$model->bid);?>">删 除</a>
                        <?php } ?>
                         &nbsp;&nbsp;<a href="javascript:void(0);" onclick="showPrompts('popupBoxs','Advertisement_title','Advertisement_text')" class="btn  btn-default">预 览</a>
                    </td> 
                </tr>
            </tbody>
            <tfoot></tfoot>
        </table> 
        <?php $this->endWidget(); ?> 
     </div><!-- form -->
<div class="popupBox popupBoxs">
    <div class="header">广告预览 <a href="javascript:void(0);" class="close" onclick="hidePormptMask('popupBox')" > </a></div>
    <div id="popupInfo">  
    </div> 
</div>
<div id="popupBox" class="popupBox">
    <div id="popupInfo" style="padding: 30px;">
        <div class="centent">温馨提示：是否删除当前广告？</div>
    </div>
    <div style="text-align: center;">
        <a id="isOk" href="" class="btn btn-primary">确定</a> &nbsp;&nbsp;
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#popupBox');" class="btn btn-default">取消</a>
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/business/popupVeiw.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/xiaoxin/qiniu/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/xiaoxin/qiniu/js/plupload/plupload.full.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/xiaoxin/qiniu/js/plupload/i18n/zh_CN.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/xiaoxin/qiniu/js/ui.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/xiaoxin/qiniu/js/qiniu.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/xiaoxin/qiniu/js/highlight/highlight.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/xiaoxin/qiniu/js/main.js"></script> 
    <script type="text/javascript">
         //删除提醒
        $('[rel=deleLink] ').click(function () {
            var urls = $(this).data('href');
            $("#isOk").attr('href', urls);
            showPromptsIfonWeb('#popupBox');
        });
//        //提交验证
//        $("#sub_from").click(function(){
//            tinyMCE.triggerSave(true); 
//            $("#business-form").submit();
//        });
//        //预览图
//        function preview(file){ 
//            var preview = $("#"+file.id).attr('rel'); 
//            var prevDiv = document.getElementById(preview);
//            var perHtml = prevDiv.innerHTML; 
//            var size = file.size / 1024;  
//            if(size>10){
//                alert("附件不能大于10M");
//            }else{ 
//                var filepath = file.value;  
//                var re = /(\\+)/g; 
//                var filename=filepath.replace(re,"#"); 
//                var one=filename.split("#"); 
//                var two=one[one.length-1]; 
//                var three=two.split("."); 
//                var last=three[three.length-1]; 
//                var tp ="jpg,JPG,png,PNG";
//                var rs=tp.indexOf(last); 
//                if(rs>=0){
//                    if (file.files && file.files[0]){ 
//                    var reader = new FileReader();
//                    reader.onload = function(evt){
//                    prevDiv.innerHTML = '<img src="' + evt.target.result + '" />';
//                    }	  
//                    reader.readAsDataURL(file.files[0]);
//                }else { 
//                    prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';
//                }
//                }else{
//                    file.value = '';
//                    prevDiv.innerHTML = perHtml;
//                    alert("您选择的上传文件不是有效的图片文件！");
//                    return false;
//                }
//            } 
//        } 
        $(function(){
             updataLoadImg('adv','pickfiles','container');//上传图片
            $('#business-form').Validform({//表单验证
                tiptype:2,
                showAllError:true, 
                postonce:true,
                datatype:{//传入自定义datatype类型 ; 
                    "tel-3" : /^(\d{3,4}-)?\d{7,8}$/,
                    'numb11':/^[1-9]\d{0,10}|0$/ 
                }
            });  
            //提交验证
            $("#sub_from").click(function(){
                 var val=$('#file_upload_tmp').attr('data-val');
                 if (val != '0') {
                     tinyMCE.triggerSave(true);
                     $('#business-form').submit();
                 }else{
                    $('#mce-tip').text('请选择广告图片').show();
                    return false;
                 }
            });
        }); 
    </script>
</div>