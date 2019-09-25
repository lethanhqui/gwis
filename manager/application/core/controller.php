<?php

class Controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Model
     */
    public $model = null;

    /**
     * Whenever controller is created, open a database connection too and load "the model".
     */
    function __construct()
    {
        $this->openDatabaseConnection();
        $this->loadUsers();
        $this->loadClasses();
        $this->loadAchievements();
        $this->loadBooks();
        $this->loadStaffs();
		$this->loadHomeworks();
		$this->loadObject();
        $this->loadLogin();
		
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }

    /**
     * Loads the "model".
     * @return object model
     */
	public function loadUsers()
    {
        require APP . 'model/Model_Users.php';
        $this->users = new Model_Users($this->db);
    }
	
	public function loadClasses()
    {
        require APP . 'model/Model_Classes.php';
        $this->classes = new Model_Classes($this->db);
    }
	
	public function loadAchievements()
    {
        require APP . 'model/Model_Achievements.php';
        $this->achievements = new Model_Achievements($this->db);
    }
	
	public function loadBooks()
    {
        require APP . 'model/Model_Books.php';
        $this->books = new Model_Books($this->db);
    }
	
	public function loadStaffs()
    {
        require APP . 'model/Model_Staffs.php';
        $this->staffs = new Model_Staffs($this->db);
    }
	  public function loadHomeworks()
    {
        require APP . 'model/Model_Homeworks.php';
        $this->homeworks = new Model_Homeworks($this->db);
    } 
	
	 public function loadObject()
    {
        require APP . 'model/Model_Objects.php';
        $this->objects = new Model_Objects($this->db);
    } 
	
	public function loadLogin()
    {
        require APP . 'model/Model_Login.php';
        $this->login = new Model_Login($this->db);
    }
}
