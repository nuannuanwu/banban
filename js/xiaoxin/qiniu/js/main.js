/*global Qiniu */
/*global plupload */
/*global FileProgress */
/*global hljs */


var updataLoadImg=function(name,uploadBtn,parent){
    var uploader = Qiniu.uploader({
        runtimes: 'html5,flash,html4',
        browse_button: uploadBtn,
        container: parent,
        drop_element: parent,
        max_file_size: '10mb',
        flash_swf_url: 'js/plupload/Moxie.swf',
        dragdrop: true,
        chunk_size: '4mb',
        uptoken_url: $('#uptoken_url').val(),
        domain: $('#domain').val(),
        // rename:true,
        filters : [ {title : "图片", extensions : "jpg,png,bmp,jpeg"} ], //文件过滤
        // downtoken_url: '/downtoken',
        unique_names: true,
        // save_key: true,
        // x_vars: {
        //     'id': '1234',
        //     'time': function(up, file) {
        //         var time = (new Date()).getTime();
        //         // do something with 'time'
        //         return time;
        //     },
        // },
        auto_start: true,
        init: {
            'FilesAdded': function(up, files) {

                $('table').show();
                $('#success').hide();
                plupload.each(files, function(file) {

                    var progress = new FileProgress(file, 'fsUploadProgress');
                    progress.setStatus("等待...");
                });
            },
            'BeforeUpload': function(up, file) {
                var progress = new FileProgress(file, 'fsUploadProgress');
                var chunk_size = plupload.parseSize(this.getOption('chunk_size'));
                if (up.runtime === 'html5' && chunk_size) {
                    progress.setChunkProgess(chunk_size);
                }
            },
            'UploadProgress': function(up, file) {
                var progress = new FileProgress(file, 'fsUploadProgress');
                var chunk_size = plupload.parseSize(this.getOption('chunk_size'));
                progress.setProgress(file.percent + "%", up.total.bytesPerSec, chunk_size);

            },
            'UploadComplete': function() {
                $('#success').show(); 
            },
            'FileUploaded': function(up, file, info) { 
                var progress = new FileProgress(file, 'fsUploadProgress');
                progress.setComplete(up, info);
                var url=$.parseJSON(info);
                var domain = up.getOption('domain');
                var res=domain+url.key;
                 var type=url.key.split(".").pop();
              
                if (name == 'business') {
                    $('#uploadImg').attr({'src': res+'?imageView2/1/w/130/h/100'});

                  
                }else if(name=='big-busin'){
                    $('#big-uploadImg').attr({'src': res});
                     $('#big-fileupload').val(url.key).attr({
                        'data-val': '1'
                    });
                  
                }else if(name=='adv'){
                    $('#uploadImg').attr({'src': res+'?imageView2/1/w/75/h/60'});
                  
                }else if(name=='mallgoods'){
                    if (type=='jpg' || type=='png'|| type=='jpeg'|| type=='bmp') {
                            var _html='<li><div class="view"><img src="'+res+'" alt="" ><input type="hidden" name="bigimage[]" value="'+url.key+'">'
                            +'<i style="display:inline-block;height:100%; vertical-align:middle;"></i></div><a href="javascript:;" class="close-upload">'
                            +'<img src="/image/xiaoxin/close-upload.png" alt="" ></a></li>';
                            $('#plupload ul').append(_html);
                            $('#plupload-tip').text('').hide();

                    }else{
                        $('#plupload-tip').show().text('请上传正确的图片格式');
                    }; 
                }else{
                    $('#uploadImg').attr({'src': res+'?imageView2/1/w/70/h/70'});
                     
                   
                }
                if(name!=='big-busin'){
                    $('#file_upload_tmp').val(url.key).attr({
                        'data-val': '1'
                    });
                }
                $('#mce-tip').text('').hide();
               
            },
            'Error': function(up, err, errTip) {
                    $('table').show();
                    var progress = new FileProgress(err.file, 'fsUploadProgress');
                    progress.setError();
                    progress.setStatus(errTip);
                }
            // ,
            // 'Key': function(up, file) {
            //     var key = "56979801.jpg";
            //     // do something with key
            //     return key
            // }
        }
    });
    
    $('#plupload').on('click', '.close-upload', function(event) {
       var _left=$(this);
       _left.parent().remove();
       $('#plupload-tip').text('').hide();
    });

 
} 
