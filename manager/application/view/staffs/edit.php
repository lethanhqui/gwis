<div class="container">

    <!-- add staff form -->
    <div class="box">
        <h3>Chỉnh Sửa CBNV</h3>
        <form action="<?php echo URL; ?>staffs/update_staff" method="POST">
		<div class="col-md-6 col-sm-6 col-xs-12">
					
			<div class="row">
				<label class="title">Họ tên:</label>
				<input type="text" name="name" value="<?php echo htmlspecialchars($staff->name, ENT_QUOTES, 'UTF-8'); ?>" required />
			</div>
							
			<div class="row">
				<label class="title">Ngày Sinh:</label>
				<input type="text" id="birthday" name="birthday" size="10" value="<?php echo htmlspecialchars($staff->birthday, ENT_QUOTES, 'UTF-8'); ?>" required />
			</div>
			
			<div class="row">
				<label class="title">Giới Tính:</label>
				<input type="radio" id="male" name="sex" value="1" <?php if($staff->sex == '1'):?>checked<?php endif;?> /><label for="male"><span></span>Nam</label>
				<input type="radio" id="female" name="sex" value="0" <?php if($staff->sex == '0'):?>checked<?php endif;?>/><label for="female"><span></span>Nữ</label>
			</div>
			
			<div class="row">
				<label class="title">Địa Chỉ:</label>
				<input type="text" name="address" value="<?php echo htmlspecialchars($staff->address, ENT_QUOTES, 'UTF-8'); ?>" />
			</div>
			
			<div class="row">
				<label class="title">Điện Thoại:</label>
				<input type="text" name="phone" value="<?php echo htmlspecialchars($staff->phone, ENT_QUOTES, 'UTF-8'); ?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
			</div>
			
			<div class="row">
				<label class="title">Email:</label>
				<input type="text" name="email" value="<?php echo htmlspecialchars($staff->email, ENT_QUOTES, 'UTF-8'); ?>" />
			</div>	
		</div>	
		
		<div class="col-md-6 col-sm-6 col-xs-12">
		
			<div class="row">
				<label class="title">Username:</label>
				<input type="text" name="username" value="<?php echo htmlspecialchars($staff->username, ENT_QUOTES, 'UTF-8'); ?>" required disabled/>
			</div>
			
			<div class="row">
				<label class="title">Password:</label>
				<input type="text" name="password" value="<?php echo htmlspecialchars($staff->password, ENT_QUOTES, 'UTF-8'); ?>" required/>
			</div>
			
			<div class="row">
				<label class="title">Type:</label>
				<select style="width: 190px;" class="select" name="type">
					<option value="admin" <?php if($staff->type == 'admin'):?>selected<?php endif;?>>Admin</option>
					<option value="manager" <?php if($staff->type == 'manager'):?>selected<?php endif;?>>Manager</option>
					<option value="staff" <?php if($staff->type == 'staff'):?>selected<?php endif;?>>User</option>
				</select>
			</div>	
			

		</div>	
		
		<div class="col-md-12 col-sm-12 col-xs-12">		
			<div class="row">
				<label class="title"></label>
				<input type="hidden" name="staff_id" value="<?php echo htmlspecialchars($staff->staff_id, ENT_QUOTES, 'UTF-8'); ?>" />
				<input type="submit" name="submit_update_staff" value="Chỉnh Sửa" />
			</div>
		</div>
        </form>
    </div>
</div>

 <script type="text/javascript">
  $(document).ready(function(){
    $( "#birthday" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: '1960:2000',
	  dateFormat: 'dd-mm-yy',
	  onClose: function(dateText, inst) { 
			date = $("#birthday").datepicker("getDate");
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, date.getDate()));
        }
    });
  } );
  </script>

