<?php
$sid = Session_id();

$this->db->where('sesid',$sid);
$cart_info = $this->db->get('order');
foreach ($cart_info->result_array() as $cart_details) {
    $sesid = $cart_details['sesid'];
}

if ($orderconfirm==$sesid) {
?>
<div class="container paddingzero" style="font-family: "Raleway",sans-serif !important";>
	<div class="panel panel-primary" style="border-radius: 0">
		<div class="panel-heading">
			<h3 class="panel-title">Payment Method</h3>
		</div>
		<div class="panel-body">
			<div role="tabpanel">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active">
						<a href="#BKash" aria-controls="home" role="tab" data-toggle="tab">BKash</a>
					</li>
					<li role="presentation">
						<a href="#HandCash" aria-controls="tab" role="tab" data-toggle="tab">Hand Cash</a>
					</li>
					<li role="presentation">
						<a href="#Profile" aria-controls="tab" role="tab" data-toggle="tab">Address</a>
					</li>
				</ul>
			
				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="BKash">
						<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 paymentsystem">
							<br>
							<h3>Bkash Online Payment</h3>
							<div class="seperator-hr"></div>
							<br>
							
								<div class="form-group">
									<label for="">Bkash TraxId</label>
									<input type="text" class="form-control" id="paymenttraxtid" placeholder="Input Bkash TraxId">
								</div>
							
								<button type="submit" class="btn btn-primary" value="<?php echo $sesid; ?>" onclick="BcashPay(this)">CONFIRM PAYMENT</button>
						</div>
						<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 paymentsystem">
							<br>
							<h3>Bkash Payment System</h3>
							<div class="seperator-hr"></div>
							<br>
							<p>পেমেন্ট সেবার মাধ্যমে, বিকাশ গ্রহণ করে এমন যেকোন মার্চেন্টকে আপনি পেমেন্ট করতে পারেন আপনার বিকাশ একাউন্ট থেকে। উদাহরস্বরূপ, আপনি যদি কেনাকাটার পর বিল পরিশোধ করতে চান, তাহলে নিচের ধাপগুলো অনুসরণ করুন -</p>
							<ul>
								<li>১। *২৪৭# ডায়াল করে বিকাশ মোবাইল মেন্যুতে যান</li>
								<li>২। “পেমেন্ট” সিলেক্ট করুন</li>
								<li>৩। আপনি যে মার্চেন্টকে পেমেন্ট করতে চান তার মার্চেন্ট বিকাশ একাউন্ট নম্বর দিন</li>
								<li>৪। আপনি যে পরিমাণ টাকা পেমেন্ট করতে চান তার পরিমাণ লিখুন</li>
								<li>৫। আপনার কেনাকাটার একটি তথ্যসূত্র দিন (আপনি আপনার লেনদেনের উদ্দেশ্য একটি শব্দের মধ্যে উল্লেখ করতে পারেন, উদাহরণস্বরূপ, বিল)*</li>
								<li>৬। কাউন্টার নম্বরটি লিখুন (কাউন্টারে অবস্থানরত বিক্রেতা আপনাকে নম্বরটি বলে দেবেন)*</li>
								<li>৭। আপনার বিকাশ মোবাইল মেন্যু পিনটি দিয়ে পেমেন্ট সম্পন্ন করুন</li>
							</ul>
							<p><b>আপনি বিকাশ থেকে একটি কনফার্মেশন মেসেজ পাবেন। কনফার্মেশন মেসেজের TraxId টি এখানে বসিয়ে দিয়ে Confirm করবেন।</b></p>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="HandCash">
						
						<div class="col-md-6 cl-lg-6 col-sm-6 col-xs-12 paymentsystem">
							<br>
							<h3>Cash On Delivery</h3>
							<div class="seperator-hr"></div>
							<br>

														
							<button value="<?php echo $sesid; ?>" class="btn btn-lg btn-primary" onclick="hadcashPay(this)">CONFIRM</button>
							
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="Profile">
						<div class="col-md-6 cl-lg-6 col-sm-6 col-xs-12 paymentsystem">
							<br>
							<h3>Profile</h3>
							<div class="seperator-hr"></div>
							<br>
							<div class="table-responsive">
								<table class="table table-striped table-bordered">
									<tbody>
									<?php 
										$this->db->where('sesid',$sesid);
										$this->db->order_by('id','desc');
										$this->db->limit(1);
										$order_profiile = $this->db->get('order');
										foreach ($order_profiile->result_array() as $profile_info) {
					            			$id = $profile_info['id'];
					            			$name = $profile_info['name'];
					            			$email = $profile_info['email'];
					            			$mobile = $profile_info['mobile'];
					            			$address = $profile_info['address'];

					            			$address2 = $profile_info['address2'];
					            			$zip = $profile_info['zip'];
					            			$city = $profile_info['city'];

					            			$a_date = $profile_info['added_date'];
					                        $create_date = date_create($a_date);

					                        $added_date = date_format($create_date, 'd-M Y');
					                        $time = date_format($create_date, 'h:i:s A');
									?>

										<tr>
											<th>Name</th>
											<td><?php echo $name ?></td>
										</tr>
										<tr>
											<th>Email</th>
											<td><?php echo $email ?></td>
										</tr>
										<tr>
											<th>Mobile</th>
											<td><?php echo $mobile ?></td>
										</tr>
										<tr>
											<th>Address 1</th>
											<td><?php echo $address ?></td>
										</tr>
										<tr>
											<th>Address 2</th>
											<td><?php echo $address2 ?></td>
										</tr>
										<tr>
											<th>ZIP</th>
											<td><?php echo $zip ?></td>
										</tr>
										<tr>
											<th>City</th>
											<td><?php echo $city ?></td>
										</tr>
										<tr>
											<th>Dated</th>
											<td><?php echo $added_date ?></td>
										</tr>
										<tr>
											<th>Time</th>
											<td><?php echo $time ?></td>
										</tr>

									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php }
else{
	redirect('main/orderlist');
}
?>