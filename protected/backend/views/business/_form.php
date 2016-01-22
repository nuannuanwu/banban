<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/business/textareas.js"></script>
<div class="box">
    <div class="form tableBox" style="min-width:1440px;">
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
            <thead></thead>
            <tbody>
                
            

                <tr>
                    <td class="td_label">商家名称*：</td>
                    <td>
                        <div style="display: inline;"> 
                            <?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>30,'datatype'=>'*1-15','nullmsg'=>'商家名称不能为空！','errormsg'=>'商家名称长度不能大于15个字！')); ?>
                            <?php echo $form->error($model,'name'); ?>
                        </div>
                        <span class="Validform_checktip ">此处限制15字以内</span>
                    </td>
                </tr>
                <tr>
                    <td class="td_label">商家类型 ：</td>
                    <td>
                        <div style="display: inline;"> 
                            <?php echo $form->dropDownList($model,'mall',Business::getMallDataArr(),array()); ?>
                            <?php echo $form->error($model,'mall'); ?>
                        </div>
                        <span class="Validform_checktip "></span>
                    </td>
                </tr>
                <tr>
                    <td class="td_label">商家LOGO*：</td>
                    <td>
                        <?php if(!$model->isNewRecord){ ?>
                              <div class="userPic fleft " style="width:130px;height:100px;vertical-align: middle;text-align: center;border: 1px solid #DBDBDA;">
                                <img style="vertical-align: middle;width: 130px;height:100px;" id="uploadImg" src="<?php echo $model->logo;?>"  /><i style="display:inline-block;height:100%; vertical-align:middle;"></i>
                            </div>          
                        <?php }else{ ?>
                              <div class="userPic fleft " style="width:130px;height:100px;vertical-align: middle;text-align: center;border: 1px solid #DBDBDA;">
                                <img style="vertical-align: middle;width: 130px;height:100px;" id="uploadImg" src=""  /><i style="display:inline-block;height:100%; vertical-align:middle;"></i>
                            </div>          
                        <?php }?>        
                        <div class="userBtnBox" style="margin-left: 140px;">
                         <!--    <p>你可以选择一张png/jpg图片（180*180）作为头像</p>
                            <div id="filePopule">
                                <input type="file" name="Account[phototmp]" id="fileUserPic" class="btn" value="相册选择">
                            </div> -->
                            <div id="container" >
                                <p>仅支持JPG，PNG格式上传（130*100）<span id="mce-tip" class="Validform_checktip Validform_wrong" style="display:none;"></span></p>
                                <input type="hidden" id="domain" value="<?php echo STORAGE_QINNIU_XIAOXIN_TX; ?>">
                                <input type="hidden" id="uptoken_url"  value="<?php echo Yii::app()->request->baseurl;?>/index.php/ajax/gettoken?type=tx">
                                <a class="btn btn-default" id="pickfiles" href="#" >                                    
                                    <i class="glyphicon glyphicon-plus"></i>
                                    <sapn>选择文件</sapn>
                                </a>
                            </div>
                            <input type="hidden" name="Business[logo]" id="file_upload_tmp" value='' data-val="<?php echo $imageFlag;?>" >
                        </div>
                     
                    </td>
                </tr>
                <tr>
                    <td class="td_label">商家大图*：</td>

                     <td>
                        <div class="userBtnBox" style="margin-bottom:20px;">
                            <div id="big-container" >
                                <a class="btn btn-default" id="big-pickfiles" href="#" >                                    
                                    <i class="glyphicon glyphicon-plus"></i>
                                    <sapn>选择文件</sapn>
                                </a>
                                 <span>建议图片比例为640*300，仅支持JPG，PNG格式上传</span><span id="big-tip" class="Validform_checktip Validform_wrong" style="display:none;"></span>
                            </div>
                            <input type="hidden" name="Business[image]" id="big-fileupload" value='' data-val="<?php echo $imageFlag;?>" >
                        </div>
                         <?php if(!$model->isNewRecord){ ?>
                              <div class="userPic fleft " style="width:644px;height:304px;vertical-align: middle;text-align: center;border: 0px solid #DBDBDA;">
                                <img style="vertical-align: middle;width: 640px;height:400px;" id="big-uploadImg" src="<?php echo $model->image;?>"  /><i style="display:inline-block;height:100%; vertical-align:middle;"></i>
                            </div>          
                        <?php }else{ ?>
                              <div class="userPic fleft " style="width:644px;height:304px;vertical-align: middle;text-align: center;border: 0px solid #DBDBDA;">
                                <img style="vertical-align: middle;width:640px;height:300px;" id="big-uploadImg" src=""  /><i style="display:inline-block;height:100%; vertical-align:middle;"></i>
                            </div>          
                        <?php }?>      
                    </td>
                 
                </tr>
                 <tr>
                    <td class="td_title_Long">分店信息*：</td>
                    <td class="search">
                    </td>
                </tr>
                <tr>
                    <td class="td_title_Long"></td>
                    <td class="search formList">
                        <ul class="partSub partSuc">
                         <?php if(isset($subs) && count($subs)): ?>
                                <?php foreach($subs as $sub): ?>
                            <li>
                                <div style="display: inline;"> 
                               
                                    <span class="laberName">名称：</span>
                                    <input type="text" name="Business[Sub][subname][]" value="<?php echo $sub->name; ?>" class="input-small"  maxlength="50" datatype="*" nullmsg="名称不能为空！">
                                    <span class="span1 laberName">地址：</span>
                                    <input type="text" name="Business[Sub][subaddress][]" value="<?php echo $sub->address; ?>" style="width:260px;" maxlength="100" >
                                    <span class="span1 laberName" style="width:80px;">联系电话：</span>
                                    <input type="text" name="Business[Sub][subphone][]"  value="<?php echo $sub->phone; ?>" class="input-xsmall"  maxlength="20" datatype="*"  nullmsg="联系电话不能为空！" errormsg="请输入正确的联系电话！"  >
                                     <a href="javascript:;" class="btn btn-primary" rel="delPart" <?php if(count($subs)==1): ?>style="display:none;"<?php endif; ?>>删除</a>
                                </div>
                                <span class="Validform_checktip Validform_phone"></span>
                            </li>     
                        <?php endforeach; ?>
                        <?php else: ?> 
                            <li>
                                <div style="display: inline;"> 
                                    <span class="laberName">名称：</span>
                                    <input type="text" name="Business[Sub][subname][]" class="input-small" datatype="*" nullmsg="名称不能为空！" maxlength="50">
                                    <span class="span1 laberName">地址：</span>
                                    <input type="text" name="Business[Sub][subaddress][]" class="input-large" style="width:260px;" maxlength="100">
                                    <span class="span1 laberName" style="width:80px;">联系电话：</span>
                                    <input type="text" name="Business[Sub][subphone][]" class="input-xsmall" maxlength="20" datatype="*" nullmsg="联系电话不能为空！" errormsg="请输入正确的联系电话！" >
                               
                                    <a href="javascript:;" class="btn btn-primary" rel="delPart" style="display:none;">删除</a>
                                </div>
                                <span class="Validform_checktip Validform_phone"></span>
                            </li>
                          <?php endif; ?>  
                        </ul>
                        <a href="#" class="btn btn-primary add-btn" rel="addPart">添加</a> 
                    </td>
                </tr>
                <tr>
                    <td class="td_label">负责人*：</td>
                    <td>
                        <div style="display: inline;">
                            <?php echo $form->textField($model,'contacter',array('style'=>'width: 200px;','size'=>30,'maxlength'=>20,'datatype'=>'*','nullmsg'=>'负责人不能为空！','errormsg'=>'')); ?>
                            <?php echo $form->error($model,'contacter'); ?>
                        </div>
                        <span class="Validform_checktip "></span>
                    </td>
                </tr>
                <tr>
                    <td class="td_label">企业电话*：</td>
                    <td>
                        <div style="display: inline;">
                            <?php echo $form->textField($model,'phone',array('style'=>'width: 200px;','size'=>30,'maxlength'=>20,'datatype'=>'*','nullmsg'=>'企业电话不能为空！','errormsg'=>'请输入正确企业电话（手机号或电话）')); ?>
                            <?php echo $form->error($model,'phone'); ?>
                        </div>
                        <span class="Validform_checktip "></span>
                    </td>
                </tr> 
                <tr>
                    <td class="td_label">商家地址：</td>
                    <td>
                        <div style="display: inline;">
                            <?php echo $form->textField($model,'address',array('size'=>50,'maxlength'=>50)); ?>
                            <?php echo $form->error($model,'address'); ?>
                        </div>
                        <span class="Validform_checktip "></span>
                    </td>
                </tr>
                <tr>
                    <td class="td_label">商家介绍：</td>
                    <td>
                        <div style="display: inline;">
                            <?php echo $form->textArea($model,'introduction',array('style'=>'height:200px;','rows'=>10, 'cols'=>63,)); ?>
                            <?php echo $form->error($model,'introduction'); ?>
                        </div>
                        <span class="Validform_checktip "></span>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td> 
                        <?php echo CHtml::submitButton($model->isNewRecord ? '创 建' : '保 存',array('class'=>'btn btn-primary', 'id'=> 'busbtn')); ?>
                        <?php if(!$model->isNewRecord){ ?>
                            &nbsp;&nbsp;
                            <a class="btn btn-default"  href="javascript:void(0);" onclick="showPromptsIfonWeb('#popupBoxRemind')"> 删 除 </a>
                        <?php } ?>
                    </td>

                </tr>

            </tbody>
            <tfoot></tfoot>
        </table> 
        <?php $this->endWidget(); ?> 
     </div><!-- form -->
    <div id="popupRemind">
        <div id="popupBoxRemind" class="popupBox" style=" width: 420px; height: 230px; margin-top: 0;">
            <div class="header">删除提醒 <a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#popupBoxRemind')" > </a></div> 
            <div class="remindInfoBox">
                <div style="height: 65px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;温馨提醒，
                    <?php if(!$model->canDeleted()){ echo '该商家所关联的商品,合同,广告,热点以及资讯内容正在使用中，请先确认上述相关联内容已删除，再进行删除商家操作。 ';} else {echo '是否删除该商家';}?>
                </div>  
            </div>
            <div style="text-align: center; margin-top:20px;">
                <?php if(!$model->canDeleted()){ ?>
                    <a class="btn btn-primary" href="javascript:void(0);" onclick="hidePormptMaskWeb('#popupBoxRemind')" >取消</a>
                <?php }else{?>
                    <a class="btn btn-primary"  href="<?php echo Yii::app()->createUrl('business/delete/'.$model->bid);?>">确定</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;  <a class="btn btn-default" href="javascript:void(0);" onclick="hidePormptMaskWeb('#popupBoxRemind')">取消</a>
                <?php }?>
            </div> 
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
    //预览图
    function preview(file){ 
        var preview = $("#"+file.id).attr('rel'); 
        var prevDiv = document.getElementById(preview);
        var perHtml = prevDiv.innerHTML; 
        var size = file.size / 1024;  
        if(size>10){
            alert("附件不能大于10M");
        }else{ 
            var filepath = file.value;  
            var re = /(\\+)/g; 
            var filename=filepath.replace(re,"#"); 
            var one=filename.split("#"); 
            var two=one[one.length-1]; 
            var three=two.split("."); 
            var last=three[three.length-1]; 
            var tp ="jpg,JPG,png,PNG";
            var rs=tp.indexOf(last); 
            if(rs>=0){
                if (file.files && file.files[0]){ 
                var reader = new FileReader();
                reader.onload = function(evt){
                prevDiv.innerHTML = '<img src="' + evt.target.result + '" />';
                }	  
                reader.readAsDataURL(file.files[0]);
            }else { 
                prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';
            }
            }else{
                file.value = '';
                prevDiv.innerHTML = perHtml;
                alert("您选择的上传文件不是有效的图片文件！");
                return false;
            }
        } 
    }
     
    $(function(){
        updataLoadImg('business','pickfiles','container');//上传图片
        updataLoadImg('big-busin','big-pickfiles','big-container');//上传图片
       
        $('#business-form').Validform({//表单验证
            tiptype:2,
            showAllError:true,
            ignoreHidden:true,
            postonce:true,
            datatype:{//传入自定义datatype类型 ; 
                "tel-3" : /^(\d{3,4}-)?\d{7,8}$/,
                'phone':function(gets,obj,curform,regxp){
                    var reg=/^((1)+\d{10})$/;
                    //var urls=obj.data('href');
                    // var errmsg=obj.attr('errormsg');
                    if(reg.test(gets)){  
                        return true;
                    }else{ 
                       return false;
                    }
                }
            }
        }); 

        $('#busbtn').on('click',function(){
            var val=$('#file_upload_tmp').attr('data-val');
            var bigVal=$('#big-fileupload').attr('data-val');
             if (val != '0') {
                 if (bigVal !='0') {
                     $('#business-form').submit();
                 }else{
                    $('#big-tip').text('请选择商家大图').show();
                    return false;
                 }
                
             }else{
                $('#mce-tip').text('请选择商家logo').show();
                return false;
             }
            

        })
         //删除操作
        $(document).on('click', 'a[rel=delPart]', function(event) {
            var liDe=$(this).parents('ul').find('li');
            if (liDe.length == 2) {
                liDe.find('a[rel=delPart]').hide();
            }
            $(this).parents('li').remove();
        });  

        //添加操作
        $(document).on('click', 'a[rel=addPart]', function(event) {
            var html=$(this).parent().find('li');
            if (html.length == 0) {
                html.find('[rel=delPart]').hide();
            }else{
                html.find('[rel=delPart]').show();
            };
            $(this).prev().append($(html[0]).clone());
            if($(this).prev().hasClass('partSuc')){
                $('.partSuc li').last().find('input[type=text]').val('');
            }
        }); 
    }); 
</script>

</div>