<div class="container">

    <!-- add user form -->
    <div class="box">
        
		<h3 style="margin-bottom: 30px;">Học Sinh: <?php if (isset($assessment->user_name)) echo htmlspecialchars($assessment->user_name, ENT_QUOTES, 'UTF-8'); ?></h3>	
		
		<div class="col-md-6 col-sm-6 col-xs-12">
			<form action="<?php echo URL . 'users/update_assessment/' . htmlspecialchars($assessment->user_id, ENT_QUOTES, 'UTF-8'); ?>" method="POST">
				<h3 style="margin-bottom: 30px;">Chỉnh Sửa Đánh Giá</h3>
				
				<div class="row">
					<label class="title">Ngày:</label>
					<input type="text" id="assessment_date" name="assessment_date" size="10" value="<?php echo htmlspecialchars($assessment->assessment_date, ENT_QUOTES, 'UTF-8'); ?>" required />
				</div>
				
				<div class="row">
					<label class="title">Đánh Giá:</label>
					<textarea rows="4" cols="25" name="description">
						<?php echo htmlspecialchars($assessment->description, ENT_QUOTES, 'UTF-8'); ?>
					</textarea>
				</div>
				
				<div class="row">
					<label class="title"></label>
					<input type="hidden" name="assessment_id" value="<?php echo htmlspecialchars($assessment->assessment_id, ENT_QUOTES, 'UTF-8'); ?>" />
					<input type="submit" name="submit_update_assessment" value="Chỉnh Sửa" />
				</div>
			</form>
		</div>	
		
    </div>
    
</div>

   <script type="text/javascript">
  $(document).ready(function(){
    $( "#assessment_date" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: '2016:2020',
	  dateFormat: 'dd-mm-yy'  
    });
  } );
  </script>
