<?php 
	if (isset($_SESSION['email'])){
		$email = $_SESSION['email'];
		$this->db->where('email',$email);
		$cous_info=$this->db->get("coustomer");
		foreach ($cous_info->result_array() as $cousProfile) {
			$cousid = $cousProfile['id'];
			$cousname = $cousProfile['name'];
			$cousemail = $cousProfile['email'];
			$cousmobile = $cousProfile['mobile'];
			$cousaddress = $cousProfile['address'];

			$cousaddress2 = $cousProfile['address2'];
			$couszip = $cousProfile['zip'];
			$couscity = $cousProfile['city'];


			$a_date = $cousProfile['added_date'];
            $create_date = date_create($a_date);

            $added_date = date_format($create_date, 'd-M Y');
            $time = date_format($create_date, 'h:i:s A');
?>
<div class="container paddingzero" style="font-family: "Raleway",sans-serif !important";>
	<div class="panel panel-default" style="margin:30px 0">
		<div class="panel-heading">
			<h3 class="panel-title"><b>PROFILE</b> &nbsp; <i class="fa fa-angle-right"></i>&nbsp; <?php echo $cousname; ?></h3>
		</div>
		<div class="panel-body">
			<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
				<div class="profile_left">
					<h4 class="text-center"><i class="fa fa-user"></i> <?php echo $cousname; ?></h4>
					<ul class="list-group">
						<li class="list-group-item"><i class="fa fa-user"></i> <a href="<?php echo base_url() ?>main/profile">Profile</a></li>
						<li class="list-group-item"><i class="fa fa-edit"></i> <a href="<?php echo base_url() ?>main/edit_profile">Edit Profile</a></li>
						<li class="list-group-item"><i class="fa fa-key"></i> <a href="<?php echo base_url() ?>main/change_pass">Change Password</a></li>
						<li class="list-group-item"><i class="fa fa-cog"></i> <a href="<?php echo base_url() ?>main/order">Orders</a></li>
					</ul>
				</div>
			</div>


			<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12" style="padding-top: 30px">
				<?php if (isset($profile)) { ?>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<tbody>
							<tr>
								<th width="50%">Name</th>
								<td><?php echo $cousname; ?></td>
							</tr>
							<tr>
								<th>Email</th>
								<td><?php echo $cousemail; ?></td>
							</tr>
							<tr>
								<th>Mobile</th>
								<td><?php echo $cousmobile; ?></td>
							</tr>
							<tr>
								<th>Address 1</th>
								<td><?php echo $cousaddress; ?></td>
							</tr>

							<tr>
								<th>Address 2</th>
								<td><?php echo $cousaddress2; ?></td>
							</tr>

							<tr>
								<th>ZIP</th>
								<td><?php echo $couszip; ?></td>
							</tr>
							
							<tr>
								<th>City</th>
								<td><?php echo $couscity; ?></td>
							</tr>

							<tr>
								<th>Date</th>
								<td><?php echo $added_date; ?></td>
							</tr>

							<tr>
								<th>Time</th>
								<td><?php echo $time; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<?php } ?>
				<?php if (isset($edit_profile)) { ?>
					<form action="<?php echo base_url() ?>main/update_profile" method="POST">
						<span style="color: red;font-size: 12px;"><?php echo validation_errors();  ?></span>
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Full Name</label>
								<input type="hidden" name="ide" value="<?php echo $cousid; ?>">
								<input type="text" class="form-control" name="namee" value="<?php echo $cousname; ?>">
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="text" class="form-control" name="emaile" value="<?php echo $cousemail; ?>">
							</div>
							<div class="form-group">
								<label for="name">Mobile Number</label>
								<input type="text" class="form-control" name="mobilee" value="<?php echo $cousmobile; ?>">
							</div>
							<div class="form-group">
								<label for="name">City/District</label>
								<input type="text" class="form-control" name="citye" value="<?php echo $couscity; ?>">
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-success">UPDATE</button>
							</div>
						</div>
						<div class="col-md-6">
							
							<div class="form-group">
								<label for="name">Address 1</label>
								<input type="text" class="form-control" name="addresse" value="<?php echo $cousaddress; ?>">
							</div>
							<div class="form-group">
								<label for="name">Address 2</label>
								<input type="text" class="form-control" name="address2e" value="<?php echo $cousaddress2; ?>">
							</div>
							<div class="form-group">
								<label for="name">ZIP</label>
								<input type="text" class="form-control" name="zipe" value="<?php echo $couszip; ?>">
							</div>

						</div>
					</form>
				<?php } ?>
				<?php if (isset($change_pass)) { ?>
					<form action="<?php echo base_url() ?>main/change_password" method="POST">
						<span style="color: red;font-size: 12px;"><?php echo validation_errors();  ?></span>
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Old Password</label>
								<input type="hidden" name="id" value="<?php echo $cousid; ?>">
								<input type="text" class="form-control" name="password" placeholder="Type Old Password">
							</div>
							<div class="form-group">
								<label for="email">New password</label>
								<input type="text" class="form-control" name="npass" placeholder="Type New Password">
							</div>

							<div class="form-group">
								<label for="name">Confirm Password</label>
								<input type="text" class="form-control" name="ncpass" placeholder="Type Confirm Password">
							</div>
							
							<div class="form-group">
								<button type="submit" class="btn btn-success">CHANGE</button>
							</div>
						</div>
					</form>
				<?php } ?>
				<?php if (isset($order)) { ?>
					<div role="tabpanel">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#ordercurrent" aria-controls="home" role="tab" data-toggle="tab">PENDING ORDER</a>
							</li>
							<li role="presentation">
								<a href="#allorder" aria-controls="tab" role="tab" data-toggle="tab">ALL ORDER</a>
							</li>
						</ul>
					
						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="ordercurrent">
								<div class="table-responsive">
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>SL</th>
												<th>Date</th>
												<th>Time</th>
												<th>Invoice</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$this->db->where('email',$email);
										$this->db->where('status',0);
										$this->db->order_by('id','desc');
										$order_info=$this->db->get("order");
										$i = 1;
										foreach ($order_info->result_array() as $orderPen) {
											$invoiceid = $orderPen['id'];


											$o_date = $orderPen['added_date'];
								            $create_date_o = date_create($o_date);

								            $o_date = date_format($create_date_o, 'd-M Y');
								            $O_time = date_format($create_date_o, 'h:i:s A');
										?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo $o_date; ?></td>
												<td><?php echo $O_time; ?></td>
												<td><a href="<?php echo base_url() ?>main/invoice_all/<?php echo $invoiceid ?>" target="_blank" class="btn btn-info btn-sm">INVOICE</a></td>
												<td><button type="button" class="btn btn-danger btn-sm" disabled>PENDING</button></td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="allorder">
								<div class="table-responsive">
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>SL</th>
												<th>Date</th>
												<th>Time</th>
												<th>Invoice</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
										<?php 

										$this->db->where('email',$email);
										$this->db->where('status',1);
										$this->db->order_by('id','desc');
										$order_info=$this->db->get("order");
										$i = 1;
										foreach ($order_info->result_array() as $orderPen) {
											$invoiceid = $orderPen['id'];


											$o_date = $orderPen['added_date'];
								            $create_date_o = date_create($o_date);

								            $o_date = date_format($create_date_o, 'd-M Y');
								            $O_time = date_format($create_date_o, 'h:i:s A');
										?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo $o_date; ?></td>
												<td><?php echo $O_time; ?></td>
												<td><a href="<?php echo base_url() ?>main/invoice_all/<?php echo $invoiceid ?>" target="_blank" class="btn btn-info btn-sm">INVOICE</a></td>
												<td><button type="button" class="btn btn-sm btn-default" disabled>SUCCESS</button></td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>



				
				


			</div>


		</div>
	</div>
</div>


<?php }} else{
redirect('main');
} ?>