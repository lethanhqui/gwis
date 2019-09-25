<?php


class Classes extends Controller
{

    public function index()
    {
		if(!$this->login->is_logged_in()){ header('Location: '.URL.'login/'); } 
		
        $classes = $this->classes->getAllClasses();
        $count_classes = $this->classes->getCountClasses();
		
		$staff = $this->staffs->getStaff($_SESSION['staff_id']);

        require APP . 'view/_templates/header.php';
        require APP . 'view/classes/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function add_class()
    {

        if (isset($_POST["submit_add_class"])) {
            $this->classes->addClass($_POST["class_code"],$_POST["name"], $_POST["fee"]);
        }

        header('location: ' . URL . 'classes/index');
    }

    public function delete_class($class_id)
    {
        if (isset($class_id)) {
            $this->classes->deleteClass($class_id);
        }

        header('location: ' . URL . 'classes/index');
    }

    public function edit_class($class_id)
    {
        if (isset($class_id)) {
            $class = $this->classes->getClass($class_id);

            require APP . 'view/_templates/header.php';
            require APP . 'view/classes/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {

            header('location: ' . URL . 'classes/index');
        }
    }

    public function update_class()
    {

        if (isset($_POST["submit_update_class"])) {
            $this->classes->updateClass($_POST["class_code"],$_POST["name"], $_POST["fee"], $_POST['class_id']);
        }

        header('location: ' . URL . 'classes/index');
    }

}
