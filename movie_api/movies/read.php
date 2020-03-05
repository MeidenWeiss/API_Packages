<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here
include_once '../config/database.php';
include_once '../objects/movies.php';
 
// initialize object
$movies = new Movies();
 
// query movies
$results = $movies->read();
 
// check if more than 0 record found
if($results != null){
 
    // movies array
    $movies_arr=array();
    $movies_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    foreach($results as $value){
 
        $movies_item=array(
            "id" => $value['mov_id'],
            "name" => $value['mov_name'],
            "genre" => $value['mov_gen'],
            "price" => $value['mov_price'],
            "description" => html_entity_decode($value['mov_desc']),
            "year" => $value['mov_year'],
        );
 
        array_push($movies_arr["records"], $movies_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
    echo json_encode($movies_arr);
}else{
 
    // set response code - 404 Not found
    http_response_code(404);
    echo json_encode(array("message" => "No movies found.")
    );
}
