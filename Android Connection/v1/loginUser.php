<?php


require_once '../includes/DBoperations.php';
$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['email']) and isset($_POST['password'])){
        $db = new DBoperations();

        if($db->userLogin($_POST['email'], $_POST['password'])) {
            $user = $db->getUserByEmail($_POST['email']);
            $response['error'] = false;
            $response['id'] = $user['id'];
            $response['name'] = $user['name'];
            $response['email'] = $user['email'];
            $response['position'] = $user['position'];
            $response['duration'] = $user['duration'];
            $response['phone_number'] = $user['phone_number'];
            $response['address'] = $user['address'];
            $response['about'] = $user['about'];
            $response['institution'] = $user['institution'];
            $response['occupation'] = $user['occupation'];
            $response['website'] = $user['website'];

        }else{
            $response['error'] = true;
            $response['message'] = "Invalid email or password";
        }
    }else{
        $response['error'] = true;
        $response['message'] = "Invalid request";
    }
}

echo json_encode($response);