<style>
    .bgImgBox{  width: 600px; *width: 760px; margin-bottom: 30px; }
    a.inviteBtn{ display: inline-table;  }
    a.inviteBtn:hover{ opacity: 0.9; }
    a.linkColor{color: #993300; vertical-align: 0px;}
    a.linkColor:hover{ text-decoration: underline;} 
</style>
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
       <div class="titleHeader bBttomT">
            <span class="icon icon8"></span>邀请有礼
        </div>
        <div class="box">
            <nav class="navMod" style="border-bottom: none; font-size: 13px; line-height: 40px; width: 70%;">
                <div><b>奖励规则：</b></div>
                <p style="line-height: 22px;">1.每成功邀请推荐一名老师或家长用户注册班班，邀请者最高可得10元班费卡；</p>
                <p style="line-height: 22px;"> 2.被邀请的老师如果完成班班“教师认证”，邀请者可另外再得10元班费卡。</p> 
            </nav> 
            <div style="margin-top: 20px; color: #EB6A05;"><b>请选择推荐方式：</b></div> 
            <div style=" position: relative; margin: 20px 0 0 0px;"> 
                <div class="bdsharebuttonbox" style="display: inline-block; *display: inline;" data-tag="share_1">
                    <a href="javascript:;" style=" background-image: none; width: 360px;  *width: 320px;font-size: 16px; height: 40px; line-height: 26px; *line-height: 40px; text-align: center; color: #fff;   text-indent: 0em;" rel="shareShow" tip="0" class="btn btn-orange" data-cmd="sqq"><img style=" display: inline-block; height: 22px; vertical-align: bottom;" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/qico.png" />　QQ分享</a>
                </div> 
            </div>
            <div class="bgImgBox" style=" background: none;">
                <div class="formBox">
                    <form id="formBoxRegister" action="<?php echo Yii::app()->createUrl('invite/send'); ?>" method="post"> 
                        <table class="tableForm">
                            <tbody>  
                                    <tr>
                                        <td>
                                            <p style=" font-size: 20px;text-align: center; margin-right:280px; line-height: 25px; ">
                                                 发邀请短信
                                            </p>
                                        </td> 
                                    </tr>
                                    <tr>
                                    <td>
                                        <span class="inputTitle"style=" float: left; margin-top: 7px;">收件人：</span>
                                        <div style="position: relative; margin-left:70px; zoom: 1; ">
                                            <div class="inputBox" style=" display: block; position: relative;"> 
                                                <textarea id="className" style="position: relative; z-index: 2; width: 280px; height: 120px; background:none; line-height: 18px;"  rows="7" cols="11" name="mobile"  placeholder="" datatype="*" nullmsg="请输入手机号！" onfocus="plasInpt('className','webPlatext');"  onblur="plastt('className','webPlatext');"></textarea>
                                                 <div onmousedown="hideThis('webPlatext');" id="webPlatext" style="display: block; position: absolute; width: 280px; top:0; left: 1%; font-size: 13px;  line-height:22px; color: #827c7c;z-index: 1;">请输入手机号,每行只能输入一个手机号,示例：<br/> 1378XXX8001 <br/>139XXXX1221<br/>159XXXX7578</div>


                                            </div> 
                                            <span id="tipCheck" class="Validform_checktip" style=" margin-left:0px;">&nbsp;</span>   
                                        </div>
                                    </td>
                                </tr>
                                 <!--
                                <tr> 
                                    <td style=" padding: 0px;">
                                        <span class="inputTitle"style=" float: left;margin-top: 7px;"> </span>
                                        <span style=" color: #EB6A05;">（对外短信）</span>
                                    </td>
                                </tr>
                                -->
                                <tr>
                                    <td style=" padding-top: 0px;">
                                        <span class="inputTitle"style=" float: left;margin-top: 7px;">内 容：</span>
                                        <div style=" margin-left:70px; word-wrap: break-word; word-break: normal;">

                                            <label for="rodioInput1" style=" display: inline-block;">
                                                <input id="rodioInput1" checked="true" type="radio" value="1" name="selecttype" style=" float: left;  display: inline-block;  "/> 
                                                <div style=" margin-left: 15px;">
                                                <input id="sendname_1" type="text" placeholder="请输入名称"  name="sendname_out" value="<?php echo $user?$user->name:'';?>"  style="width: 150px; height: 25px; margin: 0 3px;" />
                                                    邀请你加入班班，点击 http://xxxxxx 领取见面礼。作业通知网页端、手机端轻松发布；动动手指挣班费，丰富班级活动。班班，能赚班费涨知识的家校沟通工具。
                                                </div>
                                            </label> 
                                        </div>
                                    </td>
                                </tr>
                                <!--
                                <tr><td style=" padding-top: 0px;"></td></tr>
                                <tr> 
                                    <td style=" padding: 0px;">
                                        <span class="inputTitle"style=" float: left;margin-top: 7px;"> </span>
                                        <span style=" color: #EB6A05;">（对班级内成员短信）</span>
                                    </td>
                                </tr> 
                                <tr> 
                                    <td style=" padding-top: 0px;"> 
                                        <span class="inputTitle"style=" float: left;margin-top: 7px;"> </span>
                                        <div style=" margin-left:70px;   word-wrap: break-word; word-break: normal;"> 
                                            <label for="rodioInput2">
                                                <input id="rodioInput2" type="radio" value="2" name="selecttype" style="float: left; display: inline-block;" />
                                                <div style=" margin-left: 15px;">
                                                    各位家长你们好：我是
                                                    <input id="classname_2" type="text" name="classname" maxlength="40" placeholder="请输入班级名称" value="" style="width: 150px; height: 25px; line-height: 20px;  margin: 0 3px;" />
                                                    的
                                                    <input id="sendname_2" type="text" name="sendname" maxlength="20" placeholder="请输入名称" value="<?php echo $user?$user->name:'';?>" style="width: 150px; height: 25px; line-height: 20px;  margin: 0 3px;" />
                                                    老师，新学期班级通知、家庭作业、考试成绩…都会从这里发给大家，请大家尽快下载班班手机应用：http://app.banban.im/install。下载后，输入班级代码 
                                                    <input id="classcode_2" type="text" name="classcode" maxlength="6" onkeyup="this.value=this.value.replace(/\D/g,'')"  onafterpaste="this.value=this.value.replace(/\D/g,'')" placeholder="6位数代码" style="width: 80px; height: 25px; line-height: 20px; margin: 0 3px;" value="" />
                                                    就能找到咱们班了。  
                                                </div>
                                            </label>  
                                        </div>
                                    </td>
                                </tr> 
                                <tr>
                                    <td  style=" padding-top: 0px;">
                                        <span class="inputTitle"style=" float: left;margin-top: 7px;"> </span>
                                        <div style=" margin-left:80px; width:340px;   word-wrap: break-word; word-break: normal;"> 
                                            <span id="tipSelecttype" class="Validform_checktip" style=" margin-left:0px;">&nbsp;</span>
                                        </div>
                                    </td>
                                </tr>
                                -->
                                <tr>
                                    <td style=" padding: 0px;">
                                        <span class="inputTitle"style=" float: left; color: #000000; font-weight: 700; margin-top: 7px;"> &nbsp;</span> 
                                        <div style="  margin-left:80px; ">
                                            <a href="javascript:;" class="btn btn-orange"  tip="0" id="btn_send">
                                                立即发送
                                                <!--<img class="status" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/activity/inviteBtn3.png"/>--> 
                                            </a> 
                                        </div>

                                    </td>
                                </tr> 
                                <tr> 
                                    <td>
                                        <span class="inputTitle"style=" float: left; color: #000000; font-weight: 700; margin-top: 7px;"> &nbsp;</span> 
                                        <div style="  margin-left:80px; ">
                                            <p style="color: #999999;   line-height: 25px; overflow: hidden;">
                                                若接收短信的手机号用户已是班班用户， 或该手机号已累计收到过三次推荐短信， 则不会对其发出推荐短信。
                                            </p>
                                        </div>
                                       
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </form>
<!--                    <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #e5e4da; ">
                        老师，您好！“邀请好友”是班班为您免费提供的一种短信福利。我们可以通过系统短信帮您忙，邀请您的同事及好友一同使用“班班”，一起享受“班班”带来的便捷与轻松。
                    </div>-->
                </div>
            </div>
        </div> 
    </div>
</div>
<div id="sharePopupBox" class="popupBox" style="width: 500px; height: 260px;"> 
    <div id="shareBox" class="share shareBox">
        <div class="step">
            <p class="p2"></p>
            <div class="select-type">
                <span>点击你希望分享的平台：</span>
                <div class="bdsharebuttonbox" data-tag="share_1">
                    <a class="sqq" data-cmd="sqq"></a>
                    <a class="qzone" data-cmd="qzone" href="#"></a>
                    <a class="sina last" data-cmd="tsina"></a> 
                </div>
            </div>
        </div>
    </div>
</div>
<div id="disbandBox" class="popupBox" re="showPromptsRemind('#disbandBox')"></div>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/stcombobox/stcombobox.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo MainHelper::AutoVersion('/js/banban/Validform/validform.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/Validform/Validform_v5.3.2_min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/intValidform.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/shaerclass.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    if($('#className').val()!=""){
        $('#webPlatext').css('display','none');  
    } 
    function hideThis(objT){ 
        var target = JId('#'+objT);
        target.style.display="none";
    }
     function plastt(objI,objT){
        var pinput = $('#'+objI),
            target = $('#'+objT);
       if(pinput.val()==""){
           target.css('display','block'); 
        }else{
            target.css('display','none');  
        }
    }
    function plasInpt(objI,objT){
        var pinput = $('#'+objI),
            target = $('#'+objT);
        target.css('display','none'); 
    } 
$(function() {
   
    //表单验证控件
    Validform.int("#formBoxRegister"); 
    // showPromptsRemind('#disbandBox');
     function Invite(e){  
        var url="<?php echo Yii::app()->createUrl('/invite/send');?>",
        mobile= $("#className").text();
        var eg = /^((1)+\d{10})$/; 
        if(mobile!=""&&eg.test(mobile)&&mobile.length==11){ 
            $.post(url,{mobile:mobile},function(data){ 
                var typeStr ='邀请成功',idStr ="'#disbandBox'";
                if(data.status=="1"){}else{typeStr ='邀请失败';}
                var str ='<div class="header">'+typeStr+'<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('+idStr+')" > </a></div>'
                        +'<div class="remindInfo"><div id="remindText" class="centent">'+data.msg+'</div></div>'
                        +'<div class="popupBtn"><a href="javascript:void(0);" onclick="hidePormptMaskWeb('+idStr+')" class="btn btn-orange">确定</a> </div>';
                $('#disbandBox').html('');
                $('#disbandBox').append(str); 
                showPromptsRemind('#disbandBox');
                $("input[name=mobile]").val('').blur();
                 $("#btn_send").attr('tip','0');
            },"json");
        }else{
            $("#formBoxRegister").submit();
            $("#btn_send").attr('tip','0');
        } 
    }
//    $('#className').keydown(function(){ 
//        var event=arguments.callee.caller.arguments[0]||window.event;//消除浏览器差异  
//        if (event.keyCode == 13){
//            Invite();
//        }
//    });
    $("#btn_send").click(function(){  
        //$("#formBoxRegister").submit();
        $("input:radio").each(function(){
            if($(this).attr("checked")){
                var vl = $(this).val(); 
                if(vl=='1'){
                    var sn = $('#sendname_'+vl).val();
                    if(sn!=''){  
                         verifyTest(sn);
                    }else{
                        $('#tipSelecttype').text('请输入姓名！').addClass('Validform_wrong');
                    }
                }else{
                    var sn = $('#sendname_'+vl).val();
                    var sc = $('#classcode_'+vl).val();
                    var cn = $('#classname_'+vl).val();
                    if(cn!=''){
                        if(charAtLen(cn)<20){
                            if(sn!=''){
                                if(charAtLen(sn)<20){
                                    if(sc!=''){
                                        $("#formBoxRegister").submit();
                                    }else{
                                        $('#tipSelecttype').text('请输入班级代码！').addClass('Validform_wrong');  
                                    } 
                                }else{
                                    $('#tipSelecttype').text('姓名不能超过10个汉字（或" 20个英文字符）！').addClass('Validform_wrong');
                                }  
                            }else{
                                $('#tipSelecttype').text('请输入姓名！').addClass('Validform_wrong'); 
                            }
                        }else{
                            $('#tipSelecttype').text('班级名称不能超过10个汉字（或" 20个英文字符）！').addClass('Validform_wrong');
                        }
                        
                    }else{
                        $('#tipSelecttype').text('请输入班级名称！').addClass('Validform_wrong'); 
                    }  
                }
            }else{ 
            }
        });
        function verifyfoss(str){
            var egr = /^[a-zA-Z0-9\u4e00-\u9fa5\(\)\（\）\-\_\.\s]+$/;
            var flage = true ,false1 = true;
            if(egr.test(str)){
                if(charAtLen(str)<20){ 
                }else{
                     flage = false;
                }
            }else{
                flage = false;
            }
            if(flage==true &&false1==true){ 
                return true;
            }else{
                return false;
            } 
        }
        function verifyTest(str){
            var egr = /^[a-zA-Z0-9\u4e00-\u9fa5\(\)\（\）\-\_\.\s]+$/;
            if(egr.test(str)){
                if(charAtLen(str)<20){
                    $("#formBoxRegister").submit();
                }else{
                    $('#tipSelecttype').text('姓名不能超过10个汉字（或" 20个英文字符）！').addClass('Validform_wrong');
                }
            }else{
                $('#tipSelecttype').text('姓名只允许中英文数字以及()_-.和空格组成！').addClass('Validform_wrong'); 
            } 
        }
        function charAtLen(gets){
            var len = 0;
            for(var i = 0; i < gets.length; i++) {
                if (gets.charAt(i).match(/[\u4e00-\u9fa5]/)) {
                    len += 2;
                } else {
                    len++;
                }
            }
            return len;
        }
       
//        var tip = $(this).attr('tip');
//        if(tip=='0'){
//           Invite();
//        }
    });
    var shareUrl = '<?php echo Yii::app()->createAbsoluteUrl('mobile/invprize',array('uid'=>Yii::app()->user->id,'source'=>'1','clienttype'=>'1'));?>';
    var bdTexts ='这么巧，你也缺钱啊！';
    var bdDescs =  '别点，我真的不是刻意在炫富！';
    var bdPic = '<?php echo $domain = Yii::app()->request->hostInfo; ?>';
    var type="<?php //echo $class->authority;?>";
//    if(type==2){
//         shareUrl = ' ';
//         bdTexts ='今年班费少交点，百万班费随便拿';
//         bdDescs =  '领取班班的班费卡，不单可以省钱，还能够更好的和老师进行沟通';
//    }
    ShareClass.int(shareUrl,bdTexts,bdDescs,bdPic);
});
 
</script>

