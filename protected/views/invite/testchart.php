<style>
    .bgImgBox {
        background: url(/image/banban/activity/inviteIndexBg.png) no-repeat;
        overflow: hidden;
        height: 600px;
        width: 620px;
        margin-top: 30px;
    }

    a.inviteBtn {
        display: inline-table;
    }

    a.inviteBtn:hover {
        opacity: 0.9;
    }

    a.linkColor {
        color: #993300;
        vertical-align: 0px;
    }

    a.linkColor:hover {
        text-decoration: underline;
    }
</style>
<div id="mainBox" class="mainBox">
    <div id="contentBox" class="cententBox">
        <div class="titleHeader bBttomT">
            <span class="icon icon8"></span>测试Echart
        </div>
        <div class="box" id="box" style="width:800px;height:400px;border:1px solid #000080;">

        </div>
    </div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/api/require.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/api/echart/echarts.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        var baseUrl="<?php echo Yii::app()->request->baseUrl; ?>"+"/js";
        var localChart=baseUrl+'/api/echart';

        require.config({
                enforceDefine: true,
                baseUrl: baseUrl,
                paths: {echarts: ['http://echarts.baidu.com/build/dist',localChart]} //echarts.js的路径
        });
        // 使用
        require(
            [
                'echarts',
                'echarts/chart/bar' // 使用柱状图就加载bar模块，按需加载
            ],
            function (ec) {
                // 基于准备好的dom，初始化echarts图表
                var myChart = ec.init(document.getElementById('box'));
                var option = {
                    tooltip: {
                        show: true
                    },
                    legend: {
                        data:['销量']
                    },
                    xAxis : [
                        {
                            type : 'category',
                            data : ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value'
                        }
                    ],
                    series : [
                        {
                            "name":"销量",
                            "type":"bar",
                            "data":[5, 20, 40, 10, 10, 20]
                        }
                    ]
                };

                // 为echarts对象加载数据
                myChart.setOption(option);
            }
        );
    })
</script>
