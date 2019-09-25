<?php

class Model_Achievements
{

    function __construct($db)
    {		
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
		
    }

    public function getAllAchievements()
    {
        $sql = "SELECT * FROM gwis_achievements 
				ORDER BY name ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function addAchievement($name,$sale_fee)
    {
        $sql = "INSERT INTO gwis_achievements (name,sale_fee, timestamp_created) VALUES (:name,:sale_fee, NOW())";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name,':sale_fee' => $sale_fee);
        $query->execute($parameters);
    }

    public function deleteAchievement($achievement_id)
    {
        $sql = "DELETE FROM gwis_achievements WHERE achievement_id = :achievement_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':achievement_id' => $achievement_id);

        $query->execute($parameters);
    }

    public function getAchievement($achievement_id)
    {
        $sql = "SELECT * FROM gwis_achievements WHERE achievement_id = :achievement_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':achievement_id' => $achievement_id);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function updateAchievement($name,$sale_fee, $achievement_id)
    {
        $sql = "UPDATE gwis_achievements 
		SET name = :name ,
			sale_fee = :sale_fee
		WHERE achievement_id = :achievement_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name, ':sale_fee' => $sale_fee,':achievement_id' => $achievement_id);

        $query->execute($parameters);
    }

    public function getCountAchievements()
    {
        $sql = "SELECT COUNT(achievement_id) AS count_achievements FROM gwis_achievements";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch()->count_achievements;
    }
}
