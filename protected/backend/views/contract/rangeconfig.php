<style>
    .tableFormSelct{ }
    .tableFormSelct td{ font-size: 12px; padding:4px 0px;}
    .tableFormSelct th{ padding:10px 8px; font-size: 12px; }
    .tableFormSelct td .radio, .checkbox,.tableFormSelct th .radio, .checkbox { display: block; min-height: 20px; padding-left: 20px;  margin-top: 0px;   margin-bottom: 0px;  vertical-align: middle;}
</style>
<form>
    <table class="tableForm tableFormSelct">
        <tr>
            <td class="td_label" style=" vertical-align: middle;">日 期* ：</td> 
            <td class="dateBox" > 
                <input rel="dataeinput" name="stime" type="text" class=" "  style="width:120px;" value=""> 
                <span>&nbsp;至 &nbsp;</span> 
                <input rel="dataeinput" type="text" name="etime" class=" " style="width:120px;" value=""> 
                <div style=" display: inline-table;" id="detail_location_Box_<?php echo $order; ?>">
                    <span style=" display: inline-block; width: 60px; text-align: left; margin-left: 40px;">位 置* ：</span> 
                    <select name="location" rel="detail_location" order="<?php echo $order; ?>" id="detail_location_<?php echo $order; ?>">
                   <?php foreach(AdvertisementLocation::getLoactionArr() as $tk=>$t){ ?>
                       <option value="<?php echo $tk; ?>"><?php echo $t; ?></option>
                   <?php } ?>
               </select>
                </div>
            </td>  
            <td class="td_label" style=" vertical-align: middle;"><span>总点击次数* ：</span></td>
            <td>
                <input  type="text" value="" class="input-small" name="totalclick" style=" width: 120px;" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" >
            </td>
        </tr>
    </table>
    <table class="tableForm tableFormSelct">
       <tr class="search_condition_tab_region"> 
           <td class="td_label">区 域* ：</td> 
           <td class="search_condition_container_region">
               <div style="margin-bottom: 10px;">
                   <select  id="queryprovince">
                      <option value="">选择省份</option>
                      <?php foreach($provinces as $pro): ?>
                        <option value="<?php echo $pro->aid; ?>"><?php echo $pro->name; ?></option>
                      <?php endforeach; ?>
                    </select>
               </div>
               <div id="querycityDiv" class="detailBoxLink"  style="margin-bottom: 10px;"> 
                   <?php // foreach(Area::getCityArr() as $ck=>$cv){ ?>
                       <!--<a href="javascript:void(0);" data-value="<?php // echo $ck; ?>"  rel="detail_city">&nbsp;<?php // echo $cv; ?> </a>-->
                       &nbsp;&nbsp;
                   <?php // } ?>
               </div>
               <div class="regionBox"  rel="detail_city_area" style=" border: 1px solid #bbcedc; border-bottom: none;  padding:5px 10px; display: none;">
                   
               </div>
               <div style="overflow-y: auto; overflow-x: hidden; max-height: 39px;  border: 1px solid #bbcedc; padding:5px 10px; background-color:#f5f5f5;">
                    <!--<div>已选条件：</div>-->
                    <div class="checkRegionBox " style=" display: inline-block;">
                        <ul class="checkList"> 
                        </ul>
                    </div>
               </div>
           </td> 
       </tr> 
       <tr class="search_condition_container_schooltype" > 
           <td class="td_label">学校性质* ：</td>
           <td>
               <div class="detailBoxLink" style="margin-bottom: 10px;">
                   <!--<a href="javascript:void(0);">全部</a> &nbsp;&nbsp;-->
                   <?php foreach(SchoolType::getSchoolTypeArr() as $stk=>$stv){ ?>
                       <a href="javascript:void(0);" data-value="<?php echo $stk; ?>"  rel="detail_schooltype">&nbsp;<?php echo $stv; ?> </a> &nbsp;&nbsp;
                   <?php } ?>
               </div>
               <div class="schoolclassBox" rel="detail_schooltype_grade" style=" border: 1px solid #bbcedc; border-bottom: none; padding:5px 10px; display: none; "> 
               </div>
               <div style="overflow-y: auto; overflow-x: hidden; max-height: 39px; border: 1px solid #bbcedc; padding:5px 10px; background-color:#f5f5f5; ">
                    <!--<div>已选条件：</div>--> 
                    <div class="checkSchoolclassBox"  style=" display: inline-block;"> 
                         <ul class="checkList"> 
                         </ul> 
                    </div>
               </div>
           </td> 
       </tr>
       <tr>
           <td></td>
           <td><a href="javascript:void(0);" style=" padding:5px 15px; " class="btn btn-primary" rel="contype_query" data-order="<?php echo $order; ?>">查询</a></td>
       </tr> 
   </table>
</form> 
<div style="display:none" id="query_result_<?php echo $order; ?>"> 
<!--<p><a href="javascript:void(0);" class="btn btn-primary">配置</a></p> -->
</div>
<div id="findResultBox" style="display: none;">
    <table class="tableForm  tableFormSelct">
       <tr>
           <td class="td_label">查询结果：</td>
           <td> 
               <div id="query_result"> 
               </div>
           </td> 
        </tr>
    </table>
</div> 
<script type="text/javascript">
$(function () {  
    //时间输入框只读 日期控件兼容  
    $("input[name='stime']").datebox({
            onSelect: function (date) {
                $("#findResultBox").hide();
                $("#query_result").empty();
                $('[rel=contype_query]').removeAttr("disabled");
//                $(".panel").css({'z-index':'1100010'});
            }
        });
    $("input[name='etime']").datebox({
        onSelect: function (date) {
                $("#findResultBox").hide();
                $("#query_result").empty();
                $('[rel=contype_query]').removeAttr("disabled");
//                $(".panel").css({'z-index':'1100010'});
            }
    });  
    $(".combo-text").attr({readonly:'readonly',rel:'textDatetime'});
});
</script>
