<?php 
#header("Content-type: text/html; charset=utf-8;");
#require('../ppf/360_safe3.php'); 
require '../../fun.php';
require '../../pdo_mysql.php';

#����¼
#session_start(); 
#chkLoginNoJump("giiuid");
  
$pd=new pdo_mysql();
switch($_POST["tpl"]){
	case "ppf_tpl_unique": #ģ�����				
		$pd->exec("update ppf_tpl set tblunique=(select count(1) from ppf_tpl_unique where ptid=".$_POST["data"].") where id=".$_POST["data"]);	 
		break;
	case "ppf_tpl_default": #��ȡЭ����
		$pd->exec("update ppf_tpl set tbldefault=(select count(1) from ppf_tpl_default where ptid=".$_POST["data"].") where id=".$_POST["data"]);	 
		break;		
	case "deldqde":#ɾ��������������
		$pd->exec("delete from ppf_tpl_default where ptid=".$_POST["id"]);
		$pd->exec("delete from ppf_tpl_display where ptid=".$_POST["id"]);
		$pd->exec("delete from ppf_tpl_edit where ptid=".$_POST["id"]);
		$pd->exec("delete from ppf_tpl_query where ptid=".$_POST["id"]);
		$pd->exec("delete from ppf_tpl_unique where ptid=".$_POST["id"]);
		break;                 
}
$pd->close();
unset($rs);
unset($pd);