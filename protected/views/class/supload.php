<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
        <div class="titleHeader bBttomT">
            <span class="icon icon1"></span> 我的班班 > <?php echo $class->name; ?> > 添加学生
        </div>
        <div class="box">
             <div class="formBox">
                <div class="classTableBox invtesBox"> 
                    <form id="formBoxRegister" action="<?php echo Yii::app()->createUrl('/class/scheck/'.$class->cid);?>" method="post"> 
                        <table class="tableForm" id="tableFormAdd" style="margin-top: 0;">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="classStitle">
                                           一键导入学生
                                        </div>
                                        <div class="danwonInfo">请选择包含学生及家长、关注人手机号的 Excel 文件上传。 <br/>班级学生总人数不得超过100人。</div>
                                        <!--<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/xiaoxin/ecxelErpIco.png">-->
                                    </td> 
                                </tr> 
                                <!--<tr> <td style="color:#f59201;">提示：所有班级成员（老师加学生，包含自己）一共不得超过100人</td>  </tr>--> 
                            </tbody>
                        </table>
                        <table class="tableForm" style=" width: 820px; margin-top: 30px;">
                            <tbody> 
                                <tr>
                                    <td>  
                                        <div id="filePopule" class="" >
                                            <input id="fileExcle" type="button" class="btn btn-orange" style=" width: 100px; float: left;" class="file" name="upload_students" multiple="true" value="上传文件">
                                            <div class="PopFile" style=" height:50px;"> 
                                                <span class="danwonInfo" style=" color:#f59201; ">（<a href="<?php echo Yii::app()->request->baseUrl.'/template'.'/一键导入学生模板.xls';?>">下载模板</a>）</span>
                                                <span id="upFileLoading" class="Validform_checktip Validform_loading" style="display: none" > 正在上传文件...</span>
                                            </div>
                                            <div id="fileNameK" style=" font-size: 12px; color: #999999;">未选择文件 </div>
                                        </div>  
                                        <span class="Validform_checktip Validform_wrong fileFormTip" style="display: none">上传的文件没有数据或数据格式不正确，请在模板中重新编辑后再上传</span>
                                        
                                        <div id="upFileInt" class="Validform_checktip Validform_wrong" style=" display:none;clear: both; margin-top: 10px; " >该浏览器没有开启flash插件,导致文件上传功能不可用，请开启flash插件或换浏览器</div>
                                        <div id="upFileNext"class="Validform_checktip Validform_wrong"  style="display: none; background: none; padding-left: 0; clear: both;">点击下一步上传文件，进行下一步操作</div>
                                    </td>
                                </tr>
                                <tr><td></td></tr>
                            </tbody>
                            <tbody id="previewBoxTbody" style=" display: none;">
                                <tr>
                                    <td>
                                        <div class="classStitle">
                                            预览：
                                            <div id="previewError" class="danwonInfo" style=" margin-top: 10px; display: none; color:#f59201; ">(对于表格右侧有错误的整行数据，将不做导入。请检查表格，重新上传，否则将自动过滤。)</div>
                                        </div>
                                        <div id="previewTable" style=" display: none;">
                                            <table  class="table table-bordered" style="margin-top: 20px;">
                                                <thead>
                                                    <tr align="center">
                                                        <th>学生姓名</th>
                                                        <th>家长手机</th>
                                                        <th>关注人1手机</th>
                                                        <th>关注人2手机</th>
                                                        <th>关注人3手机</th>
                                                        <th>关注人4手机</th>
                                                        <th><span style="color:#f59201">正确性检查</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="datatable" class="previeTbody"> 
                                                </tbody>
                                            </table>
                                            <div id="btnSendBox" style=" padding-top: 10px;">
                                                <a rel="sendBtn" href="<?php echo Yii::app()->createUrl('class/simport/'.$class->cid);?>" class="btn btn-orange">立刻导入学生</a>
                                                <p>&nbsp;</p>
                                               <div class="danwonInfo">导入时将会自动给家长及关注人注册班班账号。</div>
                                            </div> 
                                            <div id="btnSendBox1" style=" display:none; padding-top: 10px;">
                                                <a href="javascript:;" class="btn" style="background:#cccccc; color:#999999;">立刻导入学生</a>
                                                <p>&nbsp;</p>
                                               <div class="danwonInfo">导入时将会自动给家长及关注人注册班班账号。</div>
                                            </div>
                                        </div>
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
<script src="<?php echo MainHelper::AutoVersion('/js/api/plupload-2.1.2/js/plupload.full.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
   //表单验证控件
    Validform.int("#formBoxRegister");
    var fileSiz=0,sname="",flagT=0; 
    //file上传 控件
    var userid = "<?php echo Yii::app()->user->id; ?>";
    var url = "<?php echo Yii::app()->createUrl('/class/scheck?cid='.$class->cid);?>&uid="+userid;
    var uploadurl = "<?php echo Yii::app()->createUrl('/class/scheck?cid='.$class->cid.'&userid=');?>"+userid;
    var plbaseurl="<?php echo Yii::app()->request->baseUrl; ?>"+"/js/api/plupload-2.1.2";
    var num=0;
    var classnum='<?php echo $classnum;?>'; //原来班级学生数
    var uploader = new plupload.Uploader({
        runtimes : 'html5,html4,flash,html4',
        browse_button : 'fileExcle', // you can pass in id...
        container: document.getElementById('filePopule'), // ... or DOM Element itself
        url : uploadurl,
        flash_swf_url : plbaseurl+'/js/Moxie.swf',
        silverlight_xap_url : plbaseurl+'/js/Moxie.xap',

        filters : {
            max_file_size : '10mb',
            mime_types: [
                {title : "Image files", extensions : "xls,xlsx"}
            ]
        },

        init: {
            PostInit: function() {
                //$('#upFileInt').hide();
                $("#filePopule").show();
                $("#fileNameK").show();
            },

            FilesAdded: function(up, files) {
                plupload.each(files, function(file) { 
                    $("#fileNameK").text('').show().append('<span>'+file.name+'</span>'); 
                    num++;
                    fileSiz++;
                }); 
                uploader.start();
            },

            UploadProgress: function(up, file) { 
                $('#upFileLoading').show(); 
            },

            Error: function(up, err) {
                if(window.console&&console.log){
                    console.log("\nError #" + err.code + ": " + err.message);
                }
            },
            FileUploaded:function(uploader,file,data){
                $('#upFileLoading').hide();
                $('#datatable').html('');
                var total= 0,successtotal=0;//总学生数，总成功数 
                //console.log(typeof data.response);
                if(data&&data.response){ 
                    var response=data.response;
                    if(typeof response=='string'){
                        var studentdata=jQuery.parseJSON(response);
                        var str=[];   
                        if(studentdata.data.length>0){
                            $.each(studentdata.data,function(i,obj){
                                    total++;//当前导入人数
                                    str.push('<tr>');
                                    if(obj.error==0){
                                        successtotal++;
                                    }
                                    if(obj.errorfile&&obj.errorfile==1){
                                        str.push('<td>'+obj.name+'<p class="error">('+obj.msg+')</p></td>');
                                    }else{
                                        str.push('<td>'+obj.name+'</td>');
                                    }
                                    if($.trim(obj.mobile)==':X'){
                                        str.push('<td>'+'<p class="error">(手机号未填)</p></td>');
                                    }else{
                                        if(obj.mobile.split(":").length>1){
                                            str.push('<td>'+obj.mobile.replace(':X','')+'<p class="error">(格式有误)</p></td>');
                                        }else{
                                            str.push('<td>'+obj.mobile+'</td>');
                                        }
                                    }
                                    if(obj.mobile2.split(":").length>1){
                                        str.push('<td>'+obj.mobile2.replace(':X','')+'<p class="error">(格式有误)</p></td>');
                                    }else{
                                        str.push('<td>'+obj.mobile2+'</td>');
                                    }
                                    if(obj.mobile3.split(":").length>1){
                                        str.push('<td>'+obj.mobile3.replace(':X','')+'<p class="error">(格式有误)</p></td>');
                                    }else{
                                        str.push('<td >'+obj.mobile3+'</td>');
                                    }
                                    if(obj.mobile4.split(":").length>1){
                                        str.push('<td  >'+obj.mobile4.replace(':X','')+'<p class="error">(格式有误)</p></td>');
                                    }else{
                                        str.push('<td class="">'+obj.mobile4+'</td>');
                                    }
                                    if(obj.mobile5.split(":").length>1){
                                        str.push('<td>'+obj.mobile5.replace(':X','')+'<p class="error">(格式有误)</p></td>');
                                    }else{
                                        str.push('<td>'+obj.mobile5+'</td>');
                                    }
                                    if(obj.msg){
                                        str.push('<td><span class="msgError">本行数据有误，将不做导入</span></td>'); 
                                    }else{
                                        str.push('<td><span class="msgRight">'+obj.msg+'</span></td>'); 
                                    }
                                    str.push('</tr>');
                                    if(obj.error== '1'){
                                        $("#previewError").text('(对于表格中有错误提示的整行数据，将不做导入。请检查表格，重新上传，否则将自动过滤。)').show();
                                    }
                            });
                           
                            if(parseInt(successtotal)<100){
                                if(parseInt(studentdata.oldnum)+successtotal<=100){
                                    $('#datatable').html(str.join(''));
                                    $('#previewTable').show();
                                    $('#btnSendBox').show();
                                    $('#btnSendBox1').hide();
                                }else{
                                    $('#btnSendBox1').show();
                                    $('#btnSendBox').hide();
                                    $('#previewTable').hide(); 
                                    $("#previewError").text('(当前班级已有'+studentdata.oldnum+'名学生，最多只能再导入'+(100-parseInt(studentdata.oldnum))+'名。表格学生数已超出，请检查后重新导入)').show();
                                }
                            }else{
                                $('#previewTable').hide();
                                $("#previewError").text('表格学生数已超过100人，请检查后重新导入').show();
                            }
                            if(parseInt(successtotal)==0){
                                $("#previewError").text('(对于表格中有错误提示的整行数据，将不做导入。请检查表格，重新上传，否则将自动过滤。)').show();
                                $('#btnSendBox').hide();
                                $('#btnSendBox1').show(); 
                                $('#previewTable').show();
                            }
                        }else{
                            $('#previewTable').hide();
                            $("#previewError").text('没有找到数据').show();
                        } 
                    }
                    $("#previewBoxTbody").show();

                }
                               // var fdata=JSON.parse(data);

                
            }
        }
    });
    uploader.init();

    //提交文件
//    $('[rel=sendBtn]').click(function(){ 
//        $("#upFileNext").hide(); 
//        if(fileSiz>0){
//            $('#fileExcle').uploadify('upload','*');  
//        }else{
//            $("#upFileNext").text('请先选择上传文件').show();
//        } 
//    });
});
</script>

