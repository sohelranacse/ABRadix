<?php
$sid = Session_id();

$this->db->where('sesid',$sid);
$cart_info = $this->db->get('cart');
foreach ($cart_info->result_array() as $cart_details) {
    $ssid = $cart_details['sesid'];
}

if ($ssid) {
?>
<div class="container paddingzero" style="font-family: "Raleway",sans-serif !important";>
	<div class="panel panel-primary" style="border-radius: 0">
		<div class="panel-heading">
			<h3 class="panel-title">Order List</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr class="info">
							<th>SL</th>
							<th>Image</th>
		    				<th>Name</th>
		    				<th>Quantity</th>
		    				<th>Price</th>
		    				<th>Total Price</th>
		    				<th>Size</th>
		    				<th>Color</th>
		    				<th>Dated</th>
		    				<th>Time</th>
		    				<th>Cancel</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=1;
							$sum = 0;
		        			$qty = 0;

		    				$sesid = Session_id();
		    				$this->db->where("sesid",$sesid);
		    				$this->db->order_by("id",'desc');
					        $pro_info=$this->db->get("cart");
					        foreach ($pro_info->result_array() as $pro_all) {
					            $id = $pro_all['id'];
					            $pid = $pro_all['pid'];
					            $name = $pro_all['name'];
					            $quantity = $pro_all['quantity'];
					            $price = $pro_all['price'];
					            $pricee = $pro_all['total'];
					            $size = $pro_all['size'];
					            $color = $pro_all['color'];



					            $a_date = $pro_all['added_date'];
		                        $create_date = date_create($a_date);

		                        $added_date = date_format($create_date, 'd-M Y');
		                        $time = date_format($create_date, 'h:i:s A');
		                        if ($quantity==0) {
		                        	$this->db->where('id',$id);  
        							$this->db->delete('cart');
		                        }
		                        if ($quantity>=1) {
		    			?>
							<tr id="<?php echo $id; ?>del">
								<td><?php echo $i++; ?></td>
								<td><img width="60" src="<?php echo base_url() ?>assest/images/product/<?php echo $pid; ?>.jpg" onerror="this.src='<?php echo base_url(); ?>assest/images/product/alt.jpg'"; style="height:60px !important;"></td>
			    				<td><?php echo $name; ?></td>
			    				<td>

									<button class="btn btn-default" disabled><b><?php echo $quantity; ?></b></button>
			    					
			    				</td>
			    				
			    				<td><b><?php echo $price; ?></b>Tk.</td>
			    				<td><b><?php echo $pricee; ?></b>Tk.</td>
			    				<td><?php echo $size; ?></td>
			    				<td><?php echo $color; ?></td>
			    				<td><?php echo $added_date; ?></td>
			    				<td><?php echo $time; ?></td>
			    				<td class="text-center"><button class="btn btn-sm btn-danger" value="<?php echo $id; ?>" onclick="deleteorderlist(this)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>
							</tr>
						<?php
		                    $qty = $qty + $quantity;
		                    $sum = $sum+$pricee;
		                }}
		                $this->db->where('id',1);
		                $setting = $this->db->get('setting');
		                foreach ($setting->result_array() as $setting_vat) {
		                    $vatdata = $setting_vat['vat'];
		                }
		                $vat = $vatdata/100;

		                $vatadd = $sum*$vat;

		                $gTottal = $sum + $vatadd;
						?>
						<tr class="info">
							<th class="text-right" colspan="5">Sub Total</th>
							<td><?php echo $sum; ?>Tk.</td>
		    			</tr>
		    			<tr class="success">
							<th class="text-right" colspan="5">Vat</th>
							<td><?php echo $vatdata;?>% (<?php echo $vatadd;?>Tk.)</td>
		    			</tr>
		    			<tr class="info">
							<th class="text-right" colspan="5">Total</th>
							<td><?php echo $gTottal;?>Tk.</td>
		    			</tr>
		    			<tr class="default">
							<th colspan="3"><a href="<?php echo base_url(); ?>" target="_blank" class="btn btn-default btn-sm">CONTINUE SHOPPING</a></th>
							<td colspan="3" class="text-right">
								<a href="#ordercreateacc"  data-toggle="collapse" class="btn btn-info btn-sm">ORDER NOW</a>
							</td>
		    			</tr>
					</tbody>
				</table>
			</div>
			<div id="ordercreateacc" class="collapse" >
				<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 logsign">
				

					<h4>You can create new address, then confirm your order.</h4>
					<div class="seperator-hr"></div>
					<form action="<?php echo base_url() ?>main/submitorder/<?php echo Session_id(); ?>" method="POST" role="form">
					
						<div class="form-group">
							<label for="">Full Name</label>
							<input type="text" class="form-control" name="name" placeholder="Enter Full Name">
						</div>
						<div class="form-group">
							<label for="">Email</label>
							<input type="email" class="form-control" name="email" placeholder="Enter E-mail">
						</div>
						<div class="form-group">
							<label for="">Mobile Number</label>
							<input type="text" class="form-control" name="mobile" placeholder="Enter Mobile Number">
						</div>

						<div class="form-group">
							<label for="">Address 1</label>
							<input type="text" class="form-control" name="address" placeholder="Enter Address 1">
						</div>
						<div class="form-group">
							<label for="">Address 2</label>
							<input type="text" class="form-control" name="address2" placeholder="Enter Address 2">
						</div>
						<div class="form-group">
							<label for="">ZIP Code</label>
							<input type="text" class="form-control" name="zip" placeholder="Enter ZIP">
						</div>
						<div class="form-group">
							<label for="">City</label>
							<input type="text" class="form-control" name="city" placeholder="Enter City">
						</div>
					
						<button type="submit" class="btn btn-info">ORDER</button>
					</form>
				</div>


				<div class="col-md-offset-1 col-md-5 col-lg-5 col-sm-5 col-xs-12 logsign">
					<?php
					if (isset($_SESSION['email'])){
						$email = $_SESSION['email'];
						$session_id = Session_id();

						$this->db->where('email',$email);
				        $order_profiile = $this->db->get('coustomer');
				        foreach ($order_profiile->result_array() as $profile_info) {
				            $cousId = $profile_info['id'];
				            $name = $profile_info['name'];
				            $email = $profile_info['email'];
				            $mobile = $profile_info['mobile'];
				            $address = $profile_info['address'];

				            $address2 = $profile_info['address2'];
				            $zip = $profile_info['zip'];
				            $city = $profile_info['city'];
				        
				        	if ($cousId) {

					?>
							<div class="prevacc">
								<h3>Your Current Account</h3>
								<div class="seperator-hr"></div>
								<form action="<?php echo base_url() ?>main/submitorder/<?php echo Session_id(); ?>" method="POST" role="form">
									<input type="hidden" name="name" value="<?php echo $name; ?>">
									<input type="hidden" name="email" value="<?php echo $email; ?>">
									<input type="hidden" name="mobile" value="<?php echo $mobile; ?>">
									<input type="hidden" name="address" value="<?php echo $address; ?>">

									<input type="hidden" name="address2" value="<?php echo $address2; ?>">
									<input type="hidden" name="zip" value="<?php echo $zip; ?>">
									<input type="hidden" name="city" value="<?php echo $city; ?>">
									<br>
									<button type="submit" class="btn btn-lg btn-info">CONTINUE</button>
								</form>
							</div>
					<?php }}} ?>
				</div>



				


			</div>
		</div>
	</div>
</div>

<?php }
else{
	redirect('main');
}
?>