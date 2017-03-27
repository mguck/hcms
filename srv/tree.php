<?php
header("Content-type: text/html; charset=utf-8;"); 
require '../ppf/fun.php';
require '../ppf/pdo_mysql.php';

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

$pd=new pdo_mysql();
$tbl=$pd->query("select tblname from ppf_tpl where tpl='".$_GET['tpl']."'")->fetchColumn(0);

$result = array();
$rs=$pd->query("select id,name,childnums,pid from `".$tbl."` where pid=".$id." order by odx desc");
while($row=$rs->fetch(PDO::FETCH_ASSOC)){
	$node = array();
	$node['id'] = $row['id'];
	$node['text'] = $row['name'];	
	$node['state'] =$row['childnums'] ? 'closed' : 'open'; ;#has_child($pd,$row['id']) ? 'closed' : 'open';
	array_push($result,$node);
}
echo json_encode($result);