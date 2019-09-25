<?php

class Model_Objects
{

    function __construct($db)
    {		
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
		
    }

    public function getAllObjects()
    {
        $sql ="SELECT OJ.*,
					CL.name AS class_name 
					FROM gwis_object AS OJ 
					LEFT OUTER JOIN gwis_class AS CL ON CL.class_id = OJ.class_id 
					ORDER BY OJ.object_id ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
	
	public function getObjects($object_id)
    {
        $sql = "SELECT * FROM gwis_object WHERE object_id = :object_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':object_id' => $object_id);

        $query->execute($parameters);

        return $query->fetch();
    }
	 public function addObject($class_id, $week, $deadline, $description)
    {
        $sql = "INSERT INTO gwis_object (class_id, week, deadline, description, timestamp_created) VALUES (:class_id, :week, :deadline, :description, NOW())";
        $query = $this->db->prepare($sql);
        $parameters = array(':class_id' => $class_id,':week' => $week,':deadline' => $deadline, ':description' => $description);
        $query->execute($parameters);
    }
	public function deleteObject($object_id)
    {
        $sql = "DELETE FROM gwis_object WHERE object_id = :object_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':object_id' => $object_id);

        $query->execute($parameters);
    }
	 public function updateObject($class_id,$week, $deadline, $description, $object_id)
    {
        $sql = "UPDATE gwis_object SET class_id = :class_id, week = :week, deadline = :deadline, description = :description WHERE object_id = :object_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':class_id' => $class_id,':week' => $week,':deadline' => $deadline, ':description' => $description, ':object_id' => $object_id);

        $query->execute($parameters);
    }
	
}