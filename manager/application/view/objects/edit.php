<div class="container">
    <!-- add object form -->
    <div class="box">
        <h3>Chỉnh Sửa Mục Tiêu</h3>
        <form action="<?php echo URL; ?>objects/update_object" method="POST">
		
			<div class="row">
				<label class="title">Lớp</label>
				<select class="select" name="class_id" required>			
					<?php foreach ($classes as $class) { ?>
						<option value="<?php echo $class->class_id; ?>" <?php if ($object->class_id == $class->class_id): ?>selected<?php endif;?>>
						<?php echo $class->name; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="row">
				<label class="title">Tuần</label>
				<input type="text" name="week" value="<?php echo htmlspecialchars($object->week, ENT_QUOTES, 'UTF-8'); ?>" required />
			</div>
			<div class="row">
				<label class="title">Ngày</label>
				<input type="text" id="deadline" name="deadline" size="10" value="<?php echo htmlspecialchars($object->deadline, ENT_QUOTES, 'UTF-8'); ?>" required />
			</div>
			<div class="row">
				<label class="title">Nội Dung</label>
				<textarea type="text" style="width: 283px; height: 143px; max-height: 500px;" type="text" height="200px" name="description" required >
				<?php echo htmlspecialchars($object->description, ENT_QUOTES, 'UTF-8'); ?>
				</textarea>
			</div>
			<div class="row">
				<label class="title"></label>
				<input type="hidden" name="object_id" value="<?php echo htmlspecialchars($object->object_id, ENT_QUOTES, 'UTF-8'); ?>" />
				<input type="submit" name="submit_update_object" value="Chỉnh Sửa" />
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

