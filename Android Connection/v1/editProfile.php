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
    if(isset($_POST['user_id'])){
        $db = new DBoperations();

        if($db->editProfile($_POST['user_id'], $_POST['name'], $_POST['position'], $_POST['duration']
                  , $_POST['phone_number'] , $_POST['address'] , $_POST['about'] , $_POST['institution']
                  , $_POST['occupation'] , $_POST['website']
        )) {
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