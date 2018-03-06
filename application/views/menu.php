<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> Menu</h3>
	</div>
	<div class="panel-body">
		<div role="tabpanel" class="col-md-6 col-lg-6 col-sm-8 col-xs-12">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#menu" aria-controls="home" role="tab" data-toggle="tab">Menu</a></li>
				<li role="presentation"><a href="#Submenu" aria-controls="tab" role="tab" data-toggle="tab">Submenu</a></li>
			</ul>

			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="menu">
				<form action="<?php echo base_url() ?>home/menuCreate" method="POST" role="form" autocomplete="off">
					<span style="color: red;font-size: 12px;"><?php echo validation_errors();  ?></span>
					<div class="form-group">
						<label for="">Menu title</label>
						<input type="text" class="form-control" name="menu" placeholder="Type Menu Name">
					</div>
					<div class="form-group">
						<label for="">Menu Icon</label> <span style="color: red;font-size: 12px;">* As Example: search (not space)</span>
						<input type="text" class="form-control" name="icon" placeholder="Type Menu Name">
					</div>

					<input type="hidden" name="menuid" value="0">
					<input type="hidden" name="submenu" value="0">
					<input type="hidden" name="sub_link" value="0">
				
					<button type="submit" class="btn btn-info">Add Menu</button>
					
				</form>
				</div>
				<div role="tabpanel" class="tab-pane" id="Submenu">
					<form action="<?php echo base_url() ?>home/subMenuCreate" method="POST" role="form" autocomplete="off">
					<span style="color: red;font-size: 12px;"><?php echo validation_errors();  ?></span>
					<input type="hidden" class="form-control" name="menu" value="0">
					<input type="hidden" class="form-control" name="icon" value="0">

					<div class="form-group">
						<label for="">Menu</label>
						<select name="menuid" class="form-control">
							<option value="">Select Menu</option>
							<?php foreach ($selectMenu as $result) {
								$menuu = $result->menu;
								$menuId = $result->id;
								if (!empty($menuu) || $menuu != 0) {
									echo '<option value="'.$menuId.'">'.$menuu.'</option>';
								}else{
									echo '';
								}
							} ?>

						</select>
					</div>
					<div class="form-group">
						<label for="">Sub Menu Name</label>
						<input type="text" class="form-control" name="submenu" placeholder="Type Sub Menu Name">
					</div>
					<div class="form-group">
						<label for="">Sub Menu Link</label> <span style="color: red;font-size: 12px;">* As Example: add_blogs (not space)</span>
						<input type="text" class="form-control" name="sub_link" placeholder="Type Method Name">
					</div>
					<button type="submit" class="btn btn-info">Add Sub Menu</button>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
