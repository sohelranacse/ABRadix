<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assest/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assest/css/icofont.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assest/css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assest/css/style.css">

	<script type="text/javascript" src="<?php echo base_url() ?>assest/js/jquery.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default mynavbarS" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo base_url() ?>home">
				<img src="<?php echo base_url() ?>assest/images/logo.png" alt="Admin Panel">  
				<i class="hidden-xs">
					<?php 
					$userRole = $userId = $this->session->userdata('role');
					if ($userRole==1) {
						echo 'SUPER ADMIN';
					}else{
						echo 'USER';
					}
				?>
				</i>
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
		
			
			
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo base_url() ?>" target="_blank"><i class="icofont icofont-web"></i></a></li>				

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
						<i class="icofont icofont-user"></i> <?php echo $this->session->userdata('name') ?> <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a  href="#Profile_admin" data-toggle="modal"><i class="icofont icofont-woman-in-glasses"></i> Update Profile</a></li>
						<li><a onclick="PasswordChange();" href="#Profilechange" data-toggle="modal"><i class="icofont icofont-ui-unlock"></i> Change Password</a></li>
						<li><a href="<?php echo base_url() ?>home/logout"><i class="icofont icofont-logout"></i> Logout</a></li>
					</ul>
				</li>
			</ul>

			
		</div><!-- /.navbar-collapse -->
	</div>
</nav>


<div class="modal fade" id="Profilechange">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icofont icofont-ui-close"></i></button>
				<h4 class="modal-title">Change Password</h4>
			</div>
			<div class="modal-body" id="PasswordChange1">
				
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="Profile_admin">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icofont icofont-ui-close"></i></button>
				<h4 class="modal-title">Update Profile</h4>
			</div>
			<div class="modal-body">
			<?php
				$this->db->where('id', $this->session->userdata('id'));
				$queryuser = $this->db->get('users');
				$rows = $queryuser->row();
				$userid = $rows->id;
				$username = $rows->username;
				$useremail = $rows->email;
				$userFname = $rows->name;
				$userrole = $rows->role;
				if ($userrole==1) {
					$showrole = 'Admin';
				}else{
					$showrole = 'User';
				}
			?>
			
				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#Profileshow" aria-controls="home" role="tab" data-toggle="tab">Profile</a>
						</li>
						<li role="presentation">
							<a href="#updateProfiletabs" aria-controls="tab" role="tab" data-toggle="tab">Update Profile</a>
						</li>
					</ul>
				
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="Profileshow">
							<div class="well text-center">
								<i class="icofont icofont-user usericon"></i>
								<h2><?php echo $userFname; ?></h2>
								<div class="table-responsive">
									<table class="table table-bordered table-striped">
										<tbody>
											<tr>
												<th width="50%">username : </th>
												<td class="text-right"><?php echo $username; ?></td>
											</tr>
											<tr>
												<th>Eamil : </th>
												<td class="text-right"><?php echo $useremail; ?></td>
											</tr>
											<tr>
												<th>Role : </th>
												<td class="text-right"><?php echo $showrole; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="updateProfiletabs">
							<form action="<?php echo base_url() ?>home/updateprofile" method="POST" role="form">
					
								<div class="form-group">
									<label for="">Username</label>
									<input type="hidden" name="id" value="<?php echo $this->session->userdata('id'); ?>">
									<input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
								</div>
								<div class="form-group">
									<label for="">Email</label>
									<input type="text" class="form-control" name="email" value="<?php echo $useremail; ?>">
								</div>
								<div class="form-group">
									<label for="">Name</label>
									<input type="text" class="form-control" name="name" value="<?php echo $userFname; ?>">
								</div>
							
								<button type="submit" class="btn btn-info">UPDATE</button>
							</form>
						</div>
					</div>
				</div>

					
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<!--####### leftside navbar #######-->
<div class="colorControl">
<div class="col-md-2 col-lg-2 col-sm-2 col-xs-12 leftSidebar">
	<div class="components">

		

		
		<a class="dasactive" href="<?php echo base_url(); ?>home"><strong><i class="icofont icofont-home"></i></strong> Dashboard</a>
		<?php 
			/*$userRole = $userId = $this->session->userdata('role');
			if ($userRole==1) {
				echo '<a href="'.base_url().'home/menu"><strong><i class="icofont icofont-sub-listing"></i></strong> Menu</a>';
			}else{
				echo '';
			}*/
		?>
		


			

		

		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		    <div class="panel panel-deicofontult">

		    <?php
		    	$userId = $this->session->userdata('id');
		    	if ($userId==1) {

		        	$this->db->select("*");
		    		$admin_menus=$this->db->get("menu");
		    		foreach ($admin_menus->result_array() as $admin_menu_info) {
		            	$admin_menu_id = $admin_menu_info['id'];
		            	$admin_menu = $admin_menu_info['menu'];
		            	$admin_icon = $admin_menu_info['icon'];

		            	if (!$admin_menu==0) {
				        	echo '<a data-toggle="collapse" data-parent="#accordion" href="#admin'.$admin_menu_id.'"><strong><i class="icofont icofont-'.$admin_icon.'"></i></strong> '.$admin_menu.' <i class="icofont icofont-plus pull-right icon_pad"></i></a>';

				        	$this->db->select("*");
				        	$this->db->where('menuid',$admin_menu_id);
				    		$admin_sub_menu=$this->db->get("menu");
				        	echo '
							<div id="admin'.$admin_menu_id.'" class="panel-collapse collapse">
						        <div class="panel-body">
						        	<ul class="sidebar_ul">
	                    	';

					    		foreach ($admin_sub_menu->result_array() as $admin_sub_menu_info) {
					            	$admin_submenu = $admin_sub_menu_info['submenu'];
					            	$admin_sub_link = $admin_sub_menu_info['sub_link'];

			                    	echo '<li><a href="'.base_url().'home/'.$admin_sub_link.'">'.$admin_submenu.'</a></li>';

			                    }
		                    echo '
									</ul>
								</div>
							</div>
		                    ';
	                	}
                	}
		        }else{

		    		$this->db->select("*");
		    		$this->db->where("userId",$userId);
		    		$this->db->group_by("menuid");
		    		$role_info=$this->db->get("role");
		            foreach ($role_info->result_array() as $getrole_info) {
		            	$role_menuid = $getrole_info['menuid'];



		            	$this->db->select("*");
		        		$this->db->where("id",$role_menuid);
			    		$menu_info1=$this->db->get("menu");
			    		foreach ($menu_info1->result_array() as $get_menu_info1) {
			    			$menu = $get_menu_info1['menu'];
			    			$icon = $get_menu_info1['icon'];
			    			$id = $get_menu_info1['id'];
			    			echo '<a data-toggle="collapse" data-parent="#accordion" href="#user'.$id.'"><strong><i class="icofont icofont-'.$icon.'"></i></strong> '.$menu.' <i class="icofont icofont-plus pull-right icon_pad"></i></a>';


			    			$this->db->select("*");
				    		$this->db->where("userId",$userId);
				    		$role_infoo=$this->db->get("role");
				    		echo '
							<div id="user'.$id.'" class="panel-collapse collapse">
						        <div class="panel-body">
						        	<ul class="sidebar_ul">
	                    	';
				            foreach ($role_infoo->result_array() as $getrole_infoo) {
				            	$role_submenuid = $getrole_infoo['submenuid'];

				    			$this->db->select("*");
				        		$this->db->where("menuid",$id);
					    		$menu_info2=$this->db->get("menu");
					    		
					    		foreach ($menu_info2->result_array() as $get_menu_info2) {
					    			$submenu_id = $get_menu_info2['id'];
					    			$submenu = $get_menu_info2['submenu'];
					    			$sub_link = $get_menu_info2['sub_link'];

					    			if ($role_submenuid == $submenu_id) {
					    				echo '<li><a href="'.base_url().'home/'.$sub_link.'">'.$submenu.'</a></li>';
					    			}				    			
				            	}
			            	}
			            	echo '
									</ul>
								</div>
							</div>
		                    ';
			            }
			        }

		    	}


		        
	        ?>
	        
	        </div>
	    </div>



	</div>
</div>

<!--####### leftside navbar end #######-->

<div class="col-md-10 col-lg-10 col-sm-10 col-xs-12 rightSidebar">
<!-- all content work here -->