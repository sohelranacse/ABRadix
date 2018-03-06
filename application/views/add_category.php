<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> Category </h3>
	</div>
	<div class="panel-body">
		<div role="tabpanel" class="col-md-6 col-lg-6 col-sm-8 col-xs-12">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#menu" aria-controls="home" role="tab" data-toggle="tab">Add Category</a></li>
				<li role="presentation"><a href="#Submenu" aria-controls="tab" role="tab" data-toggle="tab">Add Subcategory</a></li>
			</ul>

			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="menu">
				<form action="<?php echo base_url() ?>home/categoryCreate" method="POST" role="form" autocomplete="off">
					<span style="color: red;font-size: 12px;"><?php echo validation_errors();  ?></span>
					<div class="form-group">
						<label for="">Category Name</label>
						<input type="text" class="form-control" name="menu" placeholder="Type Category Name">
					</div>
					

					<input type="hidden" name="menuid" value="0">
					<input type="hidden" name="submenu" value="0">
					<input type="hidden" name="hp" value="1">
					<input type="hidden" name="hpp" value="1">
				
					<button type="submit" class="btn btn-info">Add Category</button>
					
				</form>
				</div>
				<div role="tabpanel" class="tab-pane" id="Submenu">
					<form action="<?php echo base_url() ?>home/subcatCreate" method="POST" role="form" autocomplete="off">
					<span style="color: red;font-size: 12px;"><?php echo validation_errors();  ?></span>
					<input type="hidden" class="form-control" name="menu" value="0">

					<div class="form-group">
						<label for="">Menu</label>
						<select name="menuid" class="form-control">
							<option value="">Select Menu</option>
							<?php
								$this->db->select("*");
								$this->db->order_by("id",'desc');
					    		$category_info=$this->db->get("category");
					    		foreach ($category_info->result_array() as $category_info_all) {
					            	$id = $category_info_all['id'];
					            	$menu = $category_info_all['menu'];
									if (!empty($menu) || $menu != 0) {
										echo '<option value="'.$id.'">'.$menu.'</option>';
									}else{
										echo '';
									}
								}
							?>

						</select>
					</div>
					<div class="form-group">
						<label for="">Sub Menu Category</label>
						<input type="text" class="form-control" name="submenu" placeholder="Type Sub Category Name">
					</div>
					<button type="submit" class="btn btn-info">Add Sub Category</button>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
