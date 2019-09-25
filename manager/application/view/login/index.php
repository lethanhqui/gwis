<div class="container">
	<!-- add login form -->
    <div class="box">
        <h3>Đăng Nhập</h3>
		<p style="color:red;"><?php if(isset($error)) echo $error; ?></p>
        <form action="<?php echo URL; ?>login/" method="POST">
			<div class="row">
				<label class="title">Username</label>
				<input type="text" name="username" value="" required />
			</div>
			<div class="row">
				<label class="title">Password</label>
				<input type="password" name="password" value="" required />
			</div>
			<div class="row">
				<label class="title"></label>
				<input type="submit" name="submit_check_user" value="Login" />
			</div>
        </form>
    </div>
   
</div>
