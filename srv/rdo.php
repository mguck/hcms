<?php 
header("Content-type: text/html; charset=utf-8;"); 
require '../ppf/fun.php';
require '../ppf/pdo_mysql.php';

#检测登录
session_start(); 
#chkLoginNoJump("jsid");
  
	
$pd=new pdo_mysql();
switch($_POST["tpl"]){
	case "read":#
		echo '{"ret":"ok","msg":"读取成功"}';	
		break;
  case "read1":#
		$rs=$pd->query("select * from project_type");
		echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));		
		break;
  case "getcate":
        $rs=$pd->query("select id,name from demo_tree");
		echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));
        break;
  case "get_consult_artcate_name":
		$rs=$pd->query("select id,name from consult_art_category order by odx desc");
		  echo json_encode($rs->fetchAll(PDO::FETCH_ASSOC));	
		break;
}			
$pd->close();
unset($pd);
unset($rs);