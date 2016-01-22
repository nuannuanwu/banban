<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span>我的班班 > <?php echo $class->name; ?> > 添加老师
        </div>
        <div class="box">
             <div class="formBox">
                <div class="classTableBox invtesBox"> 
                    <form id="formBoxRegister" action="<?php echo Yii::app()->createUrl('/class/tcheck/'.$class->cid);?>" method="post">
                        <table class="tableForm" id="tableFormAdd">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="classInfoTitle">
                                            〓 编写Excel电子表格 
                                        </div>
                                        <div class="danwonInfo">将通讯录按照模板（<a href="<?php echo  Yii::app()->request->baseUrl.'/template'.'/批量邀请老师模版.xls';?>">下载模板</a>）进行整理，保存后上传Excel文件（xls）即可。</div>
                                        <!--<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/xiaoxin/ecxelErpIco.png">-->
                                    </td> 
                                </tr> 
                                 <tr>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="color:#f59201;">提示：所有班级成员（老师加学生，包含自己）一共不得超过100人</td>
                                </tr>
                                <tr>
                                    <td></td>
                                </tr> 
                            </tbody>
                        </table>
                        <table class="tableForm">
                            <tbody> 
                                <tr>
                                    <td>
                                        <div class="classInfoTitle bTop" style="padding-top:10px; line-height: 40px; height: 40px;  ">
                                        〓 选择Excel文件上传
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 
                                        <div id="filePopule" class="" style="display:inline;"><input id="fileExcle" style="display:none;" class="file" name="upload_students" multiple="true"></div>
                                        <div id="fileNameK" class="PopFile" style="display:none;" >未选择文件</div> 
                                        <p>&nbsp;</p>
                                        <span class="Validform_checktip Validform_wrong fileFormTip" style="display: none">上传的文件没有数据或数据格式不正确，请在模板中重新编辑后再上传</span>
                                        <span id="upFileLoading" class="Validform_checktip Validform_loading" style="display: none" > 正在上传文件...</span> 
                                        <div id="upFileInt" class="Validform_checktip Validform_wrong" style="clear: both; margin-top: 10px; " >该浏览器没有安装flash插件,导致文件上传功能不可用，请安装flash插件或换浏览器</div> 
                                        <div id="upFileNext"class="Validform_checktip Validform_wrong"  style="display: none; background: none; padding-left: 0; clear: both;">点击下一步上传文件，进行下一步操作</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>&nbsp;</p>
                                        <a rel="sendBtn" href="javascript:void(0);" class="btn btn-orange">预览名单</a> 
<!--                                        <a class="btn btn-default" href="<?php echo Yii::app()->createUrl('/banban/class/students/'.$class->cid);?>" >返回</a> -->
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
<link href="<?php echo MainHelper::AutoVersion('/js/banban/uploadify/uploadify.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/uploadify/jquery.uploadify.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
   //表单验证控件
    Validform.int("#formBoxRegister");
    var fileSiz=0,sname="",flagT=0;
    //file上传 控件
    var userid = "<?php echo Yii::app()->user->id; ?>";
    var url = "<?php echo Yii::app()->createUrl('/class/tcheck?cid='.$class->cid);?>&uid="+userid;
    $("#fileExcle").uploadify({ 
        'height'        :'32',
        'width'         :'100',
        'removeTimeout' : 0,
        'overrideEvents':['onUploadProgress'],
        'buttonImage' : '<?php echo Yii::app()->request->baseUrl; ?>/image/banban/feilBtnBg1.jpg',
        'buttonText'    : '选择Excel文件 ', 
        'fileSizeLimit'     : '10MB', 
        'fileTypeExts'      : '*.xls;*.xlsx',
        'swf'           : '<?php echo Yii::app()->request->baseUrl; ?>/js/banban/uploadify/uploadify.swf',
        'uploader'      : url,
        'folder'        : '<?php echo Yii::app()->request->baseUrl; ?>/storage/uploads',
        'removeCompleted': true,
        'debug':false,
        'auto': false,
        'onInit'   : function(instance) {
            $('#upFileInt').hide();
            $("#filePopule").show();
            $("#fileNameK").show();
            $("#fileExcle").show();  
        },
        'onUploadSuccess':function(file, data, response){ 
            $("#file_upload_tmp").val(data);
            $("#upFileNext").text('').hide();
            $('#upFileLoading').hide();
            if(data=='0'){
                $('.fileFormTip').show();
                flagT=1;
            }else{
                window.location="<?php echo Yii::app()->createUrl('class/timport/'.$class->cid);?>";
            }
        }, 
        'onUploadStart' : function(file){ 
            $('#upFileLoading').show();
        }, 
        'onSelect' : function(file) { 
            if(sname==file.name){ 
            }else{
               if((fileSiz!=0)&&(flagT==0)){  
                 $('#fileExcle').uploadify('cancel','SWFUpload_0_'+fileSiz-1); 
                }else{
                   flagT=0; 
                }
                sname=file.name;
            } 
            $("#fileNameK").text('').append('<span>'+file.name+'</span>');
            $('.fileFormTip').hide(); 
            $("#upFileNext").text('点击预览名单上传文件，进行下一步操作').show();
             fileSiz++;
        }
    });
    //提交文件
    $('[rel=sendBtn]').click(function(){ 
        $("#upFileNext").hide(); 
        if(fileSiz>0){
            $('#fileExcle').uploadify('upload','*');  
        }else{
            $("#upFileNext").text('请先选择上传文件').show();
        } 
    });
});
</script>

