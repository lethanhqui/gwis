<?php

class Model_Homeworks
{

    function __construct($db)
    {		
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }	
    }

    public function getAllHomeworks()
    {
		  $sql = "SELECT HW.*,
					CL.name AS class_name 
					FROM gwis_homeworks AS HW 
					LEFT OUTER JOIN gwis_class AS CL ON CL.class_id = HW.class_id 
					ORDER BY HW.homework_id ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
	
	public function getHomeworks($homework_id)
    {
        $sql = "SELECT * FROM gwis_homeworks WHERE homework_id = :homework_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':homework_id' => $homework_id);

        $query->execute($parameters);

        return $query->fetch();
    }
	
	 public function addHomework($class_id,$deadline, $description)
    {
        $sql = "INSERT INTO gwis_homeworks (class_id,deadline, description, timestamp_created) VALUES (:class_id,:deadline, :description, NOW())";
        $query = $this->db->prepare($sql);
        $parameters = array(':class_id' => $class_id,':deadline' => $deadline, ':description' => $description);
        $query->execute($parameters);
    }
	 public function updateHomework($class_id,$deadline, $description, $homework_id)
    {
        $sql = "UPDATE gwis_homeworks SET class_id = :class_id,deadline = :deadline, description = :description WHERE homework_id = :homework_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':class_id' => $class_id,':deadline' => $deadline, ':description' => $description, ':homework_id' => $homework_id);

        $query->execute($parameters);
    }
	public function deleteHomework($homework_id)
    {
        $sql = "DELETE FROM gwis_homeworks WHERE homework_id = :homework_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':homework_id' => $homework_id);

        $query->execute($parameters);
    }
   public function getCountHomeworks()
    {
        $sql = "SELECT COUNT(homework_id) AS count_homework FROM gwis_homeworks";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch()->count_homeworks;
    } 
}
