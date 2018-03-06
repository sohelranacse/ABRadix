<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Dashboard</h3>
	</div>
	<div class="panel-body">
        <?php
            $this->db->where("status","0");
            $coustomer_data=$this->db->get("order");
            $ordercount = $coustomer_data->num_rows();
        ?>
		<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="dashModule">
                <a href="<?php echo base_url() ?>home/order_list">
                    <i class="icofont icofont-shopping-cart"><span class="badge"><?php echo $ordercount; ?></span></i>
                    <h3>ORDER</h3>
                </a>
            </div>
        </div>
        <?php
            $product_data=$this->db->get("product");
            $productcount = $product_data->num_rows();
        ?>
        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="dashModule">
                <a href="<?php echo base_url() ?>home/all_product">
                    <i class="icofont icofont-sand-clock"><span class="badge"><?php echo $productcount; ?></span></i>
                    <h3>PRODUCT</h3>
                </a>
            </div>
        </div>
        <?php
            $cous_data=$this->db->get("coustomer");
            $cous_count = $cous_data->num_rows();
        ?>
        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="dashModule">
                <a href="<?php echo base_url() ?>home/all_coustomer">
                    <i class="icofont icofont-users"><span class="badge"><?php echo $cous_count; ?></span></i>
                    <h3>COUSTOMER</h3>
                </a>
            </div>
        </div>

        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="dashModule">
                <a href="<?php echo base_url() ?>home/all_category">
                    <i class="icofont icofont-brand-dodge"></i>
                    <h3>CATEGORY</h3>
                </a>
            </div>
        </div>
        <?php
            $con_data=$this->db->get("contact");
            $con_count = $con_data->num_rows();
        ?>
        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="dashModule">
                <a href="<?php echo base_url() ?>home/contact">
                    <i class="icofont icofont-ui-contact-list"><span class="badge"><?php echo $con_count; ?></span></i>
                    <h3>CONTACT</h3>
                </a>
            </div>
        </div>

        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <div class="dashModule">
                <a href="#Profile_admin" data-toggle="modal">
                    <i class="icofont icofont-user"></i>
                    <h3>PROFILE</h3>
                </a>
            </div>
        </div>




	</div>
</div> <!-- panel end -->