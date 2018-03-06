<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> Contact us</h3>
	</div>
	<div class="panel-body">
		<div role="tabpanel">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#all_coustomer" aria-controls="home" role="tab" data-toggle="tab">All Contacts</a></li>
				
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
									<th>Subject</th>
									<th>Message</th>
									<th>Date</th>
									<th>Reply</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$this->db->select("*");
								$this->db->order_by("id",'desc');
					    		$coustomer_data=$this->db->get("contact");
					    		$i=1;
					    		foreach ($coustomer_data->result_array() as $cous_info) {
					            	$id = $cous_info['id'];
					            	$name = $cous_info['name'];
					            	$email = $cous_info['email'];
					            	$subject = $cous_info['subject'];
					            	$message = $cous_info['message'];

					            	$a_date = $cous_info['added_date'];
			                        $create_date = date_create($a_date);
			                        $added_date = date_format($create_date, 'd-M Y, h:m:sA');
					        ?>
					        <tr id="delc<?php echo $id; ?>">
										<td><?php echo $i++; ?></td>
										<td><?php echo $name; ?></td>
										<td><?php echo $email; ?></td>
										<td><?php echo $subject; ?></td>
										<td><?php echo $message; ?></td>
										<td><?php echo $added_date; ?></td>
										<td>
											<button class="btn btn-sm btn-success" value="<?php echo $id; ?>" onclick="editcontact(this)" data-target="#editcontact" data-toggle="modal"><i class="icofont icofont-undo"></i></button>
										</td>
										<td>
											<button class="btn btn-sm btn-danger" value="<?php echo $id; ?>" onclick="delcontact(this)"><i class="icofont icofont-trash"></i></button>
										</td>
									</tr>
							<?php
								}
							?>
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="editcontact">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icofont icofont-ui-close"></i></button>
				<h4 class="modal-title">Reply Message</h4>
			</div>
			<div class="modal-body" id="replymessage">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>