<?php 
header("Content-type: text/html; charset=utf-8;");
require '../../cfg/config.inc';
/*上传缩略图*/
$lid=isset($_POST['id2'])?$_POST['id2']:"";

foreach($_FILES as $f) 
{ 		
	if ($f["error"] > 0){
		echo '{"ret":"err","code":"01","des":"上传文件出错"}';
		exit();
	}
	$fsize=$f["size"]; #($f["size"] / 1024) . kb;
	$ftmp_name=$f["tmp_name"];//临时文件位置  $_files["file"]["tmp_name"];
	$ftype=$f["type"];//文件类型 $_files["file"]["type"]
	$fname=$f["name"];  //原始文件名 $_files["file"]["name"]
    //print_r($f);exit;
	$fext=".".strtolower(pathinfo($fname, PATHINFO_EXTENSION));
	if(!strpos(" .jpg.gif.png",$fext)){
		echo '{"ret":"err","code":"03","des":"禁止上传的文件类型"}';
		exit();
	}
	
	$dir=DIR_ROOT.'/upd/links_logo/';
    $nname=time();
	#$y=date("Y");	 #/m/d
	#$d=date("z");
	#$w=ceil($d/7);
	#$fd=$dir.$y."/".$w."/";  #以每周为单位
	if(!is_dir(DIR_ROOT.'/upd/links_logo/')){
		$re=mkdir(DIR_ROOT.'/upd/links_logo/',0777,true);#第3个参数为创建多级目录
		if(!$re){
			echo '{"ret":"err","code":"05","des":"没有权限创建目录"}';exit;
			exit();
		}
	}	
	//保存文件 
	if (move_uploaded_file($ftmp_name, $dir.$nname.$fext)){
    $ret=mkThumbnail($dir.$nname.$fext,null,null,$dir.$nname.$fext);
		//echo '{"ret":"ok","code":"10","fname":"'.$_POST["id"].'.jpg"}';	
    echo '{"ret":"ok","code":"10","fname":"'.$nname.$fext.'"}';
	}                     
}

function mkThumbnail($src, $width = null, $height = null, $filename = null) {  
    if (!isset($width) && !isset($height))  
        return false;  
    if (isset($width) && $width <= 0)  
        return false;  
    if (isset($height) && $height <= 0)  
        return false;  
  
    $size = getimagesize($src);  
    if (!$size)  
        return false;  
  
    list($src_w, $src_h, $src_type) = $size;  
    $src_mime = $size['mime'];  
    switch($src_type) {  
        case 1 :  
            $img_type = 'gif';  
            break;  
        case 2 :  
            $img_type = 'jpeg';  
            break;  
        case 3 :  
            $img_type = 'png';  
            break;  
        case 15 :  
            $img_type = 'wbmp';  
            break;  
        default :  
            return false;  
    }  
  
    if (!isset($width))  
        $width = $src_w * ($height / $src_h);  
    if (!isset($height))  
        $height = $src_h * ($width / $src_w);  
  
    $imagecreatefunc = 'imagecreatefrom' . $img_type;  
    $src_img = $imagecreatefunc($src);  
    $dest_img = imagecreatetruecolor($width, $height);  
    imagecopyresampled($dest_img, $src_img, 0, 0, 0, 0, $width, $height, $src_w, $src_h);  
  
    $imagefunc = 'image' . $img_type;  
    if ($filename) {  
        $imagefunc($dest_img, $filename);  
    } else {  
        header('Content-Type: ' . $src_mime);  
        $imagefunc($dest_img);  
    }  
    imagedestroy($src_img);  
    imagedestroy($dest_img);  
    return true;  
}  