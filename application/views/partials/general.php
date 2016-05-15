<?php
	if(isset($record) && count($record) > 0) {
		foreach($record as $row) {
?>
<div class="custom-header">
  <h5 class="left-align"><i class="tiny material-icons">local_offer</i>&nbsp;<a href="<?php echo BASE_URL.'chi-tiet/'.$row->id_danhMuc.'/'.$row->id; ?>"><?php echo $row->chuDe; ?></a></h5>
  <p class="left-align">
    <span style="font-weight:bold;">Ngày đăng</span>:&nbsp;<i class="tiny material-icons" style="vertical-align:text-bottom;">access_time</i>&nbsp;
    <span style="color:#212121;"><?php echo convert_date($row->createdDate); ?></span>
  </p>
</div>
<div class="card-panel custom-panel col s9">
  <div class="card-image col s3">
    <a href="<?php echo BASE_URL.'chi-tiet/'.$row->id_danhMuc.'/'.$row->id; ?>">
      <img src="<?php echo BASE_URL.$row->hinhAnh; ?>" alt="<?php echo BASE_URL.$row->hinhAnh; ?>" style="width:120px;height:100px;margin-top:5px;">
    </a>
  </div>
  <div class="card-content col s9">
    <span class="black-text text-darken-2" style="text-align:justify;"><?php echo substr($row->noiDung, 0, 250); ?></span>
  </div>
</div>
<div class="clear-fix"></div>
<!--Mobile-->
<div class="card-panel mobile-panel col s12">
	<div class="card-image">
  	<a href="<?php echo BASE_URL.'chi-tiet/'.$row->id_danhMuc.'/'.$row->id; ?>">
      <img src="<?php echo BASE_URL.$row->hinhAnh; ?>" alt="<?php echo BASE_URL.$row->hinhAnh; ?>" style="width:120px;height:100px;margin-top:5px;">
    </a>
  </div>
  <div class="card-content">
		<span class="black-text text-darken-2" style="text-align:justify;"><?php echo substr($row->noiDung, 0, 250); ?></span>
	</div>
</div>
<?php
		}
    echo $this->pagination->create_links();
	} else {
?>
<h6 class="left-align">Chưa có dữ liệu nào...</h6>
<?php
	}
?>