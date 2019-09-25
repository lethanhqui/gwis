<?php
include('password.php');
class User extends Password{

    private $_db;

    function __construct($db){
    	parent::__construct();

    	$this->_db = $db;
    }

	private function get_user_hash($username){

		try {
			$stmt = $this->_db->prepare('SELECT name,password, username, user_id FROM gwis_users WHERE username = :username');
			$stmt->execute(array('username' => $username));

			return $stmt->fetch();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}
	
	public function change_password($password,$user_id){

		try {
			$sql='UPDATE gwis_users 
				SET password = :password
				WHERE user_id = :user_id';
			$stmt = $this->_db->prepare($sql);
			$r = $stmt->execute(array('password' => $password,'user_id' => $user_id));
		
			return $r;

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}
	
	public function check_password($password,$user_id){

		try {
			$sql='SELECT name,password, username, user_id FROM gwis_users WHERE password = :password AND user_id = :user_id';
			$stmt = $this->_db->prepare($sql);
			$stmt->execute(array('password' => $password,'user_id' => $user_id));

			return $stmt->fetch();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}

	public function login($username,$password){
	
		$row = $this->get_user_hash($username);

		if($password == $row['password']){

		    $_SESSION['loggedin'] = true;
		    $_SESSION['username'] = $row['username'];
		    $_SESSION['name'] = $row['name'];
		    $_SESSION['user_id'] = $row['user_id'];
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
	 
	public function getResultUser($user_id,$type = 1){
	
		try {
		
			if($type == 1)
			{
				$join_sql = ' AND RE.result = 1';
			}
			else
			{
				$join_sql = ' AND RE.follow = 1';
			}
			
			$sql = 'SELECT RE.*,
				US.name AS user_name,
				US.username AS user_username
			FROM gwis_results AS RE
			LEFT OUTER JOIN gwis_users AS US ON US.user_id = RE.user_id 
			WHERE RE.user_id = :user_id';
			$sql.= $join_sql;
			$stmt = $this->_db->prepare($sql);
			$stmt->execute(array('user_id' => $user_id));

			return $stmt->fetchAll();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}
	
	public function getAssessmentUser($user_id){
	
		try {
		
			$sql = 'SELECT AM.*,
				US.name AS user_name,
				US.username AS user_username
			FROM gwis_assessments AS AM
			LEFT OUTER JOIN gwis_users AS US ON US.user_id = AM.user_id 
			WHERE AM.user_id = :user_id';

			$stmt = $this->_db->prepare($sql);
			$stmt->execute(array('user_id' => $user_id));

			return $stmt->fetchAll();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}
	
	public function getUser($user_id){
	
		try {
		
			$sql = 'SELECT US.*,
				CL.name AS class_name,
				CL.fee,
				AC.sale_fee
				FROM gwis_users AS US
				LEFT OUTER JOIN gwis_class AS CL ON CL.class_id = US.class_id
				LEFT OUTER JOIN gwis_achievements AS AC ON AC.achievement_id = US.achievement_id
				WHERE US.user_id = :user_id';
	
			$stmt = $this->_db->prepare($sql);
			$stmt->execute(array('user_id' => $user_id));

			return $stmt->fetch();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}
	
	public function getHomeworks($class_id){
	
		try {
		
			$sql = "SELECT HW.*,
					CL.name AS class_name
					FROM gwis_homeworks AS HW 
					LEFT OUTER JOIN gwis_class AS CL ON CL.class_id = HW.class_id
					WHERE HW.class_id = :class_id" ;

			$stmt = $this->_db->prepare($sql);
			$stmt->execute(array('class_id' => $class_id));

			return $stmt->fetchAll();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}
	public function getObjects($class_id){
	
		try {
		
			$sql = "SELECT OJ.*,
					CL.name AS class_name
					FROM gwis_object AS OJ 
					LEFT OUTER JOIN gwis_class AS CL ON CL.class_id = OJ.class_id
					WHERE OJ.class_id = :class_id" ;

			$stmt = $this->_db->prepare($sql);
			$stmt->execute(array('class_id' => $class_id));

			return $stmt->fetchAll();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}

}


?>
