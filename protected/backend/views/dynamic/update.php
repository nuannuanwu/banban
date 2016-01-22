<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/business/textareas.js"></script>
<div class="box">
<div class="form tableBox">
    <form method="post" id="business-form" action="<?php echo Yii::app()->createUrl('dynamic/'.($model->id?'update/'.$model->id:'create'));?>">
    <table class="tableForm">
        <thead></thead>
        <tbody>
        <tr>
            <td class="td_label">类型* ：</td>
            <td>
                <div style="display: inline;">
                    <select name="Dynamic[adtype]" id="selectsid" class="max" selectid="grade" > 
                        <?php foreach($typearr as $k=>$v):?>
                            <option value="<?php echo $k;?>" <?php if($model->adtype==$k) echo "selected='selected'";?>><?php echo $v;?></option>
                        <?php endforeach;?>

                    </select>
                </div>
                <span class="Validform_checktip "></span>
            </td>
        </tr>
        <tr>
            <td class="td_label">标题* ：</td>
            <td>
                <div style="display: inline;">
                   <input type="text" name="Dynamic[title]" value="<?php echo $model?$model->title:'';?>" datatype="*1-30"  nullmsg="动态标题不能为空！" errormsg="动态标题不能超过30个字！"/>
                </div>
                <span class="Validform_checktip ">此处限制30字以内</span>
            </td>
        </tr>
        <tr>
            <td class="td_label">摘要* ：</td>
            <td>
                <div style="display: inline;">
                    <input type="text" name="Dynamic[summery]" value="<?php echo $model?$model->summery:'';?>" datatype="*1-30"  nullmsg="动态摘要不能为空！" errormsg="动态摘要不能超过30个字！"/>
                </div>
                <span class="Validform_checktip ">此处限制30字以内</span>
            </td>
        </tr>

        <tr>
            <td class="td_label">图片* ：</td>
            <td>
                <div style="display: inline;">
                    <?php if(!$model->isNewRecord){ ?>
                        <!-- 编辑 修改-->
                        <div class="userPic fleft " style="width:90px;height:72px;vertical-align: middle;text-align: center;border: 1px solid #DBDBDA;">
                            <img style="vertical-align: middle;width:90px;height:72px;" id="uploadImg" src="<?php echo STORAGE_QINNIU_XIAOXIN_TX.$model->image;?>"  /><i style="display:inline-block;height:100%; vertical-align:middle;"></i>
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
                        <p>仅支持JPG，PNG格式上传<span id="mce-tip" class="Validform_checktip Validform_wrong" style="display:none;"></span></p>
                        <input type="hidden" id="domain" value="<?php echo STORAGE_QINNIU_XIAOXIN_TX; ?>">
                        <input type="hidden" id="uptoken_url"  value="<?php echo Yii::app()->request->baseurl;?>/index.php/ajax/gettoken?type=tx">
                        <a class="btn btn-default" id="pickfiles" href="#" >
                            <i class="glyphicon glyphicon-plus"></i>
                            <sapn>选择文件</sapn>
                        </a>
                    </div>
                    <input type="hidden" name="Dynamic[image]" id="file_upload_tmp" value='<?php echo $model->image;?>' data-val="<?php echo $imageFlag;?>" >
                </div>
            </td>
        </tr>
        <tr>
            <td class="td_label">内容* ：</td>
            <td>
                <div style="display: inline;"> 
                    <textarea name="Dynamic[addesc]" datatype="*"  nullmsg="动态内容不能为空！" errormsg=""><?php echo $model->addesc;?></textarea>
                </div>
                <span class="Validform_checktip "></span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <a href="javascript:void(0);" id="sub_from" class="btn btn-primary"><?php echo $model->isNewRecord ? '创 建' : '保 存'; ?></a>
                <?php //echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存',array('class'=>'btn btn-primary')); ?>
                <?php if(!$model->isNewRecord){ ?>
                    &nbsp;&nbsp;&nbsp;<a class="btn btn-default"  rel="deleLink" href="javascript:void(0);" data-href="<?php echo Yii::app()->createUrl('dynamic/delete/'.$model->id);?>">删 除</a>
                <?php } ?>
                <!--&nbsp;&nbsp; <input class="btn  btn-primary" type="reset" value="取 消">-->
                <!--&nbsp;&nbsp;<a href="javascript:void(0);" onclick="showPrompts('popupBox','Advertisement_title','Advertisement_text')" class="btn  btn-default"> 预 览 </a>-->
                <input type="hidden" name="id" value="<?php echo $model->id?$model->id:'';?>"/>
            </td>
        </tr>
        </tbody>
        <tfoot></tfoot>
    </table>
    </form>
</div><!-- form -->
</div>
<!-- 弹框 -->
<div class="popupBox">
    <div class="header">广告预览 <a href="javascript:void(0);" class="close" onclick="hidePormptMask('popupBox')" > </a></div>
    <div id="popupInfo">
    </div>
</div>
<div id="popupBox" class="popupBox">
    <div id="popupInfo" style="padding: 30px;">
        <div class="centent">温馨提示：是否删除当前动态？</div>
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
        updataLoadImg('adv','pickfiles','container');//上传图片
        $('#business-form').Validform({//表单验证
            tiptype:2,
            showAllError:true,
            postonce:true,
            datatype:{//传入自定义datatype类型 ;
                "tel-3" : /^(\d{3,4}-)?\d{7,8}$/
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
