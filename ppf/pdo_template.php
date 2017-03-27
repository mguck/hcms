<?php 
/*html Template  
*ǰ̨ģ���ҳ���Զ��������
*lren-zhs 2013-6-15 10:27
*pdo mysql ����
*/
require_once $_SERVER['DOCUMENT_ROOT'].'/cfg/config.inc';
class pdo_template{	
	public $content=''; 
	protected $path='';
	protected $blocks=array(); 
	public $db;
	/**��ʼ��ģ��ͱ��� Ĭ��gb18030 utf8*/
	public function __construct($file=false,$open_db=true,$charset='utf8')	{ #���ݿ�ͳ�� '' DB_CHARSET
		if(!empty($file))$this->loadTpl($file); 
    /*if (!file_exists($file) || !is_readable($file)) return false; 
		$this->content=file_get_contents($file);	
		$this->path=dirname($file).'/';
		$filename=basename($file); 
		$this->MatchBlock();*/ 	
		if($open_db){
			$this->connect($charset);
		}
	}	
	protected function connect($charset=DB_CHARSET){
		try{
			$this->db=new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";charset=".$charset
				,DB_USER,DB_PWD,array(PDO::ATTR_PERSISTENT=>false));			 
		}
		catch(PDOException $e){
			die("Connect not open pdo_db:" . $e->getMessage () );	
		}
		$this->db->exec("SET NAMES ".$charset);
	}  
	public function close(){
		if($this->m_rs)
			unset($this->m_rs);		
		if($this->db)
			unset($this->db);
	}
  /**��������ģ��*/
  public function loadTpl($file=false){
    if (!file_exists($file) || !is_readable($file)) return false; #file not readed
    $this->content=file_get_contents($file);	
		$this->path=dirname($file).'/';
		$filename=basename($file); 
		$this->MatchBlock(); 	
  }
	public function query($sql){
		return $this->db->query($sql);
	}
	/**������ģ��*/
	public function SetTemplate($block,$file){
		if(strpos($file ,'/'))
			$data=file_get_contents($file);
		else
			$data=file_get_contents($this->path.$file);
		if(isset($data)){
			$this->content=str_replace( '{'.$block.'}',$data,$this->content);			
		}
	}
	/**������ģ�� new */
	public function SetTpl($block,$file){
		$this->SetTemplate($block,$file);
	}
	/**��ʼ�� block*/	
	protected function MatchBlock(){
	    preg_match_all("/<!--\sSTART\s([a-z0-9_]+)\s-->([\s\S]*)<!--\sEND\s(\\1)\s-->/mis", $this->content, $m);
        //p($m);exit;		
	    for($k=0;$k<count($m[0]);$k++){
	    	$this->blocks[$m[1][$k]]=$m[2][$k];//�������飬��ǩ=>��ǩ����������
	    	$this->content=str_replace($m[0][$k], '$'.$m[1][$k].'$',$this->content);	     
	    }
//p($this->content);exit;		
	}
	/*****************************************************************************
	*
	*�����
	*
	*****************************************************************************/	 
	public function SetBlock($block,$sql,$farr=null,$farr1=null){	
		if(isset($this->blocks[$block])){
			$val=$this->blocks[$block];
			$ret='';
			preg_match_all("/{(\w*)}/mis", $val, $m);			
			$rs=$this->db->query($sql);
			while ($r=$rs->fetch(PDO::FETCH_ASSOC)) { 
			 	$val1=$val;				
				for($k=0;$k<count($m[0]);$k++){	
					if(isset($r[$m[1][$k]])){#�ֶδ���	
						if($farr&&in_array($m[1][$k],$farr)){#��ʽ������
							$idx=array_search($m[1][$k],$farr);	
							
							$val1=str_replace($m[0][$k], 								
							strftime($farr1[$idx],is_numeric($r[$m[1][$k]])?$r[$m[1][$k]]:strtotime($r[$m[1][$k]])),
								$val1);
								#is_int($val1)?$val1:strtotime($val1))
						}					
						else	
							$val1=str_replace($m[0][$k], $r[$m[1][$k]],$val1);									
					}
			 	}			 
			 	$ret.=$val1;
			 }
			unset($rs);				
			$this->content=str_replace('$'.$block.'$', $ret,$this->content);
		}
	}	
  public function SetBlock2A($block,$sql,$arr){#$arr=array($block1,$sql1,$pid	)
  //"list","sql",array("block"=>"rp","sql"=>"***? and id>?","param"=>array("id","id")))
		if(isset($this->blocks[$block])){
			$html=$this->blocks[$block];
			preg_match_all("/<!--\sSTART\s([a-z0-9_]+)\s-->([\s\S]*)<!--\sEND\s(\\1)\s-->/mis",$html,$m);
			$tmparr=array();
			for($k=0;$k<count($m[0]);$k++){
				$tmparr[$m[1][$k]]=$m[2][$k];
				$html=str_replace($m[0][$k], '$'.$m[1][$k].'$',$html);	     
			} 			 
			#��һ��
			$ret='';
			 preg_match_all("/{(\w*)}/mis", $html, $m);			 
			 $rs=$this->db->query($sql);
			while ($r=$rs->fetch(PDO::FETCH_ASSOC)) { 
			 	$val1=$html;
				for($k=0;$k<count($m[0]);$k++){
					if(isset($r[$m[1][$k]]))#�ֶδ���						
            $val1=str_replace($m[0][$k], $r[$m[1][$k]],$val1);				
			 	}
       
				#�ڶ��� ѭ��
				//foreach($arr as $d){
					$html1=$tmparr[$arr["block"]];
					$std=$this->db->prepare($arr['sql']);
					preg_match_all("/{(\w*)}/mis", $html1, $m1);
       
          switch(count($arr["param"])){
             case 1:$std->execute(array($r[$arr["param"][0]]));break;
             case 2:$std->execute(array($r[$arr["param"][0]],$r[$arr["param"][1]]));break;
             case 3:$std->execute(array($r[$arr["param"][0]],$r[$arr["param"][1]],$r[$arr["param"][2]]));break;
             case 4:$std->execute(array($r[$arr["param"][0]],$r[$arr["param"][1]],$r[$arr["param"][2]],$r[$arr["param"][3]]));break;
             case 5:
             default:$std->execute(array($r[$arr["param"][0]],$r[$arr["param"][1]],$r[$arr["param"][2]],$r[$arr["param"][3]],$r[$arr["param"][4]]));break;
       
          }
						
					$ret2='';
					while($r1=$std->fetch(PDO::FETCH_ASSOC)){
						$val2=$html1;
						for($k=0;$k<count($m1[0]);$k++){
							if(isset($r1[$m1[1][$k]]))						
								$val2=str_replace($m1[0][$k], $r1[$m1[1][$k]],$val2);				
						}	
						$ret2.=$val2;					
					}	
					$val1=str_replace( '$'.$arr['block'].'$',$ret2,$val1);
				//}					
				#�ڶ�������
			 	$ret.=$val1;				
			 }
			unset($rs);		
			unset($std);
			unset($m);
			unset($m1);
			$this->content=str_replace('$'.$block.'$', $ret,$this->content);			
		}
	} 
	/**����Ƕ�ײ����ɡ�arr(block,pid,sql)*/
	public function SetBlock2($block,$sql,$arr){#$block1,$sql1,$pid	
		if(isset($this->blocks[$block])){
			$html=$this->blocks[$block];
			preg_match_all("/<!--\sSTART\s([a-z0-9_]+)\s-->([\s\S]*)<!--\sEND\s(\\1)\s-->/mis",$html,$m);
			$tmparr=array();
			for($k=0;$k<count($m[0]);$k++){
				$tmparr[$m[1][$k]]=$m[2][$k];
				$html=str_replace($m[0][$k], '$'.$m[1][$k].'$',$html);	     
			} 			 
			#��һ��
			$ret='';
			 preg_match_all("/{(\w*)}/mis", $html, $m);
       $rs=$this->db->query($sql);
			while ($r=$rs->fetch(PDO::FETCH_ASSOC)) { 
			 	$val1=$html;
				for($k=0;$k<count($m[0]);$k++){
					if(isset($r[$m[1][$k]]))#�ֶδ���						
						$val1=str_replace($m[0][$k], $r[$m[1][$k]],$val1);				
			 	}
				#�ڶ��� ѭ��				
				foreach($arr as $d){
					$html1=$tmparr[$d["block"]];
					$std=$this->db->prepare($d['sql']);
					preg_match_all("/{(\w*)}/mis", $html1, $m1);
					$std->execute(array($r[$d['pid']]));	
					$ret2='';
					while($r1=$std->fetch(PDO::FETCH_ASSOC)){
						$val2=$html1;
						for($k=0;$k<count($m1[0]);$k++){
							if(isset($r1[$m1[1][$k]]))						
								$val2=str_replace($m1[0][$k], $r1[$m1[1][$k]],$val2);				
						}	
						$ret2.=$val2;					
					}	
					$val1=str_replace( '$'.$d['block'].'$',$ret2,$val1);
				}					
				#�ڶ�������
			 	$ret.=$val1;				
			 }
			unset($rs);		
			unset($std);
			unset($m);
			unset($m1);
			$this->content=str_replace('$'.$block.'$', $ret,$this->content);			
		}
	} 
	protected $m_blockname;
	protected $m_block;
	public $m_rs;
	protected $m_val;
	protected $m_content;
	protected $m_m=array(); #������ʽ
	/**�ֶ��滻����*/
	public function Mual_SetBlock($block,$sql){
 		$this->m_blockname=$block;
 		if(isset($this->blocks[$block])){
 			$this->m_block=$this->blocks[$block];
 			$this->m_rs=$this->db->query($sql);
 			$this->m_val=$this->m_block; 	
 			$this->m_content='';		
 			preg_match_all("/{(\w*)}/mis", $this->m_block, $m);
 			if(!empty($this->m_m))
 				$this->m_m=array();
 			 for($k=0;$k<count($m[0]);$k++){
				$this->m_m[$m[1][$k]]=$m[1][$k];		    	
			    }			
 			return true; 			
 		}
 		else 
 			return false;              
	}
	public function Mual_Assign($field,$val){
		$this->m_val=str_replace('{'.$field.'}', $val,$this->m_val);
	}
	/**����ͬ��*/
	public function Mual_Set($field,$val){
		$this->m_val=str_replace('{'.$field.'}', $val,$this->m_val);
	}
	public function Mual_Full($row){		
		foreach($this->m_m as $key=>$val){			
			if(isset($row[$key]))
				$this->m_val=str_replace('{'.$key.'}', $row[$key],$this->m_val);						
	 	}
	}
	public function Mual_OneBlock(){ #һ��
		$this->m_content.=$this->m_val;
		$this->m_val=$this->m_block;
	}
	public function Mual_EndBlock(){
		$this->content=str_replace('$'.$this->m_blockname.'$', $this->m_content,$this->content);
	}
	/*****************************************************************************
	*
	*ȫ�������滻
	*
	*****************************************************************************/	    
	public function Set_Assign($name,$val){
		$this->content=str_replace( '{'.$name.'}',$val,$this->content);
	}
	public function Set($name,$val){
		$this->Set_Assign($name,$val);
	}
	/**�����ݿ����ȡȫ����Ϣ*/
	public function Set_AssignDataBase($sql){
		$rs=$this->db->query($sql);
		if($rs){
			$r=$rs->fetch();#mysql_fetch_assoc($rs);
			preg_match_all("/{(\w*)}/mis", $this->content, $m);
			for($k=0;$k<count($m[0]);$k++){
				if( isset($r[$m[1][$k]]))
					$this->content=str_replace($m[0][$k], $r[$m[1][$k]],$this->content);			    	
			}
			unset($rs);
		}
	}
	/**�µĶ�ȡ���� �����ݿ����ȡȫ����Ϣ */
	public function ReadDB($sql){
		$this->Set_AssignDataBase($sql);
	}
	/*****************************************************************
	 * 
	 * ��ҳ 
	 * 
	 ****************************************************************/
	public $tblname = "";
	public $columns = "*";
	public $orderby = "order by id desc";
	public $where = "id>0";
	public $qwhere = ""; //url��ҳ����
	public $psize = 10;
	public $pindex = 1;
	public $pgcount = 0;
	public $rowcount = 0;
	public $pgnosize = 10; //ҳ�����

	public function ByPage($block){
		$this->SetBlock($block,$this->getPageSql());
		#$this->gen_PageLink();
	} 
	public function Mual_ByPage($block) { #�ֶ����
    $this->Mual_SetBlock($block, $this->getPageSql());
    #$this->gen_PageLink();
	}
	protected function getPageSql(){
		if($this->pindex<1)$this->pindex=1;		
		$rs=$this->db->query("select count(1) from ".$this->tblname." where ".$this->where); 
		$this->rowcount=$rs->fetchColumn(0);#���ӵ�һ���ֶ�ֵ	
		unset($rs);
		$this->pgcount = ceil($this->rowcount / $this->psize);		
		if ($this->pgcount > 0 && $this->pindex >$this->pgcount) $this->pindex = $this->pgcount;
            		return "select ".$this->columns." from ".$this->tblname." where ".$this->where." ".$this->orderby." limit ".
            		(($this->pindex - 1) * $this->psize) .",".$this->psize;             		
	}
	public function gen_PageLink() {#����ҳ������		
      $sid = $this->pindex - $this->pgnosize / 2;
      if ($sid < 1) $sid = 1;
      $eid = $sid + $this->pgnosize;//����id
      if ($eid > $this->pgcount) $eid = $this->pgcount;	          

     $page="��".$this->rowcount."����¼ ".$this->pindex."/". $this->pgcount."ҳ ";
      $page.="<a href=\"?p=1". $this->qwhere."\">��ҳ</a>";
      $page.="<a href=\"?p=".( $this->pindex - 1 > 0 ?  $this->pindex - 1 : 1).$this->qwhere."\">��һҳ</a>";

      for ($i = $sid; $i <= $eid; $i++) {
          if ($i ==  $this->pindex)
              $page.="<big>".$i."</big>";
          else
              $page.="<a href=\"?p=".$i.$this->qwhere."\">".$i."</a>";
      }
      $page.="<a href=\"?p=".($this->pindex + 1 < $this->pgcount ? $this->pindex + 1 : $this->pgcount).$this->qwhere."\">��һҳ</a>";
      $page.="<a href=\"?p=".$this->pgcount.$this->qwhere."\">βҳ</a>";
      #$this->Set_Assign("page", $page);
      return $page;
	}  
	/**���NaN $*$ */
	public function clearNaN(){		
		$this->content=preg_replace('/\$(\w*)\$/mis','',$this->content); 		
	}
	public function clearNon(){
		$this->content=preg_replace("/{(\w*)}/mis",'',$this->content); 		
	}
	/**��ʾ*/
	public function display(){
		echo $this->content;
	}
	 /**ѹ����ҳ�ڿ�*/
	public function Compress() {
		$this->content=preg_replace('/>\s+?</mis','><',$this->content); 
		$this->content=preg_replace('/\r\n\s*/mis','',$this->content);   
		$this->content=preg_replace('/\s*\/>/mis','/>',$this->content);   
		return $this->content;
	} 
} 