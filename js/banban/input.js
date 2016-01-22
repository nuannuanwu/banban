/**
 *
 * write by yue
 * time 2016.01.07 
 * 首页功能 
 *   
 */
$(function () { 
    ShowTips(); 
    $(":input").not(":input[type=submit],:input[type=button]").focus(function () {
        if ($(this).val() == this.defaultValue||$(this).val()=="") {
            $(this).val("");
        }
    }).blur(function () {
        if ($(this).val() == '') {
            $(this).val(this.defaultValue);
        }
    });

    /* 注:提示文字不能用input,防止使用tab键时出错 */
    $(".valueSpan").click(function () {
        ShowTips();
        $(this).css({ "color": "#d4d4d4" }).parent().find(".textInput").focus();
    });
    $(".textInput").focus(function () {
        //$(this).css({ "border": "2px solid #4fb1f4", "margin": 0 });
        $(this).parent().find(".valueSpan").css({ "color": "#d4d4d4" });
        ShowTips();
    });
    /* 判断input失去焦点时值是否为空 */
    $(".textInput").blur(function () {
        //$(this).css({ "border": "1px solid #A6A6A6", "margin": "1px" });
        //        if ($(this).val() == "") {
        //            $(this).parent().find(".valueSpan").show().css({ "color": "#999" });
        //        };
        ShowTips(); 
    });
    $(".textInput").keyup(function () {
        ShowTips();
    });
    /*$(document).mousemove(function () {
        ShowTips();
    });*/
    /* 判断键入的是否是tab键 */
    $(".textInput").keydown(function (event) {
        if (event.keyCode != 9) {
            $(this).parent().find(".valueSpan").hide();
        }
        if (event.keyCode == 13) {
            var txt = $(".textInput");
            var haveNoError = true;
            txt.each(function (i, item) {
                if ($(item).val() == "") { 
                    haveNoError = false;
                }
            }); 
        }
    });
    //    /*判断文本框是否幼稚*/
    //    if ($(".textInput").val() != "") {
    //        $(".valueSpan").hide();
    //    }
});

//页面 初始 判断 浏览器有没有记录密码
$(document).ready(function() { 
    window.setTimeout(function() {
        if ($('#username').val() != ""||$('#username').attr('data-form-un')) {
            var textInputs = $('.login').find('.textInput');
            textInputs.each(function (i, item) {
                $(item).parent().find(".valueSpan").hide();
            });
        } 

    }, 200);
});

//显示 输入框的提示函数
function ShowTips() {
    var textInputs = $(".textInput");
   // alert(textInputs.length);
    textInputs.each(function (i, item) {
        var vle = $(this); 
        if (vle.val()=="") {
            vle.parent().find(".valueSpan").show().css({ "color": "#999" }); 
        } else { 
            vle.parent().find(".valueSpan").hide(); 
        } 
    }); 
}

function bindEvent(obj, ev, fn)
{
    obj.addEventListener?obj.addEventListener(ev, fn, false):obj.attachEvent('on'+ev, fn);
}
function unbindEvent(obj, ev, fn)
{
    obj.removeEventListener?obj.removeEventListener(ev, fn, false):obj.detachEvent('on'+ev, fn);
}

var owen_placeholder={}; //输入框的 placeholder

(function (){
    owen_placeholder.create=function (oInput, text, defaultColor)
    {
        if(!oInput)return;
        
        if(!defaultColor)defaultColor='#9999';
        
        oInput.value='';
        
        var timer=null;
        var isDefault=true;
        
        __doDefault__();
        
        function onblur(ev)
        {
            var oEvent=ev||event;
            var oElement=oEvent.srcElement || oEvent.target;
            
            __doDefault__();
            
            clearInterval(timer);
        }
        function onfocus(ev)
        {
            var oEvent=ev||event;
            var oElement=oEvent.srcElement || oEvent.target;
            
            __cancelDefault__();
            
            timer=setInterval(function (){
                isDefault=oInput.value==0;
            }, 30);
        }
        
        bindEvent(oInput, 'blur', onblur);
        bindEvent(oInput, 'focus', onfocus);
        
        function __doDefault__()
        {
            if(oInput.value.length==0)
            {
                isDefault=true;
                
                oInput.style.color=defaultColor;
                oInput.value=text;
            }
            else
            {
                isDefault=false;
            }
        }
        
        function __cancelDefault__()
        {
            if(isDefault)
            {
                oInput.style.color='';
                oInput.value="";
            }
        }
        
        return {oInput: oInput, onblur: onblur, onfocus: onfocus};//用于删除
    };
    owen_placeholder.remove=function (handler)
    {
        unbindEvent(handler.oInput, 'blur', handler.onblur);
        unbindEvent(handler.oInput, 'focus', handler.onfocus);
        
        handler.oInput.style.color='';
    };
})();



//记住密码
$("#remembermeInfo").click(function(){
    var tip = $(this).attr('tip');
    if(tip=='0'){
        $("#rememberme").attr("checked",'checked');
        $("#remembermeInfo").find('em').removeClass('unCheked').addClass('cheked');
        $("#remembermeHidden").val('1');
        $(this).attr('tip','1');
    }else{
        $("#remembermeInfo").find('em').removeClass('cheked').addClass('unCheked');
        $("#remembermeHidden").val('0');
        $("#rememberme").removeAttr("checked");
        $(this).attr('tip','0');
    } 
});

//登录函数
function loginSubmit(){
    var username =$("#username").val();
    var password =$("#password").val();
    if(username==""||password==""){
       $('.errorSpanTip').text('用户名或密码不能为空');
       $('.error_info').text('');
    }else{
        
        $('#formBoxRegister').submit();
    } 
}
$('#lbtnLogin').click(function(){ //登录 
    loginSubmit();
});

$('#password').keydown(function(){ //登录 
    var event=arguments.callee.caller.arguments[0]||window.event;//消除浏览器差异  
    if (event.keyCode == 13){
        loginSubmit();
    }
});

//合作学校登录
$('#thirdPassword').keydown(function(){
    var event=arguments.callee.caller.arguments[0]||window.event;//消除浏览器差异  
    if (event.keyCode == 13){
        var username =$("#thirdUserN").val();
        var password =$("#thirdPassword").val();
         if(username=="" || password==""){
            $('.thirdErrorSpan').text('用户名或密码不能为空');
            //$('.error_info').text('');
        }else{
             $('#formBoxThird').submit();
        } 
    }
}); 

// 合作学校登录
var loginType = function(){
    var loginBox=$('#loginType');
    loginBox.find('.login-btns').on('click','a.click',function(){
        var type = $(this).index();
        var t =$(this).attr('t'), p =$(this).attr('p'); 
        $(this).addClass('active').siblings().removeClass('active');
        loginBox.find('.login-'+t).show().siblings('.login-'+p).hide();
        $('.other-login-type').show();
        $('.other-login-c').hide();
    });

    $('.other-login-type').on('click','a',function(){
        var id=$(this).data('id');
        var url=$(this).data('url');
        var imgUrl=$(this).find('img').attr('src');
        $('#type-logo').attr('src',imgUrl);
        $(this).parent().hide();
        $('.other-login-c').show();
        $('#thirdLoginBtn').attr('data-id',id);
        $('#unionLoginId').val(id);
        $('#thirdLoginBtn').attr('data-url',url);
        
    })
    $('.return-btn').click(function(){
         $('.other-login-type').show();
         $('.other-login-c').hide();
         $('.thirdErrorSpan').text('');
    })

     $('#thirdLoginBtn').click(function() {
        var username =$("#thirdUserN").val();
        var password =$("#thirdPassword").val();
         if(username=="" || password==""){
            $('.thirdErrorSpan').text('用户名或密码不能为空');
            //$('.error_info').text('');
        }else{
             $('#formBoxThird').submit();
        }
    });
}

$(function() {
    loginType();//
    var third = parseInt($('#thirdInput').val());
    if (third) {
        $('#thirdBtn').click(); 
        $('#area_' + third).click();
    } 

    //发送短信请求
    function ajaxPost(url,mobile){
        var str ="xx";
        $.ajax({
            url:url,
            type : 'POST',
            data : {mobile:mobile},
            dataType : 'json',
            async : false,
            contentType : 'application/x-www-form-urlencoded',
            success : function(mydata) {
                str = mydata;
            },
            error : function() {
                // alert("calc failed");
                str = "系统繁忙,请稍后再试";
            }
        });
        return str;
    } 

    //发送短信
    $('#sendPhoneBtn').click(function(){
        var phone = $('#sendPhoneCode').val(), url = $('#sendPhoneCode').attr('url'); 
        var text ='';
        if(phone){
            var str = ajaxPost(url,phone);
            if (str.status == 1) {
                var textColor = "#B4EB7C";
            } else {
                var textColor = "#EE0000";
            }
            text = str.msg;
            $('#senPhoneTip').text(text).css('color', textColor);
        }else{
            text = '请输入手机号';
            $('#senPhoneTip').text(text).css('color', textColor);
        } 
        $('#sendPhoneCode').val('');
    });
    
    $('#sendPhoneCode').live('focus',function(e){
        $('#senPhoneTip').text('');
    });
      
    //悬浮框发送短信
    $('#sendPhoneFloatBtn').click(function(){ 
        var phone = $('#sendPhoneFloatCode').val(),url = $('#sendPhoneFloatCode').attr('url');
        var text ='';
        if(phone){
            var str = ajaxPost(url,phone);
            if (str.status == 1) {
                var textColor = "#B4EB7C";
            } else {
                var textColor = "#B4EB7C";
            }
            text = str.msg;
            $('#senPhoneTips').text(text).css('color', textColor);
        }else{
            text = '请输入手机号';
            $('#senPhoneTips').text(text).css('color', textColor);
        }
        $('#sendPhoneFloatCode').val('');
    });

    $('#sendPhoneCode').live('focus',function(e){
        $('#senPhoneTips').text('');
    });  
});

// 公告隐藏
// $(".reminder .colse").click(function() {
//     $(this).parent('.reminder').hide();
// });


