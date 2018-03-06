<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> User List</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>SL</th>
						<th>username</th>
						<th width="400">Priority</th>
						<th>Role</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
		<?php
			$i = 1;
			foreach ($userlistAll as $user) {
				$id = $user->id;
				$username = $user->username;

				$role = $user->role;
				if ($role==0) {
					$roles = '<button class="btn btn-sm btn-default" type="button"><i class="icofont icofont-ui-user"></i> user </button>';
				}else{
					$roles = 'Super Admin';
				}
				$status = $user->status;
				if ($status==1) {
					$statuss = 'Active';
				}else{
					$statuss = 'Inactive';
				}
			
		?>
					<tr id="delu<?php echo $id; ?>">
						<td><?php echo $i++; ?></td>
						<td><?php echo $username ?></td>
						<td>
						<?php
						if ($id==1) {
							echo "ALL";
				        }else{
				        	$this->db->where("userId",$id);
				            $info=$this->db->get("role");
				            foreach ($info->result_array() as $getuserid) {
				                $submenuid = $getuserid['submenuid'];


				                $this->db->where("id",$submenuid);
				            	$submenu_info=$this->db->get("menu");
				            	foreach ($submenu_info->result_array() as $getsubMenu) {
				            		$submenu = $getsubMenu['submenu'];
				            		$sub_link = $getsubMenu['sub_link'];
				            		echo '<a class="btn btn-sm btn-default" href="'.base_url().'home/'.$sub_link.'">'.$submenu.'</a>&nbsp';	
				            	}
				            }
				        }
						?>
						</td>

						<td><?php echo $roles; ?></td>
						<td>
							<?php 
							if ($id==1) {
								echo "";
					        } else{ ?>
								<button value="<?php echo $id; ?>"  onclick="userstatus(this)"  class="btn btn-sm btn-warning"><i class="icofont icofont-ui-settings"></i> <?php echo $statuss; ?></button>
							<?php } ?>
						</td>
						<td>
							<?php 
							if ($id==1) {
								echo "";
					        }else{
					        	echo '
								<button value="'.$id.'"  onclick="userdel(this)" class="btn btn-sm btn-danger" type="button"><i class="icofont icofont-trash"></i></button>
					        	';
					        }
							?>
							
						</td>
					</tr>
		<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div> <!-- panel end -->