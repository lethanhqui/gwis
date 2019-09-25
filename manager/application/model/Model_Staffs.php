<?php

class Model_Staffs
{

    function __construct($db)
    {		
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
		
    }

    public function getAllStaffs()
    {
        $sql = "SELECT *
				FROM gwis_staffs 
				ORDER BY staff_id ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
	
	public function getStaff($staff_id)
    {
        $sql = "SELECT * FROM gwis_staffs WHERE staff_id = :staff_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':staff_id' => $staff_id);

        $query->execute($parameters);

        return $query->fetch();
    }
	
	public function checkStaff($username)
    {
        $sql = "SELECT username FROM gwis_staffs WHERE username = :username LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':username' => $username);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function addStaff($name,$birthday,$sex,$address,$phone,$email,$type,$username,$password)
    {
        $sql = "INSERT INTO gwis_staffs (name,address,birthday,sex,type,phone,email,username,password,timestamp_created) VALUES (:name,:address,:birthday,:sex,:type,:phone,:email,:username,:password,NOW())";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name,':address' => $address, ':birthday' => $birthday, ':sex' => $sex,':phone' => $phone, ':email' => $email,':type' => $type,':username' => $username,':password' => $password,);
	
		$query->execute($parameters);	
    }
	
	public function updateStaff($name,$birthday,$sex,$address,$phone,$email,$type,$username,$password,$staff_id)
    {
        $sql = "UPDATE gwis_staffs SET name = :name, birthday = :birthday, sex = :sex, address = :address, phone = :phone, email = :email, type = :type, username = :username, password = :password WHERE staff_id = :staff_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name, ':birthday' => $birthday, ':sex' => $sex, ':address' => $address,':phone' => $phone, ':email' => $email, ':type' => $type,':username' => $username,':password' => $password, ':staff_id' => $staff_id);

        $query->execute($parameters);
    }
	
	public function updateAccount($staffname,$password,$staff_id)
    {
        $sql = "UPDATE gwis_staffs SET staffname = :staffname, password = :password WHERE staff_id = :staff_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':staffname' => $staffname, ':password' => $password, ':staff_id' => $staff_id);

        $query->execute($parameters);
    }

    public function deleteStaff($staff_id)
    {
        $sql = "DELETE FROM gwis_staffs WHERE staff_id = :staff_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':staff_id' => $staff_id);

        $query->execute($parameters);
    }

    public function getCountStaffs()
    {
        $sql = "SELECT COUNT(staff_id) AS count_staffs FROM gwis_staffs";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch()->count_staffs;
    }

}
