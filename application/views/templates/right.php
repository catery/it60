<div class="input-field col s12">
	<form method="get" action="<?php echo BASE_URL.'tim-kiem/'; ?>" name="frmSrch" onsubmit="return checkSearch()">
		<input type="text" id="s" name="s">
		<label for="s">Tìm kiếm</label>
	</form>
</div>
<div class="collection custom-collection">
	<a href="<?php echo BASE_URL; ?>gioi-thieu" class="collection-item" title="Giới thiệu"><i class="tiny material-icons" style="vertical-align:text-top;">keyboard_arrow_right</i>&nbsp;Giới thiệu</a>
	<?php
		$menuR = $this->menu_model->menu_right();
		if($menuR) {
			foreach($menuR as $row_right) {

	?>
	<a href="<?php echo BASE_URL.'thong-tin/'.$row_right->id; ?>" class="collection-item"  title="<?php echo $row_right->tenMenu; ?>"><i class="tiny material-icons" style="vertical-align:text-top;">keyboard_arrow_right</i>&nbsp;<?php echo $row_right->tenMenu; ?></a>
	<?php
			}
		} else {
			echo '';
		}
	?>
	<a href="<?php echo BASE_URL; ?>lien-he" class="collection-item" title="Liên hệ"><i class="tiny material-icons" style="vertical-align:text-top;">keyboard_arrow_right</i>&nbsp;Liên hệ</a>
</div>
<div class="row">
	
</div>
<div class="row">
	<select onchange="checkUrl(this.value)">
		<option value="" selected>Liên kết website</option>
		<option value="http://w3schools.com">W3schools</option>
		<option value="http://www.tutorialspoint.com/">Tutorialspoint</option>
		<option value="https://angularjs.org/">Angularjs</option>
		<option value="http://sailsjs.org/">Sailsjs</option>
	</select>
</div>
<script type="text/javascript">
	$(document).ready(function() {
    	$('select').material_select();
	});
</script>