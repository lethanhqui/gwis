<div class="container">
    <!-- add homework form -->
    <div class="box">
        <h3 id="action_click">Thêm Bài Tập</h3>
        <form id="show_hide_form" action="<?php echo URL; ?>homeworks/add_homework" method="POST">
		
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
				<label class="title">Ngày</label>
				<input type="text" id="deadline" name="deadline" size="10" value="" required />
			</div>
			<div class="row">
				<label class="title">Nội Dung</label>
				<textarea name="description" value="" required="" style="width: 283px; height: 143px; max-height: 500px;" type="text" height="200px"></textarea>
			</div>
			<div class="row">
				<label class="title"></label>
				<input type="submit" name="submit_add_homework" value="Thêm" />
			</div>
		
        </form>
    </div>
<div class="box">
        <h3>Danh Sách Bài Tập</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>ID</td>
                <td>Lớp</td>
				<td>Ngày</td>
                <td>Nội dung</td>
				<td>EDIT</td>
                <td>DELETE</td> 
	
            </tr>
            </thead>
            <tbody>
			<?php $count = 0;?>
            <?php foreach ($homeworks as $homework) { ?>
                <tr>
                    <td><?php echo $count += 1; ?></td>
					<td><?php if (isset($homework->class_name)) echo htmlspecialchars($homework->class_name, ENT_QUOTES, 'UTF-8'); ?></td>
					
                    <td><?php 
						if (isset($homework->deadline)){ 
							$deadline = explode(" ",$homework->deadline);
							$deadline = explode("-",$deadline[0]);
							echo $deadline[2].'-'.$deadline[1].'-'.$deadline[0];
						}
					?></td>
					<td><?php if (isset($homework->description)) echo htmlspecialchars($homework->description, ENT_QUOTES, 'UTF-8'); ?></td>
					<td><a class="blue" href="<?php echo URL . 'homeworks/edit_homework/' . htmlspecialchars($homework->homework_id, ENT_QUOTES, 'UTF-8'); ?>">Chỉnh Sửa</a></td>
                    <td><a class="red" href="<?php echo URL . 'homeworks/delete_homework/' . htmlspecialchars($homework->homework_id, ENT_QUOTES, 'UTF-8'); ?>" onclick="return confirm('Bạn có chắc chắn xóa?');">Xóa</a></td>
				
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

 <script type="text/javascript">
 
	var URL = $('#url').val();
$(document).ready(function(){

$("#action_click").click(function(){
		$("#show_hide_form").toggle();
	});
		
	$('[name="class_id"].select').on('change', function() {
	  //alert( this.value );
	  var code = $('option:selected', this).attr('code');
	  console.log(code);
	  $('#class_code').text(code);
	  $('#post_class_code').val(code);
	});
  
    $( "#deadline" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: '1990:2020',
	  dateFormat: 'dd-mm-yy'
	  /* onClose: function(dateText, inst) { 
			date = $("#deadline").datepicker("getDate");
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, date.getDate()));
        } */
    });
  } );
  </script>