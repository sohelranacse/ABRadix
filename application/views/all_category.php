<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a>  All Category</h3>
	</div>
	<div class="panel-body">
		<div role="tabpanel" class="col-md-8 col-lg-8 col-sm-8 col-xs-12">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#menu" aria-controls="home" role="tab" data-toggle="tab">Main Category</a></li>
				<li role="presentation"><a href="#Submenu" aria-controls="tab" role="tab" data-toggle="tab">All Subcategory</a></li>
			</ul>

			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="menu">
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>SL</th>
									<th>Category Name</th>
									<th>HP Menu</th>
									<th>HP Panel</th>
									<th>Update</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$this->db->select("*");
								$this->db->order_by("id",'desc');
					    		$category_info=$this->db->get("category");
					    		$i=1;
					    		foreach ($category_info->result_array() as $category_info_all) {
					            	$id = $category_info_all['id'];
					            	$category = $category_info_all['menu'];
					            	$hp = $category_info_all['hps'];
					            	$hpp = $category_info_all['hpp'];
					            	if ($hp==1) {
					            		$hpshow = '<i class="icofont icofont-ui-check"></i>';
					            	}else{
					            		$hpshow = '<i class="icofont icofont-ui-close"></i>';
					            	}
					            	if ($hpp==1) {
					            		$hppshow = '<i class="icofont icofont-ui-check"></i>';
					            	}else{
					            		$hppshow = '<i class="icofont icofont-ui-close"></i>';
					            	}
									if (!empty($category) || $category != 0) {
							?>

									
									<tr>
										<td><?php echo $i++; ?></td>
										<td id="catid<?php echo $id; ?>"><?php echo $category; ?></td>
										<td><button value="<?php echo $id; ?>" class="btn btn-sm btn-default" onclick="changecathp(this)"><?php echo $hpshow; ?></button>
										</td>
										<td><button value="<?php echo $id; ?>" class="btn btn-sm btn-default" onclick="changecathpp(this)"><?php echo $hppshow; ?></button>
										</td>
										<td>
											<button class="btn btn-sm btn-info" value="<?php echo $id; ?>" data-toggle="modal" data-target="#editcategory" onclick="editcategories(this)"><i class="icofont icofont-edit"></i></button>
										</td>

									</tr>
							<?php		

									}
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="Submenu">
					<div class="form-group col-md-10">
						<label for="">Category</label>
						<select id="allsubcategory_menuid" class="form-control">
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
					<div class="form-group  col-md-2" style="padding-top: 25px">
						<button class="btn btn-default" onclick="allsubcategory()"><i class="icofont icofont-search"></i></button>
					</div>
					
					<div id="allsubcategory_show"></div>

				</div>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="editcategory">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icofont icofont-close"></i></button>
				<h4 class="modal-title">Category Update</h4>
			</div>
			<div class="modal-body" id="showcategoryup">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>