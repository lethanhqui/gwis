<?php

class Objects extends Controller
{
    public function index()
    {
		if(!$this->login->is_logged_in()){ header('Location: '.URL.'login/'); } 

		$classes = $this->classes->getAllClasses();
        $objects = $this->objects->getAllObjects();      
        
		
		$staff = $this->staffs->getStaff($_SESSION['staff_id']);
		
        require APP . 'view/_templates/header.php';
        require APP . 'view/objects/index.php';
        require APP . 'view/_templates/footer.php';
    }
	 public function add_object()
    {

        if (isset($_POST["submit_add_object"])) {
			$arr_deadline = explode("-",$_POST["deadline"]);
			$deadline = $arr_deadline[2].'-'.$arr_deadline[1].'-'.$arr_deadline[0];
            $this->objects->addObject($_POST["class_id"],$_POST["week"], $deadline, $_POST["description"]);
        }
        header('location: ' . URL . 'objects/index');
    }
	 public function delete_object($object_id)
    {
        if (isset($object_id)) {
            $this->objects->deleteObject($object_id);
        }
        header('location: ' . URL . 'objects/index');
    }

    public function edit_object($object_id)
    {
        if (isset($object_id)) {
            $object = $this->objects->getObjects($object_id);
			if (isset($object->deadline)){
				$deadline = $object->deadline ;
				$deadline = explode(' ',$deadline);
				$deadline = explode('-',$deadline[0]);
				
				$object->deadline = $deadline[2].'-'.$deadline[1].'-'.$deadline[0];
			}else{

				$object->deadline = "";
			}

			$classes = $this->classes->getAllClasses();
			$objects = $this->objects->getAllObjects();
            require APP . 'view/_templates/header.php';
            require APP . 'view/objects/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {

            header('location: ' . URL . 'objects/index');
        }
    }
	public function update_object()
    {

		$arr_deadline = explode("-",$_POST["deadline"]);
			$deadline = $arr_deadline[2].'-'.$arr_deadline[1].'-'.$arr_deadline[0];
        if (isset($_POST["submit_update_object"])) {
            $this->objects->updateObject($_POST["class_id"],$_POST["week"],$deadline, $_POST["description"], $_POST['object_id']);
        }

        header('location: ' . URL . 'objects/index');
    }
}
