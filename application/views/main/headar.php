<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Google fonts - witch you want to use - (rest you can just remove) -->
   	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

   	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
   	<link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
   
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="stylesheet" href="<?php echo base_url() ?>web/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>web/css/icofont.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet"> 

	<link rel="stylesheet" href="<?php echo base_url() ?>web/css/normalize.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>web/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>web/css/main.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>web/css/owl.carousel.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>web/style.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>web/responsive.css">
    <script src="<?php echo base_url() ?>web/js/vendor/modernizr-2.6.2.min.js"></script>
    
</head>
<body>
<header class="header_area">
	<div class="container">
		<div class="row">
			<div class="col-md-9 paddingErase">
				<nav class="navbar navbar-default m_nav ">
			      <div class="container">
			        <div class="navbar-header">
			          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			            <span class="sr-only">Toggle navigation</span>
			            <i class="icofont icofont-listing-box"></i>
			          </button>	
			          <div class="logo hidden-sm">
			          	<a href="<?php echo base_url() ?>main/"><img src="<?php echo base_url() ?>web/images/logo.png"></a>
			          </div>
			        </div>
			        <div id="navbar" class="navbar-collapse collapse">
			          	<ul class="nav navbar-nav custom-nav">
						  	<li><a href="<?php echo base_url() ?>main">Home</a></li>
								<?php
								$this->db->where('hps',1);
					    		$category_info=$this->db->get("category");
					    		foreach ($category_info->result_array() as $category_info_all) {
					            	$id = $category_info_all['id'];
					            	$menu = $category_info_all['menu'];
					            	if (!$menu==0) {
					            		echo '<li class="dropdown"><a class="dropdown-toggle disabled" href="'.base_url().'main/category/'.$id.'">'.$menu.' <span class="caret"></span></a>';

								    		echo '<ul class="dropdown-menu custom-dropdown">';

						            			$this->db->select("*");
									        	$this->db->where('menuid',$id);
									    		$subMenu_info=$this->db->get("category");
									    		foreach ($subMenu_info->result_array() as $category_info_sub) {
						            				$subid = $category_info_sub['id'];
						            				$submenu = $category_info_sub['submenu'];
						            				echo '<li><a href="'.base_url().'main/product/'.$subid.'"><span>'.$submenu.'</span></a></li>';
						            			}
					            			echo '</ul>';

					            		echo '</li>';
					            	}
					            }
					            ?>
						</ul><!--/.nav-collapse -->
			      </div>
			    </div></nav>
			</div>
			<div class="col-md-3" style="padding-left: 0">
				<div class="cart-links text-right">
					<?php 
						if (isset($_SESSION['email'])){
							$email = $_SESSION['email'];
							$this->db->where('email',$email);
				    		$cous_info=$this->db->get("coustomer");
				    		foreach ($cous_info->result_array() as $cousProfile) {
	            				$cousid = $cousProfile['id'];
	            				$cousname = $cousProfile['name'];
	            				$cousemail = $cousProfile['email'];
					?>
						<a class="btn btn-info" href="<?php echo base_url() ?>main/profile"><i class="icofont icofont-user"></i> Profile</a> 
						<a class="btn btn-danger" href="<?php echo base_url() ?>main/logout"><i class="icofont icofont-logout"></i> Logout</a>
					<?php }}else{ ?>
						<a class="btn btn-info" data-toggle="modal" href="#accountlogin"><i class="icofont icofont-login"></i> Login</a> 
						<a class="btn btn-success" data-toggle="modal" href="#accountsingup"><i class="icofont icofont-user"></i> Signup</a>
					<?php } ?>
					<a class="btn btn-warning" data-toggle="modal"  onclick="cartdetailsshow()" href="#shoppingcart"><i class="fa fa-shopping-cart"></i> <span id="items">0</span> Items</a>
				</div>
			</div>	

			<!-- login Modal -->
			<div class="modal fade" id="accountlogin">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
							<h4 class="modal-title">Login Account</h4>
						</div>
						<div class="modal-body">
							<section class="login_singup_area">
								<div class="user_area">
									<div class="row">
										<div class="col-md-6">
											<h2>Create a New Account</h2>
											<p>Create an account with us and you'll be able to:</p>
												<ul>
													<li>Check out faster</li>
													<li>Save multiple shipping addresses</li>
													<li>Access your order history</li>
													<li>Track new orders</li>	
													<li>Save items to your wish list</li>
												</ul>
											 <a href="#accountsingup" data-toggle="modal" data-dismiss="modal"><button id="singlebutton" name="singlebutton" class="btn btn-default">Create new account</button></a>
										</div>
										<div class="col-md-6">
											<h2>Sign In</h2>
											<form action="<?php echo base_url() ?>main/coustomerlogin" method="POST">
											
												<div class="form-group">
													<label for="">Email</label>
													<input type="text" class="form-control" name="logincousemail" placeholder="Type Email" required>
												</div>
												<div class="form-group">
													<label for="">Password</label>
													<input type="text" class="form-control" name="logincouspassword" placeholder="Type Password" required>
												</div>
											
												
											
												<button type="submit" class="btn btn-success">Sign in</button>
											</form>
										</div>
									
									</div>
								</div>
							</section>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!-- login Modal -->
			<div class="modal fade" id="accountsingup">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
							<h4 class="modal-title">Create Account</h4>
						</div>
						<div class="modal-body">
							<section class="login_singup_area">
								<div class="user_area">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="name">Full Name</label>
												<input type="text" class="form-control" id="cousname" placeholder="Type Full Name" required>
											</div>
											<div class="form-group">
												<label for="email">Email</label>
												<input type="text" class="form-control" id="cousemail" placeholder="Type Email" required>
											</div>
											<div class="form-group">
												<label for="email">Password</label>
												<input type="password" class="form-control" id="couspassword" placeholder="Type Password" required>
											</div>
											<div class="form-group">
												<label for="name">Mobile Number</label>
												<input type="text" class="form-control" id="cousmobile" placeholder="Type Mobile Number" required>
											</div>
										</div>
										<div class="col-md-6">
											
											<div class="form-group">
												<label for="name">Address 1</label>
												<input type="text" class="form-control" id="cousaddress1" placeholder="Type Address 1">
											</div>
											<div class="form-group">
												<label for="name">Address 2</label>
												<input type="text" class="form-control" id="cousaddress2" placeholder="Type Address 2">
											</div>
											<div class="form-group">
												<label for="name">ZIP</label>
												<input type="text" class="form-control" id="cousZip" placeholder="Type ZIP">
											</div>
											<div class="form-group">
												<label for="name">City/District</label>
												<input type="text" class="form-control" id="couscity" placeholder="Type City/District">
											</div>

										</div>

										<div class="col-md-12">
											<button type="button" class="btn btn-success" onclick="registercous()">SIGN UP</button>
											<a href="#accountlogin" data-dismiss="modal" data-toggle="modal"><button id="singlebutton" name="singlebutton" class="btn btn-default">Already have a account.</button></a>
										</div>

										

										
									</div>
								</div>
							</section>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Shopping cart Modal -->
		    <div class="modal fade" id="shoppingcart" tabindex="-1" role="dialog" aria-hidden="true">
		       <div class="modal-dialog modal-lg">
		         <div class="modal-content">
		            <div class="modal-header">
		             <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
		             <h4 class="modal-title">Shopping Cart</h4>
		            </div>
		            <div class="modal-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>SL</th>
										<th>Image</th>
										<th>Name</th>
										<th>Quantity</th>
										<th>Price</th>
										<th>Total</th>
										<th>Add.</th>
										<th>Sub.</th>
										<th>Cancel</th>
									</tr>
								</thead>
								<tbody id="mnshowCart">
									
								</tbody>

							</table>
						</div>

						
						
						
						
					</div>
		           <div class="modal-footer">
		           		<div class="form-group col-md-6 text-left">
							<a class="btn btn-default" data-dismiss="modal" class="btn btn-default"><i class="fa fa-shopping-cart"> CONTINUE SHOPPING</i></a>
						</div>
		             	<div class="form-group col-md-6">
							<a href="<?php echo base_url() ?>main/orderlist" class="btn btn-info"><i class="fa fa-credit-card"> CHECKOUT</i></a>
						</div>
		           </div>
		         </div><!-- /.modal-content -->
		       </div><!-- /.modal-dialog -->
		    </div><!-- /.modal -->
	</div>
</header>