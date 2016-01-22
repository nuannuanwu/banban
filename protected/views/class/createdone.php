<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/class.css'); ?>">
<style>
    .ie10 .example {
        /* IE10-only styles go here */ 
        .createDone fieldset legend { width: 145px; height: 36px; line-height: 36px;  margin-left:20px; } 
        .createDone fieldset legend span{ width: 145px; display: inline-block; text-align: center; }
    }
</style>
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox"> 
    <div class="titleHeader bBttomT">
        <span class="icon icon1"></span>我的班班 > 创建新班级
    </div>
    <div class="box"> 
        <div class="listTopTite bBottom">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/class_step1_2.png">
        </div> 
        <div class="formBox" style=" margin-bottom: 60px; ">
            <div class="classTableBox invtesBox" style="text-align: center;">
                <div style="width: 98px; margin: 30px auto;"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/tipSussess.png"></div>
                <h2 style="margin: 20px 0 30px 0;">创建成功</h2>
                <p class="" style=" color: #000;">
                    <b style=" margin-right: 5px;"><?php echo $className ? $className : '';?></b> 的班级代码为 <span style="font-weight: 600;color: #F59201;"><?php echo $classCode ? $classCode : '';?></span>。
                </p> 
            </div>
            <div class="createDone fieldsetBox" >
                    <fieldset>  
                        <legend style="margin-left:210px;"><span>您现在可以</span></legend>
                        <ul id="shareBox" class="listCreateBox">
                            <li class="borderR"> 
                                <a class="iocBox inputLinks" title="导入学生" href="<?php echo Yii::app()->createUrl('class/supload', array('cid'=>$cid,'first'=>1));?>">
                                </a>
                                <p><b>一键导入学生</b></p>
                                <p class="textLeft">一键导入班级学生名单和家长及关注人通讯录，让他们快速加入班级。</p>
                            </li>
							
                            <li class="borderR"> 
                                <a class="iocBox perfectInfor" title="完善信息" href="<?php echo Yii::app()->createUrl('class/schoolsetting', array('cid'=>$cid,'ac'=>'teachers'));?>"></a>
                                <p><b>完善学校信息</b></p>
                                <p class="textLeft">完善学校信息，方便我们提供更精准、贴心的服务。</p>
                            </li>
                            <li class="boxR bdsharebuttonbox"  data-tag="share_1">
                                <a href="javascript:;" class="boxRa" rel="shareShow1" tip="0" data-cmd="sqq"> </a>
                                <p style=" color: #000;"><b>分享班级信息</b></p>
                                <p class="textLeft" >将班级信息分享到QQ中，让其他老师和学生家长能够通过此信息找到并加入班级。</p>
                            </li>
                        </ul>
<!--                        <div id="shareBox" class="share" style=" display: none;">
                            <div style=" position: relative;">
                                <span>选择分享平台</span>
                                <a href="javascript:;" class="shareHide"></a>
                            </div>
                            <div class="bdsharebuttonbox" data-tag="share_1">
                                <a class="sqq" data-cmd="sqq"></a>
                                <a class="qzone" data-cmd="qzone" href="#"></a>
                                
                                <a class="sina" data-cmd="tsina"></a> 
                            </div>
                        </div>-->
                    </fieldset>  
                </div> 
            </div>
        </div>
    </div> 
</div>

<script src="<?php echo MainHelper::AutoVersion('/js/banban/shaerclass.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        if (window.matchMedia("screen and (-ms-high-contrast: active), (-ms-high-contrast: none)").matches) {  
            document.documentElement.className += "ie10"; 
        }
        $('[rel=shareShow]').click(function(){
            var tip = $(this).attr('tip');
            if(tip=="0"){
                $(this).attr('tip','1');
               $('#shareBox').show(); 
            }else{
                $(this).attr('tip','0');
                $('#shareBox').hide();
            }
        });
        $('.shareHide').click(function(){
            $('#shareBox').hide();
            $('[rel=shareShow]').attr('tip','0');
        });
    
    var shareUrl = '<?php echo Yii::app()->createAbsoluteUrl('mobile/classinv', array('classid'=>$cid,'uid'=>Yii::app()->user->id,'role'=>'1'));?>';
    var bdTexts = '<?php echo $className ? $className : '';?>的老师家长，快到班里来~';
    var bdDescs =  '新学期作业、通知从这里发送、接收。大家尽快加一下班哦~~';
       // var bdDescs =''//  '为了更好的进行班级沟通，我在“班班”建立了我们的班级（<?php echo $className ? $className : '';?>），班级代码为<?php echo $classCode ? $classCode : '';?>。班班是免费家校平台，方便我们班的家长老师快捷联络、收发孩子通知作业，注册后输入班级代码加入我们的班集体！我们都在等着你！';
        var bdPic = '<?php echo $domain = Yii::app()->request->hostInfo; ?>';
        ShareClass.int(shareUrl,bdTexts,bdDescs,bdPic);
    });
</script>
