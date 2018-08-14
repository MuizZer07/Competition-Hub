<?php

/*
*
* Middleware Class to communicate with our database
* Requires DBconnect class 
* Implements CRUD Database Opetations
* 
*/

class DBoperations{

    private $con;

    function __construct(){
        require_once dirname(__FILE__).'/DBconnect.php';

        $db = new DBconnect();

        $this->con = $db->connect();
    }

    # creates a new User
    public function createUser($username, $password, $email){
        if($this->isUserExist($username, $email)){
                return 0;
        }else{
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->con->prepare("INSERT INTO `users` (`id`, `name`, `email`, 
                            `password`, `remember_token`, `created_at`, `updated_at`, 
                            `token`, `position`, `duration`, `phone_number`, `address`,
                             `about`, `institution`, `occupation`, `website`) VALUES 
                             (NULL, ?, ?, ?, NULL, NULL, NULL, 
                             NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL); ");
    
            $stmt->bind_param("sss", $username,  $email, $pass);
    
            if($stmt->execute()){
                return 1;
            }
            else{
                return 2;
            }
        }
        
    }

    # verifies a User with email and password
    public function userLogin($email, $password){
        $user = $this->getUserByEmail($email);
        $pass = $user['password'];

        if(password_verify($password, $pass)){
            return true;
        }else{
            return false;
        }
    }

    # gets a User by their email address
    public function getUserByEmail($email){
        $stmt = $this->con->prepare("select * from users where email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    # gets all the competitions from the database table
    public function getAllCompetitions(){
        $today = date("Y-m-d");
        $stmt = $this->con->prepare("select * from competitions where event_date >= ?");
        $stmt->bind_param("s", $today);
        $stmt->execute();
        return $stmt->get_result()->fetch_all();
    }

    # creates a row to the participation_histories table in the database
    public function createParticipationHistory($participant_id, $competition_id){
        $stmt = $this->con->prepare("INSERT INTO `participation_histories` (`created_at`, 
                            `updated_at`, `participant_id`, `competition_id`) 
                             VALUES (NULL, NULL, ?, ?);");
        $stmt->bind_param("ss", $participant_id, $competition_id );

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    # checks if a user is participating or not
    public function isParticipating($participant_id, $competition_id){
        $stmt = $this->con->prepare("select * from participation_histories
                 where participant_id = ? and competition_id = ?");

        $stmt->bind_param("ss", $participant_id, $competition_id);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    # check the deadline is gone or yet to come
    public function checkDeadline($competition_id){
        $today = date("Y-m-d");
        $stmt = $this->con->prepare("select reg_deadline from competitions where id = ?");
        $stmt->bind_param("s", $competition_id);
        $stmt->execute();
        $stmt->bind_result($deadline);
        $stmt->fetch();
        if($deadline <= $today){
            return true;
        }else{
            return false;
        }
    }

    # update a user's information in the database
    public function editProfile($user_id, $name, $position, $duration,
                             $phn, $address, $about, $ins, $occ, $web){
        $stmt = $this->con->prepare("update users set name = ?, position = ?, duration = ?, phone_number = ?,
                                    address = ?, about = ?, institution = ?, occupation = ?, website = ?
                              where id = ?");
        $stmt->bind_param("ssssssssss", $name, $position, $duration,
                                 $phn, $address, $about, $ins, $occ, $web, $user_id);
        return $stmt->execute();
    }

    # deletes a row from the participation_histories table in the database
    public function cancelParticipation($user_id, $competition_id){
        $stmt = $this->con->prepare("delete from participation_histories where
                                participant_id = ? and competition_id = ?");
        $stmt->bind_param("ss", $user_id, $competition_id);
        return $stmt->execute();
    }

    # checks whether the given username and password exists or not
    private function isUserExist($username, $email){
        $stmt = $this->con->prepare("select id from users where name = ? or
                                email = ?");

        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    # gets all the rows from the notifications table
    public function getAllNotification($notifiable_id){
        $stmt = $this->con->prepare("select * from notifications where notifiable_id = ?");
        $stmt->bind_param("s", $notifiable_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all();
    }
}