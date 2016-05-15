<?php
	if($this->session->userdata('isLogged') == true) {
		if($this->session->flashdata('Success')) {
?>
		<script type="text/javascript">
			$(document).ready(function(){
				NotifySuccess('Xóa thành công');
			});
		</script>
<?php
		}
		if($this->session->flashdata('Error')) {
?>
		<script type="text/javascript">
			$(document).ready(function(){
				NotifyError('Xóa thất bại');
			});
		</script>
<?php
		}
?>
<a href="portal/taomoi_baiviet" class="waves-effect waves-light btn">Thêm mới<i class="material-icons right">add_circle_outline</i></a>
<a href="portal/quanly_baiviet" class="waves-effect waves-light btn">Làm mới<i class="material-icons right">loop</i></a>
<div class="input-field col s12">
	<form name="frmSrch" method="get" action="<?php echo BASE_URL.'portal/quanly_baiviet/'; ?>">
		<input id="Key" type="text" name="Key">
		<label for="Key">Tìm kiếm theo tên bài viết</label>
	</form>
</div>
<?php
		if (isset($record) && count($record) > 0) {
			echo $this->pagination->create_links();
		}
?>
<table class="highlight">
	<thead>
		<tr>
			<th>Ngày đăng</th>
			<th>Hình ảnh</th>
			<th>Tên bài viết</th>
		  	<th>Danh mục</th>
		  	<th>Tập tin</th>
		  	<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
				if (isset($record) && count($record) > 0) {
					foreach($record as $row){
		?>
		<tr>
			<td><?php echo convert_date($row->createdDate); ?></td>
			<td>
				<img src="<?php echo BASE_URL; ?><?php echo $row->hinhAnh; ?>" style="width: 34px; height:34px;">
			</td>
            <td>
            	<?php
            		if(str_word_count($row->chuDe) > 20) {
            			echo substr($row->chuDe, 0, 50);
            		} else {
            			echo $row->chuDe;
            		}
            	?>
            </td>
            <td>
        <?php
	            		$dm = $this->menu_model->lay_theoma($row->id_danhMuc);
	            		if($dm) {
	            			echo $dm['tenMenu'];
	            		} else{
	            			echo 'Không có';
	            		}
        ?>
            </td>
            <td>
            	<?php
            		if($row->tapTin == '') {
            			echo '';
            		} else {
            	?>
            	<a href="<?php echo $row->tapTin; ?>"><i class="material-icons">attach_file</i></a>
            	<?php
            		}
            	?>
            </td>
            <td>
            	<a href="portal/capnhat_baiviet/<?=$row->id?>" title="Hiệu chỉnh"><i class="material-icons">mode_edit</i></a>&nbsp;
            	<a class="modal-trigger" title="Xóa" href="#modal<?=$row->id?>"><i class="material-icons">delete</i></a>
				<div id="modal<?=$row->id?>" class="modal">
					<div class="modal-content">
						<center><p><h5 style="color:#d32f2f;">Bạn chắc muốn xóa [&nbsp;<?php echo substr($row->chuDe, 0, 50); ?>&nbsp;]&nbsp;?</h5></p></center>
					</div>
					<div class="modal-footer">
						<a class="modal-close waves-effect waves-green btn-flat">Thoát</a>
						<a href="portal/xoa_baiviet/<?=$row->id?>" class="modal-action modal-close waves-effect waves-green btn-flat">Đồng ý</a>
					</div>
				</div>
            </td>
		</tr>
		<?php
					}
				} else {
		?>
		<tr>
			<td colspan="5">Không tồn tại dữ liệu nào...</td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>
<?php
	} else {
		redirect(BASE_URL.'portal/dangnhap');
	}
?>