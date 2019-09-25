<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php if(isset($title)){ echo $title; }?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=vietnamese" rel="stylesheet">
    <!-- CSS -->
    
    <link href="style/font-awesome.min.css" rel="stylesheet">
    <link href="style/bootstrap.min.css" rel="stylesheet">	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link href="style/main.css" rel="stylesheet">
	<link href="style/responsive.css" rel="stylesheet">
	
	<!-- JS -->
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	
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
				<div class="header-menu">
					<ul>
						<li><a href='change_password.php'>ĐỔI MẬT KHẨU</a></li>
						<li><a href='logout.php'>ĐĂNG XUẤT</a></li>						
					</ul>
				</div>
				<?php endif;?>
			</div>
			
		</div>
	</div>
	
	<div class="very-bottom-header" id="very-bottom-header">
		<div class="container">	
			<!-- logo -->
			<div class="logo">
				<a href="http://gwisbinhdinh.com/"><img src="img/Logo.jpg"></a>
			</div>

			<!-- navigation -->
			<ul class="navigation">
				<li><a href="http://gwisbinhdinh.com/">Trang Chủ</a></li>
				<li><a href="http://gwisbinhdinh.com/category/gioi-thieu/">Giới Thiệu</a>
					<ul class="sub-menu">
						<li><a href="http://gwisbinhdinh.com/ban-lanh-dao/">Ban Lãnh Đạo</a></li>
						<li><a href="http://gwisbinhdinh.com/cac-cap-hoc/">Các Cấp Học</a></li>
						<li><a href="http://gwisbinhdinh.com/chuong-trinh-hoc/">Chương Trình Học</a></li>
						<li><a href="http://gwisbinhdinh.com/bang-cap/">Bằng Cấp</a></li>
					</ul>
				</li>
				<li><a href="http://gwisbinhdinh.com/category/hoat-dong/">Hoạt Động</a>
					<ul class="sub-menu">
						<li><a href="http://gwisbinhdinh.com/thong-bao-tuyen-sinh/">Thông Báo Tuyển Sinh</a></li>
						<li><a href="http://gwisbinhdinh.com/anh-ngoai-khoa/">Chương Trình Ngoại Khóa</a></li>
					</ul>
				</li>
				<li><a href="http://gwisbinhdinh.com/category/hinh-anh/">Hình Ảnh</a>
					<ul class="sub-menu">
						<li><a href="http://gwisbinhdinh.com/anh-hoat-dong/">Ảnh Hoạt Động</a></li>
						<li><a href="http://gwisbinhdinh.com/anh-ngoai-khoa/">Ảnh Ngoại Khóa</a></li>
						<li><a href="http://gwisbinhdinh.com/video/">Video</a></li>
					</ul>
				</li>
				<li><a href="http://gwisbinhdinh.com/lien-he/">Liên Hệ</a></li>
			</ul>
		</div>
    </div>
	</header>
	
<script>

var ww = document.body.clientWidth;

$(document).ready(function() {
$(".navigation li a").each(function() {
	if ($(this).next().length > 0) {
		$(this).addClass("parent");
	};
})

$(".toggleMenu").click(function(e) {
	e.preventDefault();
	$(this).toggleClass("active");
	$(".navigation").toggle();
});
adjustMenu();
})

$(window).bind('resize orientationchange', function() {
ww = document.body.clientWidth;
adjustMenu();
});

var adjustMenu = function() {
if (ww < 768) {
	$(".toggleMenu").css("display", "inline-block");
	if (!$(".toggleMenu").hasClass("active")) {
		$(".navigation").hide();
	} else {
		$(".navigation").show();
	}
	$(".navigation li").unbind('mouseenter mouseleave');
	$(".navigation li a.parent").unbind('click').bind('click', function(e) {
		// must be attached to anchor element to prevent bubbling
		e.preventDefault();
		$(this).parent("li").toggleClass("hover");
	});
} 
else if (ww >= 768) {
	$(".toggleMenu").css("display", "none");
	$(".navigation").show();
	$(".navigation li").removeClass("hover");
	$(".navigation li a").unbind('click');
	$(".navigation li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
		// must be attached to li so that mouseleave is not triggered when hover over submenu
		$(this).toggleClass('hover');
	});
}
}


</script>
