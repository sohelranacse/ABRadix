<script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> Update Product</h3>
	</div>
	<div class="panel-body">
		<?php 
			foreach ($results as $product_all) {
	        	$id = $product_all->pid;
	        	$name = $product_all->name;
	        	$subid = $product_all->submenu;

	        	//catid to category show
	        	$cati = $product_all->catid;
	        	$subids = $product_all->subid;

	        	$this->db->where("id", $cati);
	        	$query = $this->db->get("category");     
	            $row = $query->row();
	            $catname=$row->menu;

	            $submenu=$row->submenu;

	        	$catid = $catname;
	        	//catid to category end



	        	$price = $product_all->price.'Tk.';
	        	$discount = $product_all->discount;
	        	$item = $product_all->item;
	        	$quality = $product_all->quality;

	        	$feature = $product_all->feature;

	        	$avail = $product_all->avail;
	        	$hp = $product_all->hp;

	        	$body = $product_all->body;

		?>
			<form action="<?php echo base_url() ?>home/productedit" method="POST" role="form" enctype="multipart/form-data">
				
				<span style="color: #f00;font-size: 16px;"><?php echo validation_errors(); ?></span>

				<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="">Sub Category</label> <span class="label label-danger">*</span>
						<select name="catid" class="form-control" onchange="selectcategory(this)">
							<option value="">Select Category</option>
							<?php 
							$this->db->select("*");
				    		$category_info=$this->db->get("category");
				    		foreach ($category_info->result_array() as $category_info_all) {
				            	$category_id = $category_info_all['id'];
				            	$category = $category_info_all['menu'];
				            	if (!empty($category) || $category != 0) {
							?>
							<option
							<?php if ($category_id == $cati): ?>
								selected = "selected"
							<?php endif ?>
							value="<?php echo $category_id; ?>"><?php echo $category; ?></option>
							<?php }} ?>

						</select>
					</div>
					<div class="form-group">
						<label for="">Sub Category</label> <span class="label label-danger">*</span>
						<select name="subid" class="form-control" id="showsubcategory">
							<?php 
							$this->db->select("*");
				    		$subcat_info=$this->db->get("category");
				    		foreach ($subcat_info->result_array() as $sub_info_all) {
				            	$sub_categoryid = $sub_info_all['id'];
				            	$subcat = $sub_info_all['submenu'];
				            	if (!empty($subcat) || $subcat != 0) {
							?>
							<option
							<?php if ($sub_categoryid == $subids): ?>
								selected = "selected"
							<?php endif ?>
							value="<?php echo $sub_categoryid; ?>"><?php echo $subcat; ?></option>
							<?php }} ?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Product Name</label> <span class="label label-danger">*</span> </label> <span class="label label-default">not special charecter used (/ \ _ - & ^ % $ # @ ! ~ , .)</span>
						<input type="hidden" name="pid" value="<?php echo $id ?>">
						<input type="text" class="form-control" name="name" value="<?php echo $name ?>">
					</div>
					<div class="form-group">
						<label for="">Item Collection</label>
						<input type="text" class="form-control" name="item" value="<?php echo $item ?>">
					</div>
					<div class="form-group">
						<label for="">Quality</label>
						<input type="text" class="form-control" name="quality" value="<?php echo $quality ?>">
					</div>
					<div class="form-group">
						<label for="">Size</label> <span class="label label-default">seperated by comma ( , ) Do not give space.</span>
						<textarea class="form-control" name="size" rows="1">
						<?php 
						$this->db->where('id',$id);
						$querysize = $this->db->get('color_size');
						foreach ($querysize->result_array() as $color_sizee) {
				            	$sub_categoryid = $color_sizee['id'];
				            	$size = $color_sizee['size'];
				            	if (!empty($size) || $size != 0) {
				            		echo $size.',';
				            	}
				        } ?>
				        </textarea>
					</div>
					<div class="form-group">
						<label for="">Color</label> <span class="label label-default">seperated by comma ( , ) Do not give space.</span>
						<textarea class="form-control" name="color" rows="1">
						<?php 
						$this->db->where('pid',$id);
						$querycolor = $this->db->get('color_size');
						foreach ($querycolor->result_array() as $color_size) {
				            	$sub_categoryid = $color_size['id'];
				            	$color = $color_size['color'];
				            	if (!empty($color) || $color != 0) {
				            		echo $color.',';
				            	}
				        } ?>
				        </textarea>
						
					</div>
					<div class="form-group">
						<label for="">Price</label> <span class="label label-danger">*</span>
						<input type="text" class="form-control" name="price" value="<?php echo $price ?>">
					</div>
					<div class="form-group">
						<label for="">Discount</label> <span class="label label-default">Only Digit.</span>
						<input type="text" class="form-control" name="discount" value="<?php echo $discount ?>">
					</div>
					<div class="form-group">
						<label for="">Types</label> <span class="label label-danger">*</span>
						<select name="feature" class="form-control">
							
							<?php if ($feature == 0){ ?>
								<option value="0">Fetured</option>
							<?php } else{ ?>
									<option value="1">Generel</option>
							<?php } ?>
							<option value="0">Fetured</option>
							<option value="1">Generel</option>
							
							
						</select>
					</div>
					<div class="form-group checkform">
						<label for="">Availability : </label>
						<input type="radio" name="avail" value="1" <?php if ($avail==1): ?>
							checked
						<?php endif ?>> YES
						<input type="radio" name="avail" value="2" <?php if ($avail==2): ?>
							checked
						<?php endif ?>> NO
					</div>
					<div class="form-group checkform">
						<label for="">Show HP : </label>
						<input type="radio" name="hp" value="1" <?php if ($hp==1): ?>
							checked
						<?php endif ?>> YES
						<input type="radio" name="hp" value="2" <?php if ($hp==2): ?>
							checked
						<?php endif ?>> NO
					</div>
				</div>

				<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
					<div class="form-group imageform">
						<img src="<?php echo base_url() ?>assest/images/product/<?php echo $id; ?>.jpg" width="370" onerror="this.src='<?php echo base_url(); ?>assest/images/product/alt.jpg'";>
					</div>
					<div class="form-group imageform">
						<label for="">Images</label>
						<input type="file" name="userfile">
					</div>
					
					<div class="form-group">
						<label for="">Description</label>
						<textarea class="form-control" name="body" height="100"><?php echo $body; ?></textarea>
					</div>
					<script>
	                    CKEDITOR.replace( 'body' );
	                </script>
				</div>
				
				<div class="col-md-12">
					<div class="form-group text-center">
						<button type="submit" name="add_product" class="btn btn-info btn-lg">UPDATE PRODUCT</button>
						<a href="#" onclick = "javascript:self.close();" class="btn btn-default btn-lg">CANCEL</a>
					</div>
				</div>
				
				
			</form>

		<?php } ?>
	</div>
</div>
