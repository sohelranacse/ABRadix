
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> ORDER</h3>
	</div>
	<div class="panel-body">
		<div role="tabpanel">
			<ul class="nav nav-tabs" role="tablist">
			<?php
				$this->db->where("status","0");
	    		$coustomer_data=$this->db->get("order");
	    		$rowcount = $coustomer_data->num_rows();
	    	?>
				<li role="presentation" class="active"><a href="#pendingorder" aria-controls="home" role="tab" data-toggle="tab">PENDING ORDER <span class="badge"><?php echo $rowcount; ?></span></a></li>
				<li role="presentation"><a href="#all_order" aria-controls="home" role="tab" data-toggle="tab">SUCCESS ORDER</a></li>
			</ul>

			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="pendingorder">
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Invoice No.</th>
									<th>Name</th>
									<th>Email</th>
									<th>Mobile No.</th>
									<th>Address</th>
									<th>Date</th>
									<th>Time</th>
									<th>Status</th>
									<th>Payment</th>
									<th>Create Bill</th>									
									<th>Invoice</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$this->db->select("*");
								$this->db->where("status","0");
								$this->db->order_by("id",'desc');
					    		$coustomer_data=$this->db->get("order");
					    		$i=1;
					    		foreach ($coustomer_data->result_array() as $cous_info) {
					            	$paymentid = $cous_info['id'];
					            	$name = $cous_info['name'];
					            	$email = $cous_info['email'];
					            	$mobile = $cous_info['mobile'];
					            	$address = $cous_info['address'];
					            	$statuss = $cous_info['status'];
					            	$payment = $cous_info['payment'];
					            	if ($statuss==1) {
					            		$status = '<i class="icofont icofont-ui-check"></i>';
					            	}else{
					            		$status = '<i class="icofont icofont-ui-close"></i>';
					            	}
					            	$a_date = $cous_info['added_date'];
			                        $create_date = date_create($a_date);

			                        $added_date = date_format($create_date, 'd-M Y');
			                        $time = date_format($create_date, 'h:i:s A');
					        ?>
					        		<tr class="iddeess<?php echo $paymentid ?>">
										<td><?php echo $paymentid; ?></td>
										<td><?php echo $name; ?></td>
										<td><?php echo $email; ?></td>
										<td><?php echo $mobile; ?></td>
										<td><?php echo $address; ?></td>
										<td><?php echo $added_date; ?></td>
										<td><?php echo $time; ?></td>
										<td><?php echo $payment; ?></td>
										<td><button value="<?php echo $paymentid; ?>" class="btn btn-sm btn-default" onclick="changeOrderStatus(this)"><?php echo $status; ?></button>
										</td>
										<td>
											<button value="<?php echo $paymentid; ?>" onclick="createbill(this)" data-toggle="modal" data-target="#createbillmodal" class="btn btn-sm btn-default">CREATE BILL</button>
										</td>
										<td>
											<a href="<?php echo base_url() ?>main/invoice_all/<?php echo $paymentid ?>" target="_blank" class="btn btn-warning btn-sm">INVOICE</a>
										</td>
										<td>
											<button class="btn btn-sm btn-danger" value="<?php echo $paymentid; ?>" onclick="deletedorder(this)"><i class="icofont icofont-trash"></i></button>
										</td>
									</tr>
							<?php
								}
							?>
							</tbody>
						</table>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="all_order">
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Invoice No.</th>
									<th>Name</th>
									<th>Email</th>
									<th>Mobile Number</th>
									<th>Address</th>
									<th>Date</th>
									<th>Time</th>
									<th>Transection</th>
									<th>Invoice</th>
									<th>Payment</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
							<?php
					    		foreach ($results as $cous_info_p) {
					            	$id = $cous_info_p->id;
					            	$name = $cous_info_p->name;
					            	$email = $cous_info_p->email;
					            	$mobile = $cous_info_p->mobile;
					            	$address = $cous_info_p->address;
					            	$statuss = $cous_info_p->status;
					            	$payment = $cous_info_p->payment;
					            	if ($statuss==1) {
					            		$status = '<i class="icofont icofont-ui-check"></i>';
					            	}else{
					            		$status = '<i class="icofont icofont-ui-close"></i>';
					            	}
					            	$a_date = $cous_info_p->added_date;
			                        $create_date = date_create($a_date);

			                        $added_date = date_format($create_date, 'd-M Y');
			                        $time = date_format($create_date, 'h:i:s A');
					        ?>
					        		<tr class="iddeess<?php echo $id ?>">
										<td>#<?php echo $id; ?></td>
										<td><?php echo $name; ?></td>
										<td><?php echo $email; ?></td>
										<td><?php echo $mobile; ?></td>
										<td><?php echo $address; ?></td>
										<td><?php echo $added_date; ?></td>
										<td><?php echo $time; ?></td>
										<td><?php echo $payment; ?></td>
										<td><a href="<?php echo base_url() ?>main/invoice_all/<?php echo $id ?>" target="_blank" class="btn btn-success btn-sm">INVOICE</a></td>
										<td>
											<button class="btn btn-sm btn-default" disabled><?php echo $status; ?></button>
										</td>
										<td>
											<button class="btn btn-sm btn-danger" value="<?php echo $id; ?>" onclick="deletedorder(this)"><i class="icofont icofont-trash"></i></button>
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
<script>
  $( function() {
    $("#orderr1").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#orderr2").datepicker({ dateFormat: 'yy-mm-dd' });
  } );
</script>
<!-- createbill -->
<div class="modal fade" id="createbillmodal">
	<div class="modal-dialog-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icofont icofont-ui-close"></i></button>
				<h4 class="modal-title">CREATE BILL</h4>
			</div>
			<div class="modal-body">
				<div class="createbillresult"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>