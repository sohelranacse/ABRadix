<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo base_url() ?>web/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url() ?>web/css/normalize.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>web/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>web/style.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>web/responsive.css">
    <script src="<?php echo base_url() ?>web/js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>
<?php if (isset($invoiceid)) { ?>
<div class="container paddingzero" style="font-family: Raleway,sans-serif;">
	<div class="panel panel-default" style="margin:30px 0">
		<div class="panel-heading">
			<h3 class="panel-title">INVOICE</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
				<div class="invoicehead">
					<ul>
					<?php

					$this->db->where('id',$invoiceid);
					$order_profiile = $this->db->get('order');
					foreach ($order_profiile->result_array() as $profile_info) {
		    			$invoiceid = $profile_info['id'];
		    			$payment = $profile_info['payment'];

		    			$create_by = $profile_info['create_by'];

		    			$a_date = $profile_info['added_date'];
		                $create_date = date_create($a_date);
		                $added_date = date_format($create_date, 'd-M Y');
		                $time = date_format($create_date, 'h:i:s A');

		                $name = $profile_info['name'];
		    			$email = $profile_info['email'];
		    			$mobile = $profile_info['mobile'];
		    			$address = $profile_info['address'];

		    			$address2 = $profile_info['address2'];
		    			$city = $profile_info['city'];
		    			$zip = $profile_info['zip'];
					?>
						<li><h4><b>Invoice No. #<?php echo $invoiceid; ?></b></h4></li>
						<li>Invoice Date: <?php echo $added_date.', '.$time; ?></li>
						<li>Transaction: <?php echo $payment; ?></li>
					<?php } ?>
					</ul>
				</div>

				<div class="invoicehead">
					<ul>
						<li><h4><b>Invoice To</b></h4></li>
						<li><?php echo $name; ?></li>
						<li><?php echo $mobile; ?></li>
						<li><?php echo $email; ?></li>
						<li><?php echo $address.', '.$address2.', '.$city.' - '.$zip; ?></li>
					</ul>
				</div>
			</div>
			<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 text-right">
				<div class="invoicehead">
					<ul>
						<li><h4><b>Company Name</b></h4></li>
						<li>1/0 South Sugondha, Muradpur</li>
						<li>Chittagong, 3209.</li>
						<li>Bangladesh</li>
						<li>01866622233</li>
						<li>-------------</li>
					</ul>
				</div>
			</div>
			


			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>SL</th>
							<th>Image</th>
							<th>Name</th>
							<th>Color</th>
							<th>Size</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Total Price</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$i=1;
						$sum = 0;
	        			$qty = 0;

	    				$this->db->where("orderid",$invoiceid);
	    				$this->db->where("status",1);
	    				$this->db->order_by("id",'desc');
				        $pro_info=$this->db->get("orderlist");
				        foreach ($pro_info->result_array() as $pro_all) {
				            $id = $pro_all['id'];
				            $pid = $pro_all['pid'];

				            $name = $pro_all['name'];
				            $quantity = $pro_all['quantity'];
				            $price = $pro_all['price'];
				            $pricee = $pro_all['price']* $quantity;
				            $size = $pro_all['size'];
				            $color = $pro_all['color'];
					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><img width="20" src="<?php echo base_url() ?>assest/images/product/<?php echo $pid; ?>.jpg" onerror="this.src='<?php echo base_url(); ?>assest/images/product/alt.jpg'"; style="height:20px !important;"></td>
			    			<td><?php echo $name; ?></td>
							<td><?php echo $color; ?></td>
							<td><?php echo $size; ?></td>
							<td><?php echo $quantity; ?></td>
							<td><?php echo $price; ?>Tk.</td>
							<td><?php echo $pricee; ?>Tk.</td>
						</tr>
						<?php
							$qty = $qty + $quantity;
							$sum = $sum+$pricee;
						}
						$this->db->where('id',1);
		                $setting = $this->db->get('setting');
		                foreach ($setting->result_array() as $setting_vat) {
		                    $vatdata = $setting_vat['vat'];
		                } 
						$this->db->where('id',$invoiceid);
		                $orderinfo = $this->db->get('order');
		                foreach ($orderinfo->result_array() as $orderdata) {
		                    $courier = $orderdata['courier'];
		                    $others = $orderdata['others'];
		                    $note = 'Note: '.$orderdata['note'];
		                }


		                $vat = $vatdata/100;

		                $vatadd = $sum*$vat;

		                $gTottal = $sum + $vatadd+$courier+$others;
						?>
						<tr>
							<th class="text-right" colspan="7">Sub Total</th>
							<td><?php echo $sum; ?>Tk.</td>
		    			</tr>
		    			<tr>
							<th class="text-right" colspan="7">Vat</th>
							<td><?php echo $vatdata;?>% (<?php echo $vatadd;?>Tk.)</td>
		    			</tr>
		    			<tr>
							<td colspan="6"><?php echo $note;?></td>                    
		                    <th class="text-right">Courier/others</th>
		                    <td><?php echo $courier+$others;?>Tk.</td>
		    			</tr>
		    			<tr class="info">
							<th class="text-right" colspan="7">Total</th>
							<td><?php echo $gTottal;?>Tk.</td>
		    			</tr>
					</tbody>
				</table>
			</div>

	
		<div class="col-md-3 col-sm-3 text-center" style="padding-top: 60px">
			<h3 style="border-top:1px solid #222;margin-top:0">Signature <small>(Buyer)</small></h3>
		</div>
		<div class=" col-md-offset-6 col-sm-offset-6 col-md-3 col-sm-3 text-center" style="padding-top: 20px">
			<p style="font-family: 'Cookie', cursive;font-size:25px;margin:0px"><?php echo $create_by; ?></p>
			<h3 style="border-top:1px solid #222;margin-top:0">Signature <small>(Seller)</small></h3>
		</div>

		</div>
	</div>
	<button class="btn btn-default btn-sm" onclick="window.print()">Print</button>
</div>

<?php } ?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url() ?>web/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="<?php echo base_url() ?>web/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assest/js/users.js"></script>
    </body>
</html>