<?php

class Home extends Controller
{

    public function index()
    {
		if(!$this->login->is_logged_in()){ header('Location: '.URL.'login/'); } 
	
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }

}
