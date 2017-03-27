//计数处理
//参数：d,obj
function vote(d,obj){ //tpl,do,showok,callback,id,tb,col        
  d.tpl="vote";
  if(Cookies.get(d.tbl+d.id)!=undefined)return;
  Cookies.set(d.tbl+d.id,d.id,{ expires: 43200 });   
  $.post("./srv/vote.php",d, function (data, e) {       
      if(d.showok!=undefined&&d.showok!="")alert(d.showok);	
      if(obj!=undefined){  
         v=$(obj).text().replace(/[^0-9]/ig, "");
         if(v=="")v="1";else v= parseInt(v)+1;            
         $(obj).text(v);
      }                
	    if(d.callback!=undefined&&d.callback!="")window[d.callback](data);	
  });
}    

(function($) {
    $.extend({
        myTime: {
            /**
             * 当前时间戳
             * @return <int>        unix时间戳(秒)  
             */
            CurTime: function(){
                return Date.parse(new Date())/1000;
            },
            /**              
             * 日期 转换为 Unix时间戳
             * @param <string> 2014-01-01 20:20:20  日期格式              
             * @return <int>        unix时间戳(秒)              
             */
            DateToUnix: function(string) {
                var f = string.split(' ', 2);
                var d = (f[0] ? f[0] : '').split('-', 3);
                var t = (f[1] ? f[1] : '').split(':', 3);
                return (new Date(
                        parseInt(d[0], 10) || null,
                        (parseInt(d[1], 10) || 1) - 1,
                        parseInt(d[2], 10) || null,
                        parseInt(t[0], 10) || null,
                        parseInt(t[1], 10) || null,
                        parseInt(t[2], 10) || null
                        )).getTime() / 1000;
            },
            /**              
             * 时间戳转换日期              
             * @param <int> unixTime    待时间戳(秒)              
             * @param <bool> isFull    返回完整时间(Y-m-d 或者 Y-m-d H:i:s)              
             * @param <int>  timeZone   时区              
             */
            UnixToDate: function(unixTime, isFull, timeZone) {
                if (typeof (timeZone) == 'number')
                {
                    unixTime = parseInt(unixTime) + parseInt(timeZone) * 60 * 60;
                }
                var time = new Date(unixTime * 1000);
                var ymdhis = "";
                ymdhis += time.getUTCFullYear() + "-";
                ymdhis += (time.getUTCMonth()+1) + "-";
                ymdhis += time.getUTCDate();
                if (isFull === true)
                {
                    ymdhis += " " + time.getUTCHours() + ":";
                    ymdhis += time.getUTCMinutes() + ":";
                    ymdhis += time.getUTCSeconds();
                }
                return ymdhis;
            }
        }
    });
})(jQuery);

//获取地址栏参数
function queryStr(name) {
    var AllVars = window.location.search.substring(1);//即location.href中?后面的内容
    var Vars = AllVars.split("&");//分割条件
    for (i = 0; i < Vars.length; i++) {
        var Var = Vars[i].split("=");
        if (Var[0] == name)return Var[1];//返回地址栏中相应参数的值
    }
    return "";
}