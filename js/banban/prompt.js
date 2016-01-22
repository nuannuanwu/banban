/*!
 * 消息 预览弹框  
 *
 * Copyright 201405-201406, 何挺
 * 
 *调用 如下：  
<div id="popupBox" class="popupBox">
<div class="header">广告预览 <a href="javascript:void(0);" class="close" onclick="hidePormptMask('popupBox')" > </a></div>
  <div id="popupInfo"> 
          <h3>文章标题</h3> 
     <div class="prompt">
          <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/1.jpg" width="365px">
      </div>
     <div class="centent">三楼酒吧间摆放壹张圆桌,铺上白布,上面摆放自制泡末梅花鹿一个,旁边摆放圣诞小屋。</div>
  </div> 
 </div>
 <a href="javascript:void(0);" onclick="showPromptsIfon('#popupBox')"></a>
  <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/popupVeiw.js"></script> 
 */
 
 /*
  * 编辑预览弹框
  * @param {字符串} showbar 弹框的class
  * @param {字符串} title 标题框id
  * @param {字符串} text 内容框id  
  */
 function showPrompts(showbar,title,text){ 
    $("#popupInfo").html('');
    var titles = $("#"+title).val();  
    var img = $("#previewNew").html() ;
    var contentText = tinyMCE.getInstanceById(text).getBody().innerHTML;
    if(titles!=''){
        showMask(showbar);
        pormptPos(showbar);
        var str ='<h3>' + titles + '</h3><div class="prompt">' + img + '</div><div class="centent">' + contentText + '</div>';
        $("#popupInfo").html(str);
        $("." + showbar).show();
    }else{ 
    }
    //$('html,body').css('overflow','hidden');
} 
 
/* 
 * 详情预览弹框
 * @param {字符串} showbar 弹框的class  
 */
function showPromptsIfon(showbar){ 
      //$("#layoutBodyBox").css("position","static");
     showMask(showbar);
     pormptPosBox(showbar);
     $("." + showbar).show();
    // $('html,body').css('overflow','hidden');
}
 
 /* 
 * showPromptPush
 * Remind弹框 
 * @param {字符串} showbar 弹框的#id 
 */ 
function showPromptPush(showbar){ 
    //$(".layoutBodyBox").css("position","static");
    showMaskWeb(showbar);
    pormptPosPush(showbar);
    $(showbar).show();
   // $('html,body').css('overflow','hidden');
}

/* 
 * Remind弹框 
 * @param {字符串} showbar 弹框的#id 
 */ 
function showPromptBox(showbar){ 
    //$(".layoutBodyBox").css("position","static");
    showMaskWeb(showbar);
    pormptPosBox1(showbar);
    $(showbar).show();
   // $('html,body').css('overflow','hidden');
}
 /* 
 * 详情预览弹框
 * @param {字符串} showbar 弹框的class  
 */
function showPrompts(showbar){
	showMask();
	pormptPos(showbar);
	$("." + showbar).show();
       // $('html,body').css('overflow','hidden');
}

/* 
 * Remind弹框 
 * @param {字符串} showbar 弹框的#id 
 */ 
function showPromptsRemind(showbar){ 
    // $(".layoutBodyBox").css("position","static");
     showMaskWeb(showbar);
     pormptPosWeb(showbar);
     $(showbar).show();
     //$('html,body').css('overflow','hidden');
}

/* 
 * 详情预览弹框 
 * @param {字符串} showbar 弹框的#id 
 */ 
function showPromptsIfonWeb(showbar){ 
    showMaskWeb(showbar);
    pormptPosWeb(showbar);
    $(showbar).show();
    //$('html,body').css('overflow','hidden');
}

/* 
 * 详情预览弹框 
 * @param {字符串} showbar 弹框的#id 
 */ 
function showPromptsImg(showbar){ 
    // $(".layoutBodyBox").css("position","static");
    showMaskWeb(showbar);
    pormptPosImgs(showbar);
    $(showbar).show();
    //$('html,body').css('overflow','hidden');
}

/*
 * 显示蒙板 
 * @param {字符串} showbar 弹框的#id 
 */
function showMask( ){ 
   // $(".layoutBodyBox").css("position","static");
    var Box = "hidePormptMask('"+showbar+"')"; 
    //maskCon = "<div class='promptMask' onclick="+Box+"></div>";
    maskCon = "<div class='promptMask'></div>";
    $(maskCon).appendTo($("body"));
    var hg = documentHeight()+'px';
    $(".promptMask").css({
            "height":hg,
            "opacity":"0.7",
            "width":"100%",
            "top":"0",
            "left":"0",
            "background":"#bababa",
            "position":"fixed",
            "z-index":"9999"
    });
}
 

/*
 * 显示蒙板 
 * @param {字符串}
 */
function showMasks(){
    //$(".layoutBodyBox").css("position","static");
    maskCon = '<div class="promptMask"></div>'
    $(maskCon).appendTo($("body"));
    var hg = documentHeight()+'px';
    $(".promptMask").css({
            "height":hg,
            "opacity":"0.7",
            "width":"100%",
            "top":"0",
            "left":"0",
            "position":"fixed",
            "z-index":"9999",
            "background":"#000000"
    });
}
function showMaskWeb(showbar){
    //$(".layoutBodyBox").css("position","static");
  if (showbar.substr(0,1)=='#') {var sId = showbar.substr(1); }
  var maskCon = '<div id="'+sId+'_Mask" class="promptMask"></div>';
  $(maskCon).appendTo($("#layoutBodyBox")); 
  var hg = documentHeight()+'px';
  $("#"+sId+"_Mask").css({
    "height":hg,
    "opacity":"0.6",
    "width":"100%",
    "top":"0",
    "left":"0",
    "position":"fixed",
    "z-index":"9999",
    "background":"#000000"
  });
}

/*
 * 弹出框居中设置
 * @param {字符串} showbar 弹框的class  
 */
function pormptPosWebs(showbar){ 
    scrollT = $('#mianOver').scrollTop();
    offX = ($(window).width()-$("." + showbar).width())/2;
    offY = ($(window).height()-$("." + showbar).height())/2 + scrollT;
     if(offY< 250 || offY > 250){
       offY = 250 + scrollT; 
    }
    $("." + showbar).css({
            "left":offX - 100 +  "px",
            "top":offY - 250 + "px"
    });
}
/*
 * 预览图片弹出框居中设置
 * @param {字符串} showbar 弹框的id  
 */
function pormptPosImgs(showbar){ 
    boxhit= -($(showbar).height()/2);
    boxwit= -($(showbar).width()/2);
    $(showbar).css({
        "left":"50%",
        "top":"50%",
        'marginTop':boxhit+'px',
        'marginLeft':boxwit+'px'
    });
} 

/*
 * 根据设定框设置弹出框居中设置
 * @param {字符串} showbar 弹框的class 
 */
function pormptPosBox(showbar){ 
    scrollT = $('#mianOver').scrollTop();
    offX = ($('#mianOver').width()-$("." + showbar).width())/2;
    offY = ($('#mianOver').height()-$("." + showbar).height())/2 + scrollT;
    if(offY< 250 || offY > 250){
       offY = 250 + scrollT; 
    }
    $("." + showbar).css({
            "left":offX -50 +  "px",
            "top":offY - 250 + "px"
    }); 
}
 
/*
 * 弹出框居中设置
 * @param {字符串} showbar 弹框的#id  
 */
function pormptPos(showbar){ 
//    scrollT = $('#mianOver').scrollTop();
//    offX = ($(window).width()-$(showbar).width())/2;
//    offY = ($(window).height()-$(showbar).height())/2 + scrollT;
    boxhit= -($(showbar).height()/2);
    boxwit= -(($(showbar).width()/2));
    $(showbar).css({
        "left":"50%",
        "top":"45%",
        'marginTop':boxhit+'px',
        'marginLeft':boxwit+'px'
    }); 
}


/*
 * 弹出框居中设置
 * @param {字符串} showbar 弹框的#id 
 */
function pormptPosWeb(showbar){
//    scrollT = $('#layoutBodyBox').scrollTop();
//    offX = ($(window).width()-$(showbar).width())/2;
//    offY = ($(window).height()-$(showbar).height())/2 + scrollT;
    boxhit= -($(showbar).height()/2);
    boxwit= -(($(showbar).width()/2));
    $(showbar).css({
        "left":"50%",
        "top":"45%",
        'marginTop':boxhit+'px',
        'marginLeft':boxwit+'px'
    }); 
}

/*
 * 弹出框居中设置
 * @param {字符串} showbar 弹框的#id 
 */
function pormptPosPush(showbar){
    //offX = ($(window).width()-$(showbar).width())/2;
    //offY = ($(window).height()-$(showbar).height())/2 + $(window).scrollTop();
    boxhit= -($(showbar).height()/2);
    boxwit= -(($(showbar).width()/2));
    $(showbar).css({
        "left":"50%",
        "top":"40%",
        'marginTop':boxhit+'px',
        'marginLeft':boxwit+'px'
    });
}
/*
 * showPromptBox
 * 弹出框居中设置
 * @param {字符串} showbar 弹框的#id 
 */
function pormptPosBox1(showbar){
    //offX = ($(window).width()-$(showbar).width())/2;
    //offY = ($(window).height()-$(showbar).height())/2 + $(window).scrollTop();
    boxhit= -($(showbar).height()/2);
    boxwit= -(($(showbar).width()/2));  
    $(showbar).css({
        "left":"50%",
        "top":"20%",
        'marginTop':boxhit+'px',
        'marginLeft':boxwit+'px'
    });
}
/*
 * 弹出框居中设置
 * @param {字符串} showbar 弹框的class 
 */
function pormptPos(showbar){
  offX = ($(window).width()-$("."+showbar).width())/2;
  offY = ($(window).height()-$("."+showbar).height())/2 + $(window).scrollTop();
  $("." + showbar).css({
    "left":offX + "px",
    "top":offY - 110 + "px"
  });
}
/*
 * 移除弹出框与蒙板
 * @param {字符串} showbar 弹框的class 
 */
function hidePormptMask(showbar){  
    $("." + showbar).hide();
    $(".promptMask").remove();
    $("#layoutBodyBox").css("position","relative"); 
    //$('html,body').css('overflow','visible'); 
} 

/*
 * 移除弹出框与蒙板
 * @param {字符串} showbar 弹框的#id 
 */
function hidePormptMaskWeb(showbar){
    if (showbar.substr(0,1)=='#') {var sId = showbar.substr(1); }
    $(showbar).hide();
    $("#"+sId+"_Mask").remove();
    //$("#layoutBodyBox").css("position","relative"); 
    //$(showbar).find('input:[type=text]').val('');
    $(showbar).find('.error').text('');
    // $('html,body').css('overflow','visible');

}
/*
 * 移除弹出框与蒙板
 * @param {字符串} showbar 弹框的#id 
 */
function hidePormptMaskGred(showbar){
    if (showbar.substr(0,1)=='#') {var sId = showbar.substr(1); }
    $(showbar).hide();
    $("#"+sId+"_Mask").remove();
    $("#layoutBodyBox").css("position","relative"); 
    //$('html,body').css('overflow','visible');
}

//获取元素的纵坐标 
function getTop(e){ 
    var offset=e.offsetTop; 
    if(e.offsetParent!=null) offset+=getTop(e.offsetParent); 
    return offset; 
} 
//获取元素的横坐标 
function getLeft(e){ 
    var offset=e.offsetLeft; 
    if(e.offsetParent!=null) offset+=getLeft(e.offsetParent); 
    return offset; 
} 

function getElemPos(obj){
    var pos = {"top":0, "left":0};
     if (obj.offsetParent){
       while (obj.offsetParent){
         pos.top += obj.offsetTop;
         pos.left += obj.offsetLeft;
         obj = obj.offsetParent;
       }
     }else if(obj.x){
       pos.left += obj.x;
     }else if(obj.x){
       pos.top += obj.y;
     }
     alert( pos.left+'==='+pos.top)
     return {x:pos.left, y:pos.top};
}
function documentHeight() {//根据浏览器大小控制网页大小
    var hPage = window.document.body.offsetHeight; 
    var hPage_Using = document.documentElement.offsetHeight;
    var LayoutBody = document.getElementById('layoutBodyBox');
    var ContentBox = document.getElementById('contentBox');
    var HeaderBox = document.getElementById('headerBox'); 
    if(getBrowsers() == "msie7.0" || getBrowsers() == "msie6.0" || getBrowsers() == "msie5.0"){  
        //var Width_Sider = Sider.offsetWidth;
        //var Height_Crumb = Crumb.offsetHeight; 
        //若以上无效，则采用(主要是IE6.0，5.0需要)
        if(hPage > hPage_Using){
            hPage = hPage;
        } 
    }
    var hHeader = 0;
    var MainH = ContentBox.offsetHeight; 
    if(HeaderBox){  
        hHeader = HeaderBox.offsetHeight; 
        if((MainH+hHeader)>=hPage){ 
            var ph = parseInt((MainH+hHeader)-hPage);
            hPage = MainH;
            if(ph>hHeader){
                hHeader = ph-hHeader; 
            } 
        }else{
           hHeader = 0; 
        }
    }
    return  (hPage+hHeader);
}
 
function getBrowsers() {//浏览器判断
    var Sys = {};
    var ua = navigator.userAgent.toLowerCase();
    var re = /(msie|firefox|chrome|opera|version).*?([\d.]+)/;
    var m = ua.match(re);
    if(m&&m[1]){
            Sys.browser = m[1].replace(/version/, "'safari");
            Sys.ver = m[2];
            return Sys.browser + Sys.ver;
    }else{
            return '';
    }
} 