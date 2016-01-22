<style>
    #message{display: none; position:absolute; left: 0; bottom:50px; width:100%; margin: 0px auto; text-align: center;  }
    #message .cbox{display: inline-block; font-size: 18px; z-index: 10000; border-radius: 5px;}
    #message .messageType{ display: inline-block; padding:8px 15px; line-height: 30px; -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;}
    #message .success{  border: 1px solid #fbeed5; background-color: #f59201; color: #ffffff; }
    #message .error{border: 1px solid #eed3d7; background-color: #f59201; color: #ffffff; }
   //#message .messageType span{  float: left;}
</style>
<div id="message">
    <div class="cbox">
    <?php if ($type=="success"){?>
        <div class="messageType success"><span id="icon-<?php echo $type; ?>">✔</span>&nbsp;&nbsp;<?php echo $msg; ?></div>
        <?php }else{ ?>
        <div class="messageType success" ><span id="icon-<?php echo $type; ?>">✘</span>&nbsp;&nbsp;<?php echo $msg; ?></div>   
    <?php } ?> 
    </div>
</div>
<script>
    var mtypes ="<?php echo $type; ?>";
    safariMessage($("#icon-"+mtypes),mtypes);
    $('#message').show(); 
    setTimeout( function() {  
        $('#message').slideUp("slow"); 
    },4000);
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