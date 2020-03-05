<?php
class Movies{
    public $db;
	
	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
    }

    // read all Movies
    function read(){
    
        // select all query
        $sql = "SELECT * FROM tbl_movies ORDER BY mov_year DESC;";

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

    // create new Movie
    function create($name, $genre, $price, $desc, $year){
        
        // Sanitation process
        $s_name = htmlspecialchars(strip_tags($name));
        $s_genre = htmlspecialchars(strip_tags($genre));
        $s_price = htmlspecialchars(strip_tags($price));
        $s_desc = htmlspecialchars(strip_tags($desc));
        $s_year = htmlspecialchars(strip_tags($year));

        // query to insert record
        $sql = "INSERT INTO tbl_movies(mov_name, mov_gen, mov_price, mov_desc, mov_year) 
                VALUES('$s_name', '$s_genre', '$s_price', '$s_desc', '$s_year');";
    
        // execute query
        if(mysqli_query($this->db,$sql)){
            return true;
        }
        return false;
    }

    // Read only one item
    function read_one($id){
 
        // query to read single record
        $sql = "SELECT * FROM tbl_movies WHERE mov_id = '$id' LIMIT 0,1;";

        $query = mysqli_query($this->db,$sql);
        $row = mysqli_fetch_assoc($query);
        
        $this->id= $row['mov_id'];
        $this->name = $row['mov_name'];
        $this->mov_genre = $row['mov_gen'];
        $this->price = $row['mov_price'];
        $this->description = $row['mov_desc'];
        $this->year = $row['mov_year'];
    }

    // Update Movie
    function update($name, $genre, $price, $desc, $year, $id){
        // Sanitation process
        $s_id = htmlspecialchars(strip_tags($id));
        $s_name = htmlspecialchars(strip_tags($name));
        $s_genre = htmlspecialchars(strip_tags($genre));
        $s_price = htmlspecialchars(strip_tags($price));
        $s_desc = htmlspecialchars(strip_tags($desc));
        $s_year = htmlspecialchars(strip_tags($year));

        $sql = "UPDATE tbl_movies SET mov_name = '$s_name', mov_gen = '$s_genre', mov_price = '$s_price', mov_desc = '$s_desc', mov_year = '$s_year' WHERE mov_id = '$s_id';";

        if(mysqli_query($this->db,$sql)){
            return true;
        }
        return false;
    }

    // Delete Movie
    function delete($id){
        // Sanitation process
        $s_id = htmlspecialchars(strip_tags($id));

        $sql = "DELETE FROM tbl_movies WHERE mov_id = '$s_id';";

        if(mysqli_query($this->db,$sql)){
            return true;
        }
        return false;
    }

    function search($name){
        // Sanitation process
        $s_name = htmlspecialchars(strip_tags($name));

        $sql = "SELECT * FROM tbl_movies WHERE mov_name LIKE '%$s_name%';";

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