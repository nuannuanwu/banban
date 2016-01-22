/*!
 * cookies 操作 
 * Copyright 201411, 何挺 
 */  
var CookieOperate ={
    /*
    * 写cookies
    * @param {字符串} name cookie名称
    * @param {字符串} value cookie值
    * @param {字符串} time cookie时场 
    */ 
    setCookie : function(name,value,time){
        var strsec = CookieOperate.getSec(time);
        var exp = new Date();
        exp.setTime(exp.getTime() + strsec*1);
        document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString()+";path=/";
    },
    /*
    * getSec 时间单位
    * @param {字符串} str 
    * s20是代表20秒
    * h是指小时，如12小时则是：h12
    * 
    */
    getSec : function(str){
        //alert(str);
        var str1=str.substring(1,str.length)*1;
        var str2=str.substring(0,1);
        if (str2=="s"){ //s20是代表20秒
             return str1*1000;
        }
        else if (str2=="h"){//h是指小时，如12小时则是：h12
            return str1*60*60*1000;
        }
        else if (str2=="d"){//d是天数，30天则：d30
            return str1*24*60*60*1000;
        }
    },
    /*
    * getCookie 获取cookeie
    * @param {字符串} name cookeieName 
    * 
    */
     getCookie : function(name) {
        var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)"); 
        if(arr=document.cookie.match(reg)) {
            return (arr[2]);
        }else{
            return null;
        }
    },
    /*
    * delCookie 删除cookies
    * @param {字符串} name cookeieName 
    * 
    */
    delCookie : function(name){
        var exp = new Date();
        exp.setTime(exp.getTime() - 1);
        var cval=getCookie(name);
        if(cval!=null){
         document.cookie= name + "="+cval+";expires="+exp.toGMTString()+"; path=/";
        }
    }
};

/*!
 * 用户体验优化 操作 
 * Copyright 201411, 何挺 
 * obj 
 * str 操作的元素
 */  
//用户体验优化 
function clickTarget(obj,str){
    $(document).click(function(e){ 
        if($(e.target).eq(0).is(obj)){  
        }else{
            if($(str).is(":visible")){ 
                $(str).hide();
            }else{  
            } 
        }
    }); 
}

//textarea长度验证
function checktext(text) {
    allValid = true;
    for (i = 0; i < text.length; i++) {
        if (text.charAt(i) != " ") {
            allValid = false;
            break;
        }
    }
    return allValid;
} 
 
//输入框字数提示
function gbcount(messages, totals, useds, remains) {
    var max, reg=/^\s+$/; 
    max = totals.value;  
    //alert(reg.test(messages.value));
    if(!reg.test(messages.value)){ 
        if (messages.value.length > max) {
             
            messages.value = messages.value.substring(0, max);
            useds.value = max;
            remains.value = 0;
            $("#remains_text").text(remains.value); 
            //alert('抱歉，你输入的内容已超过'+max+'个字!'); 
        }else {
            
            useds.value = messages.value.length;
            remains.value = max - useds.value;
            $("#remains_text").text(remains.value);
            
        }
    }else{
        
        messages.value=messages.value.replace(/^\s+$/gi,""); 
    } 
} 

//快捷评论输入框提示
function kbcount(messages,kid){
    var reg=/^\s+$/; 
    //alert(reg.test(messages.value));
    if(!reg.test(messages.value)){
        if(messages.value.length>100){ 
            $("#"+kid).parents(".commentsBox").find('.kbcountRedinfo').text('评论不能大于100个字').show(); 
        }else{ 
            $("#"+kid).parents(".commentsBox").find('.kbcountRedinfo').text('评论不能为空').hide();
        }
      }else{ 
        messages.value =messages.value.replace(/^\s+$/gi,"");
    }
}

//详情评论输入框提示
function kbcountInfo(messages,kid){ 
    var reg=/^\s+$/;
    //alert(reg.test(messages.value));
    if(!reg.test(messages.value)){ 
        if(messages.value.length>100){ 
            $("#"+kid).show(); 
        }else{  
           $("#"+kid).hide();
        }
    }else{  
        messages.value=messages.value.replace(/^\s+$/gi,"");  
    }
}

//输入框输入空格判断
function inputBlank(messages){
    var reg=/^\s+$/; 
    //alert(reg.test(messages.value));
    if(!reg.test(messages.value)){ 
      }else{ 
        messages.value =messages.value.replace(/^\s+$/gi,"");
    }
}

//输入框输入数字判断
function inputNumber(messages){
    var reg=/\D/; 
    //alert(reg.test(messages.value));
    if(!reg.test(messages.value)){ 
      }else{ 
        messages.value =messages.value.replace(/\D/g,"");
    }
} 

//浏览器判断
function getBrowser() {
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
//表单 阻止回车提交
// onkeydown="javascript:return gosearch()"
function gosearch(){
    if(window.event.keyCode == 13){ 
        return false; 
    } 
} 