<?php
//include config
require_once('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//process login form if submitted
if(isset($_POST['submit'])){

	$old_password = $_POST['old-password'];
	$new_password = $_POST['new-password'];
	$confirm_password = $_POST['confirm-password'];
	
	if($user->check_password($old_password,$_SESSION['user_id'])){
		if($new_password == $confirm_password)
		{	
			if($user->change_password($new_password,$_SESSION['user_id'])){ 
				$success = 'Đổi mật khẩu thành công.';		
			} else {
				$error[] = 'Không thể thay đổi mật khẩu. Vui lòng thử lại.';
			}
		}else{
			$error[] = 'Mật khẩu mới và xác nhận mật khẩu không trùng hợp.';
		}	
	}else{
		$error[] = 'Mật khẩu cũ không chính xác.';
	}
	

}//end if submit

//define page title
$title = 'GWIS - Change Password';

//include header template
require('layout/header.php'); 
?>

	
<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Đổi Mật Khẩu</h2>
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}
				
				if(isset($success)){
						echo '<p style="color:green;">'.$success.'</p>';
				}

				if(isset($_GET['action'])){

					//check the action
					switch ($_GET['action']) {
						case 'active':
							echo "<h2 class='bg-success'>Your account is now active you may now log in.</h2>";
							break;
						case 'reset':
							echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
							break;
						case 'resetAccount':
							echo "<h2 class='bg-success'>Password changed, you may now login.</h2>";
							break;
					}

				}

				
				?>
				
			
				<div class="form-group">
					<input type="password" name="old-password" id="old-password" class="form-control input-lg" placeholder="Mật khẩu cũ" value="" tabindex="1" required>
				</div>

				<div class="form-group">
					<input type="password" name="new-password" id="new-password" class="form-control input-lg" placeholder="Mật khẩu mới" tabindex="3" required>
				</div>
				
				<div class="form-group">
					<input type="password" name="confirm-password" id="confirm-password" class="form-control input-lg" placeholder="Xác nhận mật khẩu" tabindex="3" required>
				</div>
				
				<hr>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Đổi Mật Khẩu" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
				
				<a style="font-size: 18px;text-decoration: underline;margin-left: 15px;"href="main.php">Quay lại</a>
				
				
			</form>
		</div>
	</div>



</div>


<?php 
//include header template
require('layout/footer.php'); 
?>
