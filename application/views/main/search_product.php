<?php 
if ($names || $catid) {
	$this->db->select("*");
	$this->db->where("id",$catid);
	$category_info=$this->db->get("category");
	foreach ($category_info->result_array() as $category_single) {
		$subid = $category_single['id'];
		$subcatname = $category_single['menu'];
?>

<section class="product_category_area">
	<div class="container product_category">
		<div class="row">
			<div class="col-md-12">
				<h2><?php echo $subcatname; ?></h2> 
				<p>Your Search Keyword - <b><?php echo $names; ?></b></p>
				<div class="seperator-hr"></div>
			</div>
		</div>
	<?php } ?>
		<div class="row">
			<?php 
				$this->db->select("*");
				$this->db->like("name",$names);
				$this->db->where("catid",$catid);
				$this->db->where("hp", 1);
				$product_info=$this->db->get("product");
				foreach ($product_info->result_array() as $subcat_single) {
					$id = $subcat_single['pid'];
					$name = $subcat_single['name'];
					$price = $subcat_single['price'];
					$discount = $subcat_single['discount'];

			    	$sohel = ($price*$discount)/100;
					$mainprice = $price-$sohel;
			?>
			<div class="col-md-3">	
				<div class="single_product text-center">
					<a href="<?php echo base_url() ?>main/prodetails/<?php echo $id; ?>" class="product-card">
					  <div class="product-card__image-wrapper">
					    <img src="<?php echo base_url() ?>assest/images/product/<?php echo $id; ?>.jpg" onerror="this.src='<?php echo base_url(); ?>assest/images/product/alt.jpg'"; class="product-card__image">
					  </div>
					  <div class="product-card__info">
					    <div class="product-card__name"><?php echo $name; ?></div>
							<div class="product-card__price">
						        <s style="color: #f00;font-size: 12px;">Tk. <?php echo $price; ?></s> <br> Tk. <?php echo $mainprice; ?>
					     	</div>
					   </div>
					   <div class="product-card__overlay">
					    <span class="btn product-card__overlay-btn">DETAILS</span>
					   </div>
					</a>
					<button class="btn btn-default" value="<?php echo $id; ?>" onclick="addtopshop(this)"><i class="fa fa-shopping-cart"></i> ADD TO SHOP</button>
				</div>
			</div>
			<?php  }?>

		</div>

	</div>		
</section>

<?php }  ?>