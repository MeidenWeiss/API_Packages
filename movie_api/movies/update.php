<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/movies.php';
 
$movies = new Movies();
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
// make sure data is not empty
if(
    !empty($data->name) &&
    !empty($data->genre) &&
    !empty($data->price) &&
    !empty($data->description) &&
    !empty($data->year)
){
 
    // set movie property values
    $movie_id = $data->id;
    $name = $data->name;
    $genre = $data->genre;
    $price = $data->price;
    $desc = $data->description;
    $year = $data->year;
 
    // create the movie
    if($movies->update($name, $genre, $price, $desc, $year, $movie_id)){
 
        // 201 CREATED
        http_response_code(201);
        echo json_encode(array("message" => "Movie was updated."));
    }
 
    // if unable to create the movie,
    else{
 
        // 503 SERVICE UNAVAILABLE
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update movie. System Error."));
    }
}
 
// tell the user data is incomplete
else{
 
    // 400 BAD REQUEST
    http_response_code(400);
    echo json_encode(array("message" => "Unable to update movie. Data is incomplete."));
}
?>