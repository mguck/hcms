<?php
header("Content-type: text/html; charset=utf-8;"); 
require '../../ppf/fun.php';
require '../../ppf/pdo_mysql.php';

if (!session_id()) session_start(); 

$pd=new pdo_mysql();
if(!isset($_GET["t"])) exit;

switch($_GET["t"]){
case "ologin":#ͳһ��¼��ϵͳ
        //err:1 �������û�ʧ�� err:2 �ǵ�ǰ��վ�û�
        $id=isset($_POST["id"])?$_POST["id"]:"";
		if(empty($id)){echo "err:1";exit;}
        $user_info=file_get_contents(APP_URL.'/getuser/?t=extend&ap='.APP_ID.'&k='.APP_KEY.'&u='.$id);
		$user_info=json_decode($user_info);
		//�����Դ���ж��Ƿ������������������ͳһ��¼
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
		$sql="select * from `act_member` where bid=?";//ͳһ��¼���û���id
		$rs=$pd->prepare($sql);
		$rs->execute(array($id));
		if($r=$rs->fetch(PDO::FETCH_ASSOC)){
			echo 'ok';exit;
		}
		else{#�������˻��򴴽����û�����
			echo "layer";	
		    exit;		  	    
        }
	break;  
}
exit;
$pd->close();
unset($rs);
unset($pd);