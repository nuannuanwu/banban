/* 
 * 站点班级分享
 * ht
 * 20150601
 */
var ShareClass={
    int:function(shareUrl,bdTexts,bdDescs,bdPic){  
        window._bd_share_config = {
            common : {
                bdText : bdTexts,	
                bdDesc : bdDescs,	
                bdUrl : shareUrl, 	
                bdPic : bdPic+'/image/banban/logo/logo.png'
            },
            share : [{
                "bdSize" : 32
            }] 
        };
        with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
    }
}; 



  