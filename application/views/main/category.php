<?php 
	if ($catid) {
?>

    <section class="slider_area" style="margin-bottom: 20px">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-3">


    				<div class="brand">
    					<?php
							$this->db->where('hps',1);
				    		$category_info=$this->db->get("category");
				    		foreach ($category_info->result_array() as $category_info_all) {
				            	$id = $category_info_all['id'];
				            	$menu = $category_info_all['menu'];
				            	if (!$menu==0) {
				            		echo '<h3><a href="'.base_url().'main/category/'.$id.'">'.$menu.'</a></h3>';
				            		echo '<ul>';

				            			$this->db->where('menuid',$id);
							    		$subMenu_info=$this->db->get("category");
							    		foreach ($subMenu_info->result_array() as $category_info_sub) {
				            				$subid = $category_info_sub['id'];
				            				$submenu = $category_info_sub['submenu'];
				            				echo '<li><a href="'.base_url().'main/product/'.$subid.'"><span>'.$submenu.'</span></a></li>';
				            			}

				            		echo '</ul>';
				            	}
				            }
	    				?>
    				</div>



    			</div>
    			<div class="col-md-9 product-home">
    				<div class="row proborder">
						
						<?php 
	    				$this->db->where("id", $catid); 
				        $query = $this->db->get("category");     
				        $row = $query->row();
				        $title=$row->menu;
				        echo '<h3>'.$title.'</h3>';


						$this->db->where("catid", $catid);
						$this->db->where("hp", 1);
						$this->db->order_by("pid",'desc');
						$this->db->limit(12);
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
    </section>
<?php } ?>