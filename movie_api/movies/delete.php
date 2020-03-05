<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/movies.php';
 
// prepare movies object
$movies = new Movies();
 
$data = json_decode(file_get_contents("php://input"));
if(!empty($data->id)){
    $movie_id = $data->id;
    if($movies->delete($movie_id)){
        // set response code - 200 OK
        http_response_code(200);
        echo json_encode(array("message" => "Movie has been deleted!"));
    }else{
        // set response code - 503 SERVICE N/A
        http_response_code(503);
        echo json_encode(array("message" => "Cannot delete movie, service unavailable"));
    }
}else{
    // 400 BAD REQUEST
    http_response_code(400);
    echo json_encode(array("message" => "Unable to delete movie. Data is incomplete."));
}
?>