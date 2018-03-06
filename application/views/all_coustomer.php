<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> Coustomer</h3>
	</div>
	<div class="panel-body">
		<div role="tabpanel">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#all_coustomer" aria-controls="home" role="tab" data-toggle="tab">All Coustomer</a></li>
				
			</ul>

			<div class="tab-content">

				<div role="tabpanel" class="tab-pane active" id="all_coustomer">
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>SL</th>
									<th>Name</th>
									<th>Email</th>
									<th>Mobile Number</th>
									<th>Address</th>
									<th width="200">Join Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php								
					    		$i=1;
					    		foreach ($results as $cous_info) {
					            	$id = $cous_info->id;
					            	$name = $cous_info->name;
					            	$email = $cous_info->email;
					            	$mobile = $cous_info->mobile;
					            	$address = $cous_info->address;
					            	$statuss = $cous_info->status;
					            	if ($statuss==1) {
					            		$status = '<i class="icofont icofont-ui-check"></i>';
					            	}else{
					            		$status = '<i class="icofont icofont-ui-close"></i>';
					            	}
					            	$a_date = $cous_info->added_date;
			                        $create_date = date_create($a_date);
			                        $added_date = date_format($create_date, 'd-M Y, h:m:sA');
					        ?>
					        <tr id="<?php echo $id; ?>delco">
										<td><?php echo $i++; ?></td>
										<td><?php echo $name; ?></td>
										<td><?php echo $email; ?></td>
										<td><?php echo $mobile; ?></td>
										<td><?php echo $address; ?></td>
										<td><?php echo $added_date; ?></td>
										<td><button value="<?php echo $id; ?>" class="btn btn-sm btn-default" onclick="changeCoustomerStatus(this)"><?php echo $status; ?></button>
										</td>
										<td>
											<button class="btn btn-sm btn-danger" value="<?php echo $id; ?>" onclick="delcoustomer(this)"><i class="icofont icofont-trash"></i></button>
										</td>
									</tr>
							<?php
								}
							?>
							</tbody>
						</table>
					</div>
					<?php echo $links; ?>
				</div>
			</div>
		</div>
	</div>
</div>