<?php

/*
*
* Handles a POST Request
* returns a response 
* 
*/

require_once '../includes/DBoperations.php';
$response = array();
$response_collection = array();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $db = new DBoperations();

    $notifications = $db->getAllNotification(1);
    foreach($notifications as $notification){
        $response['error'] = false;
        $response['data'] = $notification[4]; 
        array_push($response_collection, $response);
    }   
}

echo json_encode($response_collection);