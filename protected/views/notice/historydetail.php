<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/inbox.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/commentStyle.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/phpemoji/emoji.css'); ?>">
<style type="text/css">
    .details-c span{
        text-indent: 2em;
    }
    .read{
        color:blue!important;
    }
</style> 
<?php if(!function_exists('emoji_unified_to_html')){
    require_once('protected/extensions/PHPEmoji/emoji.php');
} ?>
<div id="mainBox" class="mainBox">  
    <div id="contentBox" class="cententBox">
    	<!-- 老师区域 -->
        <div class="titleHeader bBttomT">
            <span class="icon icon2"></span>已发送<!--（46条）-->
        </div>
        <div class="box">
            <nav class="navMod">
                <a href="<?php echo $returnurl?$returnurl:Yii::app()->request->urlReferrer; ?>" class="btn btn-default"><img class="return" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/get_back_ico.png" alt="">返回</a>
                <?php if(in_array($noticeinfo['noticetype'],array(1,2,3,4))):?>
                <a href="<?php echo Yii::app()->createUrl('notice/follow?noticeid='.$noticeinfo['noticeid']);?>" class="btn btn-default">转发</a>
                <?php endif;?>
            </nav>
            <div class="envelopeBox">
                <div class="envelopeHeader">
                    <!--<i class="l_t"></i> <i class="l_b"></i> <i class="t_t"></i> <i class="r_t"></i> <i class="r_b"></i> <i class="b_b"></i> <i class="l_l"></i> <i class="r_r"></i>-->
                    <div class="center">
                        <!--<div class="addresseeBox" style="overflow: hidden;  word-wrap: break-word;  word-break: normal;">收件人: <?php echo emoji_unified_to_html($noticeinfo['receivename']); //$noticeinfo['schoolname'].'&nbsp;&nbsp;'. ?></div>-->
                        <div class="envelopePicBox ">
                            <!--<span class="icon <?php echo $noticeinfo['showclass'];?>"></span>-->
                            <p class="picTitle"><?php echo $noticeinfo['typedesc'];?></p> 
                            <p class="infTitle" style="overflow: hidden;  word-wrap: break-word;  word-break: normal;">
                                <span>收件人：</span><span style="color:#f59201;"><?php echo emoji_unified_to_html($noticeinfo['receivename']); //$noticeinfo['schoolname'].'&nbsp;&nbsp;'. ?> </span>
                            </p>
                            <p class="infTitle" style="overflow: hidden;  word-wrap: break-word;  word-break: normal;">
                                <span>时&nbsp;&nbsp;&nbsp;间：</span><?php echo $noticeinfo['showtime'];?>
                            </p>
                        </div> 
                    </div>  
                </div>
                <div class="envelopeCenterBox">
                    <div class="box <?php if($noticeinfo['noticetype']==1 ||$noticeinfo['noticetype']==2||$noticeinfo['noticetype']==3):?> <?php endif;?>" style=" padding: 0 15px;" >
                        <div style="overflow: hidden; word-wrap: break-word; word-break: normal; margin-bottom: 15px; font-size: 15px; color: #3e3a39;" > 
                            <?php if($noticeinfo['noticetype']==5):?>
                                <?php echo emoji_unified_to_html($noticeinfo['content']);?>
                              
                            <?php else:?>
                                <p><?php echo emoji_unified_to_html($noticeinfo['content']);?></p>
                            <?php endif;?>
                        </div>
                        <!-- 图片-->
                        <div class="detailsImgBox"> 
                            <?php if(isset($noticeinfo['images'])&&is_array($noticeinfo['images'])&&!empty($noticeinfo['images'])):?>
                                <?php foreach($noticeinfo['images'] as $img):?>
                                    <a href="javascript:;" rel="imgPreview" data-img="<?php echo $img.'?imageView2/2/w/600';?>" style="width:120px;height:110px;overflow:hidden;display: inline-block;text-align:center;border:1px solid #d9d9d9;margin-right:10px; margin-bottom: 15px; ">
                                        <img style="width:120px;" src="<?php echo $img.'?imageView2/1/w/120/h/110';?>"/>
                                    </a>
                                <?php endforeach;?>
                            <?php endif;?>
                        </div>
                    <!-- /图片--> 
                    </div>
                    <?php $isHidden=!($noticeinfo['noticetype']==1 ||$noticeinfo['noticetype']==2||$noticeinfo['noticetype']==3);
                          $hiddenClass=$isHidden?'display:none;':'';
                    ?>
                    <div class="box" style=" padding: 15px; margin-top: 50px; border-top: 1px dashed #e5e4da; overflow: hidden;<?php echo $hiddenClass;?>" >
                        <div class="title">阅读统计</div>
                        <div>
                            <div id="headBox" style="width:420px;height:200px; float: left;"></div>  
                            <a href="javascript:;" rel="echartsBtn" style=" margin-top: 80px; margin-left: 40px; margin-right: 0px;" class="btn btn-default">详细清单</a>
                        </div>
                        
                    </div>
                    <div class="box "> </div>
                </div> 
            </div> 
        </div>
		<!-- 老师区域 end-->

		<!-- 家长区域 -->
        <!--
		 <div class="box">
		 		<div class="tip">
		 			<p class="p-img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/tip.png" alt=""></p>
		 			<p>提醒：发送消息功能暂时只开放给老师身份使用，如果您是老师，请在登录后选择老师身份进入。</p>
		 		</div>
		 </div>
		 -->
		<!-- 家长区域 end--> 
    </div>
</div>
<div id="PreviewBox">
    <div id="imgPreview" class="popupBox" style=" ">
        <div class="header " style="">&nbsp;<a href="javascript:void(0);" class="close" onclick="hidePormptMaskWeb('#imgPreview')" > </a></div>
        <div id="imgPBox" class="imgbox" style="padding: 10px 40px;">
            <p>正在加载...</p>
        </div>
    </div>
</div>

<div id="echartsPupBox" class="popupBox" style=" width: 650px; height: 455px;">
    <div class="header">详细清单<a href="<?php echo Yii::app()->createUrl('notice/historydetail/'.$noticeinfo['noticeid']);?>" class="close"> </a></div>
    <div class="echartsSearch" style="position: relative;">
        <label id="mobileLabel" for="mobile" style="position:absolute;top:13px;left:13px;color:#999;cursor:text;">请输入学生姓名或家长手机号</label>
        <input id="mobile" type="text" style="width: 565px; *width: 560px;" name="mobile" class="search" value="">
        <a class="btn btn-default" href="javascript:;" id="searchpersone"  noticeid="<?php echo $noticeinfo['noticeid'];?> " >
           <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/notice/search_ioc.png">
        </a>  
    </div>
    <div class="echartslistBox" style=" padding: 10px 25px; overflow-y:auto; overflow-x:hidden; height: 300px;">
        <div class="title" style=" overflow: hidden;">
            <span class="fleft">姓名</span>   <span>阅读时间</span>     <span class="right">阅读状态</span> <span class="center" style="display: none;">使用状态</span>
        </div>
        <ul class="echartslist" id="echartslistul">
            <?php if(is_array($total_res)) foreach($total_res as $val):?>
            <li class="item">
                <?php if($val):?>
                <div class="itemT typeBox  <?php echo $val['userid']!=$uid?'onIoc':'';?>" rel="<?php echo $val['userid']!=$uid?'switchBtn':'';?>" tip="0">
                    <span class="fleft"><?php echo $val['userid']==$uid?($val['name'].'(自己)'):$val['name'];?></span>
                    <span class="right1 <?php echo $val['readnum']?'eyeioc':'eyeiocs';?>">
                        <?php
                            echo $val['readnum'].'/'.$val['total'];
                        ?>
                    </span>
                    <?php if($val['type']==1):?>
                        <?php
                        //$uidstate=Member::getUserActiveState($val['userid']);
                       // $stateclass1=$uidstate['appactive']?(!$uidstate['appstate']?"iphoneIco1":"iphoneIco"):"";
                       /// $statetitle1=$uidstate['appactive']?(!$uidstate['appstate']?"手机或电脑图标灰色,表示用户不活跃（曾经登陆过，但一个月内未登录过班班手机或网页端）":"手机或电脑图标亮起,表示用户活跃（一个月内登录过班班手机或网页端"):"手机或电脑图标不存在，表示从未在班班手机或网页页端登录使用过";
                       // $stateclass2=$uidstate['webactive']?(!$uidstate['webstate']?"pcIco1":"pcIco"):"";
                       // $statetitle2=$uidstate['webactive']?(!$uidstate['webstate']?"手机或电脑图标灰色,表示用户不活跃（曾经登陆过，但一个月内未登录过班班手机或网页端）":"手机或电脑图标亮起,表示用户活跃（一个月内登录过班班手机或网页端"):"手机或电脑图标不存在，表示从未在班班手机或网页页端登录使用过";
                        ?>

                    <?php endif;?>
                </div>
                <div class="echartslistBox">
                    <ul class="echartslistR">
                        <?php if(isset($val['family'])&&is_array($val['family'])):?>
                        <?php foreach($val['family'] as $guardian):?>
                        <li class="typeBox">
                            <span class="fleft"><?php echo $guardian['role']?$guardian['role']:'家长';?>（<?php echo $guardian['mobile'];?>）</span>
                                <span><?php echo isset($guardian['readtime'])?$guardian['readtime']:'';?></span>
                                <span class="right1 <?php echo $guardian['read']?'eyeioc':'eyeiocs';?>">&nbsp;</span>


                                   <?php //$u=$guardian['userid'];$state=isset($stateArr[$u])?$stateArr[$u]:array('active'=>0,'appactive'=>0,'webactive'=>0,'webstate'=>0,'appstate'=>0);
                                   // $stateclass3=$state['appactive']?(!$state['appstate']?"iphoneIco1":"iphoneIco"):"";
                                   // $statetitle3=$state['appactive']?(!$state['appstate']?"手机或电脑图标灰色,表示用户不活跃（曾经登陆过，但一个月内未登录过班班手机或网页端）":"手机或电脑图标亮起,表示用户活跃（一个月内登录过班班手机或网页端"):"手机或电脑图标不存在，表示从未在班班手机或网页页端登录使用过";
                                   // $stateclass4=$state['webactive']?(!$state['webstate']?"pcIco1":"pcIco"):"";
                                   //$statetitle4=$state['webactive']?(!$state['webstate']?"手机或电脑图标灰色,表示用户不活跃（曾经登陆过，但一个月内未登录过班班手机或网页端）":"手机或电脑图标亮起,表示用户活跃（一个月内登录过班班手机或网页端"):"手机或电脑图标不存在，表示从未在班班手机或网页页端登录使用过";
                            ?>

                        </li>
                        <?php endforeach;?>
                        <?php endif;?>
                    </ul> 
                </div>
                <?php endif;?>
            </li>
            <?php endforeach;?>
        </ul>
        <p style="display: none" id="nosearchbody">没有找到相关人员</p>
    </div>
    <div class="echartsFooter">
        <div class="cuntBox">
            共<span><?php echo $totalStudent;?></span>学生 &nbsp;&nbsp;&nbsp;<span><?php echo $guardiannum;?></span> 家长&nbsp;&nbsp;

        </div>
    </div>
</div>
<script src="<?php echo MainHelper::AutoVersion('/js/api/require.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/api/echart/echarts.js'); ?>" type="text/javascript"></script>
<script src="<?php echo MainHelper::AutoVersion('/js/banban/prompt.js'); ?>" type="text/javascript"></script>
<script type="text/javascript"> 
     $('[rel=imgPreview]').click(function(){
            var imgUrl = $(this).data('img'); 
            var img ='<img style="max-height:600px;"  src="'+imgUrl+'">'; 
            $("#imgPBox").empty();
            $("#imgPBox").append(img);
            showPromptsImg('#imgPreview');
        }); 
    //详情弹框
     $('[rel=echartsBtn]').click(function(){
          showPromptsImg('#echartsPupBox');
     });
     //学生家长详情查看 
     $(document).on('click','[rel=switchBtn]',function(){ 
         var _this = $(this), tip = _this.attr('tip');
         if(tip=='0'){
             $('[rel=switchBtn]').attr('tip','0');
             $('.echartslistR').hide()
            _this.parent('.item').find('.echartslistR').show();
            $('[rel=switchBtn]').removeClass('offIoc').addClass('onIoc');
            _this.removeClass('onIoc').addClass('offIoc');
            _this.attr('tip','1');
         }else{
            _this.attr('tip','0'); 
            _this.parent('.item').find('.echartslistR').hide();
            $('[rel=switchBtn]').removeClass('offIoc').addClass('onIoc');
            _this.removeClass('offIoc').addClass('onIoc');
         }
     });

     $('#mobile').on('focus', function() {
         $('#mobileLabel').addClass('hidden');
     })

     $('#mobile').on('blur', function() {
         var that = $(this);
         if (that.val() == "") {
             $('#mobileLabel').removeClass('hidden');
         }
     })

     function onSearch(value){//js函数开始
       //  setTimeout(function(){//因为是即时查询，需要用setTimeout进行延迟，让值写入到input内，再读取
             var storeId =$('#echartslistul');//获取table的id标识
             var rowsLength = storeId.find("li.item");//表格总共有多少行
             var key = $.trim(value);//获取输入框的值
             var ismobile=false;
             if(/^[0]?1\d{10}$/.test(key)){ //手机号
                 ismobile=true;
             }
                rowsLength.each(function(i,obj){
                 var o=$(obj);
                 if(key==''){
                     o.css({'display':''})
                     $("#nosearchbody").hide();
                 }else{
                    if(!ismobile){
                        var name= $.trim(o.find('.itemT span.fleft').text());
                        if(name.indexOf(key)>=0){
                            o.css({'display':''});
                            $("#nosearchbody").hide();
                        }else{
                            o.css({'display':'none'});
                            $("#nosearchbody").show();
                           // storeId.append("<li>没有找到相关人员</li>");
                        }
                    }else{ //手机号搜索
                        var name= $.trim(o.find('.echartslistR span.fleft').text());
                        if(name.indexOf(key)>=0){
                            o.css({'display':''});
                            $("#nosearchbody").hide();
                        }else{
                            o.css({'display':'none'});
                            $("#nosearchbody").show();
                          //  storeId.append("<li>没有找到相关人员</li>");
                        }
                    }
                 }
             });
     }
     //发表评论
    $(function(){
        $("#searchpersone").click(function(){
            var mobile= $.trim($("input[name=mobile]").val());
            var noticeid= parseInt($(this).attr("noticeid"));
            onSearch(mobile);
//            var url="<?php //echo Yii::app()->createUrl('/notice/searchreceiver');?>"; 
//            var html=[]; 
//            if(noticeid){ 
//                $.get(url,{noticeid:noticeid,mobile:mobile},function(data){ 
//                    if(data){ 
//                        $("#echartslistul").html(data); 
//                    } 
//                }); 
//            } 
        });
        var total="<?php echo (int)$totalStudent;?>",
        total_read_num="<?php echo (int)$studentReadNum;?>";
        var total_unread_num=total-total_read_num;
        var texts ='已读('+ total_read_num +')人',textu = '未读('+(total_unread_num)+')人';
        $('#btn_reply').click(function(){
            var did = $(this).data('did');
            var msgid = $(this).attr('msgid')||0;
            var num = $(this).data('num');
            var contentS = $("#textareaText").val();
            if(contentS!=""&&contentS.length<=100){
                $.post("/index.php/notice/reply",{msgid:msgid,content:contentS,noticeId:did},function(data)  //回复评论
                {
                    if(data&&data.status==='1'){
                        location.reload(true);
                    }
                },'json');

            }else{
                $(this).parents('.commentsBox').find('.inputRedinfo').show();
            }
        });
        var baseUrl="<?php echo Yii::app()->request->baseUrl; ?>"+"/js";
        var localChart=baseUrl+'/api/echart';
         require.config({
            paths: {
                echarts: ['http://echarts.baidu.com/build/dist',localChart] //echarts.js的路径
            }
        });
        var platform="<?php echo $noticeinfo['platform'];?>",
            noticetype="<?php echo $noticeinfo['noticetype'];?>";
        // 使用
        require(
            [
                'echarts',
                'echarts/chart/pie' // 使用饼图就加载pie模块，按需加载
            ],
            
            function (ec) {
                // 基于准备好的dom，初始化echarts图表
                var myChart = ec.init(document.getElementById('headBox'));
                var option = {
                    title : {
                        text: '',
                        subtext: '',
                        x:'center'
                    },
                    tooltip : {
                        show:false,
                        trigger: 'item',
                        percent:'special',
                        formatter: "{b}:{d}%"
                    },
                    legend: {
                        orient : 'vertical',
                        x : 'right',
                        y : 'center', 
                        selectedMode:false,
                        data:[texts,textu]
                    },
                    toolbox: {
                        show : false,
                        feature : {
                            mark : {show: false},
                            dataView : {show: false, readOnly: false},
                            magicType : {
                                show: false, 
                                type: ['pie', 'funnel'],
                                option: {
                                    funnel: {
                                        x: '5%',
                                        width: '20%',
                                        funnelAlign: 'left',
                                        max: 1548
                                    }
                                }
                            },
                            restore : {show: false},
                            saveAsImage : {show: false}
                        }
                    },
                    calculable : false,
                    series : [
                        {
                            name:'已读/未读量',
                            type:'pie',
                            radius : '55%', 
                            center: ['40%', '50%'],
                            data:[
                                {value:total_read_num, name:texts},
                                {value:total_unread_num, name:textu}
                            ]
                        }
                    ]
                };

                // 为echarts对象加载数据

              //  alert(noticetype);
                if(noticetype==1 || noticetype==2 ||noticetype==3){ //旧校信平台的不要显示，新班班发的紧急通知不显示
                    myChart.setOption(option);
               }
            }
        );

    });

</script>