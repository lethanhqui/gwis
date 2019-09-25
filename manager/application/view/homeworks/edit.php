<div class="container">
    <!-- add homework form -->
    <div class="box">
        <h3>Chỉnh Sửa Bài Tập</h3>
        <form action="<?php echo URL; ?>homeworks/update_homework" method="POST">
		
			<div class="row">
				<label class="title">Lớp</label>
				<select class="select" name="class_id" required>			
					<?php foreach ($classes as $class) { ?>
						<option value="<?php echo $class->class_id; ?>" <?php if ($homework->class_id == $class->class_id): ?>selected<?php endif;?>>
						<?php echo $class->name; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="row">
				<label class="title">Ngày</label>
				<input type="text" id="deadline" name="deadline" size="10" value="<?php echo htmlspecialchars($homework->deadline, ENT_QUOTES, 'UTF-8'); ?>" required />
			</div>
			<div class="row">
				<label class="title">Nội Dung</label>
				<textarea type="text" style="width: 283px; height: 143px; max-height: 500px;" type="text" height="200px" name="description" required >
				<?php echo htmlspecialchars($homework->description, ENT_QUOTES, 'UTF-8'); ?>
				</textarea>
			</div>
			<div class="row">
				<label class="title"></label>
				<input type="hidden" name="homework_id" value="<?php echo htmlspecialchars($homework->homework_id, ENT_QUOTES, 'UTF-8'); ?>" />
				<input type="submit" name="submit_update_homework" value="Chỉnh Sửa" />
			</div>
		
        </form>
    </div>
</div>
 <script type="text/javascript">
  $(document).ready(function(){
    $( "#deadline" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: '1990:2020',
	  dateFormat: 'dd-mm-yy',
	  onClose: function(dateText, inst) { 
			date = $("#deadline").datepicker("getDate");
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, date.getDate()));
        }
    });
  } );
  </script>

