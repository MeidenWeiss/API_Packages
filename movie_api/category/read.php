<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here
include_once '../config/database.php';
include_once '../objects/category.php';
 
// initialize object
$cat = new Category();
 
// query categories
$results = $cat->read();
 
// check if more than 0 record found
if($results != null){
 
    // category array
    $cat_arr=array();
    $cat_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    foreach($results as $value){
 
        $cat_item=array(
            "id" => $value['gen_id'],
            "name" => $value['gen_name'],
            "description" => html_entity_decode($value['gen_desc']),
        );
 
        array_push($cat_arr["records"], $cat_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
    echo json_encode($cat_arr);
}else{
 
    // set response code - 404 Not found
    http_response_code(404);
    echo json_encode(array("message" => "No cat found.")
    );
}
