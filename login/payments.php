<?php

$books = $global->getBooks();
$classes = $global->getClasses();

?>

<div class="wrap-content payments">
	<div class="main-content">
		<div class="col-md-5 col-sm-6 col-xs-12">
				<h2><?php echo htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8'); ?></h2>
				<h4 style="margin-bottom:60px;">ID: <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></h4>
			<div class="row">
				<select class="select" name="class_id">			
					<?php foreach ($classes as $class) { ?>
						<option class_name="<?php echo $class["name"]; ?>" value="<?php echo $class["fee"]; ?>" <?php if ($user["class_id"] == $class["class_id"]): ?>selected<?php endif;?>><?php echo $class["name"]; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="row">
				<select class="select" name="fee">			
						<option value="0">HỌC PHÍ</option>
						<option value="1">Đóng 1 Tháng</option>
						<option value="3">Đóng 3 Tháng</option>
						<option value="6">Đóng 6 Tháng</option>
						<option value="9">Đóng 9 Tháng</option>
						<option value="12">Đóng 1 Năm</option>
				</select>
			</div>
			<div class="row">
				<select class="select" id="book" name="book_id">
					<option value="0">TIỀN SÁCH</option>
					<?php foreach ($books as $book) { ?>
						<option book_name="<?php echo $book["name"]; ?>" value="<?php echo $book["book_fee"]; ?>"><?php echo $book["name"]; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="row">
				<input id="calculator" type="submit" name="submit" value="TẠM TÍNH" class="btn btn-primary btn-block btn-lg" tabindex="5">
			</div>
		</div>
		
		<div class="col-md-7 col-sm-6 col-xs-12">
			<div class="row">
					<div class="box-new">	
							<div id="student_name" style="text-transform: uppercase;">
								<?php if (isset($user["name"])) echo htmlspecialchars($user["name"], ENT_QUOTES, 'UTF-8'); ?>
							</div>
							
							<div>ID: <?php if (isset($user["username"])) echo htmlspecialchars($user["username"], ENT_QUOTES, 'UTF-8'); ?>
							</div>
							
							<div id="lop" style="text-transform: uppercase;"><span id="class_name"><?php if (isset($user["class_name"])) echo htmlspecialchars($user["class_name"], ENT_QUOTES, 'UTF-8'); ?></span>
							</div>
							
							<div>TRƯỜNG: <?php if (isset($user["school"])) echo htmlspecialchars($user["school"], ENT_QUOTES, 'UTF-8'); ?>
							</div>
							
							<div>HỌC PHÍ: <span id="fee"><?php if (isset($user["fee"])) echo htmlspecialchars($user["fee"], ENT_QUOTES, 'UTF-8'); ?></span><span id="quantity"></span>
							<input id="data-fee" type="hidden" value="<?php echo htmlspecialchars($user["fee"], ENT_QUOTES, 'UTF-8'); ?>">
							</div>
							
							<div class="child">
								GIẢM: <?php if (isset($user["sale_fee"])) echo htmlspecialchars($user["sale_fee"], ENT_QUOTES, 'UTF-8'); ?>%
								<input type="hidden" id="sale_fee" value="<?php echo htmlspecialchars($user["sale_fee"], ENT_QUOTES, 'UTF-8'); ?>">							
							</div>
							<div>TIỀN SÁCH: <span id="book_fee"></span></div>   	
							<div class="child">LA: <i style="display:none" id="book-la" class="fa fa-check-circle" aria-hidden="true"></i></div>
							<div class="child">MATH: <i style="display:none" id="book-math" class="fa fa-check-circle" aria-hidden="true"></i></div>
							<div class="child">SCIENCE: <i style="display:none" id="book-science" class="fa fa-check-circle" aria-hidden="true"></i></div>
							<div>TỔNG CỘNG: <span style="font-weight:bold;" id="total_fee"></span></div>
					
					</div>
			</div>
			
			<div class="row">
				<input type="submit" id="continute" name="submit" value="TIẾP TỤC" class="btn btn-primary btn-block btn-lg" tabindex="5">
			</div>
			
		</div>
	</div>
</div>

 <script type="text/javascript">
  $(document).ready(function(){
	
	$('[name="book_id"].select').on('change', function() {
	  //alert( this.value );
	  var value = this.value;
	  var name = $(this).find("option:selected").attr('book_name');

	  $('#book_fee').text(value);
	  $("#book_fee").digits();
	  
	  if (value == '')
	  {
		$("#book-la").css('display','none');
		$("#book-math").css('display','none');
		$("#book-science").css('display','none');
	  }
	  
	  if(name.indexOf("LA") != -1){
			$("#book-la").css('display','inline-block');
	   }else{
			$("#book-la").css('display','none');
	   }
	   
	   if(name.indexOf("MATH") != -1){
			$("#book-math").css('display','inline-block');
	   }else{
			$("#book-math").css('display','none');
	   }
	   
	   if(name.indexOf("SCIENCE") != -1){
			$("#book-science").css('display','inline-block');
	   }else{
			$("#book-science").css('display','none');
	   }
	});
	
	$('[name="class_id"].select').on('change', function() {
	  //alert( this.value );
	  var value = this.value;
	  var text = $(this).find("option:selected").text();

	  $('#fee').text(value);
	  $('#data-fee').val(value);
	  $('#class_name').text(text);
	  $("#fee").digits();
	});
	
	$('[name="fee"].select').on('change', function() {
	  //alert( this.value );
	  var value = this.value;
	  var text = $(this).find("option:selected").text();
	  if (value == 0)
	  {
		var str = "";
	  }else{
		var str = " x " + value + " (" + text + ") ";	
	  }
	  $('#quantity').text(str);

	});
	
	$('#continute').on('click', function() {
		var student_name = $('#student_name').text();
		var class_name = $('#class_name').text();
		var total_fee =  $('#total_fee').text();
		window.location.href = 'transfer-payments.php?total=' + total_fee + '&class_name=' + class_name + '&student_name=' + student_name;
	});
	
	$('#calculator').on('click', function() {
		var fee = $('#data-fee').val();
		var quantity =  $('[name="fee"].select').val();
		var sale_fee =  $('#sale_fee').val();
		var book_fee =  $('[name="book_id"].select').val();
		
		fee = parseInt(fee);
		quantity = parseInt(quantity);
		sale_fee = parseInt(sale_fee);
		book_fee = parseInt(book_fee);
		
		console.log(fee + '--'+ quantity + '--'+ sale_fee + '--'+ book_fee )
		if(quantity != 0 )
		{
			var cal = fee * quantity ;
			if(sale_fee != 0 )
			{
				var cal = cal - (cal * sale_fee)/100;
			}
			
			cal = cal + book_fee;
		}else{
			var cal = fee ;
			if(sale_fee != 0 )
			{
				var cal = cal - (cal * sale_fee)/100;
			}
			
			cal = cal + book_fee;
		}
		console.log(cal);
		$('#total_fee').text(cal);
		$("#total_fee").digits();
	});
  	
	$.fn.digits = function(){ 
    return this.each(function(){ 
			$(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
		})
	}
	
	$("#fee").digits();
	
  } );
  </script>
