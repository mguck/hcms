//list init
$(function(){
	list_init();
});
function list_init(){       
    $.getJSON("/data/list.arr.txt",function(d){        
      showData2Page(d); 
      showCurSeleted(); 
      getChildData();//��ȡ����ѡ��  
      //chgLabelTxt();//����label�еı�ǩ����    
  });
  qso=queryStr("so");	
  $("#so").val(qso);       
}
function SO(){
 // if($("#so").val()==""){alert("�������ѯ����");return;}
  setQry(qso=$("#so").val());
}
/*/����list�еı�ǩ����
function chgLabelTxt(){
  if(qgrade!="0"){$("grade").text($("#grade a[name='"+qgrade+"']").text());}
  else{
    $("grade").each(function(a,b){
       $(b).text($("#grade a[name='"+$(b).attr("v")+"']").text());
    });
  }
  
}  */
//��ȡ����ѡ��
function getChildData(){
  if(qaddr!="0"){
    $.post("./srv/rdo.php?", {tpl:"getaddr2","id":qaddr}, function (d, e) {         
        d1=JSON.parse(d);
        $("#addr1").html("<a name=0>�ֵ���</a>");
        if(d1.length>0){           
          for(i=0;i<d1.length;i++){
            $("#addr1").append(' <a name="'+d1[i].id+'">'+d1[i].name+'</a> &nbsp;');
          }
          //event
          $("#addr1 a").bind("click",function(a,b){setQry(qaddr1=$(this).attr("name"));});
          if(qaddr1!="0"){
              $("#addr1 a[name='"+qaddr1+"']").addClass("active"); 
              $("#sed").append('<code>'+$("#addr1 a[name='"+qaddr1+"']").text()+' <i class="glyphicon glyphicon-remove" onclick="setQry(qaddr1=0)"/></code> &nbsp;');
          }
        }
    })
  }
}
//����ѡ�����
var qperiod,qorgtype,qaddr,qaddr1,qso;
function showCurSeleted(){ 
  qperiod=queryStr("per");
  qorgtype=queryStr("ot");
  qaddr=queryStr("a");
  qaddr1=queryStr("a1");

  if(qperiod=="")qperiod="0";   
  if(qorgtype=="")qorgtype="0";
  if(qaddr=="")qaddr="0";
  if(qaddr1=="")qaddr1="0"; 
 
   if(qorgtype!="0"){$("#orgtype a[name='"+qorgtype+"']").addClass("active"); 
  $("#sed").append('<code>'+$("#orgtype a[name='"+qorgtype+"']").text()+' <i class="glyphicon glyphicon-remove" onclick="setQry(qorgtype=0)"/></code> &nbsp;');}
  if(qperiod!="0"){$("#period a[name='"+qperiod+"']").addClass("active");
    $("#sed").append('<code>'+$("#period a[name='"+qperiod+"']").text()+' <i class="glyphicon glyphicon-remove" onclick="setQry(qperiod=0)"/></code> &nbsp;');}
  if(qaddr!="0"){$("#addr a[name='"+qaddr+"']").addClass("active");
    $("#sed").append('<code>'+$("#addr a[name='"+qaddr+"']").text()+' <i class="glyphicon glyphicon-remove" onclick="setQry(qaddr=0)"/></code> &nbsp;');}
  if(qaddr=="0"){$("#addr1").css("display","none");}
} 
//��ʾɸѡ��Ŀ
function showData2Page(d){    
  $("#period").html("<a name=0>ѧ�Σ�</a>");
  for(i=0;i<d.period.length;i++){
    $("#period").append(' <a name="'+d.period[i].id+'">'+d.period[i].name+'</a> &nbsp;');
  }
  $("#subject").html("<a name=0>ѧ�ƣ�</a>");
  for(i=0;i<d.subject.length;i++){
    $("#subject").append(' <a name="'+d.subject[i].id+'">'+d.subject[i].name+'</a> &nbsp;');
  }
  
  $("#addr").html("<a name=0>������</a>");
  for(i=0;i<d.addr.length;i++){
    $("#addr").append(' <a name="'+d.addr[i].id+'">'+d.addr[i].name+'</a> &nbsp;');
  }

  $("#period a").bind("click",function(a,b){setQry(qperiod=$(this).attr("name"));});
  $("#subject a").bind("click",function(a,b){setQry(qorgtype=$(this).attr("name"));});
  $("#addr a").bind("click",function(a,b){qaddr1=0;setQry(qaddr=$(this).attr("name"));});

}
//���ѡ������
function setQry(v){
  qry="&per="+qperiod+"&ot="+qorgtype+"&a="+qaddr+"&a1="+qaddr1+"&so="+qso;
  toUrl(qry);
} 
 
function toUrl(v){
  location.href="?t="+queryStr("t")+v;
}