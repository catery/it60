<div class="custom-header">
	<h5 class="left-align" style="font-weight:bold;color:#303f9f;"><?php echo wordwrap($record['chuDe'],110,"<br/>"); ?></h5>
	<p class="left-align">
		<span style="font-weight:bold;">Ngày đăng</span>:&nbsp;<i class="tiny material-icons" style="vertical-align:text-bottom;">access_time</i>&nbsp;
		<span style="color:#212121;"><?php echo convert_date($record['createdDate']); ?></span>
	</p>
</div>
<div class="custom-detail z-depth-1">
	<?php echo $record['noiDung']; ?>
</div>
<?php
	if($record['tapTin'] == '') {
		echo '';
	} else {
?>
<p class="left-align">Tải file về: <a href="<?php echo BASE_URL.$record['tapTin']; ?>"><i class="small material-icons">file_download</i></a></p>
<?php
	}
?>