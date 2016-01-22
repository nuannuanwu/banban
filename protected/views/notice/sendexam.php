<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/send.css'); ?>">
<style>
    #examcid {
        color: #999;
    }
    #examcid option {
        color: #000;
    }
    .tip{
       color:#f59201;
    }
</style>
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox"> 
        <div class="senNavbox">
            <ul class="applicationList bBttomT">
               <li>
                    <div class="applicationItme">  
                        <a rel="noticetypeBtn" href="<?php echo Yii::app()->createUrl('/notice/send?noticetype=').Constant::NOTICE_TYPE_1;?>" noticetype="<?php echo Constant::NOTICE_TYPE_1;?>">
                            <span class="fleft sendPic" ><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app1.png"/></span>
                            <span class="send-info applicationTitle">布置作业 </span>
                            <span class="send-info applicationInfo">给学生布置作业</span>
                            <!--<span class="navIco"></span>-->
                        </a> 
                    </div>
                </li>
                <li>
                    <div class="applicationItme">  
                        <a rel="noticetypeBtn" href="<?php echo Yii::app()->createUrl('/notice/send?noticetype=').Constant::NOTICE_TYPE_2;?>" noticetype="<?php echo Constant::NOTICE_TYPE_2;?>">
                            <span class="fleft sendPic"><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app2.png"/></span>
                            <span class="send-info applicationTitle">通知家长 </span>
                            <span class="send-info applicationInfo">给家长发送通知</span>
                            <!--<span class="navIco"></span>-->
                        </a>
                    </div>
                </li>
                <li>
                    <div class="applicationItme">
                        <a rel="noticetypeBtn" href="<?php echo Yii::app()->createUrl('/notice/send?noticetype=').Constant::NOTICE_TYPE_3;?>" noticetype="<?php echo Constant::NOTICE_TYPE_3;?>">
                            <span class="fleft sendPic"><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app4.png"/></span>
                            <span class="send-info applicationTitle">在校表现</span>
                            <span class="send-info applicationInfo">学生在班级的表现</span>
                            <!--<span class="navIco"></span>-->
                        </a>  
                    </div>
                </li>
                <li>
                    <div class="applicationItme">
                        <a rel="noticetypeBtn" href="javascript:;" class="focus" noticetype="<?php echo Constant::NOTICE_TYPE_3;?>">
                            <span class="fleft sendPic"><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app5.png"/></span>
                            <span class="send-info applicationTitle">发布成绩</span>
                            <span class="send-info applicationInfo">发布学生考试成绩</span> 
                            <span class="new">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/notice/new_ioc.png"/>
                            </span>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="applicationItme">
                        <?php $userinfo=Yii::app()->user->getInstance();?>
                        <?php if($userinfo&&$userinfo->teacherauth==2):?>
                            <a rel="noticetypeBtn" href="<?php echo Yii::app()->createUrl('/notice/schoolnotice');?>"  noticetype="<?php echo Constant::NOTICE_TYPE_5;?>">
                        <?php else:?>
                            <a rel="teacherauthBtn" href="javascript:;" onclick="showPromptPush('#teacherauthBox')" >
                        <?php endif;?> 
                            <span class="fleft sendPic"><img width="80%" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/app/app6.png"/></span>
                            <span class="send-info applicationTitle">紧急通知</span>
                            <span class="send-info applicationInfo">发送紧急短信通知</span>
                            <!--<span class="navIco"></span>-->
                        </a>
                    </div>
                </li> 
            </ul>
        </div>
        <div class="box" style="max-width:860px; min-height: 720px;">

            <form class="formBox" id="form1" method="post" action="<?php echo Yii::app()->createUrl('/notice/exampreview');?>">
                <div class="form-group">
                    <label for="class"></label>
                    <div style="display: inline;">
                        <a href="javascript:;" onclick="showPromptsRemind('#mediaplayerBox')" style=" font-size: 16px; text-decoration: underline;">新版成绩发布视频教程</a>
                    </div> 
                </div>
              
                <div class="form-group">
                    <label for="class">发送给:</label>
                    <div style="display: inline;">
                        <select name="cid" style="color:#999;" id="examcid" datatype="*" nullmsg="请选择班级" errormsg="请选择班级">
                            <option value="">请选择班级</option>
                            <?php foreach($classs as $val):?>
                                <option <?php if($params['cid']==$val->cid) echo "selected='selected'";?>   hasemoji="<?php echo $hasemoji[$val->cid]?'1':'0';?>" value="<?php echo $val->cid;?>" ecid="<?php echo BaseUrl::encode($val->cid);?>">
                                    <?php echo $val->name.'  '.($val->tSchool&&$val->tSchool->name?("（".$val->tSchool->name."）"):'');?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <span class="Validform_checktip"></span>
                    <span id="selectTplTips" style="margin-left: 10px;color: red;"></span>
                </div>
                <h2 class="send-common-head">〓 考试类型</h2>
                <!-- <div class="form-group">
                    <label for="class">科目:</label>
                    <div style="display: inline;">
                        <input style="width:300px;" type="text" value="<?php echo $params['examsubject'];?>" id="inputsubject" name="Exam[examsubject]" data-type="1"  datatype="subject" data-limit="200" nullmsg="请输入考试科目" placeholder="多科目请用逗号分隔，如：语文，数学，外语"/>
                    </div>
                    <span class="Validform_checktip"></span>
                    <span id="selecsubjectTplTips" style="margin-left: 10px;color: red;"></span>
                </div> -->
                <div class="form-group">
                    <label for="class">类型:</label>
                    <div style="display: inline;">
                        <select name="examtype" id="examtype" datatype="*" nullmsg="请选择考试类型" errormsg="请选择考试类型">
                            <!--<option value="">请选择</option>-->
                            <?php foreach($examtypes as $k=>$val):?>
                            <option value="<?php echo $k;?>" <?php if($params['examtype']==$k) echo "selected='selected'";?>
                               ><?php echo $val;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <span class="Validform_checktip"></span>
                </div>
                <div class="form-group">
                    <label for="class">名称:</label>
                    <div style="display: inline;">
                        <input id="examname" type="text" value="<?php echo $params['examname'];?>" name="exammame" data-type="2" maxlength="20" datatype="subject" nullmsg="请输入考试名称" style="width: 300px;" placeholder="请输入考试名称"/>
                    </div>
                    <span class="Validform_checktip"></span>
                </div>
                <div class="form-group">
                    <label for="date">时间:</label>
                    <div style="position: relative;display: inline;">
                        <input id="examdate"  name="examdate" value="<?php echo $params['examdate']?$params['examdate']:date("Y-m-d");?>" datatype="*" nullmsg="请选择考试日期" type="text" style="width: 140px;" onClick="WdatePicker({readOnly: true,maxDate:'%y-%M-%d'})"/>
                        <img src="/js/banban/My97DatePicker/skin/datePicker.gif" width="16" height="22" align="absmiddle" style="position:absolute;top:0;right:12px;cursor:pointer;" onclick="WdatePicker({el:'date',maxDate:'%y-%M-%d'})">
                    </div>
                    <span class="Validform_checktip"></span>
                </div>
                <h2 class="send-common-head">〓 导入成绩</h2>
                <p>将成绩单按照模板<a class="red" id="downloadtemplate" href="#">（下载模板）</a>,保存后上传Excel文件（xls）即可。</p>
                <p style="color:#e66805;">（提示：如果您已有现成的学生成绩excel表格， 请先确保样式与如下示意图一致后，也可以直接上传）</p>
                <table class="score-template">
                    <thead>
                        <tr>
                            <th>姓名</th>
                            <th><p>科目1名称</p><p style="font-weight: normal;">（不超过8个字符）</p></th>
                            <th><p>科目2名称</p><p style="font-weight: normal;">（不超过8个字符）</p></th> 
                            <th><p>...</p><p style="font-weight: normal;"> </p></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="name">张XX</td>
                            <td class="phone">100</td>
                            <td class="phone">85</td>
                            <td class="phone">...</td>
                        </tr>
                        <tr>
                            <td class="name">王XX</td>
                            <td class="phone">70</td>
                            <td class="phone">80</td> 
                            <td class="phone">...</td>
                        </tr> 
                    </tbody>
                </table>
                <div class="clearfix" id="containers">
                    <p class="select-file" >选择Excel文件上传 <span style="color:#e66805;">（如果您在该文字下方看见黑框或空白，请更换浏览器重试）</span></p>
                    <div id="filePopule" class="btn btn-orange" style="display: inline-block; width:120px; text-align: center;color: #ffffff;">请选择文件</div>
                    <span id="fileNameK" class="popFile" style="display:none; margin-left: 10px;" >未选择文件</span>
                    <div style=" padding-top: 20px;">
                        <p><span id="upFileLoading" class="Validform_checktip Validform_loading" style=" display: none;" > 正在上传文件...</span></p>
                        <!--<div id="upFileInt" class="Validform_checktip Validform_wrong" style=" clear: both; margin-top: 10px; " >该浏览器没有开启flash插件,导致文件上传功能不可用，请开启flash插件或换浏览器</div>-->
                    </div>
                </div>
                <div class="send-action clearfix" >
                    <a class="btn btn-default" id="sendexam" tip="1" href="javascript:void(0)">立刻上传</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="teacherauthBox" class="popupBox">
    <div class="header">提示<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#teacherauthBox')" > </a></div>
    <div class="remindInfo" >
        <div  class="centent" style="color: #000000;">只有通过“教师认证”，才能使用“紧急通知”功能。请先在班班手机客户端上申请“教师认证”。</div>
    </div>
    <div class="popupBtn">
        <a  href="javascript:void(0);" onclick="hidePormptMaskWeb('#teacherauthBox')" class="btn btn-orange">确 定</a>
    </div>
</div>
<div id="uploaderErorrBox" class="popupBox">
    <div class="header">提示<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#uploaderErorrBox')" > </a></div>
    <div class="remindInfo" >
        <div id="upErorrInf"  class="centent" style="color: #000000;"> </div>
    </div>
    <div class="popupBtn">
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#uploaderErorrBox')"; class="btn btn-orange">确 定</a>
    </div>
</div> 

<div id="templateReminBox" class="popupBox">
    <div class="header">提示<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#templateReminBox')" > </a></div>
    <div class="remindInfo" >
        <div class="centent" style="color: #000000;">
            有学生姓名含有表情符号，无法匹配姓名，表中已自动删除。需要家长修改学生姓名后，才可发送成绩
        </div>
    </div>
    <div class="popupBtn">
        <a id="downErorrBnt"  href="javascript:void(0);"  class="btn btn-orange">确定下载</a>
    </div>
</div>
<div id="isclickReminBox" class="popupBox">
    <div class="header">新版提示<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#isclickReminBox')" > </a></div>
    <div class="remindInfo" >
        <div class="centent" style="color: #000000; text-indent: 0;">
            “发布成绩”功能有重要体验优化！请点击查看视频教程。
        </div>
    </div>
    <div class="popupBtn">
        <a href="javascript:void(0);" onclick="hidePormptMaskWeb('#isclickReminBox');showPromptsRemind('#mediaplayerBox')" class="btn btn-orange">查看视频教程</a>
        <a href="javascript:;" class="btn btn-default" onclick="hidePormptMaskWeb('#isclickReminBox')">稍后查看</a>
    </div>
</div>
<div id="mediaplayerBox" class="popupBox" style="width:660px"> 
    <div class="remindInfo" style="position:request; padding:0;"> 
        <a id="hideMediaPlay" class="" href="javascript:;"  style=" display: inline-block; position: absolute; right: -21px; top:-16px; width:21px; height: 20px; background:url('/image/banban/activity/colse2.png'); "></a>
        <div id="mediaplayer">正在加载...</div>
    </div> 
</div>

<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/My97DatePicker/WdatePicker.js'); ?>" type="text/javascript"></script>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/api/plupload-2.1.2/js/plupload.full.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo MainHelper::AutoVersion('/js/banban/flash/js/cyberplayer.min.js'); ?>"></script>
<script type="text/javascript">
    function    HTMLDeCode(str)
    {
        var    s    =    "";
        if    (str.length    ==    0)    return    "";
        s    =    str.replace(/&gt;/g,    ">");
        s    =    s.replace(/&lt;/g,        " <");
        s    =    s.replace(/&nbsp;/g,        "    ");
        s    =    s.replace(/'/g,      "\'");
        s    =    s.replace(/&quot;/g,      "\"");
        s    =    s.replace(/ <br>/g,      "\n");
        return    s;
    }
    $(function() {
        //$('#examcid').children().css({color : "#000"});
        var isclick="<?php echo $isclick;?>"; 
        if(isclick=='0'){
            //弹窗视频 
            showPromptsRemind('#isclickReminBox');
        } 
        Validform.int("#form1");// 表单验证
        var cid=0;
        var fileSiz = 0, sname = "", flagT=0; // fileSiz 是否选着上传文件
        var userid = "<?php echo Yii::app()->user->id; ?>";

        //发布成绩
        $("#sendexam").click(function() { 
            var tip = $(this).attr('tip');
            var examcid = $("#examcid").val();

            var examName = $.trim($('#examname').val());
            if(examcid != ''&&examName != ''){
                if(tip=='0'){
                    if(fileSiz > 0){
                        uploader.start(); 
                    }else{ 
                        $("#fileNameK").text('请先选择文件上传').css({'color':'red'}); 
                    }
                }else{
                    $("#fileNameK").text('请先选择文件上传').css({'color':'red'}); 
                }   
            }else{
                setTimeout(function(){
                    $('#form1').submit();
                },200);

            } 
            
            return false;
        }); 

        //全校验
        var uploadurl = "<?php echo Yii::app()->createUrl('/notice/scheck?uid=');?>"+userid;

        //下载模板
        $("#downloadtemplate").click(function() {
            var cid = $("#examcid").val(); 
            var ecid = $("#examcid").find('option:selected').attr('ecid');
            var hasemoji = $("#examcid").find('option:selected').attr('hasemoji');
            var tips = $('#selectTplTips');
            var subjecttips = $('#selecsubjectTplTips');
            if (cid == "") {
                tips.removeClass('hidden').text("请选择班级再下载模板!");
                return false;
            } else {
                tips.text('').addClass('hidden');
                var url="<?php echo Yii::app()->createUrl('/notice/download?cid=');?>";
                url=url+ecid;
                if(hasemoji=='1'){ 
                    $('#downErorrBnt').attr('url',url);
                    showPromptsRemind('#templateReminBox');  
                 }else{
                    window.open(url,"windName");
                 }
            }  
            //url=url+"&subject="+encodeURIComponent(subject); 
        });
        //关闭 下载模板弹框 并下载模板
        $('#downErorrBnt').click(function(){ 
            var url=$(this).attr("url");
            window.open(url,"windName");
            hidePormptMaskWeb('#templateReminBox');
        });

        $('#examcid').change(function() {
            var that = $(this);
            var tips = $('#selectTplTips');
            if (!tips.hasClass('hidden')) {
                tips.addClass('hidden');
            }
            if (that.val() == "") {
                that.css({color : "#999"});
            } else {
                that.css({color : "#000"});
            }
            cid=$("#examcid").val();
            //uploadurl =uploadurl+"&cid="+$("#examcid").val();
        });


        var plbaseurl="<?php echo Yii::app()->request->baseUrl; ?>"+"/js/api/plupload-2.1.2";
        var num=0;
        var uploader = new plupload.Uploader({
            runtimes : 'html5,html4,flash,html4',
            browse_button : 'filePopule', // you can pass in id...
            container: document.getElementById('containers'), // ... or DOM Element itself
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
                        // document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                        $("#fileNameK").text('').append('<span>'+file.name+'</span>');
                        num++;
                        fileSiz++;
                        //uploader.start();
                    });
                    $("#sendexam").attr('tip','0');
                    $("#sendexam").addClass('btn-orange').removeClass('btn-default');
                },

                UploadProgress: function(up, file) { 
                    // document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                    $('#upFileLoading').show();
                    $("#sendexam").addClass('btn-default').removeClass('btn-orange');
                    $("#sendexam").attr('tip','1');
                },

                Error: function(up, err) {
                    if(window.console&&console.log){
                        //console.log("\nError #" + err.code + ": " + err.message);
                    }
                },
                BeforeUpload:function(){
                    uploader.settings.url =  uploader.settings.url+'&cid='+cid;
                },
                FileUploaded:function(uploader,file,data){
                    uploader.refresh();
                    $("#file_upload_tmp").val(data);
                    if(window.console&&console.log){console.log(data);}
                    var returnvalue,rev;
                    $("#sendexam").attr('tip','0');
                    if(data&&data.response){
                        returnvalue=data.response;
                        if(typeof returnvalue=='string'){
                                rev=jQuery.parseJSON(returnvalue);
                        }else if(typeof returnvalue=='object') {
                            rev=returnvalue;
                        }
                        //console.log(rev);
                        if(rev&&rev.status=='1'){
                            //alert('上传成功到下一页');
                            var url="<?php echo Yii::app()->createUrl('/notice/exampreview?cid=');?>";
                            url=url+ $("#examcid").val();
                            url+="&examdate="+$("#examdate").val();
                            url+="&examtype="+$("#examtype").val();
                            url+="&examname="+$("#examname").val();
                            location.href=url;
                        }else{
                            $('#upFileLoading').hide();
                            //上传失败，有错误，show errors
                            var msg=rev.msg||'服务器出错';
                            //alert(msg);//显示错误
                           // console.log(HTMLDeCode(msg));
                            $('#upErorrInf').html(msg);
                            showPromptsRemind('#uploaderErorrBox');
                        }
                    }
                }
            }
        });


        uploader.init(); 
    });


</script>

<script type="text/javascript">
    $(function () {
        var player = cyberplayer("mediaplayer").setup({
            flashplayer: '<?php echo Yii::app()->request->baseUrl; ?>/js/banban/flash/player/cyberplayer.flash.swf',
            image: 'http://7sbkpq.com2.z0.glb.qiniucdn.com/bb_exam_bg.jpg',
            file: "http://7sbkpq.com2.z0.glb.qiniucdn.com/bb_exam_1.MP4",
            width: 660,//播放器宽
            height: 458,//播放器高
            ak: "8qVrRbmH8lodYEjY5RDei768",
            sk: "jaN3zQZnUphKOyxU"
        });
        $('#hideMediaPlay').click(function(){
            hidePormptMaskWeb('#mediaplayerBox');
            player.pause()
        })
        
    });
     
</script>


