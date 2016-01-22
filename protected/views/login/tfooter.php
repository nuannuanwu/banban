<div id="footer" class="footer">
    <p>
        <a href="http://cdds.cdedu.com/">成都数字学校</a> |
        <a href="http://www.sneduyun.com/">陕西教育人人通综合服务平台</a> |
        <a href="http://www.edusafety.cn/">广东省校园安全管理平台</a> |
        <a href="<?php echo SCHOOL_NOTICE_LOGIN; ?>" target="_blank">合作学校管理平台</a> 
    </p>
     <p>
        <!--<a href="http://www.qthd.com/about.aspx?type=lianxi" target="_blank">联系我们</a>｜<a href="http://www.qthd.com/joinus.aspx" target="_blank">招聘信息</a>-->
        <!--｜<a href="http://www.qthd.com/about.aspx?type=lianxi" target="_blank">关于蜻蜓校信</a> ｜深圳蜻蜓互动科技有限公司--> 
        <a href="javascript:;"  onclick="AddFavorite('班班','http://www.jb51.net')">一键收藏</a> |
        <a href="<?php echo Yii::app()->createUrl('site/about')?>">关于班班</a> | <a href="<?php echo Yii::app()->createUrl('site/contactus')?>" >联系我们</a> | <a href="http://www.miibeian.gov.cn">粤ICP备14076064号-4</a>
     </p>
</div>

<!-- 右侧悬浮框 -->
<div class="floatFightBox" style="display:block;">
    <div class="floatFight_c">
        <div class="floatFight_t">
            <span>●</span>扫描二维码下载班班 
        </div>
        <div class="floatFight_b">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/logo/erxiaoxin150.png" />
        </div>
        <div class="floatFight_t">
            <span>●</span>短信下载 
        </div>
        <div class="floatFight_b">
           <div style=" position:relative; padding-bottom: 5px; "> 
                <form style="width: 100%; "> 
                    <div class="input sendPhoneCode" style=" position: relative; margin-bottom: 10px; background:#ffffff url('/image/banban/login/imgs/slipt.png') no-repeat -67px -181px; width: 142px; height: 27px;">
                        <span class="valueSpan" style="display: block;  position: absolute;  left: 10px;  top: 0; font-size: 13px; height: 27px;  line-height: 27px; z-index: 5; color: rgb(153, 153, 153); border: none;">请输入手机号</span>
                        <input id="sendPhoneFloatCode" class="textInput" url="<?php echo Yii::app()->createUrl('ajax/sendsmsbydownload');?>"  type="text" maxlength="11" style="display: block; position: absolute; top:0; left:10px; height: 27px; font-size: 13px; color: rgb(90, 90, 90); border: none;" onkeyup="this.value=this.value.replace(/\D/g,'')"  onafterpaste="this.value=this.value.replace(/\D/g,'')" value=""/>
                    </div> 
                </form>
                <a href="javascript:;" id="sendPhoneFloatBtn" rel="sendPhoneFloatCode" class="btns btns-orange" style="display:inline-block; width: 142px; font-size: 13px; padding:2px 0; text-decoration: none; margin-right: 0px;">发送</a>
            </div>
            <div id="senPhoneTips" class="colorS" style="height:20px; ont-size:13px; text-align: left; color: #EE0000;"> </div> 
        </div>
    </div>
</div>
<!-- /右侧悬浮框 -->
<div class="scroll" id="scroll" style="display: none;"> </div>
<script type="text/javascript" src="<?php echo MainHelper::AutoVersion('/js/banban/input.js'); ?>"></script>
 <script>
     $(function(){
        showScroll();
        function showScroll(){
            $(window).scroll( function() { 
                var scrollValue=$(window).scrollTop();
                scrollValue > 100 ? $('div[class=scroll]').fadeIn():$('div[class=scroll]').fadeOut();
            } );	
            $('#scroll').click(function(){
                $("html,body").animate({scrollTop:0},200);	
            });	
        }


    });
    function AddFavorite(title, url) {
        try {
            window.external.addFavorite(url, title);
        }
        catch (e) {
            try {
                window.sidebar.addPanel(title, url, "");
            }
            catch (e) {
                alert("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请进入新网站后使用Ctrl+D进行添加");
            }
        }
    }
</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?1ef1ca666d51f73f124385c51037c5d0";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>