<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>关于班班 - 国内首款基于"班级"为单位，面向老师开放注册建班，老师家长免费使用的新型社交应用。班班客服：400 101 3838</title>
		<meta name="keywords" content="班班,班班网,关于班班,班务管理,作业通知,蜻蜓校信,蜻蜓班班,校信,校信通,校讯通,家校互动,家校沟通,免费校讯通,班费,家校,青豆">
		<meta name="description" content="'班班'是国内首款基于'班级'为单位，面向老师开放注册建班，老师家长免费使用的新型社交应用，班班为老师和家长提供一种全新的、专属的沟通和社交方式。">
		<link rel="stylesheet" type="text/css" href="<?php echo MainHelper::AutoVersion('/css/banban/newstyle.css'); ?>">
		<style>
			body,a ,p,input,h1,h2,h3,h4,h5,h6,ul,li,dl,dt,dd,form{margin:0;padding:0;list-style:none;vertical-align:middle;}
			body{
				font-family:"微软雅黑";
			}
			img{
				border:none;
			}
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
            .layout_div{width: 1000px; margin: 0 auto; overflow: hidden; clear: both; background:#fff; text-align:center; }  
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
						<li><a href="<?php echo Yii::app()->createUrl('site/about')?>" class="active">关于班班</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('site/contactus')?>">联系我们</a></li>
					</ul>
				</div>
				<div class="content-box">
					<p class="center"><img src="<?php echo Yii::app()->request->baseUrl; ?>/image/banban/login/about.jpg"/ alt="蜻蜓互动前台"> </p>
					<h1>关于班班</h1>
			    	<p>"班班"是由深圳蜻蜓互动科技有限公司针对老师、家长交流刚需而研发的一款移动互联网教育社交应用。是国内首款基于"班级"为单位，面向老师开放注册建班，老师家长免费使用的新型社交应用，为老师和家长提供一种全新的、专属的沟通和社交方式。 </p>
			    	<p>班班产品一经推出，产品功能与服务深受众多学校和家长的青睐和认可。班班市场的拓展正迅速从深圳、成都、山东、广州、武汉、云南、江苏等区域向全国范围扩张。</p>
			    	<p>班班创始团队成员均是由资深互联网人士或教育界专业人士组成。大多团队成员来自知名IT公司，目前即时吸纳部分极具创意的互联网新锐精英，构建了一支充满激情与活力的班班特战队。速度和激情是班班团队践行的工作信条，在这里没有繁复的制度和流程，每个人都在自由、开放的工作状态中，获得产品、设计和创意实现的愉悦和自我挑战式的成长。</p>
				</div>
				
			</div>
		</div>
        <?php include('tfooter.php'); ?>
    </body>
</html>