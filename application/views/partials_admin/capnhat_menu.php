<?php
	if($this->session->userdata('isLogged') == true) {
		if($this->session->flashdata('Success')) {
?>
		<script type="text/javascript">
			$(document).ready(function(){
				NotifySuccess('Cập nhật thành công');
			});
		</script>
<?php
		}
		if($this->session->flashdata('Error')) {
?>
		<script type="text/javascript">
			$(document).ready(function(){
				NotifyError('Cập nhật thất bại');
			});
		</script>
<?php
		}
		if(isset($record) && count($record) > 0){
?>
<form method="post" action="portal/capnhat_danhmuc/<?=$record['id']?>" name="Menufrm">
	<a href="portal/chude_danhmuc" class="waves-effect waves-light btn">Thoát<i class="material-icons right">reply</i></a>
	<button class="btn waves-effect waves-light" type="submit" name="btn_smt" value="save" onclick="return checkMenu()">
		Lưu lại<i class="material-icons right">save</i>
	</button>
	<div class="clear-fix"></div>
	<div class="col s12 z-depth-1">
		<div class="input-field col s6">
			<input id="danhMuc" type="text" name="danhMuc" value="<?php echo $record['tenMenu']; ?>">
			<label for="danhMuc">Danh mục</label>
		</div>
		<div class="input-field col s6">
			<select name="danhMucCha">
				<option value="">Danh mục cha</option>
				<?php
					$dmcha = $this->menu_model->hienthi_danhmuc_cha();
					if($dmcha) {
						foreach($dmcha as $row_dmcha) {
							if($record['menuCha'] === $row_dmcha->id) {
				?>				
				<option value="<?php echo $row_dmcha->id; ?>" selected><?php echo $row_dmcha->tenMenu; ?></option>
				<?php
							} else {
				?>
				<option value="<?php echo $row_dmcha->id; ?>"><?php echo $row_dmcha->tenMenu; ?></option>
				<?php
							}
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
				<?php
					if($record['menuCon'] == 'N') {
				?>
					<option value="<?php echo $record['menuCon']; ?>" selected>Không</option>
					<option value="Y">Có</option>
				<?php
					} else {
				?>
					<option value="<?php echo $record['menuCon']; ?>" selected>Có</option>
					<option value="N">Không</option>
				<?php
					}
				?>
				</select>
			</div>
			<div class="input-field col s2">
				<label>Vị trí</label>
			</div>
			<div class="input-field col s3">
				<select name="viTriDanhMuc">
				<?php
					if($record['viTri'] == 'T') {
				?>
					<option value="<?php echo $record['viTri']; ?>" selected>Top</option>
					<option value="R">Right</option>
				<?php
					} else {
				?>
					<option value="T">Top</option>
					<option value="<?php echo $record['viTri']; ?>" selected>Right</option>
				<?php
					}
				?>
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
			redirect(BASE_URL.'portal/chude_danhmuc');
		}
	} else {
		redirect(BASE_URL.'portal/dangnhap');
	}
?>