<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>GWIS</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600,600i,700,700i" rel="stylesheet">
   
    <!-- CSS -->
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	 
	<!-- JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	
</head>
<body>
	<header>
	<div class="very-top-header" id="very-top-header">
		<div class="container">
			
			<div class="very-top-left">
				<ul class="social-icons">
					<li>
						<a href="https://www.facebook.com/Tr%C6%B0%E1%BB%9Dng-PTQT-George-Washington-GWIS-B%C3%8CNH-%C4%90%E1%BB%8ANH-200011737080816/?fref=ts">
							<i class="fa fa-facebook transparent-text-dark" aria-hidden="true"></i>
						</a>
					</li>
					
					<li>
						<a href="#">
							<i class="fa fa-instagram transparent-text-dark" aria-hidden="true"></i>
						</a>
					</li>
					
					<li>
						<a href="#">
							<i class="fa fa-envelope transparent-text-dark" aria-hidden="true"></i>
						</a>
					</li>
					
					<li>
						<a href="#">
							<i class="fa fa-youtube transparent-text-dark" aria-hidden="true"></i>
						</a>
					</li>
				</ul>
			</div>
			
			<div class="very-top-right">
				<?php if(isset($_SESSION['name'])):?>
				<div class="staff">	
					<span><?php echo $_SESSION['name']; ?></span> - 
					<a href="<?php echo URL; ?>login/logout">Đăng Xuất</a>
				</div>
				<?php endif;?>
			</div>
			
		</div>
	</div>
	
	<div class="very-bottom-header" id="very-bottom-header">
		<div class="container">	
			<!-- logo -->
			<div class="logo">
				<a href="/"><img src="<?php echo URL; ?>img/Logo.jpg"></a>
			</div>

			<!-- navigation -->
			<ul class="navigation">
				<li><a href="<?php echo URL; ?>">Trang Chủ</a></li>
				<li><a href="<?php echo URL; ?>users">Học Sinh</a></li>
				<li><a href="<?php echo URL; ?>classes">Lớp</a></li>
				<li><a href="<?php echo URL; ?>achievements">Miễn Giảm</a></li>
				<li><a href="<?php echo URL; ?>books">Sách</a></li>
				<li><a href="<?php echo URL; ?>staffs">CBNV</a></li>
				<li><a href="<?php echo URL; ?>homeworks">Homework</a></li>
				<li><a href="<?php echo URL; ?>objects">Mục Tiêu</a></li>
			</ul>
		</div>
    </div>
	</header>
