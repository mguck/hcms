/*
��̨�����Ի�����easyui
lren 2013-10-17 14:15  ��2014-9-9
*/ 
var showinsert = true; /*��ʾ��ӵ�����*/    
/**��dialog*/ 
function openDlgMod(id,frmid) {  
  d={"do":"r","id":id,"frmid":frmid};      
   if(typeof(l_tpl) == "undefined")
      d.tpl=queryStr("t");
    else
       d.tpl=l_tpl;       	
  readID(d);     
	//readID({tpl:queryStr("t"),"do":"r","id":id,"frmid":frmid}); 
  //$(frmid).dialog('setTitle', '�޸�����'); 
  //$(frmid+" #tips").text("�޸�����");
  $(frmid).dialog("open"); 
	$(frmid).data("dotype","m");//��������
}
/**��ʼ�� btn �½�*/
function initCBtn(e){
  $(e.btn).bind("click",function () {
     $(e.frmid).dialog('setTitle',e.name);  
     $(e.frmid+" #tips").text(e.name);
     $(e.frmid).dialog("open"); 
     $(e.frmid).data("dotype","a");//�������� 
     $(e.frmid+" #id").val("");  
     reinitDlgCtrl(e);
  });
}
/*��� �½�����*/
function addInsetData(e,newid) {
    rows = $("#listbase").html();
    reg = new RegExp("{id}", "g");
    rows = rows.replace(reg, newid);
	for (var id in e.data) { 
        if (e.data[id] == null || e.data[id] == "")
            val = "";
        else
            val = $.base64.atob(e.data[id], true);       
		if (typeof (formatunixs) != "undefined" && formatunixs.indexOf(id) > -1) {
			val = utctime(val);
		}
		if (formattrue.indexOf(id) > -1) {
			val = getTrueFalse(val);
		}
		if (rows.indexOf("{" + id + "}") > -1) {                   
			reg = new RegExp("{" + id+ "}", "g");
			rows = rows.replace(reg,val);
		}        
    }
    rows = rows.replace(/\{\w*\}/g, "");   
    if ($("#list tr:eq(0)").length>0)
        $("#list").append(rows);
        //$("#list tr:eq(0)").before(rows);  
    else
        $("#list").html(rows);
}
/*�޸�id*/
function modSaveData(e) {     
    rows = $("#listbase").html();    
    reg = new RegExp("{id}", "g");
    rows = rows.replace(reg,  e.id);
    //savestr
    for (var id in e.data) { 
        if (e.data[id] == null || e.data[id] == "")
            val = "";
        else
            val = $.base64.atob(e.data[id], true);
        if (typeof (formatunixs) != "undefined" && formatunixs.indexOf(id) > -1) {
			val = utctime(val);
		}
		if (formattrue.indexOf(id) > -1) {
			val = getTrueFalse(val);
		}
		if (rows.indexOf("{" + id + "}") > -1) {                   
			reg = new RegExp("{" + id+ "}", "g");
			rows = rows.replace(reg,val);
		}        
    }
    rows = rows.replace(/\{\w*\}/g, "");
	$("tr[name='" + e.id + "']").replaceWith(rows);
}
/**saveam �ص�*/
function amcallback(e, redata) {
  $(e.frmid).dialog("close");
	switch($(e.frmid).data("dotype")){
	    case "a":
	        addInsetData(e, redata.substr(redata.indexOf("ok") + 2));
	        break;
		  case "m":
			 modSaveData(e);
		  break;
		case "am":
	 	   break;
	}  	 
}
/**���ǰ��ʼ��select�ؼ�*/
function reinitDlgCtrl(e) {
    $(e.frmid + " select").each(function (a, b) {
        $(b).val(""); //$(b).get(0).selectedIndex = 0;
    });
    $(e.frmid + " input").each(function (a, b) {
        if($(b).data("flag")!="def")//�Ƕ�����ʼ��
            $(b).val("");
    });    
}     
function showDlgMsg(e) {
    $(e.frmid).dialog("option", "title", e.title);
    $(e.frmid + " #mesg").text(e.msg);    
    $(e.frmid).dialog("open");
}

/*��ʼ��select�ؼ� ɾ��*/
function reinitSelect(frmid) { 
    $(frmid+" select").each(function (a, b) {
        $(b).val('0');
    });
}
/**��Ϣ��ʾ�Ի��� ���ô�ɾ�� */
function dlgMsgInit(e) {
    $(e.frmid).dialog({
        autoOpen:false,modal: e.modal,
        buttons: {
            "ȷ��": function () {
                $(this).dialog("close");
            }
        }
    });
}   
 