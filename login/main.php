<?php require('includes/config.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//define page title
$title = 'GWIS - Main Page';

//include header template
require('layout/header.php'); 
?>

<div class="breadcrumb">
	<div class="container">

		<div class="row">

			<div class="col-xs-12 col-sm-12 col-md-12">
				
					<h5>ĐĂNG NHẬP</h5>
					<p><a href="http://gwisbinhdinh.com/">Trang chủ </a>/ <a id="breadcrumb-nav">Kết Quả Học Tập</a></p>
				<!--	<hr>
					<a href='logout.php'>Logout</a> -->
			</div>
		</div>


	</div>
</div>


<div id="tab-control" class="container">	
	<ul class="nav nav-tabs">
		<li id="first" value="1" class="active"><a href="#1" data-toggle="tab">Kết Quả Học Tập</a></li>
		<li value="2"><a href="#2" data-toggle="tab">Đánh Giá Của Giáo Viên</a></li>
		<li value="3"><a href="#3" data-toggle="tab">Ý Kiến Phụ Huynh</a></li>
		<li value="4"><a href="#4" data-toggle="tab">Đóng Học Phí</a></li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane active" id="1">
			<?php require('results.php'); ?>
		</div>
		<div class="tab-pane" id="2">
			<?php require('assessments.php'); ?>
		</div>
		<div class="tab-pane" id="3">
		  <?php require('comments.php'); ?>
		</div>
		<div class="tab-pane" id="4">
		  <?php require('payments.php'); ?>
		</div>
	</div>
</div>

  <script type="text/javascript">
  $(document).ready(function(){
	
	$('#tab-control .nav-tabs li').on('click', function() {
	  var value = this.value;
	  console.log(value);
	  switch (value) {

			case 1:
				$('#breadcrumb-nav').text('Kết Quả Học Tập');
				break;
			case 2:
				$('#breadcrumb-nav').text('Đánh Giá Của Giáo Viên');
				break;
			case 3:
				$('#breadcrumb-nav').text('Ý Kiến Phụ Huynh');
				break;
			case 4:
				$('#breadcrumb-nav').text('Đóng Học Phí');
				break;
		}
	});
  
  } );
  
  
  </script>

  
<?php 
//include header template
require('layout/footer.php'); 
?>
