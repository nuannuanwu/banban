/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 //表单验证控件
 var Validform ={
     int:function(str){
        var getInfoObj=function(){
             return   $(this).parents("td").find(".info");
        } 
        $("[datatype]").focusin(function(){
                if(this.timeout){clearTimeout(this.timeout);}
                var infoObj=getInfoObj.call(this);
                if(infoObj.siblings(".Validform_right").length!=0){
                    return;	
                } 
                infoObj.css('display','inline-block').siblings('.Validform_checktip"').hide(); 
        }).focusout(function(){
                var infoObj=getInfoObj.call(this);
                this.timeout=setTimeout(function(){
                    infoObj.hide().siblings(".Validform_checktip ,.Validform_wrong,.Validform_loading").css('display','inline-block');
                },0); 
        });
        $(str).Validform({
            tiptype:2,
            showAllError:true,
            postonce:true,
            datatype:{//传入自定义datatype类型 ; 
               "tel-3" : /^(\d{3,4}-)?\d{7,8}$/, 
               "nZ"    : /^(0|[1-9][0-9]{1}|100)$/,
               "nF"    :/^(?:0\.\d+|[01](?:\.0)?)$/,
               "nS"    : /^(([1-9]\d{0,1})|100)$/ ,
               'phone':/^((1)+\d{10})$/,
               "pwd6-16":/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i,
               "pwd":  /^[0-9 | A-Z | a-z]{6,16}$/,
               "num2":/^\d+(\.\d{1,2})?$/,
               "num3":/^((\d+\.\d{1,2})|([1-9]\d*))$/,
               "namestr":/^[a-zA-Z0-9\u4e00-\u9fa5\(\)\（\）\-\_\.\s]+$/,//姓名只允许中英文数字以及()_-.和空格组成,
               "subjectstr":/^[a-zA-Z0-9\u4e00-\u9fa5\(\)\（\）\-\_\.\,，\s]+$/,//科目只允许中英文数字以及()_-.，和空格组成
               "subject": function(gets, obj, curform, regxp) {
                   var len = 0;
                   var type = "";
                   var limit = obj.attr("data-limit") == undefined ? 20 : parseInt(obj.attr("data-limit"));
                   if (obj.attr("data-type") == "1") {
                        type = "科目";
                   } else {
                        type = "考试名称";
                   }
                   if (!/^[a-zA-Z0-9\u4e00-\u9fa5\(\)\（\）\-\_\.\,，\s]+$/.test(gets)) {
                       return type + "只允许中英文数字以及()_-.，和空格组成。";
                   }
                   for(var i = 0; i < gets.length; i++) {
                       if (gets.charAt(i).match(/[\u4e00-\u9fa5]/)) {
                           len += 2;
                       } else {
                           len++;
                       }
                   }
                   if (len > limit) {
                       return type + "不能超过" + (limit/2) + "个汉字（或" + limit + "个英文字符）。";
                   }
                   return true;
               },
               "znStr": function(gets, obj, curform, regxp) {
                    var len = 0,type = obj.attr("data-wrong") == undefined ? "" : obj.attr("data-wrong");
                    var limit = obj.attr("data-limit") == undefined ? 20 : parseInt(obj.attr("data-limit")); 
                    if (!/^[a-zA-Z0-9\u4e00-\u9fa5\(\)\（\）\-\_\.\,，\s]+$/.test(gets)) {
                        return type + "只允许中英文数字以及()_-.，和空格组成。";
                    }
                    for(var i = 0; i < gets.length; i++) {
                        if (gets.charAt(i).match(/[\u4e00-\u9fa5]/)) {
                            len += 2;
                        } else {
                            len++;
                        }
                    }
                    if (len > limit) {
                        return   type+ "不能超过" + (limit/2) + "个汉字（或" + limit + "个英文字符）。";
                    }
                    return true;
                },
               "need2":function(gets,obj,curform,regxp){
                    var need=1,numselected=curform.find("input[name='"+obj.attr("name")+"']:checked").length; 
                    return  numselected >= need ? true : "请至少选择"+need+"项！";
                }, 
                "idcard":function(gets,obj,curform,datatype){ 
                        var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ];// 加权因子;
                        var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ];// 身份证验证位值，10代表X; 
                        if (gets.length == 15) {   
                                return isValidityBrithBy15IdCard(gets);   
                        }else if (gets.length == 18){   
                                var a_idCard = gets.split("");// 得到身份证数组   
                                if (isValidityBrithBy18IdCard(gets)&&isTrueValidateCodeBy18IdCard(a_idCard)) {   
                                        return true;   
                                }   
                                return false;
                        }
                        return false; 
                        function isTrueValidateCodeBy18IdCard(a_idCard) {   
                                var sum = 0; // 声明加权求和变量   
                                if (a_idCard[17].toLowerCase() == 'x') {   
                                        a_idCard[17] = 10;// 将最后位为x的验证码替换为10方便后续操作   
                                }   
                                for ( var i = 0; i < 17; i++) {   
                                        sum += Wi[i] * a_idCard[i];// 加权求和   
                                }   
                                valCodePosition = sum % 11;// 得到验证码所位置   
                                if (a_idCard[17] == ValideCode[valCodePosition]) {   
                                        return true;   
                                }
                                return false;   
                        } 
                        function isValidityBrithBy18IdCard(idCard18){   
                                var year = idCard18.substring(6,10);   
                                var month = idCard18.substring(10,12);   
                                var day = idCard18.substring(12,14);   
                                var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
                                // 这里用getFullYear()获取年份，避免千年虫问题   
                                if(temp_date.getFullYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){   
                                        return false;   
                                }
                                return true;   
                        } 
                        function isValidityBrithBy15IdCard(idCard15){   
                                var year =  idCard15.substring(6,8);   
                                var month = idCard15.substring(8,10);   
                                var day = idCard15.substring(10,12);
                                var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
                                // 对于老身份证中的你年龄则不需考虑千年虫问题而使用getYear()方法   
                                if(temp_date.getYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){   
                                        return false;   
                                }
                                return true;
                        } 
                }  
           } ,
            usePlugin:{
                passwordstrength:{
                    minLen:6,
                    maxLen:18,
                    trigger:function(obj,error){
                        if(error){
                            obj.parent().next().find(".passwordStrength").hide().siblings(".info").css('display','inline');
                        }else{
                            obj.removeClass("Validform_error").parent().next().find(".passwordStrength").css('display','inline').siblings().hide();	
                        }
                    }
                }
            }
        });
    }
};


 //表单验证控件
 var ValidformNew ={
     int:function(str){
        var getInfoObj=function(){
             return   $(this).parents("td").find(".info");
        } 
        $("[datatype]").focusin(function(){
                if(this.timeout){clearTimeout(this.timeout);}
                var infoObj=getInfoObj.call(this);
                if(infoObj.siblings(".Validform_right").length!=0){
                    return;	
                } 
                infoObj.css('display','inline').siblings('.Validform_checktip"').hide(); 
        }).focusout(function(){
                var infoObj=getInfoObj.call(this);
                this.timeout=setTimeout(function(){
                    infoObj.hide().siblings(".Validform_checktip ,.Validform_wrong,.Validform_loading").css('display','inline');
                },0); 
        });
        $(str).Validform({
            tiptype:2,
            showAllError:true,
            postonce:false,
            datatype:{//传入自定义datatype类型 ; 
               "tel-3" : /^(\d{3,4}-)?\d{7,8}$/, 
               "nZ"    : /^(0|[1-9][0-9]{1}|100)$/,
               "nF"    :/^(?:0\.\d+|[01](?:\.0)?)$/,
               "nS"    : /^(([1-9]\d{0,1})|100)$/ ,
               'phone':/^((1)+\d{10})$/,
               "pwd6-16":/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i,
               "pwd":  /^[0-9 | A-Z | a-z]{6,16}$/,
               "num2":/^\d+(\.\d{1,2})?$/,  //任意整数 或 1到两位小数 可以为0
               "num3":/^((\d+\.\d{1,2})|([1-9]\d*))$/, //任意整数 或 1到两位小数 不能为0
               "need2":function(gets,obj,curform,regxp){
                    var need=1,numselected=curform.find("input[name='"+obj.attr("name")+"']:checked").length; 
                    return  numselected >= need ? true : "请至少选择"+need+"项！";
                }, 
                "idcard":function(gets,obj,curform,datatype){ 
                        var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ];// 加权因子;
                        var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ];// 身份证验证位值，10代表X; 
                        if (gets.length == 15) {   
                                return isValidityBrithBy15IdCard(gets);   
                        }else if (gets.length == 18){   
                                var a_idCard = gets.split("");// 得到身份证数组   
                                if (isValidityBrithBy18IdCard(gets)&&isTrueValidateCodeBy18IdCard(a_idCard)) {   
                                        return true;   
                                }   
                                return false;
                        }
                        return false; 
                        function isTrueValidateCodeBy18IdCard(a_idCard) {   
                                var sum = 0; // 声明加权求和变量   
                                if (a_idCard[17].toLowerCase() == 'x') {   
                                        a_idCard[17] = 10;// 将最后位为x的验证码替换为10方便后续操作   
                                }   
                                for ( var i = 0; i < 17; i++) {   
                                        sum += Wi[i] * a_idCard[i];// 加权求和   
                                }   
                                valCodePosition = sum % 11;// 得到验证码所位置   
                                if (a_idCard[17] == ValideCode[valCodePosition]) {   
                                        return true;   
                                }
                                return false;   
                        } 
                        function isValidityBrithBy18IdCard(idCard18){   
                                var year = idCard18.substring(6,10);   
                                var month = idCard18.substring(10,12);   
                                var day = idCard18.substring(12,14);   
                                var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
                                // 这里用getFullYear()获取年份，避免千年虫问题   
                                if(temp_date.getFullYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){   
                                        return false;   
                                }
                                return true;   
                        } 
                        function isValidityBrithBy15IdCard(idCard15){   
                                var year =  idCard15.substring(6,8);   
                                var month = idCard15.substring(8,10);   
                                var day = idCard15.substring(10,12);
                                var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
                                // 对于老身份证中的你年龄则不需考虑千年虫问题而使用getYear()方法   
                                if(temp_date.getYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){   
                                        return false;   
                                }
                                return true;
                        } 
                }  
           } ,
           callback:function(form){	  
        	   if(form[0].name){ 
                        return true;
        	   }else{
                       showPromptPush("#sharePopupBox");
                        return false;
        	   } 
            },
            usePlugin:{
                passwordstrength:{
                    minLen:6,
                    maxLen:18,
                    trigger:function(obj,error){
                        if(error){
                            obj.parent().next().find(".passwordStrength").hide().siblings(".info").css('display','inline');
                        }else{
                            obj.removeClass("Validform_error").parent().next().find(".passwordStrength").css('display','inline').siblings().hide();	
                        }
                    }
                }
            }
        });
    }
};

$(".registerform").Validform({
		tiptype:2,
		datatype:{//传入自定义datatype类型【方式二】;
			"idcard":function(gets,obj,curform,datatype){
				//该方法由佚名网友提供;
			
				var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ];// 加权因子;
				var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ];// 身份证验证位值，10代表X;
			
				if (gets.length == 15) {   
					return isValidityBrithBy15IdCard(gets);   
				}else if (gets.length == 18){   
					var a_idCard = gets.split("");// 得到身份证数组   
					if (isValidityBrithBy18IdCard(gets)&&isTrueValidateCodeBy18IdCard(a_idCard)) {   
						return true;   
					}   
					return false;
				}
				return false;
				
				function isTrueValidateCodeBy18IdCard(a_idCard) {   
					var sum = 0; // 声明加权求和变量   
					if (a_idCard[17].toLowerCase() == 'x') {   
						a_idCard[17] = 10;// 将最后位为x的验证码替换为10方便后续操作   
					}   
					for ( var i = 0; i < 17; i++) {   
						sum += Wi[i] * a_idCard[i];// 加权求和   
					}   
					valCodePosition = sum % 11;// 得到验证码所位置   
					if (a_idCard[17] == ValideCode[valCodePosition]) {   
						return true;   
					}
					return false;   
				}
				
				function isValidityBrithBy18IdCard(idCard18){   
					var year = idCard18.substring(6,10);   
					var month = idCard18.substring(10,12);   
					var day = idCard18.substring(12,14);   
					var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
					// 这里用getFullYear()获取年份，避免千年虫问题   
					if(temp_date.getFullYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){   
						return false;   
					}
					return true;   
				}
				
				function isValidityBrithBy15IdCard(idCard15){   
					var year =  idCard15.substring(6,8);   
					var month = idCard15.substring(8,10);   
					var day = idCard15.substring(10,12);
					var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
					// 对于老身份证中的你年龄则不需考虑千年虫问题而使用getYear()方法   
					if(temp_date.getYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){   
						return false;   
					}
					return true;
				}
				
			}
			
		}
	});