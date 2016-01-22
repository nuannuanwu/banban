<script src="<?php echo MainHelper::AutoVersion('/js/banban/jquery-1.7.2.min.js'); ?>" type="text/javascript"></script>
<style>
    #message{ display: none; position:absolute; left:0%; top:50%; width: 100%;  text-align: center; z-index: 10000;  font-size: 18px;  margin: 0px auto;}
    #message .messageType{ display: inline-block; padding:8px 35px 8px 10px; line-height: 30px; -webkit-border-radius: 5px;-moz-border-radius: 5px; border-radius: 5px;}
    #message .success{ border: 1px solid #fbeed5; background-color: #f59201; color: #fbe4e5; }
    #message .error{ border: 1px solid #eed3d7; background-color: #f59201; color: #fbe4e5; }
    #message span.ioc{ display: inline-block; height: 30px; width: 20px;}
   // #message .messageType span{  float: left;}
</style>
<div id="message">
    <?php if ($type=="success"){?>
    <div class="messageType success"><span class="ioc" id="icon-<?php echo $type; ?>">✔</span>&nbsp;&nbsp;<?php echo $msg; ?></div>
        <?php }else{ ?>
    <div class="messageType success" ><span class="ioc" id="icon-<?php echo $type; ?>">✘</span>&nbsp;&nbsp;<?php echo $msg; ?></div>   
    <?php } ?> 
</div>
<script>
    var mtypes ="<?php echo $type; ?>";
    safariMessage($("#icon-"+mtypes),mtypes);
    $('#message').show(); 
    setTimeout( function() {  
        $('#message').slideUp("slow"); 
    },3000);
    function safariMessage(obj,str){
            var Sys = {}; 
            var ua = navigator.userAgent.toLowerCase(); 
            var s;  
            (s = ua.match(/version\/([\d.]+).*safari/)) ? Sys.safari = s[1] : 0; 
            if (Sys.safari){ 
                obj.text(' ');
                obj.css({
                    display:"inline-block", 
                    width: "20px",
                    height: "16px"
                });
                if(str=="success"){
                    obj.css("background","url('/image/xiaoxin/checkedIco1.png') no-repeat center");
                }else{
                   obj.css("background","url('/image/xiaoxin/checkedIco2.png') no-repeat center"); 
                } 
            } 
        }
</script>