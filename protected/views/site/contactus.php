<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>联系我们 - 班班团队。班班客服：400 101 3838</title>
    <meta name="keywords" content="班班,班班网,班务管理,作业通知,蜻蜓校信,蜻蜓班班,校信,校信通,校讯通,家校互动,家校沟通,免费校讯通,班费,家校,青豆">
    <meta name="description" content="深圳蜻蜓互动科技有限公司联系方式">
    <link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/newstyle.css'); ?>">
    <script src="<?php echo MainHelper::AutoVersion('/js/banban/jquery-1.7.2.min.js'); ?>" type="text/javascript"></script>
    ﻿<style> 
        .layout_div{width: 1000px; margin: 0 auto; overflow: hidden; clear: both; background:#fff; text-align:center; } 
        .container{
            background:#FFF;
        }
        .bgColor1{
            background:#FaFaFa;
        }
        .container{
            width:1000px;
            margin:20px auto;
            color:#000;
            overflow:hidden;
        }
        .container h1{
            text-align:center;
            font-weight:normal;
            font-size:24px;
            margin:30px 10px;

        }
        .container p{
            text-indent:2em;
            margin-bottom:10px;
            font-size:13px;
            line-height:26px;
        } 
        .about .sidebar{
            width:238px;
            border:1px solid #E5E5E5;
            float:left;
        }
        .about .content-box{
            margin-left:280px;
            padding-bottom:50px;
        }
        .about .sidebar ul li a{
            display:block;
            padding:10px 0 10px 20px;
            background:#F5F5F5;
            font-size:16px;
            border-left:8px solid #F5F5F5;
            color:#993300;
        }
        .about .sidebar ul li a:hover{
            text-decoration: none;

        }
        .about .sidebar ul li a.active{
            background:#E5E4DA;
            border-left:8px solid #F68D00;
            color:#000;
        }
        .center{
            text-align:center;
        }
        .about .content-box ul li{
            font-size:14px;
            line-height:24px;
            margin-bottom:10px;
        }
        .layout_div{
            overflow:visible;
        } 
    </style> 
</head>
<body> 
    <div id="contentBox" class="layout_div">
        <?php include('theader.php'); ?>  
    </div>
        <div style="border-top:8px solid #F59201;">
    	   <div class="container about">
    			<div class="sidebar">
    				<ul>
    					<li><a href="<?php echo Yii::app()->createUrl('site/about')?>" >关于班班</a></li>
    					<li><a href="<?php echo Yii::app()->createUrl('site/contactus')?>" class="active">联系我们</a></li>
    				</ul>
    			</div>
    			<div class="content-box">
    					<h1>联系我们</h1>
    				   	<ul>
    				   		<li><span>地址：</span>深圳市南山区高新南九道9号威新软件科技园1栋2楼西翼</li>
    				   		<li><span>邮编：</span>518057</li>
    				   		<li><span>市场总部：</span>0755-86080505</li>
    				   		<li><span>客服电话：</span>4001013838</li>
    				   		<li><div style="height:550px;border:#ccc solid 1px;margin-top:20px;" class="dutuw" id="dituContent"></div></li>
    				   	</ul>
    			</div>
    			
    		</div>
        </div>
        <?php include('tfooter.php'); ?>  
	   	<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script> 
		<script type="text/javascript">
    //创建和初始化地图函数：
    function initMap() {
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
        addMarker();//向地图中添加marker
    }

    //创建地图函数：
    function createMap() {
        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
        var point = new BMap.Point(100.954904, 22.536588);//定义一个中心点坐标
        map.centerAndZoom(point, 18);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }

    //地图事件设置函数：
    function setMapEvent() {
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }

    //地图控件添加函数：
    function addMapControl() {
        //向地图中添加缩放控件
        var ctrl_nav = new BMap.NavigationControl({ anchor: BMAP_ANCHOR_TOP_LEFT, type: BMAP_NAVIGATION_CONTROL_LARGE });
        map.addControl(ctrl_nav);
        //向地图中添加缩略图控件
        var ctrl_ove = new BMap.OverviewMapControl({ anchor: BMAP_ANCHOR_BOTTOM_RIGHT, isOpen: 1 });
        map.addControl(ctrl_ove);
        //向地图中添加比例尺控件
        var ctrl_sca = new BMap.ScaleControl({ anchor: BMAP_ANCHOR_BOTTOM_LEFT });
        map.addControl(ctrl_sca);
    }

    //标注点数组
    var markerArr = [{ title: "深圳蜻蜓互动科技有限公司", content: "威新科技园1号楼2层西翼", point: "113.954904|22.536613", isOpen: 1, icon: { w: 21, h: 21, l: 0, t: 0, x: 6, lb: 5 } }
    ];
    //创建marker
    function addMarker() {
        for (var i = 0; i < markerArr.length; i++) {
            var json = markerArr[i];
            var p0 = json.point.split("|")[0];
            var p1 = json.point.split("|")[1];
            var point = new BMap.Point(p0, p1);
            var iconImg = createIcon(json.icon);
            var marker = new BMap.Marker(point, { icon: iconImg });
            var iw = createInfoWindow(i);
            var label = new BMap.Label(json.title, { "offset": new BMap.Size(json.icon.lb - json.icon.x + 10, -20) });
            marker.setLabel(label);
            map.addOverlay(marker);
            label.setStyle({
                borderColor: "#808080",
                color: "#333",
                cursor: "pointer"
            });

            (function () {
                var index = i;
                var _iw = createInfoWindow(i);
                var _marker = marker;
                _marker.addEventListener("click", function () {
                    this.openInfoWindow(_iw);
                });
                _iw.addEventListener("open", function () {
                    _marker.getLabel().hide();
                })
                _iw.addEventListener("close", function () {
                    _marker.getLabel().show();
                })
                label.addEventListener("click", function () {
                    _marker.openInfoWindow(_iw);
                })
                if (!!json.isOpen) {
                    label.hide();
                    _marker.openInfoWindow(_iw);
                }
            })()
        }
    }
    //创建InfoWindow
    function createInfoWindow(i) {
        var json = markerArr[i];
        var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>" + json.content + "</div>");
        return iw;
    }
    //创建一个Icon
    function createIcon(json) {
        var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w, json.h), { imageOffset: new BMap.Size(-json.l, -json.t), infoWindowOffset: new BMap.Size(json.lb + 5, 1), offset: new BMap.Size(json.x, json.h) })
        return icon;
    }

    initMap();//创建和初始化地图
</script> 
</body>
</html>
