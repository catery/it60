<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="content-language" content="vi"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta http-equiv="refresh" content="600"/>
		<meta name="robots" content="INDEX,FOLLOW"/>
		<meta name="description" content="<?php echo META_DESCRIPT; ?>"/>
		<meta name="keywords" content="<?php echo META_KEY; ?>"/>
		<title><?php echo isset($title_header) ? convert_title($title_header) : ''; ?></title>
		<base href="<?php echo BASE_URL; ?>"/>
		<link rel="shortcut icon" href="<?php echo BASE_URL; ?>public/icon/60ico.ico"/>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>public/css/materialize.min.css" media="screen,projection"/>
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>public/css/portal.css">
		<script type="text/javascript" src="<?php echo BASE_URL; ?>public/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo BASE_URL; ?>public/js/materialize.min.js"></script>
		<script type="text/javascript" src="<?php echo BASE_URL; ?>public/js/main.js"></script>
	</head>
	<body>
		<div id="loader-wrapper">
			<div id="loader"></div>        
			<div class="loader-section section-left"></div>
			<div class="loader-section section-right"></div>
		</div>
		<?php $this->load->view('templates/top'); ?>
		<div class="row custom-advertise"></div>
		<div class="row custom-content">
			<div class="content-left">
				<ul class="breadcrumb custom-breadcrumb">
					<li>
						<a href="<?php echo BASE_URL; ?>" title="Trang chủ">
							Trang chủ
						</a>
					</li>
					<?php
						if($breadcrums_cha == '') {
							echo '';
						} else {
					?>
					<li>
						<a href="<?php echo BASE_URL; ?><?php echo $key_cha ?>" title="<?php echo $breadcrums_cha; ?>">
							<?php echo $breadcrums_cha; ?>
						</a>
					</li>
					<?php
						}
						if($breadcrums_con == '') {
							echo '';
						} else {
							if(str_word_count($breadcrums_con) > 14) {
					?>
					<li>
						<a href="<?php echo BASE_URL; ?><?php echo $key_con ?>" title="<?php echo $breadcrums_con; ?>">
							<?php echo substr($breadcrums_con, 0, 75); ?>
						</a>
					</li>
					<?php
							} else {
					?>
					<li>
						<a href="<?php echo BASE_URL; ?><?php echo $key_con ?>" title="<?php echo $breadcrums_con; ?>">
							<?php echo substr($breadcrums_con, 0, 75); ?>
						</a>
					</li>
					<?php

							}
						}
					?>
				</ul>
				<!--Mobile-->
				<ul class="breadcrumb mobile-breadcrumb">
					<?php
						if($breadcrums_cha == '' && $breadcrums_con == '') {
					?>
					<li>
						<a href="<?php echo BASE_URL; ?>" title="Trang chủ">
							Trang chủ
						</a>
					</li>
					<?php
						} else {
							echo '';
						}
						if($breadcrums_cha == '') {
							echo '';
						} else {
							if(strlen($breadcrums_con) >= 4) {
								echo '';
							} else {
					?>
					<li>
						<a href="<?php echo BASE_URL; ?><?php echo $key_cha ?>" title="<?php echo $breadcrums_cha; ?>">
							<?php echo $breadcrums_cha; ?>
						</a>
					</li>
					<?php
							}
						}
						if($breadcrums_con == '') {
							echo '';
						} else {
							if(str_word_count($breadcrums_con) > 10) {
					?>
					<li>
						<a href="<?php echo BASE_URL; ?><?php echo $key_con ?>" title="<?php echo $breadcrums_con; ?>">
							<?php echo substr($breadcrums_con, 0, 20); ?>
						</a>
					</li>
					<?php
							} else {
					?>
					<li>
						<a href="<?php echo BASE_URL; ?><?php echo $key_con ?>" title="<?php echo $breadcrums_con; ?>">
							<?php echo substr($breadcrums_con, 0, 20); ?>
						</a>
					</li>
					<?php

							}
						}
					?>
				</ul>
				<?php $this->load->view($template, isset($data) ? $data : NULL); ?>
			</div>
			<div class="content-right">
				<?php $this->load->view('templates/right'); ?>
			</div>
			<div class="content-bottom">
				<?php $this->load->view('templates/bottom'); ?>
			</div>
		</div>
	</body>
</html>