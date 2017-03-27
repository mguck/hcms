$(function(){
	chklogin();
  /*var hidrow = $("#hidrow").attr("val");
  if(hidarr){
    var hidarr = hidrow.split(",");
    for(var i=0;i<hidarr.length;i++){
      $(hidarr[i]).css("display","none");
    }
  }      
  */ 
  
  heartbeat();      
});

function chklogin(){
$.get("/srv/glg.php?" + Math.random(), {}, function (data, status) {
      try {
          o =JSON.parse(data);// eval("[" + data + "]")[0];  
          if (o.ret == "no") {
			 var url=window.btoa(document.URL);
             $("#top_user_login").html('<li><a href="/?t=login&url='+url+'">登录</a></li><li><a href="/?t=reg">注册</a></li>');
          }
          else {            
            switch(o.idtype){
              case '1':s='stu';break;
              case '2':case '4':s='tech'; break;
              case '3':s='guardian';break;
              default:s='stu';break;
            }           
             $("#top_user_login").html('<li><a href="/'+s+'"><img width="22px" src="'+o.face+'" onerror=this.src="/error/face.jpg"> '+ o.nick+'<msg id="top_user_msg">('+o.msg+')</msg></a></li>\
             <li><a href="/?t=exit">【退出】</a></li>');            
          }
      }
      catch (e) {
          alert(e + data);
      }
  });
}
//心跳
function heartbeat(){
   $.get("/srv/heartbeat.php?",{}, function (d,e) {
       t=JSON.parse(d); 
       if(t.ret=="new"){            
           $("#top_user_msg").text("消息("+t.num+")"); 
       } 
   });
}