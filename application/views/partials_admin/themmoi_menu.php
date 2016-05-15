<?php
	if($this->session->userdata('isLogged') == true) {
		if($this->session->flashdata('ErrorExist')) {
?>
		<script type="text/javascript">
			$(document).ready(function(){
				NotifyError('Tên danh mục đã tồn tại');
			});
		</script>
<?php
		}
		if($this->session->flashdata('Success')) {
?>
		<script type="text/javascript">
			$(document).ready(function(){
				NotifySuccess('Thêm mới thành công');
			});
		</script>
<?php
		}
		if($this->session->flashdata('Error')) {
?>
		<script type="text/javascript">
			$(document).ready(function(){
				NotifyError('Thêm mới thất bại');
			});
		</script>
<?php
		}
?>
<form method="post" action="portal/taomoi_danhmuc" name="Menufrm">
	<a href="portal/chude_danhmuc" class="waves-effect waves-light btn">Thoát<i class="material-icons right">reply</i></a>
	<button class="btn waves-effect waves-light" type="submit" name="btn_smt" value="save" onclick="return checkMenu()">
		Lưu lại<i class="material-icons right">save</i>
	</button>
	<div class="clear-fix"></div>
	<div class="col s12 z-depth-1">
		<div class="input-field col s6">
			<input id="danhMuc" type="text" name="danhMuc">
			<label for="danhMuc">Danh mục</label>
		</div>
		<div class="input-field col s6">
			<select name="danhMucCha">
				<option value="" selected>Danh mục cha</option>
				<?php
					$dmc = $this->menu_model->hienthi_danhmuc_cha();
					if($dmc) {
						foreach($dmc as $row_dmc) {
				?>
				<option value="<?php echo $row_dmc->id; ?>"><?php echo $row_dmc->tenMenu; ?></option>
				<?php
						}
					} else {
						echo '';
					}
				?>
			</select>
		</div>
		<div class="row">
			<div class="input-field col s2">
				<label>Danh mục con</label>
			</div>
			<div class="input-field col s3">
				<select name="danhMucCon">
					<option value="N" selected>Không</option>
					<option value="Y">Có</option>
				</select>
			</div>
			<div class="input-field col s2">
				<label>Vị trí</label>
			</div>
			<div class="input-field col s3">
				<select name="viTriDanhMuc">
					<option value="T" selected>Top</option>
					<option value="R">Right</option>
				</select>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function() {
    	$('select').material_select();
	});
</script>
<?php
	} else {
		redirect(BASE_URL.'portal/dangnhap');
	}
?>