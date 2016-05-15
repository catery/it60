<?php
	if(isset($_GET['s'])) {
		if(isset($record) && count($record) > 0) {
			foreach($record as $row_srch) {
?>
<div class="custom-header">
	<h5 class="left-align"><i class="tiny material-icons">local_offer</i>&nbsp;<a href="<?php echo BASE_URL.'chi-tiet/'.$row_srch->id_danhMuc.'/'.$row_srch->id; ?>"><?php echo $row_srch->chuDe; ?></a></h5>
	<p class="left-align">Ngày đăng: <span style="color:#212121;"><?php echo convert_date($row_srch->createdDate); ?></span></p>
</div>
<div class="card-panel custom-panel col s9">
	<div class="card-image col s3">
		<a href="<?php echo BASE_URL.'chi-tiet/'.$row_srch->id_danhMuc.'/'.$row_srch->id; ?>">
			<img src="<?php echo BASE_URL.$row_srch->hinhAnh; ?>" alt="<?php echo BASE_URL.$row_srch->hinhAnh; ?>" style="width:120px;height:100px;margin-top:5px;">
		</a>
	</div>
	<div class="card-content col s9">
		<span class="black-text text-darken-2" style="text-align:justify;"><?php echo substr($row_srch->noiDung, 0, 250); ?></span>
	</div>
</div>
<div class="clear-fix"></div>
<!--Mobile-->
<div class="card-panel mobile-panel col s12">
	<div class="card-image">
		<a href="<?php echo BASE_URL.'chi-tiet/'.$row_srch->id_danhMuc.'/'.$row_srch->id; ?>">
			<img src="<?php echo BASE_URL.$row_srch->hinhAnh; ?>" alt="<?php echo BASE_URL.$row_srch->hinhAnh; ?>" style="width:120px;height:100px;margin-top:5px;">
		</a>
	</div>
	<div class="card-content">
		<span class="black-text text-darken-2" style="text-align:justify;"><?php echo substr($row_srch->noiDung, 0, 250); ?></span>
	</div>
</div>
<?php
			}
		echo $this->pagination->create_links();
		} else {
?>
<p class="center-align" style="color:#d32f2f;font-weight:bold;">Không tìm thấy từ khóa: <?php echo '[&nbsp;'.$_GET['s'].'&nbsp;]'; ?></p>
<?php
		}
	} else {
		$bv_dm = $this->baiviet_model->layma_danhmuc();
		if($bv_dm) {
			foreach($bv_dm as $row_bvdm) {
				$menu = $this->menu_model->laymenu_trangchu($row_bvdm->id_danhMuc);
				if($menu) {
					foreach($menu as $row_menu) {
?>
<div class="card darken-1 z-depth-1 tcard">
	<div class="grey darken-2 custom-title z-depth-1">
		<a href="<?php echo BASE_URL.'bai-viet/'.$row_menu->id; ?>" title="<?php echo $row_menu->tenMenu; ?>"><i class="material-icons" style="vertical-align:middle;">send</i>&nbsp;<?php echo $row_menu->tenMenu; ?></a>
	</div>
	<div>
		<div class="row custom-pixel">
			<div class="col s12">
<?php
						$baiviet = $this->baiviet_model->danhsach_khongtheoma($row_menu->id);
						if($baiviet) {
							foreach($baiviet as $row_bv) {
?>
				<div class="card custom-card">
					<div class="card-image">
						<a href="<?php echo BASE_URL.'chi-tiet/'.$row_bv->id_danhMuc.'/'.$row_bv->id; ?>" title="<?php echo $row_bv->chuDe; ?>">
							<img src="<?php echo $row_bv->hinhAnh; ?>" alt="<?php echo TITLE_URL; ?>">
						</a>
					</div>
					<div class="card-action">
						<h6 style="text-align:center;">
							<a href="<?php echo BASE_URL.'chi-tiet/'.$row_bv->id_danhMuc.'/'.$row_bv->id; ?>" title="<?php echo $row_bv->chuDe; ?>" style="color:#000000;text-transform:none;">
								<?php echo $row_bv->chuDe; ?>
							</a>
						</h6>
					</div>
				</div>
<?php
							}
?>
			</div>
		</div>
<!--Mobile-->
<?php
							$baiviet_mb = $this->baiviet_model->danhsach_khongtheoma($row_menu->id);
							if($baiviet_mb) {
								foreach($baiviet_mb as $row_mbv) {
?>
		<div class="row">
			<div class="custom-mpixel">
				<div class="card">
					<div class="cus-img">
						<a href="<?php echo BASE_URL.'chi-tiet/'.$row_mbv->id_danhMuc.'/'.$row_mbv->id; ?>" title="<?php echo $row_mbv->chuDe; ?>">
							<img src="<?php echo $row_mbv->hinhAnh; ?>" alt="<?php echo TITLE_URL; ?>">
						</a>
					</div>
					<div class="card-action">
						<h6 style="text-align:center;">
							<a href="<?php echo BASE_URL.'chi-tiet/'.$row_mbv->id_danhMuc.'/'.$row_mbv->id; ?>" title="<?php echo $row_mbv->chuDe; ?>" style="color:#000000;text-transform:none;">
								<?php echo $row_mbv->chuDe; ?>
							</a>
						</h6>
					</div>
				</div>
			</div>
		</div>
<?php
								}
							} else {
								echo '';
							}
						} else {
							echo '';
						}
?>
	</div>
</div>
<?php
					}
				} else {
					echo '';
				}
			}
		} else {
			echo '';
		}
	}
?>