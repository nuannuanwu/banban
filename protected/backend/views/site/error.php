<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <div style="text-align: center;">
        <?php if($error['code']==404){ ?> 
            <div>
                <h3> HTTP 404 - 您请求的页面无法访问，请稍候再试！</h3> 
            </div> 
        <?php }else if($error['code']==500){ ?> 
            <div>
                <h3>HTTP 500 - 服务器异常，，请稍候再试！</h3>
            </div> 
        <?php }else if($error['code']==502){ ?> 
                <div>
                    <h3>HTTP 502 - 服务器异常，，请稍候再试！</h3>
                </div>

        <?php }else{?>
                <div>
                    <h3>很抱歉！您请求的页面出错了，请稍候再试！</h3>
                </div> 
        <?php } ?>
    </div>  
</body>
</html>