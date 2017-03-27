<?php
header("Content-type: text/html; charset=utf-8;");
require('../../ppf/fun.php');
require('../../ppf/pdo_mysql.php');

if (!session_id()) session_start();  
chkLoginNoJump("uid"); 

$tpl=isset($_POST['tpl'])?$_POST['tpl']:"";
if(empty($tpl)){echo "error:1";exit;}
$pd=new pdo_mysql();
switch($tpl){
	//生成、修改配置信息
	case "gen":
		$res=$pd->query("select * from `sys_config` where id=1");
		if($r=$res->fetch(PDO::FETCH_ASSOC)){
			$p=file_get_contents('../../cfg/config.txt');
			foreach($r as $k=>$v){
				$p=str_replace('{'.$k.'}',$v,$p);
			}
			//p($p);
			file_put_contents('../../cfg/config.inc',$p); 	
            unset($p);
			echo "ok";exit;
		}
		echo "error:2";
		break;
	//删除静态文件
	case "s_del":
		loopDel($_SERVER['DOCUMENT_ROOT'].'/'.S_ROOT_PATH);//此处注意文档相对位置
		echo "ok";exit;
		break;
}

function loopDel($dir){
	if(is_dir($dir)){
		if($handle=opendir($dir)){
			while(($file=readdir($handle))!==false){
				if($file!="." && $file!=".."){
					if(is_dir($dir.'/'.$file)){
						loopDel($dir.'/'.$file);
					}else{
						unlink($dir.'/'.$file);
					}
				}
			}
			closedir($handle);
		}		
	}
}


?>