<?php


Class Login extends Controller
{

    public function index()
    {
		 if (isset($_POST["submit_check_user"])) {
            if($this->login->login($_POST["username"], $_POST["password"])){
				header('location: ' . URL . 'home/index');
				exit;
			}else{
				$error = 'Tài khoản hoặc mật khẩu không chính xác.';
			}
        }
		
        require APP . 'view/_templates/header.php';
        require APP . 'view/login/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function check_user()
    {

        if (isset($_POST["submit_check_user"])) {
            if($this->login->login($_POST["username"], $_POST["password"])){
				header('location: ' . URL . 'home/index');
				exit;
			}else{
				$error = 'Tài khoản hoặc mật khẩu không chính xác.';
				 header('location: ' . URL . 'login/index');
			}
        }

    }
	
	public function logout()
    {

         $this->login->logout();

        header('location: ' . URL . 'home/index');
    }

}
