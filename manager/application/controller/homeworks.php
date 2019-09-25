<?php

class Homeworks extends Controller
{
    public function index()
    {
		if(!$this->login->is_logged_in()){ header('Location: '.URL.'login/'); } 

		$classes = $this->classes->getAllClasses();
        $homeworks = $this->homeworks->getAllHomeworks();      
        //$count_homeworks = $this->homeworks->getCountHomeworks();
		
		$staff = $this->staffs->getStaff($_SESSION['staff_id']);
		
        require APP . 'view/_templates/header.php';
        require APP . 'view/homeworks/index.php';
        require APP . 'view/_templates/footer.php';
    }
	 public function add_homework()
    {

        if (isset($_POST["submit_add_homework"])) {
						
			$arr_deadline = explode("-",$_POST["deadline"]);
			$deadline = $arr_deadline[2].'-'.$arr_deadline[1].'-'.$arr_deadline[0];

            $this->homeworks->addHomework($_POST["class_id"],$deadline, $_POST["description"]);
        }
        header('location: ' . URL . 'homeworks/index');
    }
	 public function delete_homework($homework_id)
    {
        if (isset($homework_id)) {
            $this->homeworks->deleteHomework($homework_id);
        }

        header('location: ' . URL . 'homeworks/index');
    }

    public function edit_homework($homework_id)
    {
        if (isset($homework_id)) {
            $homework = $this->homeworks->getHomeworks($homework_id);
			if (isset($homework->deadline)){
				$deadline = $homework->deadline ;
				$deadline = explode(' ',$deadline);
				$deadline = explode('-',$deadline[0]);
				
				$homework->deadline = $deadline[2].'-'.$deadline[1].'-'.$deadline[0];
			}else{

				$homework->deadline = "";
			}

			$classes = $this->classes->getAllClasses();
			$homeworks = $this->homeworks->getAllHomeworks();
            require APP . 'view/_templates/header.php';
            require APP . 'view/homeworks/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {

            header('location: ' . URL . 'homeworks/index');
        }
    }
	public function update_homework()
    {

        if (isset($_POST["submit_update_homework"])) {
			$deadline = explode("-",$_POST["deadline"]);
			$deadline = $deadline[2].'-'.$deadline[1].'-'.$deadline[0];
            $this->homeworks->updateHomework($_POST["class_id"],$deadline, $_POST["description"], $_POST['homework_id']);
        }

        header('location: ' . URL . 'homeworks/index');
    }
}
