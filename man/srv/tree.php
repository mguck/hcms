<?php
header("Content-type: text/html; charset=utf-8;"); 
require '../../ppf/fun.php';
require '../../ppf/pdo_mysql.php';
if (!session_id()) session_start();
$idtype = $_SESSION["idtype"];

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$type = isset($_GET['type']) ? intval($_GET['type']) : 0;
$wh = "";
if(!empty($type)){
  $wh = " and push_type=".$type;
}

$pd=new pdo_mysql();
$tbl = $_GET['tpl'];

$result = array();
$cate = array();
$rs=$pd->query("select id,name,childnums,pid,odx from `".$tbl."` where pid=".$id.$wh." order by odx desc");
$art = $pd->query("select GROUP_CONCAT(aid) from main_art_type_permission where tid=".$idtype)->fetchColumn(0);
if(strpos($art,",") === true){     
  $artarr = explode(',',$art);
}else{
  $artarr = array(0=>".$art.");  
}
while($row=$rs->fetch(PDO::FETCH_ASSOC)){
	$node = array();
	$node['id'] = $row['id'];
	$node['text'] = $row['name'];	
	$node['state'] =$row['childnums'] ? 'closed' : 'open'; ;#has_child($pd,$row['id']) ? 'closed' : 'open';
	array_push($result,$node);
}
$i=0;
foreach($result as $v){
  if(in_array($v["id"], $artarr)){
    $cate[$i] = $v;
    $i++;
  }
}

echo json_encode($cate);

#²»Ê¹ÓÃ
function has_child($pd,$id){
	#$rs = mysql_query("select count(*) from nodes where parentId=$id");
	$pd->query("select count(1) from blog_t where pid=".$id)->fetchColumn(0);
	#$row = mysql_fetch_array($rs);
	return $pd->query("select count(1) from blog_t where pid=".$id)->fetchColumn(0) > 0 ? true : false;
}