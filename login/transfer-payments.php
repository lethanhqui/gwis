<?php require('includes/config.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//define page title
$title = 'GWIS - Main Page';
$total='total';
$student_name='student_name';
$class_name='class_name';

//include header template
require('layout/header.php'); 
?>


	<div class="container">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<h2 class="title">Thông Tin:</h2>
			<p>	
			<?php
				echo 'Tổng số tiền tạm tính được là: <b>' . htmlspecialchars($_GET["total"]) . 'đ. </b>';
			?>
			</p>
			<p>Phụ huynh có thể chuyển tiền vào tài khoản dưới đây:</p>
			<p>Tài khoản Vietcombank : <b>0051000517979 </b></p>
			<p>Chủ TK : <b>Nguyễn Thị Mai</b></p>
			<p>Nội dung đóng tiền: <b>Học phí tháng 1</b></p>
			<p>
				<?php echo 'Tên học sinh : <b>' . htmlspecialchars($_GET["student_name"]) . '</b>'; ?>
			</p>
			<p>
				<?php echo 'Lớp : <b>' . htmlspecialchars($_GET["class_name"]) . '</b>'; ?>
			</p>

<a style="font-size: 18px;text-decoration: underline;"href="main.php">Quay lại</a>			
			
	</div>
	</div>


  
<?php 
//include header template
require('layout/footer.php'); 
?>
