
<section class="slider_area">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-8">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
						<li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
						<li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
                        <div class="item">
							<img src="<?php echo base_url() ?>web/images/slider/slider1.jpg">
						</div>
						<div class="item active">
							<img src="<?php echo base_url() ?>web/images/slider/slider2.jpg">
						</div>
						<div class="item">
							<img src="<?php echo base_url() ?>web/images/slider/slider3.jpg">
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-4">
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
	</div>
</section>



<?php
$this->db->where("hps",'1');
$this->db->where("hpp",'1');
$category_info=$this->db->get("category");
$i=1;
foreach ($category_info->result_array() as $category_info_all) {
	$id = $category_info_all['id'];
	$category = $category_info_all['menu'];
?>
<section class="home_section_area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row home_section">
					<div class="col-md-3 paddingErase">
						<div class="home_menu">
							<h2><a href="<?php echo base_url() ?>main/category/<?php echo $id; ?>"><?php echo $category; ?></a></h2>
							<ul>
								<?php 
									$this->db->select("*");
									$this->db->where("menuid",$id);
									$sub_info=$this->db->get("category");
									foreach ($sub_info->result_array() as $sub_info_all) {
										$subcategory = $sub_info_all['submenu'];
										$subid = $sub_info_all['id'];
									?>
									<li><a href="<?php echo base_url() ?>main/product/<?php echo $subid; ?>"><?php echo $subcategory; ?></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<div class="col-md-9 productdes">
						<div class="row">
							<?php
							$this->db->select("*");
							$this->db->where("catid", $id);
							$this->db->where("hp", 1);
							$this->db->order_by("pid",'desc');
							$this->db->limit(8);
				    		$product_info=$this->db->get("product");
				    		$i=1;
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

								<div class="col-md-3 product_home">
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
		</div>
	</div>
</section>
<?php } ?>

<section class="product_carousel_area">
	<div class="container">
		<div class="product_carousel">
			<h3>Fetured Products</h3>
			<div class="wrapper-with-margin">
				<div id="owl-demo" class="owl-carousel">
				
				<?php
					$this->db->where("feature", 0);
					$this->db->where("hp", 1);
					$this->db->order_by("pid",'desc');
					$this->db->limit(10);
		    		$product_info=$this->db->get("product");
		    		$i=1;
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
