<?php
/**前端自动化模板  post处理
*lren-zhs 2013-6-16 10:01
*/  
require('../ppf/pdo_frtdo.php');
date_default_timezone_set('PRC'); //中国时区

if (!session_id()) session_start(); 
chkLoginNoJump("uid");
//p($_POST);exit;
$tpl=$_POST["tpl"]; 
if(!isset($tpl)){echo "err:tpl is null";exit;} 
$do=$_POST["do"];
$db=new pdo_frtdo($tpl);

//print_r(base64_decode($_POST["data"]["isTop"]));exit;
if($do=="a"||$do=="m"||$do=="am"){  
  $data=$_POST["data"]; #获取数组
  $data["uid"]=base64_encode($_SESSION["uid"]);
  $data["created"]=base64_encode(date('Y-m-d H:i',time()));
  if(!is_array($data)){echo "err:data is null";exit;}
  $data["timestamp"]=base64_encode(time());
  if(isset($data['CreateTime'])){
      $data['CreateTime']=empty($data['CreateTime'])?base64_encode(strtotime(date('Y-m-d H:i:s',time()))):base64_encode(strtotime(base64_decode($data['CreateTime'])));
  }

}

switch($do){	
  case "r":    
    $db->Read($_POST["id"]);
		break;
	case "a":
		$db->Insert($data);
		break;
	 case "m":
		$db->Save($data);
		break;	
	case "am":
		$db->SaveInsert($data);
		break;
  case "d":
    $db->Del($_POST["id"]);
    break;

}

$db->close();
unset($db);
unset($data);