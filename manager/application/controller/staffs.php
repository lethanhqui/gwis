<?php

class Staffs extends Controller
{

    public function index($error)
    {
		if(!$this->login->is_logged_in()){ header('Location: '.URL.'login/'); } 

        $staffs = $this->staffs->getAllStaffs();      
        $count_staffs = $this->staffs->getCountStaffs();
		
		$staff_obj = $this->staffs->getStaff($_SESSION['staff_id']);
		
		if($error == 1)
		{
			$mesage_error = "Không thể thêm CBNV. Vui lòng kiểm tra lại.";
		}
		
        require APP . 'view/_templates/header.php';
        require APP . 'view/staffs/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function add_staff()
    {	
        if (isset($_POST["submit_add_staff"])) {
			$arr_birthday = explode("-",$_POST["birthday"]);
			$birthday = $arr_birthday[2].'-'.$arr_birthday[1].'-'.$arr_birthday[0];
			if($this->staffs->checkStaff($_POST["username"]))
			{
				header('location: ' . URL . 'staffs/index/1');
				exit;
			}else{
				$this->staffs->addStaff($_POST["name"],$birthday,$_POST["sex"],$_POST["address"],$_POST["phone"],$_POST["email"],$_POST["type"],$_POST["username"],$_POST["password"]);
			}
            
        }

        header('location: ' . URL . 'staffs/index');
    }
	
	public function check_staff()
	{
		if($this->staffs->checkStaff($_POST["username"]))
		{
			echo 1;
			return true;
		}else{
			echo 0;
			return false;
		}
	}
	
    public function delete_staff($staff_id)
    {
        if (isset($staff_id)) {
            $this->staffs->deleteStaff($staff_id);
        }

        header('location: ' . URL . 'staffs/index');
    }

    public function update_staff()
    {
        if (isset($_POST["submit_update_staff"])) {
			$birthday = explode("-",$_POST["birthday"]);
			$birthday = $birthday[2].'-'.$birthday[1].'-'.$birthday[0];
            $this->staffs->updateStaff($_POST["name"],$birthday,$_POST["sex"],$_POST["address"],$_POST["phone"],$_POST["email"],$_POST["type"],$_POST["username"],$_POST["password"], $_POST['staff_id']);
        }

        header('location: ' . URL . 'staffs/index');
    }
	
	public function edit_staff($staff_id)
    {
        if (isset($staff_id)) {
            $staff = $this->staffs->getStaff($staff_id);
			if (isset($staff->birthday)){
				$birthday = $staff->birthday ;
				$birthday = explode(' ',$birthday);
				$birthday = explode('-',$birthday[0]);			
				$staff->birthday = $birthday[2].'-'.$birthday[1].'-'.$birthday[0];
			}else{
				$staff->birthday = "";
			}

            require APP . 'view/_templates/header.php';
            require APP . 'view/staffs/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header('location: ' . URL . 'staffs/index');
        }
    }
	

}
