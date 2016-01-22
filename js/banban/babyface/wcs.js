var appId = 'wxa3e0fee749ef9692';    
var shareTitle = "惊喜！99%的孩子不曾拥有的儿童节";
var shareDescription = "萌娃这么晒 绝对是真爱";   
var shareUrl = strPolarBearWebRoot
var picUrl = strPolarBearPicRoot
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
  WeixinJSBridge.call('hideToolbar');
  WeixinJSBridge.on('menu:share:appmessage',
    function (argv) {
      WeixinJSBridge.invoke('sendAppMessage', {
        "appid": appId,
        "img_url": picUrl,
        "link": shareUrl,
        "desc": shareDescription,
        "title": shareTitle
      },
      function (res) {
      });
    });
  WeixinJSBridge.on('menu:share:timeline',
    function (argv) {
      WeixinJSBridge.invoke('shareTimeline', {
        "appid": appId,
        "img_url": picUrl,
        "link": shareUrl,
        "desc": shareDescription,
        "title": shareTitle
      },
      function (res) {
      });
    });
  WeixinJSBridge.on('menu:share:weibo',
    function (argv) {
      WeixinJSBridge.invoke('shareWeibo', {
                "img_url": picUrl,
                "content": shareDescription +shareTitle+shareUrl,
                "url": shareUrl,
                "title": shareTitle,
      },
      function (res) {
      });
    });
});

function shareWechatInit(title, desc, link, imgUrl) {
  WeixinJSBridge.invoke('shareTimeline', {
    "img_url": imgUrl,
    "link": link,
    "desc": desc,
    "title": title
  });
}