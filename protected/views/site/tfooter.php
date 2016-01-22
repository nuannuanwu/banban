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
        <a href="javascript:;" style="color:#993300;text-decoration:none;"onclick="AddFavorite('班班','http://www.jb51.net')">一键收藏</a> |
       <a style="color:#993300;text-decoration:none;" href="<?php echo Yii::app()->createUrl('site/about')?>">关于班班</a> | <a href="<?php echo Yii::app()->createUrl('site/contactus')?>"  style="color:#993300;text-decoration:none;">联系我们</a> | <a href="http://www.miibeian.gov.cn">粤ICP备14076064号-4</a>
     </p>
</div>
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