<?php

class Model_Users
{

    function __construct($db)
    {		
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
		
    }

    public function getAllUsers()
    {
        $sql = "SELECT US.*,
				CL.name AS class_name, 
				AC.name AS achievement_name 
				FROM gwis_users AS US 
				LEFT OUTER JOIN gwis_class AS CL ON CL.class_id = US.class_id 
				LEFT OUTER JOIN gwis_achievements AS AC ON AC.achievement_id = US.achievement_id 
				ORDER BY US.user_id ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
	
	public function getUser($user_id)
    {
        $sql = "SELECT * FROM gwis_users WHERE user_id = :user_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);

        $query->execute($parameters);

        return $query->fetch();
    }
	
	public function checkUser($username)
    {
        $sql = "SELECT username FROM gwis_users WHERE username = :username LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':username' => $username);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function addUser($name,$class_id,$address,$birthday,$sex,$school,$achievement_id,$name_father,$name_mother,$phone,$email,$password,$username)
    {
        $sql = "INSERT INTO gwis_users (name,class_id,achievement_id,address,birthday,sex,school,name_father,name_mother,phone,email,timestamp_created) VALUES (:name, :class_id,:achievement_id,:address,:birthday,:sex,:school,:name_father,:name_mother,:phone,:email,NOW())";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name, ':class_id' => $class_id,':achievement_id' => $achievement_id, ':address' => $address, ':birthday' => $birthday, ':sex' => $sex, ':school' => $school,':name_father' => $name_father,':name_mother' => $name_mother,':phone' => $phone, ':email' => $email);
	
        $result = $query->execute($parameters);
		if ($result == true)
		{		
			$user_id = $this->db->lastInsertId();
			//$username = str_pad($user_id ,8,'0',STR_PAD_LEFT);
			//updateAccount($username,$password,$user_id);		
			$sql = "UPDATE gwis_users SET username = :username, password = :password WHERE user_id = :user_id";
			$query = $this->db->prepare($sql);
			$parameters = array(':username' => $username, ':password' => $password, ':user_id' => $user_id);

			$query->execute($parameters);

		}
		
    }
	
	public function updateUser($name,$class_id,$address,$birthday,$password,$sex,$school,$achievement_id,$name_father,$name_mother,$phone,$email,$username,$user_id)
    {
        $sql = "UPDATE gwis_users SET name = :name, class_id = :class_id, address = :address, birthday = :birthday, password = :password, sex = :sex, school = :school, achievement_id = :achievement_id, name_father = :name_father, name_mother = :name_mother,phone = :phone, email = :email, username = :username WHERE user_id = :user_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name, ':class_id' => $class_id, ':address' => $address, ':birthday' => $birthday,':password' => $password, ':sex' => $sex,':school' => $school,':achievement_id' => $achievement_id,':name_father' => $name_father,':name_mother' => $name_mother,':phone' => $phone, ':email' => $email,':username' => $username, ':user_id' => $user_id);

        $query->execute($parameters);
    }
	
	public function updateAccount($username,$password,$user_id)
    {
        $sql = "UPDATE gwis_users SET username = :username, password = :password WHERE user_id = :user_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':username' => $username, ':password' => $password, ':user_id' => $user_id);

        $query->execute($parameters);
    }

    public function deleteUser($user_id)
    {
        $sql = "DELETE FROM gwis_users WHERE user_id = :user_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);

        $query->execute($parameters);
    }

    public function getCountUsers()
    {
        $sql = "SELECT COUNT(user_id) AS count_users FROM gwis_users";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch()->count_users;
    }
	
	public function nextUser($user_id)
	{
		//select * from foo where id = (select min(id) from foo where id > 4)
		$sql = "SELECT * FROM gwis_users WHERE user_id = (SELECT min(user_id) FROM  gwis_users where user_id > :user_id) LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);

        $query->execute($parameters);

        return $query->fetch();
	}
	
	public function prevUser($user_id)
	{
		//select * from foo where id = (select min(id) from foo where id > 4)
		$sql = "SELECT * FROM gwis_users WHERE user_id = (SELECT max(user_id) FROM  gwis_users where user_id < :user_id) LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);

        $query->execute($parameters);

        return $query->fetch();
	}
	
	public function addResult($result_date,$lesson,$test15,$test45,$testlast,$note,$user_id)
    {
        $sql = "INSERT INTO gwis_results
	   (result_date,lesson,test15,test45,testlast,note,user_id,result,timestamp_created) VALUES (:result_date, :lesson,:test15,:test45,:testlast,:note,:user_id,1,NOW())";
        $query = $this->db->prepare($sql);
        $parameters = array(':result_date' => $result_date, ':lesson' => $lesson,':test15' => $test15, ':test45' => $test45, ':testlast' => $testlast, ':note' => $note, ':user_id' => $user_id);
	
        $query->execute($parameters);	
    }
	
	public function addFollow($follow_date,$participate,$reason,$user_id)
    {
        $sql = "INSERT INTO gwis_results
	   (follow_date,participate,reason,user_id,follow,timestamp_created) VALUES (:follow_date, :participate,:reason,:user_id,1,NOW())";
        $query = $this->db->prepare($sql);
        $parameters = array(':follow_date' => $follow_date, ':participate' => $participate,':reason' => $reason,':user_id' => $user_id);
	
        $query->execute($parameters);	
    }
	
	public function getAllResults($user_id)
    {
        $sql = "SELECT RE.*,
				US.name AS user_name 
				FROM gwis_results AS RE 
				LEFT OUTER JOIN gwis_users AS US ON US.user_id = RE.user_id 
				WHERE RE.result = 1
				AND RE.user_id = ".$user_id."	
				ORDER BY RE.result_date ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
	
	public function getAllFollows($user_id)
    {
        $sql = "SELECT RE.*,
				US.name AS user_name 
				FROM gwis_results AS RE 
				LEFT OUTER JOIN gwis_users AS US ON US.user_id = RE.user_id 
				WHERE RE.follow = 1
				AND RE.user_id = ".$user_id."
				ORDER BY RE.follow_date ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
	
	public function getResult($result_id)
    {
        $sql = "SELECT RE.*,
				US.name AS user_name 	
				FROM gwis_results AS RE
				LEFT OUTER JOIN gwis_users AS US ON US.user_id = RE.user_id
				WHERE RE.result_id = :result_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':result_id' => $result_id);

        $query->execute($parameters);

        return $query->fetch();
    }
	
	public function deleteResult($result_id)
    {
        $sql = "DELETE FROM gwis_results WHERE result_id = :result_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':result_id' => $result_id);

        $query->execute($parameters);
    }
	
	public function updateResult($result_date,$lesson,$test15,$test45,$testlast,$note,$result_id)
    {
        $sql = "UPDATE gwis_results SET result_date = :result_date, 
		lesson = :lesson,
		test15 = :test15,
		test45 = :test45,
		testlast = :testlast,
		note = :note
		WHERE result_id = :result_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':result_date' => $result_date, ':lesson' => $lesson,':test15' => $test15,':test45' => $test45,':testlast' => $testlast,':note' => $note, ':result_id' => $result_id);

        $query->execute($parameters);
    }
	
	public function updateFollow($follow_date,$participate,$reason,$result_id)
    {
        $sql = "UPDATE gwis_results SET follow_date = :follow_date, participate = :participate , reason = :reason
		WHERE result_id = :result_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':follow_date' => $follow_date, ':participate' => $participate,':reason' => $reason, ':result_id' => $result_id);

        $query->execute($parameters);
    }
	
	public function getAllAssessments($user_id)
    {
        $sql = "SELECT AM.*,
				US.name AS user_name 
				FROM gwis_assessments AS AM 
				LEFT OUTER JOIN gwis_users AS US ON US.user_id = AM.user_id 
				WHERE AM.user_id = ".$user_id."	
				ORDER BY AM.assessment_date ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
	
	public function addAssessment($assessment_date,$description,$user_id)
    {
        $sql = "INSERT INTO  gwis_assessments
	   (assessment_date,description,user_id,timestamp_created) VALUES (:assessment_date, :description,:user_id,NOW())";
        $query = $this->db->prepare($sql);
        $parameters = array(':assessment_date' => $assessment_date, ':description' => $description,':user_id' => $user_id);
	
        $query->execute($parameters);	
    }
	
	public function getAssessment($assessment_id)
    {
        $sql = "SELECT AM.*,
				US.name AS user_name 	
				FROM gwis_assessments AS AM
				LEFT OUTER JOIN gwis_users AS US ON US.user_id = AM.user_id
				WHERE AM.assessment_id = :assessment_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':assessment_id' => $assessment_id);

        $query->execute($parameters);

        return $query->fetch();
    }
	
	public function updateAssessment($assessment_date,$description,$assessment_id)
    {
        $sql = "UPDATE gwis_assessments SET assessment_date = :assessment_date, description = :description
		WHERE assessment_id = :assessment_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':assessment_date' => $assessment_date, ':description' => $description,':assessment_id' => $assessment_id);

        $query->execute($parameters);
    }
	
	public function deleteAssessment($assessment_id)
    {
        $sql = "DELETE FROM gwis_assessments WHERE assessment_id = :assessment_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':assessment_id' => $assessment_id);

        $query->execute($parameters);
    }

}
