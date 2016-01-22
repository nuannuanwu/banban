<!DOCTYPE html>
<html style="height: 100%;margin: 0; padding: 0; border: 0;overflow-x: auto;">
<head>
    <meta charset="UTF-8">
    <?php if('product'==BANBAN_ENVIRONMENT):?>
        <meta property="qc:admins" content="155124117662162166157" /><!-- QQ登录验证 -->
    <?php else: ?>
        <meta property="qc:admins" content="15512415605340061401170166375" /><!-- QQ登录验证 -->
    <?php endif; ?>
    <meta name="renderer" content="webkit|ie-comp">
    <title>班班 - 国内首款基于"班级"为单位，30万老师的家校沟通专属社交应用。班班客服：400 101 3838</title>
    <meta name="keywords" content="班班,班班网,班务管理,作业通知,蜻蜓校信,校信,校信通,校讯通,家校互动,家校沟通,免费校讯通,班费,教育,家校,平台,沟通,社交,班费,青豆,老师,家长">
    <meta name="description" content="班班是国内首款基于'班级'为单位，面向老师与家长之间，家长与家长之间的教育专属社交应用。班班是30万老师的家校沟通首选专属工具，比Q群、微信更实用。班班为老师家长提供一种全新的、专属的沟通和社交方式，为班级提供全新的管理增值服务方式。">
    <link rel="shortcut icon" type="image/ico" href="<?php echo Yii::app()->request->baseUrl; ?>/image/favicon.ico">

    <script src="<?php echo MainHelper::AutoVersion('/js/banban/jquery-1.7.2.min.js'); ?>" type="text/javascript"></script>

    <script type="text/javascript">
        //        $(function () {
        //            //检测IE
        //            if ($.browser.msie && $.browser.version == "6.0") {
        //                window.location.href = 'ie6update.html';
        //            };
        //        });
    </script>
    <style>
        *{
            margin:0;
            padding;0;
        }
        body{
            font-size: 18px;;
        }
        .loginBar{
            width:400px;
            height:400px;
            margin:0 auto;
            border:1px solid gray;
            padding-top:40px;
        }

    </style>
</head>
<body>
<form method="post" id="form1">
    <div class="loginBar ">
        <div class="input userName" style="margin-bottom: 10px;">
            <span class="valueSpan" style="margin-left:50px;display:inline-block;width:80px;color: rgb(153, 153, 153); ">手机号</span>
            <input id="username" name="ULoginForm[username]" value="" type="text" maxlength="30" style="width:120px;"
                   id="ContentPlaceHolder1_txtTelephone" class="textInput" size="11" autocomplete="off"
                   value="">
        </div>
        <div class="input password">
            <span class="valueSpan" style="margin-left:50px;text-align:left;display:inline-block;width:80px;color: rgb(153, 153, 153);">密&nbsp;&nbsp;&nbsp;码</span>
            <input style="width:120px;" id="password" name="ULoginForm[password]" value="" type="password" maxlength="16"
                   id="ContentPlaceHolder1_txtPwd" class="textInput" autocomplete="off">
        </div>
        <div class="input password" style="margin: 20px auto;text-align: center">
            <input type="button" id="ok" value="确定"/>
            <input type="button"  id="cancel" value="取消"/>
        </div>

    </div>
</form>
<?php Yii::app()->msg->printMsg();?> 
<script type="text/javascript">
    $(function(){
        $("#ok").click(function(){
            $("#form1").submit();
        });
        $("#cancel").click(function(){
            $("#username").val('');
            $("#password").val('');
        })
    })
</script>
</body>
</html>