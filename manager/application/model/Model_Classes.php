<?php

class Model_Classes
{

    function __construct($db)
    {		
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
		
    }

    public function getAllClasses()
    {
        $sql = "SELECT * FROM gwis_class";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function addClass($class_code,$name, $fee)
    {
        $sql = "INSERT INTO gwis_class (class_code,name, fee, timestamp_created) VALUES (:class_code,:name, :fee, NOW())";
        $query = $this->db->prepare($sql);
        $parameters = array(':class_code' => $class_code,':name' => $name, ':fee' => $fee);
        $query->execute($parameters);
    }

    public function deleteClass($class_id)
    {
        $sql = "DELETE FROM gwis_class WHERE class_id = :class_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':class_id' => $class_id);

        $query->execute($parameters);
    }

    public function getClass($class_id)
    {
        $sql = "SELECT * FROM gwis_class WHERE class_id = :class_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':class_id' => $class_id);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function updateClass($class_code,$name, $fee, $class_id)
    {
        $sql = "UPDATE gwis_class SET class_code = :class_code,name = :name, fee = :fee WHERE class_id = :class_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':class_code' => $class_code,':name' => $name, ':fee' => $fee, ':class_id' => $class_id);

        $query->execute($parameters);
    }

    public function getCountClasses()
    {
        $sql = "SELECT COUNT(class_id) AS count_class FROM gwis_class";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch()->count_class;
    }
}
