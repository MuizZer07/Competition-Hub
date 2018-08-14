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
    if(isset($_POST['username']) and
         isset($_POST['email']) and
             isset($_POST['password'])
    ){
        $db = new DBoperations();
        $result = $db->createUser(
                    $_POST['username'],
                    $_POST['password'],
                    $_POST['email']
        );

        if($result == 1){
            $response['error'] = false;
            $response['message'] = "User Created successfully!";
        }else if($result == 2){
            $response['error'] = true;
            $response['message'] = "User not created";
        }else if($result == 0){
            $response['error'] = true;
            $response['message'] = "Username or Email is already registered!";
        }
    }else{
        $response['error'] = true;
        $response['message'] = "Required fields are missing";
    }
}else{
    $response['error'] = true;
    $response['message'] = "Invalid request";
}

echo json_encode($response);