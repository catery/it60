<?php
	if($this->session->userdata('isLogged') == true) {
		if($this->session->flashdata('SuccessPass')) {
?>
		<script type="text/javascript">
			$(document).ready(function(){
				NotifySuccess('Đổi mật khẩu thành công');
			});
			Location('portal/dangnhap');
		</script>
<?php
		}
		if($this->session->flashdata('flashErrorPass')) {
?>
		<script type="text/javascript">
			$(document).ready(function(){
				NotifyError('Tài khoản không tồn tại');
			});
		</script>
<?php
		}
		if($this->session->flashdata('ErrorPass')) {
?>
		<script type="text/javascript">
			$(document).ready(function(){
				NotifyError('Đổi mật khẩu thất bại');
			});
		</script>
<?php
		}
		if($this->session->flashdata('Success')) {
?>
		<script type="text/javascript">
			$(document).ready(function(){
				NotifySuccess('Xóa thành công');
			});
		</script>
<?php
		}
		if($this->session->flashdata('ErrorExist')) {
?>
		<script type="text/javascript">
			$(document).ready(function(){
				NotifyError('Vui lòng xóa danh mục cha trước');
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
<a href="portal/taomoi_danhmuc" class="waves-effect waves-light btn">Thêm mới<i class="material-icons right">add_circle_outline</i></a>
<a href="portal/chude_danhmuc" class="waves-effect waves-light btn">Làm mới<i class="material-icons right">loop</i></a>
<?php
		if (isset($record) && count($record) > 0) {
			echo $this->pagination->create_links();
		}
		if (isset($record) && count($record) > 0) {
?>
<ul class="collapsible" data-collapsible="accordion">
<?php
			$i=1;
			foreach($record as $row){
?>
    <li>
      	<div class="collapsible-header">
      		<div class="col s9">
      			<i class="material-icons">subject</i><?php echo $row->tenMenu; ?>
      		</div>
<?php
				if($row->menuCha == "") {
?>
			<div class="col s3">
      			<a href="portal/capnhat_danhmuc/<?=$row->id?>" title="Hiệu chỉnh"><i class="material-icons">mode_edit</i></a>&nbsp;
            	<a class="modal-trigger" title="Xóa" href="#modal<?php echo $i; ?>"><i class="material-icons">delete</i></a>
      		</div>
<?php
				}
?>
			<div id="modal<?php echo $i; ?>" class="modal">
				<div class="modal-content">
					<center><p><h5 style="color:#d32f2f;">Bạn chắc muốn xóa [&nbsp;<?php echo isset($row->tenMenu) ? $row->tenMenu : ''; ?>&nbsp;]?</h5></p></center>
				</div>
				<div class="modal-footer">
					<a class="modal-close waves-effect waves-green btn-flat">Thoát</a>
					<a href="portal/xoatoan_danhmuc/<?=$row->id?>" class="modal-action modal-close waves-effect waves-green btn-flat">Đồng ý</a>
				</div>
			</div>
      	</div>
      	<div class="collapsible-body">
<?php
				$menu_con = $this->menu_model->lay_menucon($row->id);
				if($menu_con) {
					foreach($menu_con as $row_con) {
?>
			<ul class="collection">
				<li class="collection-item">
					<div class="col s9">
						<a href="portal/capnhat_danhmuc/<?=$row_con->id?>" class="collection-item">
							<i class="material-icons" style="vertical-align:top;margin-right:10px;">label_outline</i><?php echo $row_con->tenMenu; ?>
						</a>
					</div>
					<div class="col s3">
						<a class="modal-trigger" title="Xóa" href="#modal<?=$row_con->id?>"><i class="material-icons">delete</i></a>
					</div>
					<div id="modal<?=$row_con->id?>" class="modal">
						<div class="modal-content">
							<center><p><h5 style="color:#d32f2f;">Bạn chắc muốn xóa [&nbsp;<?php echo isset($row_con->tenMenu) ? $row_con->tenMenu : ''; ?>&nbsp;]?</h5></p></center>
						</div>
						<div class="modal-footer">
							<a class="modal-close waves-effect waves-green btn-flat">Thoát</a>
							<a href="portal/xoa_danhmuc/<?=$row_con->id?>" class="modal-action modal-close waves-effect waves-green btn-flat">Đồng ý</a>
						</div>
					</div>
				</li>
      		</ul>
<?php
					}
				} else {
					echo '';
				}
?>
     	</div>
    </li>
<?php
				$i++;
			}
?>
</ul>
<?php
		} else {
?>
<div>
    <h5 class="left-align">Không có dữ liệu nào...</h5>
</div>
<?php
		}
	} else {
		redirect(BASE_URL.'portal/dangnhap');
	}
?>