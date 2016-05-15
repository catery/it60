<div class="navbar-fixed">
	<nav class="grey darken-1 z-depth-2" role="navigation">
		<div class="nav-wrapper">
			<a href="<?php echo BASE_URL; ?>" title="<?php echo TITLE_URL; ?>" class="brand-logo" style="margin-left:5px;">
				<img src="<?php echo BASE_URL.'public/icon/IT60logo.png'; ?>"><span>IT60</span>
			</a>
			<!--Mobile/Tablet-->
			<ul id="slide-out" class="side-nav">
				<li class="no-padding"><a href="<?php echo BASE_URL; ?>" title="Trang chủ">&nbsp;Trang chủ</a></li>
				<?php
					$q_mbkc = $this->menu_model->menu_khongcon();
					if($q_mbkc) {
						foreach($q_mbkc as $row_mbkc) {
				?>
				<li class="no-padding"><a href="<?php echo BASE_URL.'bai-viet/'.$row_mbkc->id; ?>" title="<?php echo $row_mbkc->tenMenu; ?>"><?php echo $row_mbkc->tenMenu; ?></a></li>
				<?php
						}
					} else {
						echo '';
					}
					$q_mbcc = $this->menu_model->menu_cocon();
					if($q_mbcc) {
						foreach($q_mbcc as $row_mbcc) {
				?>
				<li class="no-padding">
					<ul class="collapsible collapsible-accordion">
						<li style="margin-left:-6%;">
							<a class="collapsible-header"  title="<?php echo $row_mbcc->tenMenu; ?>"><?php echo $row_mbcc->tenMenu; ?><i class="mdi-navigation-arrow-drop-down right"></i></a>
							<div class="collapsible-body">
								<ul>
				<?php
							$q_mbmnc = $this->menu_model->lay_menucon($row_mbcc->id);
							if($q_mbmnc) {
								foreach($q_mbmnc as $row_mbnc) {
				?>
								<li><a href="<?php echo BASE_URL.'bai-viet/'.$row_mbnc->id; ?>" title="<?php echo $row_mbnc->tenMenu; ?>"><?php echo $row_mbnc->tenMenu; ?></a></li>
				<?php
								}
							} else {
								echo '';
							}
				?>
								</ul>
							</div>
						</li>
					</ul>
				</li>
				<?php
						}
					} else {
						echo '';
					}
				?>
			</ul>
			<!--End Mobile/Tablet-->
			<ul class="right hide-on-med-and-down">
				<li class="no-padding"><a href="<?php echo BASE_URL; ?>" title="Trang chủ">Trang chủ</a></li>
				<?php
					$q_kc = $this->menu_model->menu_khongcon();
					if($q_kc) {
						foreach($q_kc as $row_kc) {
				?>
				<li class="no-padding"><a href="<?php echo BASE_URL.'bai-viet/'.$row_kc->id; ?>" title="<?php echo $row_kc->tenMenu; ?>"><?php echo $row_kc->tenMenu; ?></a></li>
				<?php
						}
					} else {
						echo '';
					}
					$q_cc = $this->menu_model->menu_cocon();
					if($q_cc) {
						$i = 1;
						foreach($q_cc as $row_cc) {
				?>
				<li class="no-padding"><a class="dropdown-button" data-activates="dropdown<?php echo $i; ?>" title="<?php echo $row_cc->tenMenu; ?>"><?php echo $row_cc->tenMenu; ?><i class="mdi-navigation-arrow-drop-down right"></i></a></li>
				<ul id='dropdown<?php echo $i; ?>' class='dropdown-content'>
				<?php
							$q_mnc = $this->menu_model->lay_menucon($row_cc->id);
							if($q_mnc) {
								foreach($q_mnc as $row_mnc) {
				?>
					<li><a href="<?php echo BASE_URL.'bai-viet/'.$row_mnc->id; ?>" title="<?php echo $row_mnc->tenMenu; ?>"><?php echo $row_mnc->tenMenu; ?></a></li>
				<?php
								}
							} else {
								echo '';
							}
				?>
				</ul>
				<?php
							$i++;
						}
					} else {
						echo '';
					}
				?>
			</ul>
			<a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
		</div>
	</nav>
</div>
<script type="text/javascript">
	(function($){ $(function(){ $('.button-collapse').sideNav(); }); })(jQuery);
	$('.dropdown-button').dropdown({
		inDuration: 300,outDuration: 225,constrain_width: true,hover: true,gutter: 0,belowOrigin: true,alignment: 'left'
	});
</script>