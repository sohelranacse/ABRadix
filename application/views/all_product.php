<script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> All Product  <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#vatControlmodal">Vat Control</button></h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>SL</th>
						<th>Name</th>
						<th>Image</th>
						<th>Category</th>
						<th>SubCat.</th>
						<th>Price</th>
						<th>Discount</th>
						<th>Item</th>
						<th>Quality</th>
						<th>Feature</th>
						<th>Avail</th>
						<th>Show</th>
						<th>Details</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					
		    		$i=1;
		    		foreach ($results as $product_all) {
		            	$id = $product_all->pid;
		            	$name = $product_all->name;
		            	$subid = $product_all->submenu;

		            	//catid to category show
		            	$cati = $product_all->catid;

		            	$this->db->where("id", $cati);
		            	$query = $this->db->get("category");     
		                $row = $query->row();
		                $catname=$row->menu;

		            	$catid = $catname;
		            	//catid to category end



		            	$price = $product_all->price.'Tk.';
		            	$discount = $product_all->discount.'%';
		            	$item = $product_all->item;
		            	$quality = $product_all->quality;

		            	$a_date = $product_all->added_date;
                        $create_date = date_create($a_date);
                        $added_date = date_format($create_date, 'd-M Y');

		            	$featured = $product_all->feature;
		            	if ($featured==1) {
		            		$feature = 'Fetured';
		            	}else{
		            		$feature = 'Generel';
		            	}

		            	$availed = $product_all->avail;
		            	if ($availed==1) {
		            		$avail = 'YES';
		            	}else{
		            		$avail = 'NO';
		            	}

		            	$hpshow = $product_all->hp;
		            	if ($hpshow==1) {
		            		$hp = '<i class="icofont icofont-ui-check"></i>';
		            	}else{
		            		$hp = '<i class="icofont icofont-ui-close"></i>';
		            	}

		            	$body = substr($product_all->body, 0, 30).'...';
		        ?>
					<tr id="<?php echo $id; ?>delpro">
						<td><?php echo $i++ ?></td>
						<td><?php echo $name ?></td>
						<td><img src="<?php echo base_url() ?>assest/images/product/<?php echo $id; ?>.jpg" width="80" onerror="this.src='<?php echo base_url(); ?>assest/images/product/alt.jpg'";></td>
						<td><?php echo $catid ?></td>
						<td><?php echo $subid ?></td>
						<td><?php echo $price ?></td>
						<td><?php echo $discount ?></td>
						<td><?php echo $item ?></td>
						<td><?php echo $quality ?></td>
						<td><?php echo $feature ?></td>
						<td><?php echo $avail ?></td>
						<td><button value="<?php echo $id; ?>" class="btn btn-sm btn-default" onclick="changeProducthp(this)"><?php echo $hp; ?></button></td>
						<td><?php echo $body ?></td>
						<td><?php echo $added_date ?></td>
						<td>
							<a href="<?php echo base_url() ?>home/product_updated/<?php echo $id; ?>" target="_blank" class="btn btn-sm btn-info"><i class="icofont icofont-edit"></i></a> <br><br>
							<button class="btn btn-sm btn-warning" value="<?php echo $id ?>" onclick="deleteproduct(this)"><i class="icofont icofont-trash"></i></button>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
		<?php echo $links; ?>
	</div>
</div>

<!-- vatControlmodal -->
<div class="modal fade" id="vatControlmodal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icofont icofont-ui-close"></i></button>
				<h4 class="modal-title">Vat Control</h4>
			</div>
			<div class="modal-body">
				<?php 
				$this->db->where('id',1);
                $setting = $this->db->get('setting');
                foreach ($setting->result_array() as $setting_vat) {
                    $vatdata = $setting_vat['vat'];
                }
                ?>
                	<div class="form-group">
                		<label for="">Vat</label>
                		<input type="text" class="form-control" id="vatchange" value="<?php echo $vatdata ?>">
                	</div>
                
                	<button type="button" class="btn btn-info btn-sm" onclick="vatchange()">CHANGE VAT</button>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>