<div class="container">

    <!-- add user form -->
    <div class="box">
        
		<h3 style="margin-bottom: 30px;">Học Sinh: <?php if (isset($user->name)) echo htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8'); ?></h3>	
		
		<div class="col-md-6 col-sm-6 col-xs-12">
			<form action="<?php echo URL . 'users/add_assessment/' . htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>" method="POST">
				<h3 style="margin-bottom: 30px;">Thêm Đánh Giá</h3>
				
				<div class="row">
					<label class="title">Ngày:</label>
					<input type="text" id="assessment_date" name="assessment_date" size="10" value="" required />
				</div>
				
				<div class="row">
					<label class="title">Đánh Giá:</label>
					<textarea rows="4" cols="25" name="description"></textarea>
				</div>
				
				<div class="row">
					<label class="title"></label>
					<input type="submit" name="submit_add_assessment" value="Thêm" />
				</div>
			</form>
		</div>	
		
    </div>
    <!-- main content output -->

	  <div class="box">
       
        <h3>Danh Sách Đánh Giá</h3>
        <table>
            <thead>
            <tr>
                <td>Ngày</td>
                <td>Đánh Giá</td>
				<td>EDIT</td>
                <td>DELETE</td>              
            </tr>
            </thead>
            <tbody>
            <?php foreach ($assessments as $assessment) { ?>
                <tr>
                    
                    <td><?php 
						if (isset($assessment->assessment_date)){ 
							$assessment_date = explode(" ",$assessment->assessment_date);
							$assessment_date = explode("-",$assessment_date[0]);
							echo $assessment_date[2].'-'.$assessment_date[1].'-'.$assessment_date[0];
						}
					?></td>
                    <td><?php if (isset($assessment->description)) echo htmlspecialchars($assessment->description, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a class="blue" href="<?php echo URL . 'users/edit_assessment/' . htmlspecialchars($assessment->assessment_id, ENT_QUOTES, 'UTF-8').'/'.htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>">Chỉnh Sửa</a></td>
                    <td><a class="red" href="<?php echo URL . 'users/delete_assessment/' . htmlspecialchars($assessment->assessment_id, ENT_QUOTES, 'UTF-8').'/'.htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>" onclick="return confirm('Bạn có chắc chắn xóa?');">Xóa</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
	
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
