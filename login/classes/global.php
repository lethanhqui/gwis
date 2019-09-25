<?php

class Globals{

    private $_db;

    function __construct($db){
    	$this->_db = $db;
    }
	
	public function getClasses(){

		try {
		
			$sql = 'SELECT *
				FROM gwis_class';
			$stmt = $this->_db->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}
	
	public function getBooks(){

		try {
		
			$sql = 'SELECT *
				FROM gwis_books';
			$stmt = $this->_db->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}

}


?>
