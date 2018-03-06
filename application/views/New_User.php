<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> New User Create</h3>
	</div>

	<?php echo form_open('home/userSubmit'); ?>
	<div class="panel-body">
		<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
			

			
			<div class="well">
				<span style="color: red;font-size: 12px;"><?php echo validation_errors();  ?></span>
				<div class="form-group">
					<label for="">username</label>
					<input type="text" class="form-control" name="username" placeholder="Input Type username" autocomplete="off">
				</div>
				<div class="form-group">
					<label for="">password</label>
					<input type="password" class="form-control" name="password" id="passShowId" placeholder="Input Type password">
					<input type="checkbox" id="showPass"> Show Password
				</div>
				<div class="form-group">
					<label for="">Select Type</label>

					<select id="type" name="role" onchange="return per_type(this)" class="form-control" required="required">

						<option value="1">Type</option>
						<option value="0">user</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Status </label>
					<input type="radio" name="status" value="1" checked=""> Active
					<input type="radio" name="status" value="0"> Inactive
				</div>
			
			</div>
			


		</div>

		
		<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12" id="per"></div>
	</div>
	
	<div class="text-center" style="padding-bottom: 20px;" id="getsumitbutton"></div>
    <?php echo form_close(); ?>
</div> <!-- panel end -->
<script type="text/javascript" src="<?php echo base_url() ?>assest/js/users.js"></script>