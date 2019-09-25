<div class="container">
<?php if(isset($staff_obj) && $staff_obj->type == 'admin') :?>
    <!-- add staff form -->
    <div class="box">
        <h3 id="action_click">Thêm CBNV</h3>
        <form id="show_hide_form" action="<?php echo URL; ?>staffs/add_staff" method="POST">
		<div class="col-md-6 col-sm-6 col-xs-12">
			
			<?php if(isset($mesage_error)) :?>
			<div class="row">
				<p style="color:red;"> <?php echo htmlspecialchars($mesage_error, ENT_QUOTES, 'UTF-8'); ?></p>
			</div>
			<?php endif;?>
			
			<div class="row">
				<label class="title">Họ tên:</label>
				<input type="text" name="name" value="" required />
			</div>
							
			<div class="row">
				<label class="title">Ngày Sinh:</label>
				<input type="text" id="birthday" name="birthday" size="10" value="" required />
			</div>
			
			<div class="row">
				<label class="title">Giới Tính:</label>
				<input type="radio" id="male" name="sex" value="1" checked /><label for="male"><span></span>Nam</label>
				<input type="radio" id="female" name="sex" value="0" /><label for="female"><span></span>Nữ</label>
			</div>
			
			<div class="row">
				<label class="title">Địa Chỉ:</label>
				<input type="text" name="address" value="" />
			</div>
			
			<div class="row">
				<label class="title">Điện Thoại:</label>
				<input type="text" name="phone" value="" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
			</div>
			
			<div class="row">
				<label class="title">Email:</label>
				<input type="text" name="email" value="" />
			</div>	
		</div>	
		
		<div class="col-md-6 col-sm-6 col-xs-12">
		
			<div class="row">
				<label class="title">Username:</label>
				<input type="text" name="username" id="code-username" value="" required/>
			</div>
			
			<div style="display:none;" id="show_code_username" class="row">
				<label class="title"></label>
				<span style="color:red;" id="username_availability_result"></span>
			</div>
			
			<div class="row">
				<label class="title">Password:</label>
				<input type="password" name="password" value="" required/>
			</div>
			
			<div class="row">
				<label class="title">Loại:</label>
				<select style="width: 190px;" class="select" name="type">
					<option value="admin">Admin</option>
					<option value="manager">Manager</option>
					<option value="user">Staff</option>
				</select>
			</div>	
			

		</div>	
		
		<div class="col-md-12 col-sm-12 col-xs-12">		
			<div class="row">
				<label class="title"></label>
				<input type="submit" name="submit_add_staff" value="Thêm" />
			</div>
		</div>
        </form>
    </div>
<?php endif; ?>	
    <!-- main content output -->
    <div class="box">
        

        <h3>Danh Sách CBNV</h3>
        <table>
            <thead>
            <tr>
                <td>STT</td>
                <td>Họ Tên</td>
                <td>Địa Chỉ</td>
                <td>Điện Thoại</td>
                <td>Email</td>
                <td>Ngày Sinh</td>
                <td>Giới Tính</td>
                <td>Loại</td>
				<?php if(isset($staff_obj) && $staff_obj->type == 'admin') :?>
				<td>EDIT</td>
                <td>DELETE</td> 
				<?php elseif(isset($staff_obj) && $staff_obj->type == 'manager') :?>
                <td>EDIT</td>
				<?php endif; ?>		
            </tr>
            </thead>
            <tbody>
			<?php $count = 0;?>
            <?php foreach ($staffs as $staff) { ?>
                <tr>
                    <td><?php if (isset($staff->staff_id)) echo $count += 1; ?></td>
                    <td><?php if (isset($staff->name)) echo htmlspecialchars($staff->name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($staff->address)) echo htmlspecialchars($staff->address, ENT_QUOTES, 'UTF-8'); ?></td>   
                    <td><?php if (isset($staff->phone)) echo htmlspecialchars($staff->phone, ENT_QUOTES, 'UTF-8'); ?></td>
					<td><?php if (isset($staff->email)) echo htmlspecialchars($staff->email, ENT_QUOTES, 'UTF-8'); ?></td>  
                    <td><?php 
						if (isset($staff->birthday)){ 
							$birthday = explode(" ",$staff->birthday);
							$birthday = explode("-",$birthday[0]);
							echo $birthday[2].'-'.$birthday[1].'-'.$birthday[0];
						}
					?></td>
                    <td><?php 
						if (isset($staff->sex)) 
							if($staff->sex == 1)
								echo 'Nam'; 
							else
								echo 'Nữ';
					?></td>
					<td><?php 
						if (isset($staff->type)) 
							if($staff->type == 'admin')
								echo 'Admin';
							elseif($staff->type == 'manager')
								echo 'Manager'; 		
							else
								echo 'User';
					?></td>
					<?php if(isset($staff_obj) && $staff_obj->type == 'admin') :?>
					<td><a class="blue" href="<?php echo URL . 'staffs/edit_staff/' . htmlspecialchars($staff->staff_id, ENT_QUOTES, 'UTF-8'); ?>">Chỉnh Sửa</a></td>
                    <td><a class="red" href="<?php echo URL . 'staffs/delete_staff/' . htmlspecialchars($staff->staff_id, ENT_QUOTES, 'UTF-8'); ?>" onclick="return confirm('Bạn có chắc chắn xóa?');">Xóa</a></td>
                    <?php elseif(isset($staff_obj) && $staff_obj->type == 'manager') :?>
					<td><a class="blue" href="<?php echo URL . 'staffs/edit_staff/' . htmlspecialchars($staff->staff_id, ENT_QUOTES, 'UTF-8'); ?>">Chỉnh Sửa</a></td>
					<?php endif; ?>	
                </tr>
            <?php } ?>
            </tbody>
        </table>
	<input type="hidden" id="url" value="<?php echo URL; ?>">
    </div>
	 <div class="box">	
		<h3>Tổng CBNV</h3>
        <div>
            <?php echo $count_staffs; ?>
        </div>
       </div>
</div>

 <script type="text/javascript">
 
 var URL = $('#url').val();
	
 function check_availability(){  
  
        //get the username
        var username = $('#code-username').val();;  

        //use ajax to run the check  
        $.post(URL + "staffs/check_staff", { username: username },  
            function(result){  
                //if the result is 1  
                if(result == 1){   
					//show that the username is available  
                    $('#username_availability_result').html("'" + username + "' đã tồn tại");		
					$('#show_code_username').css('display','block');												
					$('#code-username').css('border','1px solid red');
					$('#code-username').focus();					
                }else{  
					//show that the username is NOT available  
					$('#show_code_username').css('display','none');
                    $('#username_availability_result').html('');  
					$('#code-username').css('border','1px solid #0bc179');				
                }  
        });  
  
}  

  $(document).ready(function(){
	
	$("#action_click").click(function(){
		$("#show_hide_form").toggle();
	});

  
  $('#code-username').on('change', function() { 
            check_availability();          
      });  
	  
    $( "#birthday" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: '1960:2000',
	  dateFormat: 'dd-mm-yy'
	 /*  onClose: function(dateText, inst) { 
			date = $("#birthday").datepicker("getDate");
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, date.getDate()));
        } */
    });
  } );
  </script>
