<?php 
#header("Content-type: text/html; charset=gbk;");
require '../../cfg/config.inc';
/*上传图片*/
#检测登录

foreach($_FILES as $f) 
{ 		
	//if (function_exists("iconv"))$f["name"] = iconv("UTF-8","GB2312",$f["name"]);	
	if ($f["error"] > 0){
		echo '{"ret":"err","errno":"1","msg":"文件出错"}';
		exit();
	}
	$fsize=$f["size"]; #($f["size"] / 1024) . kb;
	$ftmp_name=$f["tmp_name"];//临时文件位置  $_files["file"]["tmp_name"];
	$ftype=$f["type"];//文件类型 $_files["file"]["type"]
	$fname=$f["name"];  //原始文件名 $_files["file"]["name"]

	$fext=".".strtolower(pathinfo($fname, PATHINFO_EXTENSION));
	if(!strpos(" .jpg.gif.png.bmp",$fext)){
		echo '{"ret":"err","errno":"5","msg":"禁止上传的文件类型"}';
		exit();
	}
	
	$dir=DIR_ROOT."/demo/upds/";
	#$y=date("Y");	 #/m/d
	#$m=date("m");
	#$w=ceil($d/7);
	#$fd=$dir.$y."/".$m."/";  
	/*if(!is_dir($fd)){
		$re=mkdir($fd,0777,true);#第3个参数为创建多级目录
		if(!$re){
			echo '{"ret":"err","des":"'. urlencode("创建目录错误，没有权限").'"}';
			exit();
		}
	}*/	
	$nname=microtime(true); #毫秒#time().
	//保存文件 
	if (move_uploaded_file($ftmp_name, DIR_ROOT."/demo/upds/".$nname.$fext)){  
		echo '{"ret":"ok","flag":"'.$_GET["flag"].'","fname":"'.'/demo/upds/'.$nname.$fext.'"}';	
	}
}