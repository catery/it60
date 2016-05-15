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
<form method="post" action="portal/capnhat_baiviet/<?=$record['id']?>" name="Menufrm">
	<a href="portal/quanly_baiviet" class="waves-effect waves-light btn">Thoát<i class="material-icons right">reply</i></a>
	<button class="btn waves-effect waves-light" type="submit" name="btn_smt" value="save" onclick="return checkMenu()">
		Lưu lại<i class="material-icons right">save</i>
	</button>
	<div class="clear-fix"></div>
	<div class="col s12 z-depth-1">
		<div class="col s12">
			<h5>Hình đại diện</h5>
			<img class="z-depth-1" src="<?php echo $record['hinhAnh']; ?>" width="128" height="128" id="show_image" onclick="javascript:open_popup('<?php echo BASE_URL; ?>file_manager/filemanager/dialog.php?type=1&popup=1&field_id=field_image')"/>
			<input id="field_image" name="avatar_image" type="hidden" value="<?php echo $record['hinhAnh']; ?>">
		</div>
		<div class="input-field col s12">
			<div class="col s10">
				<input id="fieldID2" name="tapTin" type="text" value="<?php echo isset($record['tapTin']) ? $record['tapTin'] : ''; ?>">
				<label for="fieldID2">Tập tin</label>
			</div>
			<div class="col s2">
	  			<a href="javascript:open_popup('<?php echo BASE_URL; ?>file_manager/filemanager/dialog.php?type=2&popup=1&field_id=fieldID2')" class="btn iframe-btn" type="button">Đính kèm</a>
			</div>
		</div>
		<div class="input-field col s9">
			<input id="baiViet" type="text" name="baiViet" maxlength="255" value="<?php echo $record['chuDe']; ?>">
			<label for="baiViet">Chủ đề</label>
		</div>
		<div class="input-field col s3">
			<select id="danhMuc" name="danhMuc">
				<option value="">Danh mục</option>
				<?php
					$dmc = $this->menu_model->hienthi_danhmuc_con();
					if($dmc) {
						foreach($dmc as $row_dmc) {
							if($row_dmc->id == $record['id_danhMuc']) {
				?>
				<option value="<?php echo $row_dmc->id; ?>" selected><?php echo $row_dmc->tenMenu; ?></option>
				<?php
							} else {
				?>
				<option value="<?php echo $row_dmc->id; ?>"><?php echo $row_dmc->tenMenu; ?></option>
				<?php
							}
						}
					} else {
						echo '';
					}
				?>
			</select>
		</div>
		<div class="input-field col s12" style="margin-bottom:10px;">
          	<script type="text/javascript">
          		tinymce.init({
    				selector: "#noiDung",theme: "modern",width: 1060,height: 400,
    				relative_urls : false,remove_script_host: false,
					plugins: [
						"advlist autolink link image lists charmap print preview hr anchor pagebreak",
						"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
						"table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
					],
					toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
					toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
					external_filemanager_path:"<?php echo BASE_URL; ?>file_manager/filemanager/",
					filemanager_title:"Responsive Filemanager" ,
					external_plugins: { "filemanager" : "<?php echo BASE_URL; ?>file_manager/filemanager/plugin.min.js"}
				});
          	</script>
          	<h5 class="left-align">Nội dung</h5>
          	<textarea id="noiDung" name="noiDung" class="materialize-textarea"><?php echo $record['noiDung']; ?></textarea>
		</div>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function() {
    	$('select').material_select();
	});
	function responsive_filemanager_callback(field_id){
		if(field_id){
			var url=jQuery('#'+field_id).val();
		}
	}
	$(function() {
	    $("#field_image").observe_field(1, function() {
	        $('#show_image').attr('src',this.value).show();
	    });
	});
</script>
<?php
		} else {
			redirect(BASE_URL.'portal/quanly_baiviet');
		}
	} else {
		redirect(BASE_URL.'portal/dangnhap');
	}
?>