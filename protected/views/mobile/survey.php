<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta  name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
<meta content="telephone=no" name="format-detection">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"> 
<meta content="yes" name="apple-mobile-web-app-capable" /> 
<meta content="black" name="apple-mobile-web-app-status-bar-style" /> 
<meta content="telephone=no" name="format-detection" /> 
<link href="" rel="stylesheet">
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/banban/move3.js"></script>
<style>
    ,* { tap-highlight-color: transparent }
    * { -webkit-tap-highlight-color: transparent; }
    html,body{ width: 100%; height: auto; padding: 0;  margin: 0 auto; background-color: #fff;}
    body{ position: relative;}
    p,div{ padding: 0; margin: 0;}
    a{ text-decoration: none; color: #4c4c4c; }
    .f-left{ float: left; }
    .f-right{ float: right; }
    .layout{ position: relative; max-width:450px; height: 100%; margin:0 auto;  font-family: "黑体"; background:url('/image/banban/mobile/survey/bg.jpg') repeat-y; background-size: contain; z-index: 1; } 
    .box{ width: auto; padding:10px; margin: 0 auto; margin-bottom: 15px; overflow: hidden;  }
    .img-box{ position: relative; width: 100%; }
    .img-box img{display:block; max-width: 100%; height: auto; } 
    .b-p{ position: absolute;left: 0; top:0%; width: 100%; text-align: center; }
    .btn{ display: inline-block; width: 75%; height: 40px; line-height: 40px;   padding: 0px 8px; font-size: 18px; background-color: #f59201; border: 1px solid #f59201; border-radius: 6px; color: #ffffff; } 
    .t-title{ font-weight: 100; }
    .startPage{ background:url('/image/banban/mobile/survey/f_bg.jpg') repeat-y; background-size: contain; }
    .iQpages{ display: none; position: relative; width: 100%; margin: 0 auto;  overflow: hidden; }
    .iQpages .t-c{ padding:1% 12%; background:url('/image/banban/mobile/survey/t_c.jpg') repeat-y; background-size: contain; font-size: 14px; }
    .iQpages .c-c{ display: block; position: relative; width: 100%; background:url('/image/banban/mobile/survey/c_c.jpg') repeat-y; background-size: contain; }
    .c-c .oplist{ width: 100%; display: block; width: 100%; padding: 1% 0; margin: 0 auto; overflow: hidden;  }
    .c-c .nextBtn{ display: block; width: 100%; height: 55px; margin-top: 5%; background:url('/image/banban/mobile/survey/next_btn.png') center no-repeat; background-size: contain;}
    .c-c .nextBtn:hover{ opacity: 0.8;}
    .c-c .nextBtn::visited{opacity: 1;}
    .c-c .lastClass{display: block; width: 100%; height: 55px; margin-top: 5%; background:url('/image/banban/mobile/survey/lastBtn.png') center no-repeat; background-size: contain;}
    .oplist li{ display:table; list-style-type: none;  width: 100%; height: 55px; margin: 1% auto; overflow: hidden; } 
    .oplist li.bg0{background:url('/image/banban/mobile/survey/a.png') center no-repeat; background-size: contain;}
    .oplist li.bg1{background:url('/image/banban/mobile/survey/b.png') center no-repeat; background-size: contain;}
    .oplist li.bg2{background:url('/image/banban/mobile/survey/c.png') center no-repeat; background-size: contain;}
    .oplist li.bg3{background:url('/image/banban/mobile/survey/d.png') center no-repeat; background-size: contain;}
    .oplist li.bg00{background:url('/image/banban/mobile/survey/a1.png') center no-repeat; background-size: contain;}
    .oplist li.bg10{background:url('/image/banban/mobile/survey/b1.png') center no-repeat; background-size: contain;}
    .oplist li.bg20{background:url('/image/banban/mobile/survey/c1.png') center no-repeat; background-size: contain;}
    .oplist li.bg30{background:url('/image/banban/mobile/survey/d1.png') center no-repeat; background-size: contain;}
    .oplist li.bg00_0{background:url('/image/banban/mobile/survey/a1_0.png') center no-repeat; background-size: contain;}
    .oplist li.bg10_0{background:url('/image/banban/mobile/survey/b1_0.png') center no-repeat; background-size: contain;}
    .oplist li.bg20_0{background:url('/image/banban/mobile/survey/c1_0.png') center center no-repeat; background-size: contain;}
    .oplist li.bg30_0{background:url('/image/banban/mobile/survey/d1_0.png') center center no-repeat; background-size: contain;}
    .oplist li.bg00_1{background:url('/image/banban/mobile/survey/a1_1.png') center no-repeat; background-size: contain;}
    .oplist li.bg10_1{background:url('/image/banban/mobile/survey/b1_1.png') center no-repeat; background-size: contain;}
    .oplist li.bg20_1{background:url('/image/banban/mobile/survey/c1_1.png') center no-repeat; background-size: contain;}
    .oplist li.bg30_1{background:url('/image/banban/mobile/survey/d1_1.png') center no-repeat; background-size: contain;} 
    .oplist li div.subwrap{ display:table-cell; vertical-align:middle; _position:absolute; _top:50%; width: 100%; height: 55px; margin: 0 auto; overflow: hidden;}
    .oplist li a{  _position:relative; _top:-50%; display: block; width: 65%; padding:2% 0; padding-left: 12%;  margin: 0 auto; font-size: 13px;   color: #f0f6f9; overflow: hidden;}
    .rBg{background:url('/image/banban/mobile/survey/h_bg.jpg') repeat-y; background-size: contain;}
    .popupTier{display:none; position: fixed; left: 0%; top:0%; width: 100%; margin: 0 auto; z-index: 999;}
    .p-box{ position:absolute;  width: 100%; left: 0%; top:40%; width: 100%; text-align: center; margin: 0 auto; z-index: 9999; }
    .p-box .p-tier{ display: inline-block; width:auto; height: 80px; padding: 0 5%; margin: 0 auto; line-height: 80px; font-size: 18px; color: #ffffff; text-align: center; background: #555352; opacity: 0.9; }
    </style> 
</head>
<body>
	<div id="layout" class="layout">
        <div style=" display: none;">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/pic_logo.jpg" />
            <ul class="oplist"><li class="bg00_0"></li><li class="bg10_0"></li><li class="bg20_0"></li><li class="bg20_0"></li><li class="bg00_1"></li><li class="bg10_1"></li>
                <li class="bg20_1"></li><li class="bg20_1"></li><li class="bg00"></li><li class="bg10"></li><li class="bg20"></li><li class="bg20"></li></ul>
        </div>
            <!-- 首页-->
            <div id="fastBox" class="startPage iQpage" style="display: block;" > 
                <div class="img-box" style=" min-height: 80px;">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/f_1.jpg" />
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/f_2.jpg" />
                </div>
                <div class="img-box" style=" min-height: 40px;">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/f_3.jpg" />
                    <div class="b-p" style=" top:2%; left:0; width: 100%; text-align: center;">
                        <span style=" font-size: 24px; color: #04b7ef;">【<?php echo $survey->title;?>】</span>
                    </div>
                    <?php if($hasJoin): ?>
                    <div class="b-p" style=" top:15%; left: 10%;"> 
                        <img width="100" src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/a_pic.png" />
                    </div>
                    <?php endif;?>
                </div>
                <div class="img-box" style=" min-height: 100px;">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/f_4.jpg" />
                    <div style=" position: absolute; top:0; left:0; width: 100%; margin: 0 auto; z-index: 999;">
                        <a href="javascript:;" id='startBtn' pId="fastBox" nId='iQpageBox' style=" display: block;">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/starBtn.png" />
                        </a>
                    </div>
                </div>  
            </div>
            <!-- /首页-->
            <!-- 试题-->
            <div id="iQpageBox"> </div> 
            <!-- /试题-->
            <!-- 提示-->
            <div id="popupTier" class="popupTier">
                <div class="p-box">
                    <div class="p-tier">至少选一个吧！</div>
                </div>
            </div>
            <div id="popupMask" class="popupTier" style=" opacity: 0;"></div>
            <!-- /提示 -->
            <!--提交表单-->
            <form id="postForm" method="post" action="<?php echo Yii::app()->createUrl("/mobile/survey/$id");?>" >
                <input id="uidInput" type="hidden" name="id" value="<?php echo $id;?>"/>
                <input id="idInput" type="hidden" name="uid" value="<?php echo $uid;?>"/>
                <input id="aidInput" type="hidden" name="aid" value="<?php echo $aid;?>"/>
                <input id="cidInput" type="hidden" name="cid" value="<?php echo $cid;?>"/>
                <input id="lastmoney" type="hidden" name="lastmoney" value="<?php echo $lastmoney;?>"/>
                <input id="answerInput" type="hidden" name="answer" value="">
            </form>
            <!--/提交表单-->
	</div> 

    <script type="text/javascript">
         function JId(idd){
            var obj = {};
            if( typeof( idd ) === 'string'){
                var idName = idd.substr(1, idd.length ); 
                if( idd.substr(0,1) === '#' ){
                    obj = document.getElementById(idName);
                }   
            } else {
                obj = idd;
            }
            return obj;
        } 
        //var dataStr =window.surveyjson;
         var s ='<?php echo $surveyJson;?>';
         var dataStr=JSON.parse(s)||{};
    	var survey = {
            iqBox:'iQpageBox',
            result:'', 
            itemClass:["alone","double","aloneOpen","doubleOpen"],//保存选项class名称
            iqName:["单选题","多选题","单选题","多选题"],//多选和单选的提示 
            getByClass:function(oParent, sClass){
                var aEle=oParent.getElementsByTagName('*');
                var aResult=[]; 
                for(var i=0;i<aEle.length;i++) {
                    if(aEle[i].className==sClass) {
                            aResult.push(aEle[i]);
                    }
                } 
                return aResult;
            }, 
            defaultEvent:function (e){
                if ( e && e.preventDefault ){  
                        e.preventDefault(); //阻止默认浏览器动作(W3C) 
                }else{ 
                    window.event.returnValue = false; //IE中阻止函数器默认动作的方式 
                    return false;
                }
            },
            init:function(containerId,data){
                var iQpageBox = document.getElementById(survey.iqBox); //问题盒子
                iQpageBox.innerHTML = survey.pinHTML(containerId,survey.getDatas(data));//题型加载到页面 
                survey.startTest(containerId);
                survey.nextTopic(iQpageBox);
                var checkBox = survey.getByClass(iQpageBox,'iQpages');
                for(var i=0; i< checkBox.length; i++){ 
                    var types =checkBox[i].getAttribute('types'); 
                    if(parseInt(types)==0){ 
                        survey.aloneCheck(checkBox[i],survey.itemClass[types]);
                    }else if(parseInt(types)==1){ 
                        survey.doubleCheck(checkBox[i],survey.itemClass[types]) 
                    }else if(parseInt(types)==2){ 
                            survey.aloneOpenCheck(checkBox[i],survey.itemClass[types]);  
                    }else if(parseInt(types)==3){ 
                        survey.doubleOpenCheck(checkBox[i],survey.itemClass[types]) 
                    }  
                }
                survey.psotResult(iQpageBox);

            },
            doubleOpenCheck:function(nid,itemCname){ //开放多选
                var iQpageBox = nid;
                var aIQpItme = survey.getByClass(iQpageBox,itemCname);
                for(var i=0; i< aIQpItme.length; i++){ 
                    aIQpItme[i].onclick = function(e){ 
                        var isclick = this.getAttribute('isclick'); 
                        var opItime = iQpageBox;
                        var oIQp = survey.getByClass(opItime,itemCname); 
                        if(parseInt(isclick)==1){  
                            this.setAttribute('isclick', 0);
                            this.parentNode.parentNode.className =this.parentNode.parentNode.className+this.getAttribute('isclick'); 
                        }else{ 
                            this.parentNode.parentNode.className = 'bg'+(parseInt(this.getAttribute('order'))-1);
                            this.setAttribute('isclick', 1); 
                        }
                        opItime = '';  
                         
                        survey.defaultEvent(e)
                    }
                }
                var nextBtn =survey.getByClass(nid,'nextBtn')[0]; 
            },
            aloneOpenCheck:function(nid,itemCname){ //开放单选
                var iQpageBox = nid;
                var aIQpItme = survey.getByClass(iQpageBox,itemCname);
                for(var i=0; i< aIQpItme.length; i++){  
                    aIQpItme[i].onclick = function(e){ 
                        var isclick = this.getAttribute('isclick'); 
                        var opItime = iQpageBox;
                        var oIQp = survey.getByClass(opItime,itemCname); 
                        if(parseInt(isclick)==1){ 
                            for (var j = 0; j < oIQp.length; j++) { 
                                if(parseInt(oIQp[j].getAttribute('isclick'))==0){ 
                                    oIQp[j].setAttribute('isclick', 1); 
                                    oIQp[j].parentNode.parentNode.className = 'bg'+j;
                                }
                            }
                            this.setAttribute('isclick', 0);
                            this.parentNode.parentNode.className =this.parentNode.parentNode.className+this.getAttribute('isclick'); 
                        }else{ 
                            this.parentNode.parentNode.className = 'bg'+(parseInt(this.getAttribute('order'))-1);
                            this.setAttribute('isclick', 1); 
                        }
                        opItime = '';  
                        survey.defaultEvent(e);
                    }
                } 
            },
            doubleCheck:function(nid,itemCname){ //多选 
                var iQpageBox = nid;
                var aIQpItme = survey.getByClass(iQpageBox,itemCname);
                for(var i=0; i< aIQpItme.length; i++){ 
                    aIQpItme[i].onclick = function(e){ 
                        var isclick = this.getAttribute('isclick'); 
                        var opItime = iQpageBox;
                        var oIQp = survey.getByClass(opItime,itemCname); 
                        if(parseInt(isclick)==1){  
                            this.setAttribute('isclick', 0);
                            this.parentNode.parentNode.className =this.parentNode.parentNode.className+this.getAttribute('isclick'); 
                        }else{ 
                            this.parentNode.parentNode.className = 'bg'+(parseInt(this.getAttribute('order'))-1);
                            this.setAttribute('isclick', 1); 
                        }
                        opItime = '';  
                         
                        survey.defaultEvent(e)
                    }
                }
                var nextBtn =survey.getByClass(nid,'nextBtn')[0]; 
            },
            aloneCheck:function(nid,itemCname){ //单选 
                var iQpageBox = nid;
                var aIQpItme = survey.getByClass(iQpageBox,itemCname);
                for(var i=0; i< aIQpItme.length; i++){  
                    aIQpItme[i].onclick = function(e){ 
                        var isclick = this.getAttribute('isclick'); 
                        var opItime = iQpageBox;
                        var oIQp = survey.getByClass(opItime,itemCname); 
                        if(parseInt(isclick)==1){ 
                            for (var j = 0; j < oIQp.length; j++) { 
                                if(parseInt(oIQp[j].getAttribute('isclick'))==0){ 
                                    oIQp[j].setAttribute('isclick', 1); 
                                    oIQp[j].parentNode.parentNode.className = 'bg'+j;
                                }
                            }
                            this.setAttribute('isclick', 0);
                            this.parentNode.parentNode.className =this.parentNode.parentNode.className+this.getAttribute('isclick'); 
                        }else{ 
                            this.parentNode.parentNode.className = 'bg'+(parseInt(this.getAttribute('order'))-1);
                            this.setAttribute('isclick', 1); 
                        }
                        opItime = '';  
                        survey.defaultEvent(e);
                    }
                } 
            }, 
            nextTopic:function(obj){//下一题   
                var qIemt = survey.getByClass(obj,'nextBtn');
                for(var i=0; i< qIemt.length; i++){  
                    qIemt[i].onclick=function(e){ 
                        var tObj = this.parentNode.parentNode,type=this.getAttribute('types');
                        var num =survey.verdict(tObj,type);//当前题目选择了几个选项 
                        pid = document.getElementById(this.getAttribute('pid')),
                        nid = document.getElementById(this.getAttribute('nid'));
                        if(parseInt(num)>0){//
                            if(survey.itemClass[type]=="alone"||survey.itemClass[type]=="double") {//单选和多选不显示对错
                                survey.verdictResult(pid,type);
                                MotionFrames.startMove(pid,{},850,function(){
                                    nid.style.display = 'block';
                                    pid.style.display = 'none'; 
                                });
                            }else{//开放单选和开放多选不显示对错
                                MotionFrames.startMove(pid,{},550,function(){
                                    nid.style.display = 'block';
                                    pid.style.display = 'none'; 
                                });
                            }  
                        }else{//提示至少选一个
                            survey.popupTier('popupTier').style.display = 'block';
                            MotionFrames.startMove(pid,{},700,function(){
                                survey.popupTier('popupTier').style.display = 'none';
                            });
                            
                        }

                    } 
                } 
            },
            verdictResult:function(pid,type){//判断当前题的结果  
                var itme = survey.getByClass(pid,survey.itemClass[type]);
                for (var i = 0; i < itme.length; i++) { 
                    if(parseInt(itme[i].getAttribute('isclick'))==0){
                        var iquestion = itme[i].getAttribute('iquestion');
                        itme[i].parentNode.parentNode.className='bg'+i+'0_'+iquestion;
                    }
                }; 
            },
            verdict:function(obj,type){//判断选着了几个答案
                var num = 0;
                var itme = survey.getByClass(obj,survey.itemClass[type]);
                for (var i = 0; i < itme.length; i++) {
                    var isclick = itme[i].getAttribute('isclick'); 
                    if(parseInt(isclick)==0){
                        num++;
                    }
                };
                return num;
            },
            startTest:function(){//开始答题
                var startBtn =  document.getElementById('startBtn'),
                pid = document.getElementById(startBtn.getAttribute('pid')),
                nid = document.getElementById(startBtn.getAttribute('nid')); 
                var qIemt = survey.getByClass(nid,'iQpages')[0];
                startBtn.onclick=function(e){//开始答题 
                    qIemt.style.display = 'block';
                    nid.style.display = 'block';
                    pid.style.display = 'none'; 
                };
            },
            psotResult:function(obj){//提交结果 
                var qIemt = survey.getByClass(obj,'lastClass')[0];
                qIemt.onclick =function(){
                    var pid = document.getElementById(this.getAttribute('pid'));
                    var tObj = pid,type=this.getAttribute('types');
                        var num =survey.verdict(tObj,type);//当前题目选择了几个选项   
                        if(parseInt(num)>0){ 
                            if(survey.itemClass[type]=="alone"||survey.itemClass[type]=="double") {//单选和多选不显示对错
                                survey.verdictResult(pid,type); 
                            }
                            survey.popupTier('popupMask').style.display = 'block';
                            MotionFrames.startMove(pid,{},550,function(){ 
                                survey.getResult();//组装结果提交
                            }); 
                        }else{//最后一题提示至少选一个
                            survey.popupTier('popupTier').style.display = 'block';
                            MotionFrames.startMove(pid,{},550,function(){
                                survey.popupTier('popupTier').style.display = 'none';
                            });
                        }
                }
            },
            getResult:function(){//组装结果提交
                survey.result="";
                var iQpageBox = document.getElementById(survey.iqBox);
                var iqItme =survey.getByClass(iQpageBox,'iQpages');
                for(var i=0; i<iqItme.length;i++){
                    var sqid = iqItme[i].getAttribute('sqid');
                    var sItme =survey.getByClass(iqItme[i],'subwrap'); 
                    var str='';
                    for(var j=0; j<sItme.length;j++){ 
                        var _this = sItme[j].getElementsByTagName('a')[0];
                        if(parseInt(_this.getAttribute('isclick'))==0){ 
                            var sqiid = _this.getAttribute('sqiid');
                            str += sqiid+',';//选择结果 
                        }
                    }
                    survey.result +='"'+sqid +'":"' + str.substring(0,str.length-1)+'",';
                }
                var answer= document.getElementById('answerInput');
                answer.value ='{'+ survey.result.substring(0,survey.result.length-1)+'}'; //去除字符串最后一个字符’-‘
                var postBtn = document.getElementById('postForm');
                MotionFrames.startMove(answer,{},500,function(){
                    if(answer.value){
                       postBtn.submit(); 
                    }
                });
                 
            },
            popupTier:function(objId){//提示至少选一个
                var popupTiers = document.getElementById(objId);  
                return popupTiers; 
            }, 
            getDatas:function(data){ //数据处理
                //var aJson= JSON.parse(data);
                var aJson= data;
                return aJson;
            },
            pinHTML:function(containerId,data){ //渲染视图  
                var strhtml="",sType='',itmeClass='',islast=0,lastClass='nextBtn';
                for(var i=0; i<data.questions.length;i++){ 
                    var title =data.questions[i].content,types=data.questions[i].type;
                    var dataItme = data.questions[i].items;
                    var itme ='',iquestion=0;
                    sType = survey.iqName[data.questions[i].type];
                    itmeClass = survey.itemClass[data.questions[i].type]; 
                    for (var j = 0; j < dataItme.length; j++) {
                        if(parseInt(dataItme[j].score)>0){ 
                            iquestion = 1;
                        }else{
                            iquestion = 0;  
                        }
                        itme += '<li class="bg'+j+'" sqiid="" iquestion="'+iquestion+'"><div class="subwrap">'
                            +'<a class="'+itmeClass+'" href="javascript:;" itme="1" isclick="1" sid="'+dataItme[j].sid+'" sqiid="'+dataItme[j].sqiid+'"'
                            +'iquestion="'+iquestion+'" order="'+dataItme[j].order+'" sqid="'+dataItme[j].sqid+'" islast="1">'+dataItme[j].content+'</a></div></li>';
                    };
                    if(i==(data.questions.length-1)){ 
                        lastClass ="lastClass";
                    } 
                    var haedr ='<div class="img-box" style="zoom: 0;">'
                        +'<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/t_h.jpg" />'
                        +'<div style=" position: absolute; width: 100%; text-align: center; left: 0%; top:38%; color: #00b7ee; font-size: 14px;">'
                        +'<span style=" font-size: 16px;">'+sType+'</span> 第'+(i+1)+'题/共'+data.questions.length+'题 </div></div>'
                        +'<div class="t-c">'+title+'</div> <div class="img-box">'
                        +'<img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/t_f.jpg" /></div>';

                    strhtml +='<section id="iQp_'+i+'" class="iQpages" iid="'+i+'" types="'+types+'" sqid="'+data.questions[i].sqid+'" style="display:none;">'
                        +haedr+'<div class="c-c" style="padding-bottom: 4%;"><ul class="oplist" style=" height: 40%;">'+itme+'</ul>'
                        +'<a href="javascript:;" class="'+lastClass+'"  pId="iQp_'+i+'" nId="iQp_'+(i+1)+'" types="'+types+'" > &nbsp;</a></div>' 
                        +'<div class="img-box"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/mobile/survey/r_f.jpg" /></div></section>'; 
                    }

                return strhtml;

            }  
        }; 
        
        window.onload = function(){ 
            JId('#layout').style.height = setHeight()+'px';
            JId('#fastBox').style.height = setHeight()+'px';
            JId('#popupTier').style.height = setHeight()+'px';
            JId('#popupMask').style.height = setHeight()+'px'; 
            survey.init('iQpageBox',dataStr);
        };
        
        function setHeight(){
            var hPage = window.document.body.clientHeight; 
            var hPageUsing = document.documentElement.clientHeight;
            if(hPageUsing > hPage){
                hPage = hPageUsing;
            }
            return hPage; 
        } 
    </script>
</body>
</html>