<?php

class Model_Login
{

    function __construct($db)
    {		
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
		session_start();
    }

    private function get_user_hash($username){
		
		$sql = "SELECT name,password, username, staff_id FROM gwis_staffs WHERE username = :username";
        $query = $this->db->prepare($sql);
        $parameters = array(':username' => $username);

        $query->execute($parameters);

        return $query->fetch();
	}

	public function login($username,$password){
	
		$row = $this->get_user_hash($username);

		if($password == $row->password){

		    $_SESSION['loggedin'] = true;
		    $_SESSION['username'] = $row->username;
		    $_SESSION['name'] = $row->name;
		    $_SESSION['staff_id'] = $row->staff_id;
		    return true;
		}
	}

	public function logout(){
		session_destroy();
	}

	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}
}
