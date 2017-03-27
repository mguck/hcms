<?php
header("Content-type: text/html; charset=utf-8;"); 
require '../../ppf/fun.php';
require '../../ppf/pdo_mysql.php';

if (!session_id()) session_start(); 

$pd=new pdo_mysql();
if(!isset($_GET["t"])) exit;

switch($_GET["t"]){
case "ologin":#统一登录本系统
        //err:1 创建新用户失败 err:2 非当前网站用户
        $id=isset($_POST["id"])?$_POST["id"]:"";
		if(empty($id)){echo "err:1";exit;}
        $user_info=file_get_contents(APP_URL.'/getuser/?t=extend&ap='.APP_ID.'&k='.APP_KEY.'&u='.$id);
		$user_info=json_decode($user_info);
		//检测来源，判断是否允许对其他机构开放统一登录
		if(APP_OPTA=='1'){//echo APP_OPTA;echo APP_OPTA_OID;
			if(APP_OPTA_OID!=''){//echo '?'.$user_info->orgid.'?';
				$oids_arr=explode(",",APP_OPTA_OID);
				array_push($oids_arr,APP_ORGID);//p($oids_arr);
				if(!in_array($user_info->orgid,$oids_arr)){echo "err:2";exit;}
			}
		}else{
			if($user_info->orgid!=APP_ORGID){echo "err:2";exit;}
		}
        $ip=getIP();
		$sql="select * from `act_member` where bid=?";//统一登录的用户绑定id
		$rs=$pd->prepare($sql);
		$rs->execute(array($id));
		if($r=$rs->fetch(PDO::FETCH_ASSOC)){
			echo 'ok';exit;
		}
		else{#弹出绑定账户或创建新用户窗口
			echo "layer";	
		    exit;		  	    
        }
	break;  
}
exit;
$pd->close();
unset($rs);
unset($pd);