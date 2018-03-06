<?php 
	if ($link) {
	$explode = explode('_0',$link);
    $pid = $explode[1];

    $this->db->where("pid",$pid);
	$this->db->where("hp", 1);
	$product_info=$this->db->get("product");
	foreach ($product_info->result_array() as $product_single) {
		$id = $product_single['pid'];
		$catid = $product_single['catid'];
		$name = $product_single['name'];
		$price = $product_single['price'];
		$body = $product_single['body'];

		$discount = $product_single['discount'];

    	$sohel = ($price*$discount)/100;
		$mainprice = $price-$sohel;
?>
<section class="single_product_area">
    <div class="container">
	        <div class="col-lg-4 col-md-4 col-sm-6 borderlagan">
	        
	            <div class="product-image-area">
	                <div class="pro-image-block">
	                    <img id="zoom_01" src='<?php echo base_url() ?>assest/images/product/<?php echo $id; ?>.jpg' data-zoom-image="<?php echo base_url() ?>assest/images/product/<?php echo $id; ?>.jpg" onerror="this.src='<?php echo base_url(); ?>assest/images/product/alt.jpg'"/>
	                </div>
	            </div>

	            <div class="share-items" data-title="Custom Share Links" data-hash="Custom Share Links" data-url="hair-building-fiber.html">
	                <ul class="whySocial">
						<li><a class="fbb" href="#"><i class="icofont icofont-social-facebook"></i></a></li>
						<li><a class="tw" href="#"><i class="icofont icofont-social-twitter"></i></a></li>
						<li><a class="yout" href="#"><i class="icofont icofont-social-youtube"></i></a></li>
						<li><a class="gplus" href="#"><i class="icofont icofont-social-google-plus"></i></a></li>
						<li><a class="linked" href="#"><i class="icofont icofont-brand-linkedin"></i></a></li>
					</ul>
	            </div>

	        </div>
           
            <div class="col-md-5 col-lg-5 col-sm-6">
            	<div class="detailsProRight">
					<h3><?php echo $name; ?></h3>

					<div class="form-horizontal">
						<fieldset>
							<input type="hidden" value="<?php echo $name; ?>" id="productname">
							<input type="hidden" value="<?php echo $id; ?>" id="productpid">
							<input type="hidden" value="<?php echo $mainprice; ?>" id="productprice">
						<!-- Select Basic -->
						<div class="form-group">
						  <label class="col-md-4 col-xs-4">Price : </label>
						  <div class="col-md-8">
						  	<h5 style="font-family: play;"><s style="color: #f00;font-size: 12px; font-weight: bold;">Tk.<?php echo $price; ?></s>&nbsp;&nbsp;<?php echo $mainprice; ?> Tk.</h5>
						  	</div>
						</div>	

						<!-- Select Basic -->
						<div class="form-group">
						  <label class="col-md-4" for="selectbasic">Color :</label>
						  <div class="col-md-8">
						    <select id="productcolor" name="selectbasic" class="form-control">
						      <option value="">Select Color</option>

						      	<?php
								$this->db->where("pid",$id);
					    		$color_size_info=$this->db->get("color_size");
					    		foreach ($color_size_info->result_array() as $color_size) {
					            	$color = $color_size['color'];
					            	if (!$color=='') {
					            ?>
						      	<option value="<?php echo $color; ?>"><?php echo $color; ?></option>
								<?php }} ?>

						    </select>
						  </div>
						</div>

						<!-- Select Basic -->
						<div class="form-group">
						  <label class="col-md-4" for="selectbasic">Size :</label>
						  <div class="col-md-8">
						    <select id="productsize" name="selectbasic" class="form-control">
						      <option value="">Select Size</option>
								<?php
								$this->db->where("pid",$id);
					    		$color_size_info=$this->db->get("color_size");
					    		foreach ($color_size_info->result_array() as $color_size) {
					            	$size = $color_size['size'];
					            	if (!$size=='') {
					            ?>
						      	<option value="<?php echo $size; ?>"><?php echo $size; ?></option>
								<?php }} ?>

						    </select>
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4" for="textinput">Quantity : </label>  
						  <div class="col-md-8">

						  	<input id="productquantity" name="textinput" type="text" value="1" class="form-control input-md">
						    
						  </div>
						</div>

						</fieldset>
					</div>

					<button class="btn cart-btn btn-default btn-block" onclick="addtopshopDetails()" id="detailsPro"><i class="fa fa-shopping-cart"></i> Buy Now</button>

					<div class="product-details">
						<h4>Product Details</h4>
						<div class="seperator-hr"></div>
						<?php echo $body; ?>
					</div>
				</div>
			</div>


			<div class="col-md-3 col-sm-6">
				<div class="brand">
					<h2>Brands</h2>
					<ul>
						<?php
							$this->db->where("hps",1);
				    		$category_info=$this->db->get("category");
				    		foreach ($category_info->result_array() as $category_info_all) {
				            	$id = $category_info_all['id'];
				            	$menu = $category_info_all['menu'];
				            	if (!$menu==0) {
				            		echo '<li><a href="'.base_url().'main/category/'.$id.'">'.$menu.'</a></li>';
				            	}
				            }
						?>
					</ul>
				</div>
			</div>
        
    </div>
</section>

<section class="productDescriptionTab container-fluid">
	<div class="container">
		
		<div role="tabpanel tbastyle">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#DeliveryPro" aria-controls="DeliveryPro" role="tab" data-toggle="tab">DELIVERY PROCESS</a>
				</li>
				<li role="presentation">
					<a href="#howOrder" aria-controls="howOrder" role="tab" data-toggle="tab">HOW TO ORDER</a>
				</li>
			</ul>
		
			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active milmil" id="DeliveryPro">

					<ul>
						<li><i class="icofont icofont-dotted-right"></i> Free delivery all over Bangladesh.</li>
						<li><i class="icofont icofont-dotted-right"></i> Cash on delivery available within Chittagong city.</li>
						<li><i class="icofont icofont-dotted-right"></i> In case of delivery outside Dhaka, we deliver our product via SA Paribahan Courier Service & Sundarban Courier Service.</li>
						<li><i class="icofont icofont-dotted-right"></i> Cash on delivery available in all SA Paribahan Courier Service branches & selected Sundarban Courier Service branches where on condition delivery available. But, customer must have to pay minimum 500 Taka for exercise items & 200 Taka for all other items in advance via bkash. And have to pay the rest amount in courier service office at the time of receiving the product.</li>
						<li><i class="icofont icofont-dotted-right"></i> In case of delivery outside Dhaka where on condition delivery not possible, customer must have to make full payment in advance.</li>
						<li><i class="icofont icofont-dotted-right"></i> Within Dhaka city products will be delivered within 24 business hours & outside Dhaka it will take up to 72 business hours after confirmation of the order.</li>
						<li><i class="icofont icofont-dotted-right"></i> Bkash Number: 018XXXXXXXX (Personal). After sending Bkash plz call 018XXXXXXXX to confirm your order.</li>
					</ul>
				</div>

				<div role="tabpanel" class="tab-pane milmil" id="howOrder">
					<ul>
						<li><i class="icofont icofont-dotted-right"></i> Click on your desired product.</li>
						<li><i class="icofont icofont-dotted-right"></i> Click on "Order Now" button.</li>
						<li><i class="icofont icofont-dotted-right"></i> Fill-up the form with your personal & delivery information.</li>
						<li><i class="icofont icofont-dotted-right"></i> Answer the security question of summation value of two numbers.</li>
						<li><i class="icofont icofont-dotted-right"></i> Check the box on "I agree to the Terms of Use".</li>
						<li><i class="icofont icofont-dotted-right"></i> Click on "Submit" button.</li>
						<li><i class="icofont icofont-dotted-right"></i> You will see a massage "Your Order is Submitted Successfully"</li>
						<li><i class="icofont icofont-dotted-right"></i> We will call you to confirm your order.</li>
					</ul>
					 
				</div>

			</div>
		</div>


	</div>
</section>
<section class="product_carousel_area">
	<div class="container">
		<div class="product_carousel">
			<h3>Related Products</h3>
			<div class="wrapper-with-margin">
				<div id="owl-demo" class="owl-carousel">
				
				<?php
					$this->db->where("pid", $pid); 
			        $query = $this->db->get("product");     
			        $row = $query->row();
			        $catid=$row->catid; //end

					$this->db->where("catid", $catid);
					$this->db->where("hp", 1);
					$this->db->order_by("pid",'desc');
					$this->db->limit(10);
		    		$product_info=$this->db->get("product");
		    		foreach ($product_info->result_array() as $product_all) {
		            	$id = $product_all['pid'];
		            	$name = $product_all['name'];
		            	$price = $product_all['price'];
		            	
		            	$discount = $product_all['discount'];

		            	$sohel = ($price*$discount)/100;
	            		$mainprice = $price-$sohel;

	            		$keywords = preg_split("/[\s,-]+/", $name);
	            		$clink = '';
						foreach ($keywords as $links) {
						    $clink .= $links.'-';
						}
	    		?>
				    <div class="product_home slidertime">
						<a href="<?php echo base_url() ?>main/prodetails/<?php echo $clink.'_0'.$id; ?>">
							<div class="pimge">
								<img src="<?php echo base_url() ?>assest/images/product/<?php echo $id; ?>.jpg" onerror="this.src='<?php echo base_url(); ?>assest/images/product/alt.jpg'" class="img img-responsive">
							</div>
							<h4><?php echo $name; ?></h4>
							<p>Tk. <?php echo $mainprice; ?> <small><s>Tk. <?php echo $price; ?></s></small></p>
						</a>
						<button class="btn btn-block btn-warning" value="<?php echo $id; ?>" id="addedText<?php echo $id; ?>" onclick="addtopshop(this)"><i class="icofont icofont-shopping-cart"></i> ADD TO CART</button>
					</div>

				<?php } ?>


				</div>
			</div>
		</div>
	</div>
</section>

<?php }} ?>