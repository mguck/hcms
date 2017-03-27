<?php 
header("Content-type: text/html; charset=utf-8;"); 
require '../../ppf/fun.php';
require '../../ppf/pdo_mysql.php';

#检测登录
session_start(); 
#chkLoginNoJump("jsid");  
 	
$pd=new pdo_mysql();
switch($_POST["tpl"]){
  case "send":#回复  
		echo "回复成功,你的消息:".$_POST["title"];
		break;
	case "rsend":#重发贴
			$des=base64_decode($_POST["des"]);
		$pd->exec("update doc_content set name='".$_POST["title"]."',des='".$des."',uid=".$_SESSION["uid"].",unick='".$_SESSION["nick"]."',timestamp=UNIX_TIMESTAMP() where id=".$_POST["id"]);
  
		$pid=$pd->query("select cid from doc_content where id=".$_POST["id"])->fetchColumn(0);
		$pd->exec("update doc_category set dnums=(select count(1) from doc_content where cid=".$pid.") where id=".$pid);
		echo "发贴成功";	
		break;
 
	  
}			
$pd->close();
unset($pd);
unset($rs);