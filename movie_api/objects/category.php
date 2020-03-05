<?php
class Category{
    public $db;
	
	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
    }

    function read(){
        // select all query
        $sql = "SELECT * FROM tbl_genre ORDER BY gen_name ASC;";

        // prepare query statement
        $query = mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_assoc($query)){
			$result[] = $row;
		}
		if(!empty($result)){
			return $result;
		}else{
			return;																	
		}
    }
}
?>