<?php


require_once '../includes/DBoperations.php';
$response = array();
$response_collection = array();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $db = new DBoperations();

    $competitions = $db->getAllCompetitions();
    foreach($competitions as $competition){
        $response['error'] = false;
        $response['id'] = $competition[0];
        $response['name'] = $competition[1];
        $response['venue'] = $competition[2];
        $response['event_date'] = $competition[3];
        $response['reg_deadline'] = $competition[4];
        $response['description'] = $competition[5];
        $response['catagory_id'] = $competition[6];
        $response['organizer_id'] = $competition[7];
        if($db->checkDeadline($competition[0])){
            $response['isDeadlineOver'] = true;
        }else{
            $response['isDeadlineOver'] = false;
        }

        array_push($response_collection, $response);
    }
}

echo json_encode($response_collection);