<div class="container">
<?php if(isset($staff) && ($staff->type == 'admin'||$staff->type == 'manager')) :?>
    <!-- add user form -->
    <div>
        <h3>Chỉnh Sửa Học Sinh</h3>
        <form action="<?php echo URL; ?>users/update_user" method="POST">
		<div class="col-md-6 col-sm-6 col-xs-12">
		
			<div style="display:none;" class="row">
				<label class="title">Mã Học Sinh</label>
				<input autofocus type="text" name="username" value="<?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?>" required />
			</div>
			
			<div class="row">
				<label class="title">Họ Tên</label>
				<input autofocus type="text" name="name" value="<?php echo htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8'); ?>" required />
			</div>
			
			<!--
			<div class="row">
				<label class="title">Ngày Sinh:</label>
				<input type="text" maxlength="2" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="day" placeholder="dd" size="4" value="<?php echo htmlspecialchars($user->day, ENT_QUOTES, 'UTF-8'); ?>" required /> -
				<input type="text" maxlength="2" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="month" placeholder="mm" size="4" value="<?php echo htmlspecialchars($user->month, ENT_QUOTES, 'UTF-8'); ?>" required /> - 
				<input type="text" maxlength="4" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="year" placeholder="yyyy" size="8" value="<?php echo htmlspecialchars($user->year, ENT_QUOTES, 'UTF-8'); ?>" required />
			</div>
			-->
			
			<div class="row">
				<label class="title">Ngày Sinh:</label>
				<input type="text" id="birthday" name="birthday" size="10" value="<?php echo htmlspecialchars($user->birthday, ENT_QUOTES, 'UTF-8'); ?>" required />
			</div>
			
			<div class="row">
				<label class="title">Giới Tính</label>
				<input type="radio" id="male" name="sex" value="1" <?php if($user->sex == '1'):?>checked<?php endif;?> /><label for="male"><span></span>Nam</label>
				<input type="radio" id="female" name="sex" value="0" <?php if($user->sex == '0'):?>checked<?php endif;?> /><label for="female"><span></span>Nữ</label>
			</div>
			
			<div class="row">
				<label class="title">Lớp:</label>
				<select class="select" name="class_id" required>			
					<?php foreach ($classes as $class) { ?>
						<option value="<?php echo $class->class_id; ?>" <?php if ($user->class_id == $class->class_id): ?>selected<?php endif;?>>
						<?php echo $class->name; ?></option>
					<?php } ?>
				</select>
			</div>
			
			<div class="row">
				<label class="title">Trường:</label>
				<input type="text" name="school" value="<?php echo htmlspecialchars($user->school, ENT_QUOTES, 'UTF-8'); ?>" required />
			</div>
			
			<div class="row">
				<label class="title">Thành Tích:</label>
				<select class="select" name="achievement_id">			
					<?php foreach ($achievements as $achievement) { ?>
						<option value="<?php echo $achievement->achievement_id; ?>" <?php if ($user->achievement_id == $achievement->achievement_id): ?>selected<?php endif;?>>
						<?php echo $achievement->name; ?></option>
					<?php } ?>
				</select>
			</div>
			
			
			
			
		</div>	
			<!--
			<div class="row">
				<label>Type</label>
				<select name="type">
					<option value="hs" <?php if($user->type == 'hs'):?>selected<?php endif;?>>Student</option>
					<option value="ph" <?php if($user->type == 'ph'):?>selected<?php endif;?>>Parent</option>
				</select>
			</div>
			-->
		<div class="col-md-6 col-sm-6 col-xs-12">	
			<div class="row">
				<label class="title">Tên Cha:</label>
				<input type="text" name="name_father" value="<?php echo htmlspecialchars($user->name_father, ENT_QUOTES, 'UTF-8'); ?>" />
			</div>
			
			<div class="row">
				<label class="title">Tên Mẹ:</label>
				<input type="text" name="name_mother" value="<?php echo htmlspecialchars($user->name_mother, ENT_QUOTES, 'UTF-8'); ?>" />
			</div>
			
			<div class="row">
				<label class="title">Địa Chỉ:</label>
				<input type="text" name="address" value="<?php echo htmlspecialchars($user->address, ENT_QUOTES, 'UTF-8'); ?>" />
			</div>
			
			<div class="row">
				<label class="title">Điện Thoại:</label>
				<input type="text" name="phone" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php echo htmlspecialchars($user->phone, ENT_QUOTES, 'UTF-8'); ?>" />
			</div>
			
			<div class="row">
				<label class="title">Email:</label>
				<input type="text" name="email" value="<?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?>" />
			</div>
			<?php if(isset($staff) && $staff->type == 'admin') :?>
			<div class="row">
				<label class="title">Đặt lại mật khẩu</label>
				<input type="radio" id="reset" name="password_reset" value="1" /><label for="reset"><span></span>Có</label>
				<input type="radio" id="no_reset" name="password_reset" value="0" checked /><label for="no_reset"><span></span>Không</label>
			</div>
			<div class="row">
				<label class="title">Mật Khẩu:</label>
				<input type="password" id="pass" name="pass" value="<?php echo htmlspecialchars($user->password, ENT_QUOTES, 'UTF-8'); ?>" disabled />
				<input type="hidden" id="pass_defaut" name="pass_defaut" value="<?php echo htmlspecialchars($user->password, ENT_QUOTES, 'UTF-8'); ?>" />
			</div>
			<?php endif;?>
		</div>	
		
		<div class="col-md-12 col-sm-12 col-xs-12">	
			<div class="row">
				<label class="title"></label>
				<input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>" />
				<input type="submit" name="submit_update_user" value="Chỉnh Sửa" />
			</div>
		</div>
        </form>
    </div>
	<?php endif;?>
	<div class="box">
		<a class="blue" href="<?php echo URL . 'users/results_detail/' . htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>">
			<h3>Kết Quả Học Tập</h3>
		</a>
	</div>
		
	<div class="box">
		<a class="blue" href="<?php echo URL . 'users/assessments_detail/' . htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>">
			<h3>Đánh Giá Của Giáo Viên</h3>
		</a>
	</div>	
</div>

 <script type="text/javascript">
  $(document).ready(function(){
    $( "#birthday" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: '1990:2020',
	  dateFormat: 'dd-mm-yy',
	  onClose: function(dateText, inst) { 
			date = $("#birthday").datepicker("getDate");
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, date.getDate()));
        }
    });
	$("input:radio[name=password_reset]").change(function() {

		if (this.value == '1') {
           $('#pass').attr('type', 'text');
		   $('#pass').prop('disabled', false);
        }
        else if (this.value == '0') {
            $('#pass').attr('type', 'password');
			$('#pass').prop('disabled', true);
			var pass_defaut = $('#pass_defaut').val();
			$('#pass').val(pass_defaut);
        }
	});
  } );
  </script>

