<?php
$_SESSION['orderkey'] = 0;
class Adminmodel extends Model {
	 
	 var $table;
	 var $field;
	 var $id;
	 var $data;
	 var $k;
	 var $companyid;
	 var $whereC;
	 var $limit;
	 var $start;
	 var $searchoption;
	 var $searchstring;
	 var $query;
	 var $tableArray;
	 var $order;
	 var $sortby;
	 var $filename;
	 var $title;
	 var $groupby;
	 
	 function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
		$this->table = '';
		$this->field = '';
		$this->id = '';
		$this->data = array();
		$this->k = 0;
		$this->wherec = array();
		$this->limit = 0;
		$this->start = 0;
		$this->searchoption = '';
		$this->searchstring = '';
		$this->query = array();
		$this->tableArray = array();
		$this->order = '';
		$this->sortby = '';
		$this->filename = '';
		$this->title = '';
		$this->groupby = '';
    }
	
	public function record_count($table)
    {
        $this->table = $table;
		return $this->db->count_all($this->table);
    }
	
	public function record_search_count($table, $searchoption, $searchstring)
    {
        $this->table = $table;
		
		$this->searchoption = $searchoption;
		$this->searchstring = $searchstring;

		if($this->searchoption != NULL && $this->searchstring != NULL){
			$this->db->like($this->searchoption, $this->searchstring, 'after');
		}

		return $this->db->count_all($this->table);
    }
	
	public function record_list_count($table, $tableArray, $searchoption, $searchstring, $where)
	{
		$this ->table = $table;
		$this->tableArray = $tableArray;
		$this->where = $where;
		$this->searchoption = $searchoption;
		$this->searchstring = $searchstring;
		if(count($this->where) > 0){
			foreach($this->where as $wh){
				$this->db->where($wh['condition'], $wh['value']);
			} 
		}

		if($this->searchoption != NULL && $this->searchstring != NULL){
			$this->db->like($this->searchoption, $this->searchstring, 'after');
		}
		 if(count($this->tableArray) > 0){
   			foreach($this->tableArray as $ta)
   			{
    			$this->db->join($ta['TableName'], $ta['CompairField']);
		    }
  		 }

		$this->query = $this->db->get($this->table);

		return $this->query->num_rows();
	}

	public function fetch_records($limit, $start, $table, $tableArray, $searchoption, $searchstring, $sortby, $where)
	{
		$this ->table = $table;
		$this->tableArray = $tableArray;
		$this->limit = $limit;
		$this->start = $start;
		$this->where = $where;
		$this->searchoption = $searchoption;
		$this->searchstring = $searchstring;
		$this->sortby = $sortby;
		if(count($this->where) > 0){
			foreach($this->where as $wh){
				$this->db->where($wh['condition'], $wh['value']);
			} 
		}
		$this->db->order_by($this->sortby, 'desc');
		$this->db->limit($this->limit,$this->start);
		if($this->searchoption != NULL && $this->searchstring != NULL){
			$this->db->like($this->searchoption, $this->searchstring, 'after');
		}
		 if(count($this->tableArray) > 0){
   			foreach($this->tableArray as $ta)
   			{
    			$this->db->join($ta['TableName'], $ta['CompairField']);
		    }
  		 }
		$this->query = $this->db->get($this->table);
		if($this->query->num_rows() > 0)
		{
			/*foreach ($this->query->result() as $row)
			{
				$this->data[] = $row;
			}
			return $this->data;*/
	 
			return $this->query->result();
		}else
		{
			return false;
		}
	}
	
	public function sort_records($limit, $start, $table, $tableArray, $sort, $order, $where)
	{
		$this ->table = $table;
		$this->tableArray = $tableArray;
		$this->limit = $limit;
		$this->start = $start;
		$this->where = $where;
		$this->sort = $sort;
		$this->order = $order;
		
		if(count($this->where) > 0){
			foreach($this->where as $wh){
				$this->db->where($wh['condition'], $wh['value']);
			} 
		}
		$this->db->limit($this->limit,$this->start);
		$this->db->order_by($this->sort, $this->order);
		if(count($this->tableArray) > 0){
   			foreach($this->tableArray as $ta)
   			{
    			$this->db->join($ta['TableName'], $ta['CompairField']);
		    }
  		 }
		$this->query = $this->db->get($this->table);
		if($this->query->num_rows() > 0)
		{
			/*foreach ($this->query->result() as $row)
			{
				$this->data[] = $row;
			}*/
			return $this->query->result();
		}else
		{
			return FALSE;
		}
	}
	
	public function order_by($table,$tableArray,$field,$where){
	    $this ->table = $table;
		$this->tableArray = $tableArray;
	    $this->where = $where;
		$this->sort = $field;
		$this->db->select($this->sort);
		if(count($this->where) > 0){
			foreach($this->where as $wh){
				$this->db->where($wh['condition'], $wh['value']);
			} 
		}
		$this->db->order_by($this->sort, 'asc');
		if(count($this->tableArray) > 0){
   			foreach($this->tableArray as $ta)
   			{
    			$this->db->join($ta['TableName'], $ta['CompairField']);
		    }
  		 }
		$this->query = $this->db->get($this->table);
		if($this->query->num_rows() > 0)
		{
		  	return $this->query->result();
		}else
		{
			return FALSE;
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
	
	public function fetch_distinct_row($table, $tableArray, $where, $groupby){
		$this->table = $table;
		$this->tableArray = $tableArray;
		$this->where = $where;
		$this->groupby = $groupby;
		
		$this->db->select($this->groupby);
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
		
		$this->db->groupby($this->groupby);
		$this->query = $this->db->get();
		
		if ($this->query->num_rows() > 0)  
        {  
		    return $this->query->result();  
        }else{  
               return false;
        }  
	}	
	
	public function fetch_row_where($where, $table, $tjoin){
		$this->table = $table;
		$this->db->select('*');
		$this->db->from($this->table);
		if(count($where) > 0){
			foreach($where as $wh){ 
				$this->db->where($wh['condition'], $wh['value']);
			}	
		}
		if(count($tjoin) > 0){
			foreach($tjoin as $jn){ 
				$this->db->join($jn['TableName'], $jn['Condition']);
			}	
		}
		
		$queryresult = $this->db->get();
		 if ($queryresult->num_rows() > 0)  
            {  
				 return $queryresult->result();  
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
	
	function edit_data($field, $id, $table){
		
		$this->field = $field;
		$this->id = $id;
		$this->table = $table;
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where($this->field, $this->id); 
		$queryresult = $this->db->get();
		
		 if ($queryresult->num_rows() > 0)  
            {  
				 return $queryresult->result();  
            }else{  
               return false;
            }  
	}
	
	function update_data($field, $id, $data, $table){
		$this->field = $field;
		$this->id = $id;
		$this->data = $data;
		$this->table = $table;
		$this->db->where($this->field, $this->id);
		$f = $this->db->update($this->table, $this->data);

		if($f == true){
			return true; 
		}else{
			return false;
		}
	}
	
	function update_multi_data($where, $data, $table){
		$this->table = $table;
		$this->data = $data;
		if(count($where) > 0){
			foreach($where as $wh){
				$this->db->where($wh['condition'], $wh['value']);
			} 
		}
		
		$f = $this->db->update($table, $data);

		if($f == true){
			return true; 
		}else{
			return false;
		}
	}
		
	function export_records($table){
		$this->table = $table;
		$query = $this->db->get($this->table);  
		if ($query->num_rows() > 0)  
		{  
			return $query->result();  
		}else{  
		   return false;
		}  
	}
	
	function show_rows($table, $where){
		$this->table = $table;
		$this->where = $where;
		if(count($this->where) > 0){
			foreach($this->where as $wh){
				$this->db->where($wh['condition'], $wh['value']);
			} 
		}
		$this->query = $this->db->get($this->table);  
		if ($this->query->num_rows() > 0)  
		{  
			return $this->query->result();  
		} 
		 
	}
	
	function query_fun($sql){
	
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)  
		{  
			return $query->result();
		}
	}
	
	
	function menu_show($rollid){
		$this->table = 'rollmenu';
		$this->field = 'RollId';
		$this->db->where($this->field, $rollid);
		$this->db->join('submenu', 'submenu.SubMenuId = rollmenu.SubMenuId');
		$this->db->join('mainmenu', 'mainmenu.MainMenuId = rollmenu.MainMenuId');
		$query = $this->db->get($this->table);  
		if ($query->num_rows() > 0)  
		{  
			return $query->result();  
		}else{  
		   return false;
		}  
		 
	}
	
	public function createThumbs( $pathToImages, $file_name, $pathToThumbs, $thumbWidth) 
	{
	   // open the directory
   	  $dir = opendir( $pathToImages );

	  $filename = strtolower($file_name) ; 
	  $exts = explode(".", $file_name) ; 
	  $n = count($exts)-1; 
	  $exts = $exts[$n]; 
 
	  // load image and get image size
	  switch($exts) {
		case 'gif':
		$img = imagecreatefromgif("{$pathToImages}{$file_name}" );
		break;
		case 'jpg':
		$img = imagecreatefromjpeg("{$pathToImages}{$file_name}" );
		break;
		case 'png':
		$img = imagecreatefrompng("{$pathToImages}{$file_name}" );
		break;
	}
	  $width = imagesx( $img );
	  $height = imagesy( $img );
	
	  // calculate thumbnail size
	  $new_width = $thumbWidth;
	  if($thumbWidth == '50'){
	  	$new_height = 50;
	  }else{
	  	$new_height = floor( $height * ( $thumbWidth / $width ) );
	  }	

	  // create a new tempopary image
	  $tmp_img = imagecreatetruecolor( $new_width, $new_height );

	  // copy and resize old image into new image 
	  imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

	  // save thumbnail into a file
	  $status = imagejpeg( $tmp_img, "{$pathToThumbs}{$file_name}" );
	  
	 // close the directory
  	 closedir( $dir );
	 if($status){
	  	return $file_name;
	  }
	}
					
	function delete_one_row($table, $where){
		$this->table = $table;
		$this->where = $where;
		if(count($this->where) > 0){
			foreach($this->where as $wh){
				$this->db->where($wh['condition'], $wh['value']);
			} 
		}
		$status = $this->db->delete($this->table);
		return $status; 
	}
	
	function maxvalue($table, $data, $where){
		$i =0;
		for($i = 0; $i < count($data); $i++){
			$this->db->select_max($data[$i]);
		}
		if(count($where) > 0){
			foreach($where as $wh){
				$this->db->where($wh['condition'], $wh['value']);
			} 
		}	
		$query = $this->db->get($table);
		if ($query->num_rows() > 0)  
		{  
			return $query->result();  
		}
	}
	
	function secondmaxvalue($table, $data, $where){
		$i =0;
		for($i = 0; $i < count($data); $i++){
			$this->db->select_max($data[$i]);
		}
		if(count($where) > 0){
			foreach($where as $wh){
				$this->db->where($wh['condition'], $wh['value']);
			} 
		}
		$query = $this->db->get($table);
		if ($query->num_rows() > 0)
		{  
			return $query->result();  
		}
	}
	
	public function fetch_srow($field, $row, $table){
		$this->field = $field;
		$this->id = $row;
		$this->table = $table;
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where($this->field, $this->id); 
		$this->db->join('stafftype', 'staff.StafftypeId = stafftype.StafftypeId');
		$queryresult = $this->db->get();
		
		 if ($queryresult->num_rows() > 0)  
            {  
				 return $queryresult->result();  
            }else{  
               	 return false;
            }  
	}
	
	function show_ilrows($field, $row1, $table){
		$this->table = $table;
		$this->field = $field; 
		$this->id = $row1;
		$this->db->where($this->field, $this->id);
		$this->db->join('libraryreg', 'libraryrecord.LibraryNo = libraryreg.LibraryNo');
		$this->db->join('student', 'libraryreg.StudentId = student.StudentId');
		$this->db->join('studentclass', 'student.StudentRollNo = studentclass.RollNo');
		$this->db->join('course', 'studentclass.StudentClass = course.ClassId');
		$this->db->join('book', 'libraryrecord.BookCode = book.BookCode');
		$query = $this->db->get($this->table);  
		if ($query->num_rows() > 0)  
		{  
			return $query->result();
		}else{  
		   return false;
		}  
		 
	}
	
	function show_rlrows($field, $row, $table){
		$this->table = $table;
		$this->field = $field; 
		$this->id = $row;
		$this->db->where($this->field, $this->id);
		$this->db->join('libraryreg', 'libraryrecord.LibraryNo = libraryreg.LibraryNo');
		$this->db->join('student', 'libraryreg.StudentId = student.StudentId');
		$this->db->join('studentclass', 'student.StudentRollNo = studentclass.RollNo');
		$this->db->join('course', 'studentclass.StudentClass = course.ClassId');
		$this->db->join('book', 'libraryrecord.BookCode = book.BookCode');
		$query = $this->db->get($this->table);  
		if ($query->num_rows() > 0)  
		{  
			return $query->result();
		}else{  
		   return false;
		}  
		 
	}
}
