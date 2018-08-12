<?php


require_once '../includes/DBoperations.php';
$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['participant_id']) and isset($_POST['competition_id'])){
        $db = new DBoperations();

        if($db->cancelParticipation($_POST['participant_id'], $_POST['competition_id'])){
            $response['error'] = false;
            $response['message'] = "Success";
        }else{
            $response['error'] = true;
            $response['message'] = "Invalid input";
        }
    }else{
        $response['error'] = true;
        $response['message'] = "Invalid request";
    }
}

echo json_encode($response);