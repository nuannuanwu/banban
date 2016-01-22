/* 
 *  站点弹框提醒
 *  ht
 *  Copyright 2015.06
 *  
  *调用 如下：  
    var ts = new Tooltip();
    var obj ={ title:'', msg:''};
    ts.showTooltip(obj);
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/banban/tooltip.js"></script> 
 */
   
var Tooltip =(function($){  
    var Class = function() { }; 
    
    var now = Date.now || function() {
        return new Date().getTime();
    };  
    var ts = now();
    var tsid = 'tooltip_' + ts;
    /*浏览器判断*/
    function tooltipgetBrow () {
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
    }; 
    /*根据浏览器大小控制网页大小*/
    function tooltipDh(){
        var hPage = window.document.body.offsetHeight; 
        var hPage_Using = document.documentElement.offsetHeight;
        var LayoutBody = document.getElementById('layoutBodyBox');
        var ContentBox = document.getElementById('contentBox');
        var HeaderBox = document.getElementById('headerBox'); 
        if(tooltipgetBrow() == "msie7.0" || tooltipgetBrow() == "msie6.0" || tooltipgetBrow() == "msie5.0"){  
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
    };
    
    Class.prototype.Init = function(){  
        var ii = now();
       // console.log(ii);
    }; 
    /* 
     * Remind弹框 
     * @param {字符串} showbar 弹框的#id 
     */ 
    Class.prototype.showTooltip = function (obj){   
        var html = this.tooltipHtml(tsid,obj); 
        $("#layoutBodyBox").append(html);
        this.showTooltipMask(tsid); 
        this.tooltipPosition(tsid);
        $('#'+tsid).show();
         var _this = this;
        $('#'+tsid).find('.header').on('click','a.close',function(){
            _this.removeTooltipMask(tsid);
        });
        $('#'+tsid).find('.popupBtn').on('click','a.btn',function(){
            _this.removeTooltipMask(tsid);
        });
    };
    /* 
     * Remind蒙层
     * @param {字符串} showbar 弹框的#id 
     */ 
    Class.prototype.showTooltipMask = function(sid){ 
        var maskCon = '<div id="'+sid+'_Mask" class="promptMask"></div>';
        $(maskCon).appendTo($("#layoutBodyBox")); 
        var hg = tooltipDh()+'px';
        $("#"+sid+"_Mask").css({
            "height":hg,
            "opacity":"0.6",
            "width":"100%",
            "top":"0",
            "left":"0",
            "position":"fixed",
            "z-index":"9999",
            "background":"#000000"
        });
    };
    
    /*
    * 移除弹出框与蒙层
    * @param {字符串} showbar 弹框的#id 
    */
    Class.prototype.removeTooltipMask = function (showbar){ 
       $("#"+showbar).remove();
       $("#"+showbar+"_Mask").remove();
    };
    /*
    * 弹出框 Position
    * @param {字符串} showbar 弹框的id 
    */
    Class.prototype.tooltipPosition = function (showbar){ 
        boxhit= -($('#'+showbar).height()/2);
        boxwit= -(($('#'+showbar).width()/2));
        $('#'+showbar).css({
            "left":"50%",
            "top":"45%",
            'marginTop':boxhit+'px',
            'marginLeft':boxwit+'px'
        }); 
    }
     /*
    * 弹出框 html
    * @param {字符串} showbar 弹框的id 
    */
    Class.prototype.tooltipHtml = function(showbar,obj){
        var title = '';
        if(obj.title){
            title = obj.title;
        }
         return  '<div id="'+showbar+'" class="popupBox">'
                +'<div class="header">'+ title +'<a href="javascript:void(0);" class="close"> </a></div>'
                +'<div id="popupInfo" style="padding:10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">'
                +'<div class="centent">'+obj.msg+'</div>'
                +'<div class="popupBtn"><a id="deleLink" href="javascript:void(0);" class="btn btn-orange">确 定</a>'
                +'</div></div></div>';
    };
    
    return Class;
   
})($);


