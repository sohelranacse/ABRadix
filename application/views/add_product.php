<script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> Add Product</h3>
	</div>
	<div class="panel-body">
		<form action="<?php echo base_url() ?>home/productadded" method="POST" role="form" enctype="multipart/form-data">
			
			<span style="color: #f00;font-size: 16px;"><?php echo validation_errors(); ?></span>

			<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="">Sub Category</label> <span class="label label-danger">*</span>
					<select name="catid" class="form-control" onchange="selectcategory(this)" required>
						<option value="">Select Category</option>
						<?php 
						$this->db->select("*");
						$this->db->order_by("id",'desc');
			    		$category_info=$this->db->get("category");
			    		foreach ($category_info->result_array() as $category_info_all) {
			            	$id = $category_info_all['id'];
			            	$category = $category_info_all['menu'];
			            	if (!empty($category) || $category != 0) {
						?>
						<option value="<?php echo $id; ?>"><?php echo $category; ?></option>
						<?php }} ?>

					</select>
				</div>
				<div class="form-group">
					<label for="">Sub Category</label> <span class="label label-danger">*</span>
					<select name="subid" class="form-control" id="showsubcategory">
						<option value="">First time select Category</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Product Name</label> <span class="label label-danger">*</span> </label> <span class="label label-default">not special charecter used (/ \ _ - & ^ % $ # @ ! ~ , .)</span>
					<input type="text" class="form-control" name="name" placeholder="Product Name" required>
				</div>
				<div class="form-group">
					<label for="">Item Collection</label>
					<input type="text" class="form-control" name="item" placeholder="Item Collection">
				</div>
				<div class="form-group">
					<label for="">Quality</label>
					<input type="text" class="form-control" name="quality" placeholder="Product Quality">
				</div>
				<div class="form-group">
					<label for="">Size</label> <span class="label label-default">seperated by comma ( , ) Do not give space.</span>
					<input type="text" class="form-control" name="size" placeholder="5'',3.5'',2'',2KG,5KG">
				</div>
				<div class="form-group">
					<label for="">Color</label> <span class="label label-default">seperated by comma ( , ) Do not give space.</span>
					<input type="text" class="form-control" name="color" placeholder="Black,White,Blue,Yellow">
				</div>
				<div class="form-group">
					<label for="">Price</label> <span class="label label-danger">*</span>
					<input type="text" class="form-control" name="price" placeholder="Product Price" required>
				</div>
				<div class="form-group">
					<label for="">Discount</label> <span class="label label-default">Only Digit.</span>
					<input type="text" class="form-control" name="discount" placeholder="4">
				</div>
			</div>

			<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group imageform">
					<label for="">Images</label>
					<input type="file" name="userfile">
				</div>
				<div class="form-group">
					<label for="">Types</label> <span class="label label-danger">*</span>
					<select name="feature" class="form-control" required>
						<option value="">Select Type</option>
						<option value="0">Fetured</option>
						<option value="1">Generel</option>
					</select>
				</div>
				<div class="form-group checkform">
					<label for="">Availability : </label>
					<input type="radio" name="avail" value="1" checked> YES
					<input type="radio" name="avail" value="2"> NO
				</div>
				<div class="form-group checkform">
					<label for="">Show HP : </label>
					<input type="radio" name="hp" value="1" checked> YES
					<input type="radio" name="hp" value="2"> NO
				</div>
				<div class="form-group">
					<label for="">Description</label>
					<textarea class="form-control" name="body" height="100"></textarea>
				</div>
				<script>
                    CKEDITOR.replace( 'body' );
                </script>
			</div>
			
			<div class="col-md-12">
				<div class="form-group text-center">
					<button type="submit" name="add_product" class="btn btn-info btn-lg">ADD PRODUCT</button>
				</div>
			</div>
			
			
		</form>
	</div>
</div>
