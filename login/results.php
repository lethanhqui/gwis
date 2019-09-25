<?php

	$results = $user->getResultUser($_SESSION['user_id'],1);
	$follows = $user->getResultUser($_SESSION['user_id'],0);

	$us = $user->getUser($_SESSION['user_id']);
	$homeworks = $user->getHomeworks($us['class_id']);
	$objects = $user->getObjects($us['class_id']);
	
	//var_dump($homeworks);
	//var_dump($us);
	//var_dump($us['class_id']);
?>

<div class="wrap-content">
	<div class="main-content">
		<div class="col-md-5 col-sm-6 col-xs-12 homeworks">
			<h2><?php echo htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8'); ?></h2>
			<h4>ID: <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></h4>
			<!--
			<div class="row">
				<span>THÁNG: </span><input type="text" size="6" id="month-year" name="month" value="" />
			</div>
			-->
			<div class="row">
					<h5>BÀI TẬP</h5>
				<div class="box-new box-homework">
					<table>
					<thead>
					<tr>
						<td>Lớp</td>
						<td>Ngày</td>
						<td>Nội dung</td>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($homeworks as $homework) { ?>
						<tr>
							<td><?php if (isset($homework["class_name"])) echo htmlspecialchars($homework["class_name"], ENT_QUOTES, 'UTF-8'); ?></td>
							 <td><?php 
								if (isset($homework["deadline"])){ 
									$deadline = explode(" ",$homework["deadline"]);
									$deadline = explode("-",$deadline[0]);
									echo $deadline[2].'-'.$deadline[1].'-'.$deadline[0];
								}
							?></td>
							<td><?php if (isset($homework["description"])) echo htmlspecialchars($homework["description"], ENT_QUOTES, 'UTF-8'); ?></td>
						</tr>			
						
					<?php } ?>
					</tbody>
					</table>
				</div>
			</div>
			
			<div class="row">
					<h5>MỤC TIÊU</h5>
				<div class="box-new box-object">
					<table>
					<thead>
					<tr>
						<td>Lớp</td>
						<td>Tuần</td>
						<td>Ngày</td>
						<td>Nội dung</td>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($objects as $object) { ?>
						<tr>
							<td><?php if (isset($object["class_name"])) echo htmlspecialchars($object["class_name"], ENT_QUOTES, 'UTF-8'); ?></td>
							<td><?php if (isset($object["week"])) echo htmlspecialchars($object["week"], ENT_QUOTES, 'UTF-8'); ?></td>
							<td><?php 
								if (isset($object["deadline"])){ 
									$deadline = explode(" ",$object["deadline"]);
									$deadline = explode("-",$deadline[0]);
									echo $deadline[2].'-'.$deadline[1].'-'.$deadline[0];
								}
							?></td>
							<td><?php if (isset($object["description"])) echo htmlspecialchars($object["description"], ENT_QUOTES, 'UTF-8'); ?></td>
						</tr>			
						
					<?php } ?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div class="col-md-7 col-sm-6 col-xs-12 result">
			<div class="row">
					<h5>KẾT QUẢ</h5>
				<div class="box-new">
					<table>
					<thead>
					<tr>
						<td>Ngày</td>
						<td>KT Môn</td>
						<td>15'</td>
						<td>45'</td>
						<td>Học Kì</td>
						<td>Ghi Chú</td>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($results as $result) { ?>
						<tr>
							 <td><?php 
								if (isset($result["result_date"])){ 
									$result_date = explode(" ",$result["result_date"]);
									$result_date = explode("-",$result_date[0]);
									echo $result_date[2].'-'.$result_date[1].'-'.$result_date[0];
								}
							?></td>
							<td><?php if (isset($result["lesson"])) echo htmlspecialchars($result["lesson"], ENT_QUOTES, 'UTF-8'); ?></td>
							<td><?php if (isset($result["test15"])) echo htmlspecialchars($result["test15"], ENT_QUOTES, 'UTF-8'); ?></td>
							<td><?php if (isset($result["test45"])) echo htmlspecialchars($result["test45"], ENT_QUOTES, 'UTF-8'); ?></td>   
							<td><?php if (isset($result["testlast"])) echo htmlspecialchars($result["testlast"], ENT_QUOTES, 'UTF-8'); ?></td>
							<td><?php if (isset($result["note"])) echo htmlspecialchars($result["note"], ENT_QUOTES, 'UTF-8'); ?></td>
						</tr>			
						
					<?php } ?>
						</tbody>
				</table>
				</div>
			</div>
			
			<div class="row">
				<h5>THEO DÕI</h5>
				<div class="box-new">
					<table>
					<thead>
					<tr>
						<td>Ngày</td>
						<td>Nội Dung</td>
						<td>Lý Do</td>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($follows as $follow) { ?>
						<tr>
							 <td><?php 
								if (isset($follow["follow_date"])){ 
									$follow_date = explode(" ",$follow["follow_date"]);
									$follow_date = explode("-",$follow_date[0]);
									echo $follow_date[2].'-'.$follow_date[1].'-'.$follow_date[0];
								}
							?></td>
							<td><?php if (isset($follow["participate"])) echo htmlspecialchars($follow["participate"], ENT_QUOTES, 'UTF-8'); ?></td>
							<td><?php if (isset($follow["reason"])) echo htmlspecialchars($follow["reason"], ENT_QUOTES, 'UTF-8'); ?></td> 
						</tr>
					<?php } ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>

 <script type="text/javascript">
  $(document).ready(function(){
    $( "#month-year" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  showButtonPanel: true,
	  yearRange: '2016:2020',
	  dateFormat: 'mm-yy',
	  onClose: function(dateText, inst) { 
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }
	  
    });
  } );
  </script>