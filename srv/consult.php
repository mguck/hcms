<?php 
header("Content-type: text/html; charset=utf-8;"); 
require '../ppf/fun.php';
require '../ppf/pdo_mysql.php';

#检测登录
session_start(); 
#chkLoginNoJump("jsid");

$pd=new pdo_mysql();
switch($_POST["tpl"]){
	case "consult_add":#
		$time=time();
		$pd->exec("insert into consult_art (`id`,`cid`,`name`,`sex`,`phone`,`address`,`unit`,`ip`,`title`,`content`,`see`,`timestamp`,`show`) VALUES ('{$time}','{$_POST['ddlConType']}','{$_POST['tbName']}','{$_POST['tbSex']}','{$_POST['tbTEL']}','{$_POST['tbAddress']}','{$_POST['tbUnit']}','{$_POST['lbIP']}','{$_POST['tbTitle']}','{$_POST['tbCon']}','0','{$time}','0')");
		echo "ok";
		break;
}			
$pd->close();
unset($pd);
unset($rs);