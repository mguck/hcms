//js原生方法重写
window.alert=layer.msg;
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
//转换标准时间为时间戳
function getDateTimeStamp(dateStr){
 return Date.parse(dateStr.replace(/-/gi,"/"));
}
//Javascript扩展Date
Date.prototype.format = function(format) {
	   var date = {
			  "M+": this.getMonth() + 1,
			  "d+": this.getDate(),
			  "h+": this.getHours(),
			  "m+": this.getMinutes(),
			  "s+": this.getSeconds(),
			  "q+": Math.floor((this.getMonth() + 3) / 3),
			  "S+": this.getMilliseconds()
	   };
	   if (/(y+)/i.test(format)) {
			  format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
	   }
	   for (var k in date) {
			  if (new RegExp("(" + k + ")").test(format)) {
					 format = format.replace(RegExp.$1, RegExp.$1.length == 1
							? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
			  }
	   }
	   return format;
}
function getDateDiff (dateStr) {
    var publishTime = getDateTimeStamp(dateStr)/1000,
        d_seconds,
        d_minutes,
        d_hours,
        d_days,
        timeNow = parseInt(new Date().getTime()/1000),
        d,

        date = new Date(publishTime*1000),
        Y = date.getFullYear(),
        M = date.getMonth() + 1,
        D = date.getDate(),
        H = date.getHours(),
        m = date.getMinutes(),
        s = date.getSeconds();
        //小于10的在前面补0
        if (M < 10) {
            M = '0' + M;
        }
        if (D < 10) {
            D = '0' + D;
        }
        if (H < 10) {
            H = '0' + H;
        }
        if (m < 10) {
            m = '0' + m;
        }
        if (s < 10) {
            s = '0' + s;
        }

    d = timeNow - publishTime;
    d_days = parseInt(d/86400);
    d_hours = parseInt(d/3600);
    d_minutes = parseInt(d/60);
    d_seconds = parseInt(d);

    if(d_days > 0 && d_days < 3){
        return d_days + '天前';
    }else if(d_days <= 0 && d_hours > 0){
        return d_hours + '小时前';
    }else if(d_hours <= 0 && d_minutes > 0){
        return d_minutes + '分钟前';
    }else if (d_seconds < 60) {
        if (d_seconds <= 0) {
            return '刚刚发表';
        }else {
            return d_seconds + '秒前';
        }
    }else if (d_days >= 3 && d_days < 30){
        return d_days + '天前';
    }else if (d_days >= 30) {
        return d_days + '天前';
    }
}    
//时间戳处理
//参数：tm(时间戳),t(类型)
//说明：t
function utctime(tm,t){
	var newDate = new Date();
	newDate.setTime(tm * 1000);
	switch(arguments.length){
		case 1:
			return newDate.format('yyyy-MM-dd hh:mm:ss');
			break;
		case 2:
			switch (t)
			{
				case 1:
					//长时间1
					return newDate.format('yyyy-MM-dd hh:mm:ss');
					break;
				case 2:
					//长时间2
					return newDate.format('yyyy-MM-dd h:m:s');
					break;
				case 3:
					//短时间
					return newDate.format('MM-dd hh:mm');
					break;
				case 4:
					//显示几天前,几小时前...
					return getDateDiff(newDate.format('yyyy-MM-dd hh:mm:ss'));
					break;
				default:
					return newDate.format('yyyy-MM-dd hh:mm:ss');
			}
			break;
		default:
			return "";
	}
}

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

function test(){
	alert("11");
}