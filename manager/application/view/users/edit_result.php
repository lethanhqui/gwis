<div class="container">

    <!-- add result form -->
    <div>
        <h3 style="margin-bottom: 30px;">Học Sinh: <?php if (isset($result->user_name)) echo htmlspecialchars($result->user_name, ENT_QUOTES, 'UTF-8'); ?></h3>	
        
		<?php if($result->result == 1) :?>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<form action="<?php echo URL; ?>users/update_result/<?php echo htmlspecialchars($result->user_id, ENT_QUOTES, 'UTF-8'); ?>" method="POST">
				<h3 style="margin-bottom: 30px;">Chỉnh Sửa Kết Quả</h3>	
				<div class="row">
					<label class="title">Ngày:</label>
					<input type="text" id="result_date" name="result_date" size="10" value="<?php echo htmlspecialchars($result->result_date, ENT_QUOTES, 'UTF-8'); ?>" required />
				</div>
				
				<div class="row">
					<label class="title">Kiểm Tra Môn:</label>
					<input type="text" name="lesson" value="<?php echo htmlspecialchars($result->lesson, ENT_QUOTES, 'UTF-8'); ?>" required />
				</div>
				
				<div class="row">
					<label class="title">Kiểm Tra 15':</label>
					<input type="text" name="test15" size="4" value="<?php echo htmlspecialchars($result->test15, ENT_QUOTES, 'UTF-8'); ?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
				</div>
				
				<div class="row">
					<label class="title">Kiểm Tra 45':</label>
					<input type="text" name="test45" size="4" value="<?php echo htmlspecialchars($result->test45, ENT_QUOTES, 'UTF-8'); ?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
				</div>
				
				<div class="row">
					<label class="title">Kiểm Tra Học Kì':</label>
					<input type="text" name="testlast" size="4" value="<?php echo htmlspecialchars($result->testlast, ENT_QUOTES, 'UTF-8'); ?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
				</div>
				
				<div class="row">
					<label class="title">Ghi chú:</label>
					<textarea rows="4" cols="25" name="note"><?php echo htmlspecialchars($result->note, ENT_QUOTES, 'UTF-8'); ?></textarea>
				</div>
				
				<div class="row">
					<label class="title"></label>
					<input type="hidden" name="result_id" value="<?php echo htmlspecialchars($result->result_id, ENT_QUOTES, 'UTF-8'); ?>" />
					<input type="submit" name="submit_update_result" value="Chỉnh Sửa" />
				</div>
			
			</form>
		</div>	
		
		<?php elseif($result->follow == 1) :?>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<form action="<?php echo URL; ?>users/update_result/<?php echo htmlspecialchars($result->user_id, ENT_QUOTES, 'UTF-8'); ?>" method="POST">
				<h3 style="margin-bottom: 30px;">Chỉnh Sửa Theo Dõi</h3>
				
				<div class="row">
					<label class="title">Ngày:</label>
					<input type="text" id="follow_date" name="follow_date" size="10" value="<?php echo htmlspecialchars($result->follow_date, ENT_QUOTES, 'UTF-8'); ?>" required />
				</div>
				
				<div class="row">
					<label class="title">Tham Gia:</label>
					<textarea rows="4" cols="25" name="participate"><?php echo htmlspecialchars($result->participate, ENT_QUOTES, 'UTF-8'); ?></textarea>
				</div>
				
				<div class="row">
					<label class="title">Lý Do:</label>
					<textarea rows="4" cols="25" name="reason"><?php echo htmlspecialchars($result->reason, ENT_QUOTES, 'UTF-8'); ?></textarea>
				</div>
				
				<div class="row">
					<label class="title"></label>
					<input type="hidden" name="result_id" value="<?php echo htmlspecialchars($result->result_id, ENT_QUOTES, 'UTF-8'); ?>" />
					<input type="submit" name="submit_update_follow" value="Chỉnh Sửa" />
				</div>
			</form>
		</div>
		<?php endif;?>		
    </div>
	

</div>

<script type="text/javascript">
  $(document).ready(function(){
    $( "#result_date,#follow_date" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: '2016:2020',
	  dateFormat: 'dd-mm-yy'
    });
  } );
  </script>

