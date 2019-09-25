<div class="container">

    <!-- add user form -->
    <div class="box">
        
		<h3 style="margin-bottom: 30px;">Học Sinh: <?php if (isset($user->name)) echo htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8'); ?></h3>	
        
		<div class="col-md-6 col-sm-6 col-xs-12">
			<form action="<?php echo URL . 'users/add_result/' . htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>" method="POST">
				<h3 style="margin-bottom: 30px;">Thêm Kết Quả</h3>	
				<div class="row">
					<label class="title">Ngày:</label>
					<input type="text" id="result_date" name="result_date" size="10" value="" required />
				</div>
				
				<div class="row">
					<label class="title">Kiểm Tra Môn:</label>
					<input type="text" name="lesson" value="" required />
				</div>
				
				<div class="row">
					<label class="title">Kiểm Tra 15':</label>
					<input type="text" name="test15" size="4" value="" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
				</div>
				
				<div class="row">
					<label class="title">Kiểm Tra 45':</label>
					<input type="text" name="test45" size="4" value="" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
				</div>
				
				<div class="row">
					<label class="title">Kiểm Tra Học Kì':</label>
					<input type="text" name="testlast" size="4" value="" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
				</div>
				
				<div class="row">
					<label class="title">Ghi chú:</label>
					<textarea rows="4" cols="25" name="note"></textarea>
				</div>
				
				<div class="row">
					<label class="title"></label>
					<input type="submit" name="submit_add_result" value="Thêm" />
				</div>
			
			</form>
		</div>	
		
		<div class="col-md-6 col-sm-6 col-xs-12">
			<form action="<?php echo URL . 'users/add_follow/' . htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>" method="POST">
				<h3 style="margin-bottom: 30px;">Thêm Theo Dõi</h3>
				
				<div class="row">
					<label class="title">Ngày:</label>
					<input type="text" id="follow_date" name="follow_date" size="10" value="" required />
				</div>
				
				<div class="row">
					<label class="title">Nội Dung:</label>
					<textarea rows="4" cols="25" name="participate"></textarea>
				</div>
				
				<div class="row">
					<label class="title">Lý Do:</label>
					<textarea rows="4" cols="25" name="reason"></textarea>
				</div>
				
				<div class="row">
					<label class="title"></label>
					<input type="submit" name="submit_add_follow" value="Thêm" />
				</div>
			</form>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12">		
			<?php if (isset($prev->user_id)) :?>
			<a class="prev" href="<?php echo URL . 'users/results_detail/' . htmlspecialchars($prev->user_id, ENT_QUOTES, 'UTF-8'); ?>">Prev</a>	
			<?php endif; ?>
			
			<?php if (isset($next->user_id)) :?>
			<a class="next" href="<?php echo URL . 'users/results_detail/' . htmlspecialchars($next->user_id, ENT_QUOTES, 'UTF-8'); ?>">Next</a>
			<?php endif; ?>			
		</div>
    </div>
    <!-- main content output -->
    <div class="box">
        

        <h3>Kết Quả Học Tập</h3>
        <table>
            <thead>
            <tr>
                <td>Ngày</td>
                <td>Kiểm Tra Môn</td>
                <td>Kiểm Tra 15'</td>
                <td>Kiểm Tra 45'</td>
                <td>Kiểm Tra Học Kì</td>
                <td>Ghi Chú</td>
				<td>EDIT</td>
                <td>DELETE</td>              
            </tr>
            </thead>
            <tbody>
            <?php foreach ($results as $result) { ?>
                <tr>
                    
                    <td><?php 
						if (isset($result->result_date)){ 
							$result_date = explode(" ",$result->result_date);
							$result_date = explode("-",$result_date[0]);
							echo $result_date[2].'-'.$result_date[1].'-'.$result_date[0];
						}
					?></td>
                    <td><?php if (isset($result->lesson)) echo htmlspecialchars($result->lesson, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($result->test15)) echo htmlspecialchars($result->test15, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($result->test45)) echo htmlspecialchars($result->test45, ENT_QUOTES, 'UTF-8'); ?></td>   
                    <td><?php if (isset($result->testlast)) echo htmlspecialchars($result->testlast, ENT_QUOTES, 'UTF-8'); ?></td>
					<td><?php if (isset($result->note)) echo htmlspecialchars($result->note, ENT_QUOTES, 'UTF-8'); ?></td>  
                    <td><a class="blue" href="<?php echo URL . 'users/edit_result/' . htmlspecialchars($result->result_id, ENT_QUOTES, 'UTF-8').'/'.htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>">Chỉnh Sửa</a></td>
                    <td><a class="red" href="<?php echo URL . 'users/delete_result/' . htmlspecialchars($result->result_id, ENT_QUOTES, 'UTF-8').'/'.htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>" onclick="return confirm('Bạn có chắc chắn xóa?');">Xóa</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
	
    </div>
	  <div class="box">
        

        <h3>Theo Dõi Học Tập</h3>
        <table>
            <thead>
            <tr>
                <td>Ngày</td>
                <td>Nội Dung</td>
                <td>Lý Do</td>
				<td>EDIT</td>
                <td>DELETE</td>              
            </tr>
            </thead>
            <tbody>
            <?php foreach ($follows as $follow) { ?>
                <tr>
                    
                    <td><?php 
						if (isset($follow->follow_date)){ 
							$follow_date = explode(" ",$follow->follow_date);
							$follow_date = explode("-",$follow_date[0]);
							echo $follow_date[2].'-'.$follow_date[1].'-'.$follow_date[0];
						}
					?></td>
                    <td><?php if (isset($follow->participate)) echo htmlspecialchars($follow->participate, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($follow->reason)) echo htmlspecialchars($follow->reason, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a class="blue" href="<?php echo URL . 'users/edit_result/' . htmlspecialchars($follow->result_id, ENT_QUOTES, 'UTF-8').'/'.htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>">Chỉnh Sửa</a></td>
                    <td><a class="red" href="<?php echo URL . 'users/delete_result/' . htmlspecialchars($follow->result_id, ENT_QUOTES, 'UTF-8').'/'.htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>" onclick="return confirm('Bạn có chắc chắn xóa?');">Xóa</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
	
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
