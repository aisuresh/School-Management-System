<?php
class Loginmodel extends Model {

	function __construct()
	{
		parent::Model();
		$this->load->database();	
	}
	
	  function user_login($table, $where)
      {
		if(count($where) > 0){
			foreach($where as $wh){
				$this->db->where($wh['condition'], $wh['value']);
			} 
		}
		$queryresult = $this->db->get($table);

		if ($queryresult->num_rows() > 0)
		{
			return true;
	    }else{
			return false;
		} 
     }
	
	public function fetch_row($table, $tableArray, $where){
		$this->table = $table;
		$this->tableArray = $tableArray;
		$this->where = $where;
		$this->db->select('*');
		$this->db->from($this->table);
		if(count($this->where) > 0){
			foreach($this->where as $wh){
				$this->db->where($wh['condition'], $wh['value']);
			} 
		}
		if(count($this->tableArray) > 0){
   			foreach($this->tableArray as $ta)
   			{
    			$this->db->join($ta['TableName'], $ta['CompairField']);
		    }
  		 }
		$this->query = $this->db->get();
		
		 if ($this->query->num_rows() > 0)  
            {  
				 return $this->query->result();  
            }else{  
               return false;
            }  
	}
	function save_data($data, $table){
		
		$this->table = $table;
		$this->data = $data;
		$f = $this->db->insert($this->table, $this->data);
		
		if($f == true){
			return true; 
		}else{
			return false;
		}
	}
	
}
