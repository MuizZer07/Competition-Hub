<?php

class DBoperations{

    private $con;

    function __construct(){
        require_once dirname(__FILE__).'/DBconnect.php';

        $db = new DBconnect();

        $this->con = $db->connect();
    }

    public function createUser($username, $password, $email){
        if($this->isUserExist($username, $email)){
                return 0;
        }else{
            $pass = md5($password);
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

    public function userLogin($email, $password){
        $password = md5($password);
        $stmt = $this->con->prepare("select id from users where email = ? and
                                    password = ?");

        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function getUserByEmail($email){
        $stmt = $this->con->prepare("select * from users where email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();

    }

    public function getAllCompetitions(){
        $stmt = $this->con->prepare("select * from competitions");
        $stmt->execute();
        return $stmt->get_result()->fetch_all();
    }

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

    public function isParticipating($participant_id, $competition_id){
        $stmt = $this->con->prepare("select * from participation_histories
                 where participant_id = ? and competition_id = ?");

        $stmt->bind_param("ss", $participant_id, $competition_id);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }


    private function isUserExist($username, $email){
        $stmt = $this->con->prepare("select id from users where name = ? or
                                email = ?");

        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
}