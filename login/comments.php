
<?php 
$user = $user->getUser($_SESSION['user_id']);

if(isset($_POST['submit'])){
	try {

		$sql='INSERT INTO gwis_comments (user_id,name_parent,subject,description) 
		VALUES (:user_id, :name_parent, :subject, :description)';
		//insert into database with a prepared statement
		$stmt = $db->prepare($sql);
		$stmt->execute(array(
			':user_id' => $_SESSION['user_id'],
			':name_parent' => $_POST['name_parent'],
			':subject' => $_POST['subject'],
			':description' => $_POST['description']
		));
		
		$comment_id = $db->lastInsertId('comment_id');

		//send email
		$from = $user['email'];
		$to = SITEEMAIL;
		$subject = $_POST['subject'];
		$body = $_POST['description']."\nComment ID: ".$comment_id;

		$mail = new Mail();
		$mail->setFrom($from);
		$mail->addAddress($to);
		$mail->subject($subject);
		$mail->body($body);
		$mail->send();

		//redirect to index page
		header('Location: main.php');
		exit;

	//else catch the exception and show the error.
	} catch(PDOException $e) {
		$error[] = $e->getMessage();
	}
}	
?>

<div class="wrap-content">
	<div class="main-content">
		<div class="col-md-5 col-sm-6 col-xs-12">
			<h2><?php echo htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8'); ?></h2>
			<h4>ID: <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></h4>
		</div>
		
		<div class="col-md-7 col-sm-6 col-xs-12">
			<div class="comment">
				<form role="form" method="post" action="" autocomplete="off">
				<div class="row">
				<select class="select" name="name_parent">
					<option value="">TÊN PHỤ HUYNH</option>
					<option value="<?php echo htmlspecialchars($user['name_father'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($user['name_father'], ENT_QUOTES, 'UTF-8'); ?></option>
					<option value="<?php echo htmlspecialchars($user['name_mother'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($user['name_mother'], ENT_QUOTES, 'UTF-8'); ?></option>
				</select>
				</div>
				
				<div class="row">
				<select class="select" name="subject" required>
					<option value="Nội Dung Chương Trình">Ý KIẾN VỀ</option>
					<option value="Nội Dung Chương Trình">Nội Dung Chương Trình</option>
					<option value="Phương Pháp Giảng Dạy">Phương Pháp Giảng Dạy</option>
					<option value="Thái Độ Giáo Viên">Thái Độ Giáo Viên</option>
					<option value="Khác">Khác</option>
				</select>
				</div>
				
				<div class="row">
				<textarea placeholder="NỘI DUNG" rows="8" name="description" class="box-new" required>				
				</textarea>
				</div>
				<div class="row">
					<input type="submit" name="submit" value="Gửi" class="btn btn-primary btn-block btn-lg" tabindex="5">
				</div>
				</form>
			</div>
	
		</div>
	</div>
</div>


 <script type="text/javascript">
  $(document).ready(function(){
	
	$('.comment .box-new').text('');
  
  } );
  </script>