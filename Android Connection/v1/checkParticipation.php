<?php

/*
*
* Handles a POST Request
* returns a response 
* 
*/

require_once '../includes/DBoperations.php';
$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $db = new DBoperations();

    if($db->isParticipating($_POST['participant_id'], $_POST['competition_id'])){
        $response['participation'] = true;
    }else{
        $response['participation'] = false;
    }
}

echo json_encode($response);