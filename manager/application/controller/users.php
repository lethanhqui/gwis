<?php

class Users extends Controller
{

    public function index($error)
    {
		if(!$this->login->is_logged_in()){ header('Location: '.URL.'login/'); } 
		
		$classes = $this->classes->getAllClasses();
		$achievements = $this->achievements->getAllAchievements();
        $users = $this->users->getAllUsers();      
        $count_users = $this->users->getCountUsers();
		
        $staff = $this->staffs->getStaff($_SESSION['staff_id']);
		
		if($error == 1)
		{
			$mesage_error = "Không thể thêm Học Sinh. Vui lòng kiểm tra lại.";
		}
				
        require APP . 'view/_templates/header.php';
        require APP . 'view/users/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function add_user()
    {	
        if (isset($_POST["submit_add_user"])) {
			
			//$birthday = $_POST["year"].'-'.$_POST["month"].'-'.$_POST["day"];
			$arr_birthday = explode("-",$_POST["birthday"]);
			$birthday = $arr_birthday[2].'-'.$arr_birthday[1].'-'.$arr_birthday[0];
			$password = $arr_birthday[0].$arr_birthday[1].$arr_birthday[2];
			$username = $_POST["class_code"].$_POST["username"];
			if($this->users->checkUser($username))
			{
				header('location: ' . URL . 'users/index/1');
				exit;
			}else{
				$this->users->addUser($_POST["name"],$_POST["class_id"],$_POST["address"],$birthday,$_POST["sex"],$_POST["school"],$_POST["achievement_id"],$_POST["name_father"],$_POST["name_mother"],$_POST["phone"],$_POST["email"],$password,$username);
			}
            
        }

        header('location: ' . URL . 'users/index');
    }
	
	public function check_user()
	{
		if($this->users->checkUser($_POST["username"]))
		{
			echo 1;
			return true;
		}else{
			echo 0;
			return false;
		}
	}
	
    public function delete_user($user_id)
    {
        if (isset($user_id)) {
            $this->users->deleteUser($user_id);
        }

        header('location: ' . URL . 'users/index');
    }

    public function update_user()
    {
        if (isset($_POST["submit_update_user"])) {
			//$birthday = $_POST["year"].'-'.$_POST["month"].'-'.$_POST["day"];
			$birthday = explode("-",$_POST["birthday"]);
			$birthday = $birthday[2].'-'.$birthday[1].'-'.$birthday[0];
			if($_POST["password_reset"] == 1){
					$password = $_POST["pass"];
				
				}else{
					$password = $_POST["pass_defaut"];
		
				}
            $this->users->updateUser($_POST["name"],$_POST["class_id"],$_POST["address"],$birthday,$password,$_POST["sex"],$_POST["school"],$_POST["achievement_id"],$_POST["name_father"],$_POST["name_mother"],$_POST["phone"],$_POST["email"],$_POST["username"], $_POST['user_id']);
        }

        header('location: ' . URL . 'users/index');
    }
	
	public function edit_user($user_id)
    {
        if (isset($user_id)) {
            $user = $this->users->getUser($user_id);
			$staff = $this->staffs->getStaff($_SESSION['staff_id']);
			if (isset($user->birthday)){
				$birthday = $user->birthday ;
				$birthday = explode(' ',$birthday);
				$birthday = explode('-',$birthday[0]);
				
				$user->day = $birthday[2];
				$user->month = $birthday[1];
				$user->year = $birthday[0];
				$user->birthday = $birthday[2].'-'.$birthday[1].'-'.$birthday[0];
			}else{
				$user->day = "";
				$user->month = "";
				$user->year = "";
				$user->birthday = "";
			}

			$classes = $this->classes->getAllClasses();
			$achievements = $this->achievements->getAllAchievements();
            require APP . 'view/_templates/header.php';
            require APP . 'view/users/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header('location: ' . URL . 'users/index');
        }
    }
	
	public function results_detail($user_id)
    {
        if (isset($user_id)) {
            $user = $this->users->getUser($user_id);
            $next = $this->users->nextUser($user_id);
            $prev = $this->users->prevUser($user_id);
			if (isset($user->birthday)){
				$birthday = $user->birthday ;
				$birthday = explode(' ',$birthday);
				$birthday = explode('-',$birthday[0]);
				
				$user->day = $birthday[2];
				$user->month = $birthday[1];
				$user->year = $birthday[0];
				$user->birthday = $birthday[2].'-'.$birthday[1].'-'.$birthday[0];
			}else{
				$user->day = "";
				$user->month = "";
				$user->year = "";
				$user->birthday = "";
			}
			
			$results = $this->users->getAllResults($user_id);
			$follows = $this->users->getAllFollows($user_id);

            require APP . 'view/_templates/header.php';
            require APP . 'view/users/result.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header('location: ' . URL . 'users/index');
        }
    }
	
	public function add_result($user_id)
    {	
        if (isset($_POST["submit_add_result"])) {

			$arr_result_date = explode("-",$_POST["result_date"]);
			$result_date = $arr_result_date[2].'-'.$arr_result_date[1].'-'.$arr_result_date[0];

            $this->users->addResult($result_date,$_POST["lesson"],$_POST["test15"],$_POST["test45"],$_POST["testlast"],$_POST["note"],$user_id);
        }

        header('location: ' . URL . 'users/results_detail/'.$user_id);
    }
	
	public function add_follow($user_id)
    {	
        if (isset($_POST["submit_add_follow"])) {
			$arr_follow_date = explode("-",$_POST["follow_date"]);
			$follow_date = $arr_follow_date[2].'-'.$arr_follow_date[1].'-'.$arr_follow_date[0];

            $this->users->addFollow($follow_date,$_POST["participate"],$_POST["reason"],$user_id);
        }

        header('location: ' . URL . 'users/results_detail/'.$user_id);
    }
	
	public function edit_result($result_id,$user_id)
    {
        if (isset($result_id)) {
            $result = $this->users->getResult($result_id);
			if (isset($result->result) && $result->result == 1){
				$result_date = $result->result_date ;
				$result_date = explode(' ',$result_date);
				$result_date = explode('-',$result_date[0]);
				$result->result_date = $result_date[2].'-'.$result_date[1].'-'.$result_date[0];
			}elseif(isset($result->follow) && $result->follow == 1){
				$follow_date = $result->follow_date ;
				$follow_date = explode(' ',$follow_date);
				$follow_date = explode('-',$follow_date[0]);
				$result->follow_date = $follow_date[2].'-'.$follow_date[1].'-'.$follow_date[0];
			}

            require APP . 'view/_templates/header.php';
            require APP . 'view/users/edit_result.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header('location: ' . URL . 'users/results_detail/'.$user_id);
        }
    }
	
	public function update_result($user_id)
    {
        if (isset($_POST["submit_update_result"])) {
			$result_date = explode("-",$_POST["result_date"]);
			$result_date = $result_date[2].'-'.$result_date[1].'-'.$result_date[0];
            $this->users->updateResult($result_date,$_POST["lesson"],$_POST["test15"],$_POST["test45"],$_POST["testlast"],$_POST["note"], $_POST['result_id']);
        }
		
		if (isset($_POST["submit_update_follow"])) {
			$follow_date = explode("-",$_POST["follow_date"]);
			$follow_date = $follow_date[2].'-'.$follow_date[1].'-'.$follow_date[0];
            $this->users->updateFollow($follow_date,$_POST["participate"],$_POST["reason"], $_POST['result_id']);
        }

        header('location: ' . URL . 'users/results_detail/'.$user_id);
    }
	
	public function delete_result($result_id,$user_id)
    {
        if (isset($result_id)) {
            $this->users->deleteResult($result_id);
        }

        header('location: ' . URL . 'users/results_detail/'.$user_id);
    }
	
	public function assessments_detail($user_id)
    {
        if (isset($user_id)) {
            $user = $this->users->getUser($user_id);
			if (isset($user->birthday)){
				$birthday = $user->birthday ;
				$birthday = explode(' ',$birthday);
				$birthday = explode('-',$birthday[0]);
				
				$user->day = $birthday[2];
				$user->month = $birthday[1];
				$user->year = $birthday[0];
				$user->birthday = $birthday[2].'-'.$birthday[1].'-'.$birthday[0];
			}else{
				$user->day = "";
				$user->month = "";
				$user->year = "";
				$user->birthday = "";
			}
			
			$assessments = $this->users->getAllAssessments($user_id);

            require APP . 'view/_templates/header.php';
            require APP . 'view/users/assessment.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header('location: ' . URL . 'users/index');
        }
    }
	
	public function add_assessment($user_id)
    {	
        if (isset($_POST["submit_add_assessment"])) {

			$arr_assessment_date = explode("-",$_POST["assessment_date"]);
			$assessment_date = $arr_assessment_date[2].'-'.$arr_assessment_date[1].'-'.$arr_assessment_date[0];

            $this->users->addAssessment($assessment_date,$_POST["description"],$user_id);
        }

        header('location: ' . URL . 'users/assessments_detail/'.$user_id);
    }
	
	public function edit_assessment($assessment_id,$user_id)
    {
        if (isset($assessment_id)) {
            $assessment = $this->users->getAssessment($assessment_id);
			if (isset($assessment->assessment_date)){
				$assessment_date = $assessment->assessment_date ;
				$assessment_date = explode(' ',$assessment_date);
				$assessment_date = explode('-',$assessment_date[0]);
				$assessment->assessment_date = $assessment_date[2].'-'.$assessment_date[1].'-'.$assessment_date[0];
			}

            require APP . 'view/_templates/header.php';
            require APP . 'view/users/edit_assessment.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header('location: ' . URL . 'users/assessments_detail/'.$user_id);
        }
    }
	
	public function update_assessment($user_id)
    {
		
		if (isset($_POST["submit_update_assessment"])) {
			$assessment_date = explode("-",$_POST["assessment_date"]);
			$assessment_date = $assessment_date[2].'-'.$assessment_date[1].'-'.$assessment_date[0];
            $this->users->updateAssessment($assessment_date,$_POST["description"], $_POST['assessment_id']);
        }

        header('location: ' . URL . 'users/assessments_detail/'.$user_id);
    }
	
	public function delete_assessment($assessment_id,$user_id)
    {
        if (isset($assessment_id)) {
            $this->users->deleteAssessment($assessment_id);
        }

        header('location: ' . URL . 'users/assessments_detail/'.$user_id);
    }

}
