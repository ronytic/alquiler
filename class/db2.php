<?php
$archivo=$_SERVER['SCRIPT_NAME'];
$carpeta=explode("/",$archivo);
$subcarpeta=$carpeta[1];
include_once($_SERVER['DOCUMENT_ROOT']."/".$subcarpeta."/basedatos.php");
class db{
	var $l;
	var $tabla;
	var $resultado;
	var $campos=array();
	function __construct(){
		global $bost,$user,$pass,$database;
		@$link=mysql_connect($host,$user,$pass);
		if($link){
			if(@mysql_select_db($database,$link)){
				mysql_query("SET NAMES utf8");
				$this->l=$link;
			}
			else{
				echo "No se puede encontrar la base de Datos ";
				exit();
			}
		}else{
			echo "No se Puede Conectar a la Base de Datos";
		exit();
		}
	}
	function __destruct(){
		@mysql_close($this->l);
	}
	function getTables(){
		global $database;
		return $this->sql("SHOW TABLES FROM ".$database);	
	}
	function get_db(){
		global $database;
		return $database;	
	}
	private function sql($consulta)
	{
		//echo mysql_real_escape_string ($consulta);
		$consQ =mysql_query (($consulta));
		$resultado =array ();
		if ($consQ)
		{
			while ($consF =mysql_fetch_assoc ($consQ))
			array_push ($resultado, $consF);
		}
		return $resultado;
	}
	function queryE($data,$f){
		//echo $data;
		if($f=="lock" && md5("lock")==md5($f))
		{	
			mysql_query($data); //or die(mysql_error($this->l));
		}
	}
	function statusTable(){
		$query ="SHOW TABLE STATUS LIKE '$this->tabla'";
		$res=mysql_query($query);
		return mysql_fetch_array($res);
	}
	 function getRecords ($where_str=false, $order_str=false,$group_str=false, $count=false, $start=0, $order_strDesc=false)
	{
		$where =$where_str ? "WHERE $where_str" : "";
		$order =$order_str ? "ORDER BY $order_str ASC" : "";
		$order =$order_strDesc ? "ORDER BY $order_str DESC" : $order;
		$group =$group_str ? "GROUP BY $group_str":"";
		$count = $count ? "LIMIT $start, $count" : "";
		$camposs =implode (', ', $this->campos);
		$query ="SELECT $camposs FROM {$this->tabla} $where $group $order $count ";
		//echo $query."<br>";
		return $this->sql ($query);
	}  
	public function getRecord ($id)
	{
   		return $this->getRecords ("id=$id", false, 1);
	}
	public function insertRecord ($data){
		$campos =$this->getTableFields ();
		$sysData =$this->getDefaultValues ();
		$data =implode ("', '", $data);
		$query ="INSERT INTO {$this->tabla} ($campos) VALUES ($sysData, '$data')";
		echo $query;
/*
		$log =fopen ('c:\leo\logworb.txt', 'w');
		fwrite ($log, $query);
		fclose ($log);
*/
//		mysql_query ($query);
	//	return $this->validateOperation ();
	}
	public function insertRow ($data,$sw=0){
		////
		$key=array();
		$val=array();
		foreach($data as $k => $v){
			$key[]=$k;
			$val[]=$v;
		}
		$campos=implode(",",$key);
		$datos= implode(",",$val);
		
		////
		if($sw==0)
			$query ="INSERT INTO {$this->tabla} VALUES ($datos)";
		else
			$query ="INSERT INTO {$this->tabla} ($campos) VALUES ($datos)";
			
		//echo $query;
		return mysql_query($query);
	}
	public function deleteRecord ($where_str){
		$where =$where_str ? "WHERE $where_str" : "";
		mysql_query ("DELETE FROM {$this->tabla} $where");
		return $this->validateOperation ();
	}
	public function updateRecord ($where_str, $data)
	{
		$where =$where_str ? "WHERE $where_str" : "";
		$campos =$this->campos;
		$datos =array ();
		foreach ($campos as $ind => $campo)
		{
			$current_data =$data[$ind];
			array_push ($datos, "$campo='$current_data'");
		}
		$datos =implode (", ", $datos);
		//echo "UPDATE {$this->tabla} SET $datos $where";
		mysql_query ("UPDATE {$this->tabla} SET $datos $where");
	}
	public function updateRow($dataValues,$where_str){
		$where =$where_str ? "WHERE $where_str" : "";
		$data=array();
		foreach($dataValues as $k =>$v){
			array_push($data,$k."=".$v);
		}
		$datos=implode(",",$data);
		//echo "UPDATE {$this->tabla} SET $datos $where";
		mysql_query ("UPDATE {$this->tabla} SET $datos $where");
	}
	private function getTableFields ($asArray=false){
		$return =$this->getNameFields ('private');
		$return +=$this->getNameFields ('public');
		return $asArray ? $return : implode (', ', $return);
	} 
	private function getDefaultValues ($asArray=false){
		$return =array ();
		$fields =$this->getFieldsByType ('private');
		foreach ($fields as $field){
			array_push ($return, $field[2]);
		}
		return $asArray ? $return : implode (', ', $return);
	}
	private function getNameFields ($type){
		$return =array ();
		$fields =$this->getFieldsByType ($type);
		foreach ($fields as $field){
			array_push ($return, $field[1]);
		}
		return $return;
	}
	private function getFieldsByType ($type=''){
		$return =array ();
		$types =explode ('|', $type);
		foreach ($this->campos as $field){
			$includeField =false;
			foreach ($types as $t){
				if ($field[0] == $t){
					array_push ($return, $field);
				}
			}
		}
		return $return;
	}
}

?>