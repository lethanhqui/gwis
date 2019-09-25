<div class="container">

<?php if(isset($staff) && ($staff->type == 'admin' ||$staff->type == 'manager')):?>
    <!-- add user form -->
    <div class="box">
        <h3 id="action_click">Thêm Học Sinh</h3>
        <form id="show_hide_form" action="<?php echo URL; ?>users/add_user" method="POST">
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
			
			<!--
			<div class="row">
				<label class="title">Ngày Sinh:</label>
				<input type="text" maxlength="2" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="day" placeholder="dd" size="4" value="" required /> -
				<input type="text" maxlength="2" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="month" placeholder="mm" size="4" value="" required /> - 
				<input type="text" maxlength="4" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="year" placeholder="yyyy" size="8" value="" required />
			</div>
			-->
				
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
				<label class="title">Lớp:</label>
				<select class="select" name="class_id" required>	
					<option code="" value="">Chọn Lớp</option>
					<?php foreach ($classes as $class) { ?>
						<option code="<?php echo $class->class_code; ?>" value="<?php echo $class->class_id; ?>"><?php echo $class->name; ?></option>
					<?php } ?>
				</select>
			</div>
			
			<div class="row">
				<label class="title">Mã Học Sinh:</label>
				<span id="class_code"></span>
				<input type="hidden" id="post_class_code" name="class_code" value="" />
				<input type="text" size="4" id="code-username" name="username" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="" required />
				
			</div>
			
			<div style="display:none;" id="show_code_username" class="row">
				<label class="title"></label>
				<span style="color:red;" id="username_availability_result"></span>
			</div>
			
			<div class="row">
				<label class="title">Trường:</label>
				<input type="text" name="school" value="" required />
			</div>
			
			<div class="row">
				<label class="title">Miễn Giảm:</label>
				<select class="select" name="achievement_id">			
					<?php foreach ($achievements as $achievement) { ?>
						<option value="<?php echo $achievement->achievement_id; ?>" <?php if ($achievement->achievement_id == 3): ?>selected<?php endif;?>><?php echo $achievement->name; ?></option>
					<?php } ?>
				</select>
			</div>		
		</div>	
		
		<div class="col-md-6 col-sm-6 col-xs-12">
		
			<div class="row">
				<label class="title">Tên Cha:</label>
				<input type="text" name="name_father" value="" />
			</div>
			
			<div class="row">
				<label class="title">Tên Mẹ:</label>
				<input type="text" name="name_mother" value="" />
			</div>
			
			<div class="row">
				<label class="title">Địa Chỉ:</label>
				<input type="text" name="address" value="" />
			</div>
					
			<!--
			<div class="row">
				<label>Type:</label>
				<select name="type">
					<option value="hs">Student</option>
					<option value="ph">Parent</option>
				</select>
			</div>
			-->
			
			
			
			<div class="row">
				<label class="title">Điện Thoại:</label>
				<input type="text" name="phone" value="" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
			</div>
			
			<div class="row">
				<label class="title">Email:</label>
				<input type="text" name="email" value="" />
			</div>
		</div>	
		
		<div class="col-md-12 col-sm-12 col-xs-12">		
			<div class="row">
				<label class="title"></label>
				<input type="submit" name="submit_add_user" value="Thêm" />
			</div>
		</div>
        </form>
    </div>
	
<?php endif;?>
	
    <!-- main content output -->
    <div class="box">
        

        <h3>Danh Sách Học Sinh</h3>
        <table>
            <thead>
            <tr>
                <td>ID</td>
                <td>Họ Tên</td>
                <td>Lớp</td>
                <td>Trường</td>
                <td>Thành Tích</td>
                <td>Ngày Sinh</td>
                <td>Giới Tính</td>
				<?php if(isset($staff) && $staff->type == 'admin') :?>
				<td>EDIT</td>
				<td>DELETE</td>
				<?php elseif(isset($staff) && ($staff->type == 'manager'||$staff->type == 'user')) :?>
                <td>EDIT</td>
				<?php endif; ?>	
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php if (isset($user->username)) echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($user->name)) echo htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($user->class_name)) echo htmlspecialchars($user->class_name, ENT_QUOTES, 'UTF-8'); ?></td>   
                    <td><?php if (isset($user->school)) echo htmlspecialchars($user->school, ENT_QUOTES, 'UTF-8'); ?></td>
					<td><?php if (isset($user->achievement_name)) echo htmlspecialchars($user->achievement_name, ENT_QUOTES, 'UTF-8'); ?></td>  
                    <td><?php 
						if (isset($user->birthday)){ 
							$birthday = explode(" ",$user->birthday);
							$birthday = explode("-",$birthday[0]);
							echo $birthday[2].'-'.$birthday[1].'-'.$birthday[0];
						}
					?></td>
                    <td><?php 
						if (isset($user->sex)) 
							if($user->sex == 1)
								echo 'Nam'; 
							else
								echo 'Nữ';
					?></td>
					
					<?php if(isset($staff) && $staff->type == 'admin') :?>
					<td><a class="blue" href="<?php echo URL . 'users/edit_user/' . htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>">Chỉnh Sửa</a></td>
                    <td><a class="red" href="<?php echo URL . 'users/delete_user/' . htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>" onclick="return confirm('Bạn có chắc chắn xóa?');">Xóa</a></td>
					<?php elseif(isset($staff) && ($staff->type == 'manager' ||$staff->type == 'user')) :?>
					<td><a class="blue" href="<?php echo URL . 'users/edit_user/' . htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>">Chỉnh Sửa</a></td>
					<?php endif; ?>
                    
                </tr>
            <?php } ?>
            </tbody>
        </table>
	<input type="hidden" id="url" value="<?php echo URL; ?>">
    </div>
	 <div class="box">	
		<h3>Tổng Học Sinh</h3>
        <div>
            <?php echo $count_users; ?>
        </div>
       </div>
</div>

 <script type="text/javascript">
 
	var URL = $('#url').val();
	
 function check_availability(){  
  
        //get the username
		var	code = $('#post_class_code').val();	
		var	usID = $('#code-username').val();	
        var username = code + usID;  

        //use ajax to run the check  
        $.post(URL + "users/check_user", { username: username },  
            function(result){  
                //if the result is 1  
                if(result == 1){   
					//show that the username is available  
                    $('#username_availability_result').html(username + ' đã tồn tại');	
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
		
	$('[name="class_id"].select').on('change', function() {
	  //alert( this.value );
	  var code = $('option:selected', this).attr('code');
	  console.log(code);
	  $('#class_code').text(code);
	  $('#post_class_code').val(code);
	});
  
    $( "#birthday" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: '1990:2020',
	  dateFormat: 'dd-mm-yy'
	/*   onClose: function(dateText, inst) { 
			date = $("#birthday").datepicker("getDate");
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, date.getDate()));
        } */
    });
  } );
  </script>
