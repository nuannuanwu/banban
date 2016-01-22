
<div class="box">
    <div class="form tableBox" style="margin-bottom: 30px;">
        <form action="<?php echo Yii::app()->createUrl('school/updateschoolsms/'.$model->sid);?>" id="business-form" method="post">
            <table class="tableForm">
                <thead></thead>
                <tbody>
                <tr>
                    <td class="td_title_Long">剩余短信条数 ：</td>
                    <td>
                        <div style="display: inline;">
                            <input style="width: 80px" type="text" name="smsnum" value="<?php echo (int)$model->smsnum;?>" />
                        </div>
                        <span class="Validform_checktip "></span>
                        <div style=" color:#999; margin-top: 10px; ">

                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <table class="tableForm">
                <thead></thead>
                <tbody>
                <tr>
                    <td class="td_title_Long"></td>
                    <td>
                        <input type="submit" class="btn btn-primary" value="保 存">&nbsp;&nbsp;
                        <!-- <a id="sub_from" href="javascript:void(0);" >创 建</a> -->
                       
                        <a id="sub_cancel" href="<?php echo Yii::app()->createUrl('school/index');?>" class="btn btn-default">取消</a>
                    </td>
                </tr>

                </tbody>
                <tfoot></tfoot>
            </table>
        </form>
    </div>
</div>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/business/prompt.js" ></script>
<script type="text/javascript">
    $(function(){       
    
        $('#business-form').Validform({//表单验证
            tiptype:2,
            showAllError:true,
            postonce:true,
            datatype:{//传入自定义datatype类型【方式二】;
                "need2":function(gets,obj,curform,regxp){
                    var need=1,
                        numselected=curform.find("input[name='"+obj.attr("name")+"']:checked").length;
                    return  numselected >= need ? true : "请至少选择"+need+"项！";
                },

                "max2":function(gets,obj,curform,regxp){
                    var atmax=2,
                        numselected=curform.find("input[name='"+obj.attr("name")+"']:checked").length;

                    if(numselected==0){
                        return false;
                    }else if(numselected>atmax){
                        return "最多只能选择"+atmax+"项！";
                    }
                    return  true;
                }

            }
        });
    })
</script>
