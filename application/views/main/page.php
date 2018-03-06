<?php
if (isset($contact)) { ?>
<section class="slider_area">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="brand">
					<h2>Brands</h2>
					<ul>
						<?php
							$this->db->select("*");
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
			<div class="col-md-9 controlpage">

				<div class="row">
					<h4>Contact Us</h4>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-horizontal" action="">
							<fieldset>

							<!-- Text input-->
							<div class="form-group">
							  <div class="col-md-12">
							  <input type="text" id="cname" placeholder="Your Name" class="form-control input-md" required="">
							    
							  </div>
							</div>

							<!-- Text input-->
							<div class="form-group"> 
							  <div class="col-md-12">
							  <input type="text" id="cemail" placeholder="Your Email" class="form-control input-md" required="">
							    
							  </div>
							</div>

							<!-- Text input-->
							<div class="form-group">
							  <div class="col-md-12">
							  <input type="text" id="csubject" placeholder="Subject" class="form-control input-md" required="">
							    
							  </div>
							</div>

							<!-- Textarea -->
							<div class="form-group">
							  <div class="col-md-12">                     
							    <textarea class="form-control" cols="" rows="4" id="cmessage">Message</textarea>
							  </div>
							</div>

							<!-- Button -->
							<div class="form-group">
							  <div class="col-md-12">
							    <button type="button" name="singlebutton" class="btn btn-info" onclick="sendcontact()">Send</button>
							  </div>
							</div>

							</fieldset>
						</div>
					</div>
					<div class="col-md-6">
						<p>If you have any questions, concerns or comments, please send us an email and we will get back to you within 24-48 hours, inshAllah.</p>

						<p>If you are looking for a specific style of hijab or color, please type the specific word in our search box above and it will find all items with that word or words in the description. For example if you are looking for a blue hijab, type the word 'blue' in the search box.</p>

						<p>Please see our Frequently Asked Questions page to see if you can find the answer to your question.</p>

						<div class="contact_widget">
							<p><b>Address:</b> House #83/A Road # 2/1<br>
							Muradpur, Chittagong, Bangladesh</p>

							<p><b>Phone:</b> +88 01819 156144</p>
							<p><b>Email:</b> abrahmanm2017@gmail.com</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<?php }
if (isset($about)) { ?>

<section class="slider_area">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="brand">
					<h2>Brands</h2>
					<ul>
						<?php
							$this->db->select("*");
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
			<div class="col-md-9 controlpage">
				<h4>About Us</h4>
				<div class="col-md-12">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> 

					<p>hijabbd.netis located in Pennsylvania, USA.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<?php } ?>