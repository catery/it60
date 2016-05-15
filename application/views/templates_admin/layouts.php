<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="content-language" content="vi"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title><?php echo isset($title_admin) ? convert_title($title_admin) : ''; ?></title>
		<base href="<?php echo BASE_URL; ?>"/>
		<link rel="shortcut icon" href="public/icon/60ico.ico"/>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="public/css/materialize.min.css" media="screen,projection"/>
		<link rel="stylesheet" type="text/css" href="public/css/base.css">
		<script type="text/javascript" src="public/js/init.js"></script>
		<script type="text/javascript" src="public/js/jquery.min.js"></script>
		<script type="text/javascript" src="public/js/materialize.min.js"></script>
		<script type="text/javascript" src="public/js/notify.js"></script>
		<script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>
		<script type="text/javascript" src="public/js/jquery.observe_field.js"></script>
	</head>
	<body>
		<?php $this->load->view('templates_admin/top'); ?>
		<div class="row">
      		<div class="col s2 collect">
				<?php $this->load->view('templates_admin/left'); ?>
      		</div>
      		<div class="col s10">
      			<h5><i class="small material-icons" style="vertical-align: bottom;">reorder</i>&nbsp;<?php echo convert_title($title_admin); ?></h5>
      			<?php $this->load->view($template_admin, isset($data) ? $data : NULL); ?>
      		</div>
    	</div>
    	<style type="text/css">
    		.collection {min-width: 100%;max-height: auto;margin-left: -10px;}
    	</style>
    	<script type="text/javascript">
			$(document).ready(function(){ $('.modal-trigger').leanModal(); });
		</script>
	</body>
</html>