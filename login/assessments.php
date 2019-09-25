<?php

	$assessments = $user->getAssessmentUser($_SESSION['user_id']);

?>

<div class="wrap-content">
	<div class="main-content">
		<div class="col-md-5 col-sm-6 col-xs-12">
			<h2><?php echo htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8'); ?></h2>
			<h4>ID: <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></h4>
			<!--
			<div class="row">
				<span>THÁNG: </span><input type="text" size="6" id="month-year-assessment" name="month" value="" />
			</div>
			-->
		</div>
		
		<div class="col-md-7 col-sm-6 col-xs-12 assessment">
			<div class="row">
				<h5>ĐÁNH GIÁ</h5>
				<div class="box-new">	
					<table id="desktop-show">
					<thead>
					<tr>
						<td>Ngày</td>
						<td>Đánh Giá</td>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($assessments as $assessment) { ?>
						
						<tr>
							 <td>
							 <?php 
								if (isset($assessment["assessment_date"])){ 
									$assessment_date = explode(" ",$assessment["assessment_date"]);
									$assessment_date = explode("-",$assessment_date[0]);
									echo $assessment_date[2].'-'.$assessment_date[1].'-'.$assessment_date[0];
								}
							?>
							</td>
							<td>
							 <?php if (isset($assessment["description"])) echo htmlspecialchars($assessment["description"], ENT_QUOTES, 'UTF-8'); ?>
							 </td>
						</tr>
						
					<?php } ?>
					</tbody>
				</table>
				<div id="mobile-show" style="display:none;">
					<?php foreach ($assessments as $assessment) { ?>
					<div class="section">					
						<span>
							<?php 
								if (isset($assessment["assessment_date"])){ 
									$assessment_date = explode(" ",$assessment["assessment_date"]);
									$assessment_date = explode("-",$assessment_date[0]);
									echo $assessment_date[2].'-'.$assessment_date[1].'-'.$assessment_date[0];
								}
							?>
						</span>: 
						<span>
							<?php if (isset($assessment["description"])) echo htmlspecialchars($assessment["description"], ENT_QUOTES, 'UTF-8'); ?>
						</span>
					</div>
					<hr class="division">
					<?php } ?>
				</div>	
				</div>
			</div>
	
		</div>
	</div>
</div>

 <script type="text/javascript">
  $(document).ready(function(){
    $( "#month-year-assessment" ).datepicker({
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