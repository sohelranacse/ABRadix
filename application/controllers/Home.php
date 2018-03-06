<?php
class Home extends CI_Controller
{

    function __construct() {
        parent::__construct();

        $this->load->library('session');
        
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');


        $admin_user = $this->session->userdata('username');
        if(empty($admin_user))
        {   
            redirect('login');
        }


        $this->load->model('Header_model', 'header');


    } 

    

    public function index() {
        $data=[];
        $data['title']="Admin Panel :: Hijab";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 


        $this->load->view('home'); //important

        $this->load->view("footer");
    }
    
    function logout(){
        $this->session->unset_userdata('username');
        redirect('login');      
    }

    //login and logout session control


    //password change process
    public function PasswordChange1(){
        echo '
            <div class="input-group">
                <span class="input-group-addon"><i class="icofont icofont-lock"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Enter old Password" onblur="return PasswordChange2(this)">
            </div>
            <input type="hidden" value="'.$this->session->userdata('id').'" id="hiddenSessionId">
            <div id="password2Result"></div>
        ';
    }
    public function loginPassword2(){
        $passwordIn = md5($this->input->post('passwordIn'));
        $hiddenSessionId = $this->input->post('hiddenSessionId');
        $result = $this->header->changePassword2($passwordIn ,$hiddenSessionId);
        if ($result) {
            echo '
            <div class="passInputGroup">
                <div class="input-group">
                    <span class="input-group-addon"><i class="icofont icofont-ui-unlock"></i></span>
                    <input type="password" class="form-control" id="passwordNew" placeholder="Enter new Password">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icofont icofont-ui-unlock"></i></span>
                    <input type="password" class="form-control" id="passwordNewCon" placeholder="Enter confirm Password" onblur="return passwordNewCon3()">
                </div>
                <div id="password3Result"></div>
                <div id="password4Result"></div>
            </div>
            ';
        }else{
            echo '<span style="margin-top:9px;font-size:12px;color:red;display: block">password does not exist.</span>';
        }
    }

    public function loginPassword3(){
        $id = $this->session->userdata('id');
        $passwordNewCon = md5($this->input->post('passwordNewCon'));
        $result = $this->header->changePassword3($passwordNewCon, $id);
        if ($result) {
            echo '
                <div class="alert alert-success" style="margin-top:10px">Password Successfully Changed.</div>
                <a class="btn btn-info btn-block" href="'.base_url().'home/logout">Login Now</div>
            ';
        }else{
            echo '<span style="margin-top:9px;font-size:12px;color:red;display: block">Present password can not be changed</span>';
        }

    }
    //change password end


    //page menu
    public function menu(){
        $data=[];
        $data['title']="Menu || Admin Panel";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); //100% need

        $selectMenu['selectMenu'] = $this->header->selectMenu();
        $this->load->view('menu', $selectMenu); //important

        $this->load->view("footer");
    }

    public function menuCreate(){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('menu','menu','trim|required');
        $this->form_validation->set_rules('icon','icon','trim|required');
        $this->form_validation->set_rules('menuid','menuid','trim|required');
        $this->form_validation->set_rules('submenu','submenu','trim|required');
        $this->form_validation->set_rules('sub_link','sub_link','trim|required');
        if ($this->form_validation->run()==false) {
            $this->menu();
        }else{
            $menus=array(
                'menu' => $this->input->post('menu'),
                'icon' => $this->input->post('icon'),
                'menuid' => $this->input->post('menuid'),
                'submenu' => $this->input->post('submenu'),
                'sub_link' => $this->input->post('sub_link')
            );
            $result = $this->header->menuCreate($menus);
            redirect('home/menu');
        }
    }

    public function subMenuCreate(){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('menu','menu','trim|required');
        $this->form_validation->set_rules('icon','icon','trim|required');
        $this->form_validation->set_rules('menuid','menuid','trim|required');
        $this->form_validation->set_rules('submenu','submenu','trim|required');
        $this->form_validation->set_rules('sub_link','sub_link','trim|required');

        if ($this->form_validation->run()==false) {
            $this->menu();
        }else{
            $menus=array(
                'menu' => $this->input->post('menu'),
                'icon' => $this->input->post('icon'),
                'menuid' => $this->input->post('menuid'),
                'submenu' => $this->input->post('submenu'),
                'sub_link' => $this->input->post('sub_link')
            );
            $result = $this->header->subMenuCreate($menus);
            redirect('home/menu');
        }
    }//menu and submenu created complete



    /*
    ###########################

    #### Important Process ####

    ###########################
    */

    //user list created process

    public function New_User(){
        $data=[];
        $data['title']="New User || Admin Panel";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 

        $this->load->view("New_User");

        $this->load->view("footer");
    }


    public function user_access(){
        $id = $this->input->post('id');
        $result = $this->header->selectMenu();
        if ($result) {
            echo '
                <div class="well components2">
                    <h4 class="alert alert-success"><i class="icofont icofont-ui-settings"></i> Settings</h4>
                    <ul class="sidebar_ul2">
                    
            ';
           foreach ($result as $value) {
                $id = $value->id;
                $icon = $value->icon;
                $menu = $value->menu;
                
                if (!$menu==0) {
                    echo '                    
                        <li><input type="checkbox" id="'.$id.'c" value="'.$id.':0" onclick="ttt('.$id.')"> <i class="icofont icofont-'.$icon.'"></i>  '.$menu.'</li>
                        <div class="col-xs-12 bac" id="'.$id.'p"></div>
                    ';
                }
           }
           echo '
                    </ul>
                </div>
            ';
        }

    }

    public function user_access_sub_menu(){
        $id = $this->input->post('id');
        $result = $this->header->selectMenuheader2($id);
        if ($result) {
            echo '
                <ul class="lsitul">
            ';
            foreach ($result as $sub) {
                $subId = $sub->id;
                $submenu = $sub->submenu;

                echo '<li class="listCheck"><input type="checkbox" value="'.$id.':'.$subId.'" name="menu_sub[]" checked> '.$submenu.'</li>';

            }
            echo '
                </ul>
            ';
        }
    }


    public function userSubmit(){
        $menu_sub = $this->input->post('menu_sub');

        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username','username','trim|required');
        $this->form_validation->set_rules('password','password','trim|required');
        $this->form_validation->set_rules('role','role','trim|required');
        $this->form_validation->set_rules('status','status','trim|required');

        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $role = $this->input->post('role');
        $status = $this->input->post('status');

        
        if ($this->form_validation->run()==false) {
            $this->New_User();
        }else{

            $userData=array(
                'username' => $username,
                'password' => $password,
                'role' => $role,
                'status' => $status
            );

            $insertuser = $this->db->insert('users',$userData);

            if ($insertuser) {

                $resulss = $this->header->selectlastuser();
                if ($resulss) {
                    foreach ($resulss as $lastid) {
                        $id = $lastid->id;


                        foreach ($menu_sub as $value) {

                            $sohel = explode(':',$value);
                            $menuid = $sohel[0];
                            $submenuid = $sohel[1];

                            $menus=array(
                                'userId' => $id,
                                'menuid' => $menuid,
                                'submenuid' => $submenuid
                            );

                            $this->db->insert('role',$menus);
                        }


                        redirect('home/User_List');
                    }
                }
            }

        } //else insert function
        
    } //end add user



    public function User_List(){
        $data=[];
        $data['title']="User List || Admin Panel";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 

        
        $this->load->view("User_List");

        $this->load->view("footer");
    }
    public function add_category(){
        $data=[];
        $data['title']="Add Category || Admin Panel";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 

        
        $this->load->view("add_category");

        $this->load->view("footer");
    }
    public function all_category(){
        $data=[];
        $data['title']="All Category || Admin Panel";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 

        
        $this->load->view("all_category");

        $this->load->view("footer");
    }
    public function allsubcategory(){
        $menuid = $this->input->post('menuid');

        $this->db->limit(1);
        $this->db->where("id", $menuid); 
        $query = $this->db->get("category");     
        $row = $query->row();

        $menu=$row->menu;

        echo '
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th colspan="4"><h4 class="text-center">'.$menu.'</h4></th>
                    </tr>
                    <tr>
                        <th>SL</th>
                        <th>Sub Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
        ';

        $this->db->select("*");
        $this->db->where("menuid",$menuid);
        $this->db->order_by("id",'desc');
        $category_info=$this->db->get("category");
        $i=1;
        foreach ($category_info->result_array() as $category_info_all) {
            $id = $category_info_all['id'];
            $submenu = $category_info_all['submenu'];

            echo '
                <tr id="delccat'.$id.'">
                    <td>'.$i++.'</td>
                    <td>'.$submenu.'</td>
                    <td>
                        <button class="btn btn-sm btn-info" value="'.$id.'" data-toggle="modal" data-target="#editcategory" onclick="editsubcategories(this)"><i class="icofont icofont-edit"></i></button>
                        <button class="btn btn-sm btn-danger" value="'.$id.'" onclick="delcategory(this)"><i class="icofont icofont-trash"></i></button>
                    </td>
                </tr>
            ';

        }


        echo '
                </tbody>
            </table>
        </div>
        ';
    }

    public function subcatCreate(){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('menu','menu','trim|required');
        $this->form_validation->set_rules('menuid','menuid','trim|required');
        $this->form_validation->set_rules('submenu','submenu','trim|required');

        if ($this->form_validation->run()==false) {
            $this->add_category();
        }else{
            $menus=array(
                'menu' => $this->input->post('menu'),
                'menuid' => $this->input->post('menuid'),
                'submenu' => $this->input->post('submenu')
            );
            $this->db->insert('category',$menus);
            redirect('home/all_category');
        }
    }//menu and submenu created complete

    public function updateprofile(){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id','id','trim|required');
        $this->form_validation->set_rules('username','username','trim|required');
        $this->form_validation->set_rules('email','email','trim');
        $this->form_validation->set_rules('name','name','trim');

        $id = $this->input->post('id');

        if ($this->form_validation->run()==false) {
            $this->index();
        }else{
            $users=array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'name' => $this->input->post('name')
            );
            $this->db->where('id',$id);
            $this->db->update('users',$users);
            redirect('home');
        }
    }


    public function categoryCreate(){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('menu','menu','trim|required');
        $this->form_validation->set_rules('menuid','menuid','trim|required');
        $this->form_validation->set_rules('submenu','submenu','trim|required');
        $this->form_validation->set_rules('hp','hp','trim|required');
        $this->form_validation->set_rules('hpp','hpp','trim|required');

        $menu = $this->input->post('menu');
        $menuid = $this->input->post('menuid');
        $submenu = $this->input->post('submenu');
        $hp = $this->input->post('hp');
        $hpp = $this->input->post('hpp');

        if ($this->form_validation->run()==false) {
            $this->all_category();
        }else{
            $categories=array(
                'menu' => $menu,
                'menuid' => $menuid,
                'submenu' => $submenu,
                'hps' => $hp,
                'hpp' => $hpp
            );

            $this->db->insert('category',$categories);
        
            redirect('home/all_category');

        }


        
    }

    public function changecathp(){
        $id = $this->input->post('id');

        $this->db->where("id",$id);
        $category_info=$this->db->get("category");
        foreach ($category_info->result_array() as $category_info_all) {
            $hp = $category_info_all['hps'];
            if ($hp==1) {
               $data=array(
                    'hps' => 0
                );

                $this->db->where("id",$id); 
                $this->db->update('category',$data);
            }else{
                $data=array(
                    'hps' => 1
                );

                $this->db->where("id",$id); 
                $this->db->update('category',$data);
            }

        }
        
    }
    public function changecathpp(){
        $id = $this->input->post('id');

        $this->db->where("id",$id);
        $category_info=$this->db->get("category");
        foreach ($category_info->result_array() as $category_info_all) {
            $hpp = $category_info_all['hpp'];
            if ($hpp==1) {
               $data=array(
                    'hpp' => 0
                );

                $this->db->where("id",$id); 
                $this->db->update('category',$data);
            }else{
                $data=array(
                    'hpp' => 1
                );

                $this->db->where("id",$id); 
                $this->db->update('category',$data);
            }

        }
        
    }

    public function add_product(){
        $data=[];
        $data['title']="Add Product || Admin Panel";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 

        
        $this->load->view("add_product");

        $this->load->view("footer");
    }
    public function cat_to_subcat(){
        $catid = $this->input->post('catid');
        

        $this->db->where("menuid", $catid);
        $sub_info=$this->db->get("category");
        foreach ($sub_info->result_array() as $sub_info_all) {
            $subid = $sub_info_all['id'];
            $subcat = $sub_info_all['submenu'];
            echo '<option value="'.$subid.'">'.$subcat.'</option>';
        }
    }

    public function productadded(){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('catid','catid','trim|required');
        $this->form_validation->set_rules('subid','subid','trim|required');
        $this->form_validation->set_rules('name','name','trim|required');
        $this->form_validation->set_rules('price','price','trim|required');
        $this->form_validation->set_rules('avail','avail','trim|required');
        $this->form_validation->set_rules('feature','feature','trim|required');
        $this->form_validation->set_rules('hp','hp','trim|required');

        $catid = $this->input->post('catid');
        $subid = $this->input->post('subid');
        $name = $this->input->post('name');
        $item = $this->input->post('item');
        $quality = $this->input->post('quality');
        $size = $this->input->post('size');
        $color = $this->input->post('color');
        $price = $this->input->post('price');
        $discount = $this->input->post('discount');
        $feature = $this->input->post('feature');
        $avail = $this->input->post('avail');
        $hp = $this->input->post('hp');
        $body = $this->input->post('body');

        if ($this->form_validation->run()==false) {
            $this->add_product();
        }else{

            $products=array(
                'catid' => $catid,
                'subid' => $subid,
                'name' => $name,
                'item' => $item,
                'quality' => $quality,
                'price' => $price,
                'discount' => $discount,
                'feature' => $feature,
                'avail' => $avail,
                'hp' => $hp,
                'body' => $body
            );

            $this->db->insert('product',$products);

            $this->db->limit(1);
            $this->db->order_by("pid", 'desc'); 
            $querys = $this->db->get("product");     
            $rows = $querys->row();
            $lastId=$rows->pid;

            //color
            $explode = explode(',',$color);
            $explode_length = count($explode);

            for ($i=0; $i <$explode_length ; $i++) { 
                $colors = $explode[$i];
                $color_size=array(
                    'pid' => $lastId,
                    'color' => $colors
                );

                $this->db->insert('color_size',$color_size);
            }

            //size
            $explode_s = explode(',',$size);
            $explode_length_s = count($explode_s);

            for ($i=0; $i <$explode_length_s ; $i++) { 
                $sizes = $explode_s[$i];
                $color_size=array(
                    'pid' => $lastId,
                    'size' => $sizes
                );

                $this->db->insert('color_size',$color_size);
            }


            $config['upload_path'] = './assest/images/product/';

            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = '200000';
            $config['max_width'] = '1524000';
            $config['max_height'] = '1000000';

            $this->load->library('upload', $config);
            $this->load->library('image_lib');
                        
            $upload = $this->upload->do_upload('userfile');


            if($upload == true){

                $data1 = array('upload_data' => $this->upload->data());
                $image= $data1['upload_data']['file_name'];

                $configBig = array();
                $configBig['image_library'] = 'gd2';
                $configBig['source_image'] = './assest/images/product/'.$image;
                        
                        
                $configBig['create_thumb'] = TRUE;
                $configBig['maintain_ratio'] = FALSE;
                $configBig['width'] = 450;
                $configBig['height'] = 450;
                $configBig['thumb_marker'] = "_big";
                $this->image_lib->initialize($configBig);
                $this->image_lib->resize();
                $this->image_lib->clear();
                unset($configBig);

                $filename1 = $data1['upload_data']['raw_name'].'_big'.$data1['upload_data']['file_ext'];

                $this->db->limit(1);
                $this->db->order_by("pid", 'desc'); 
                $query = $this->db->get("product");     
                $row = $query->row();
                $lastid=$row->pid;

                $rename = $this->input->post('pho').$lastid.".jpg";

                rename('./assest/images/product/' .$filename1, './assest/images/product/' .$rename);

                unlink('./assest/images/product/'.$image);
            }

            redirect('home/all_product');
        }
    }
    public function all_product(){
        $data=[];
        $data['title']="ALL Product || Admin Panel";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 

        //pagination start
        $config = array();
        $config["base_url"] = base_url() . "home/all_product";
        $config["total_rows"] = $this->header->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = 'FIRST';
        $config["uri_segment"] = 3;
        $config['last_link'] = 'LAST';
        $config['next_link'] = '...NEXT';
        $config['prev_link'] = 'PREV...';

        $config['full_tag_open'] = '<div class="paginations">';
        $config['full_tag_close'] = '</div>';
        $config['anchor_class'] = 'class="number" ';
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data1["results"] = $this->header->fetch_products($config["per_page"], $page);
        $data1["links"] = $this->pagination->create_links();
        //pagination end

        $this->load->view("all_product", $data1);

        $this->load->view("footer");
    }
    public function deleteproduct(){
        $delid = $this->input->post('delid');
        $result = $this->header->deleteproduct($delid);
        echo json_encode($result);
        unlink('./assest/images/product/'.$delid.'.jpg');
        $this->db->where("pid", $delid); 
        $this->db->delete("color_size");
    }

    public function product_updated($pid){
        $data=[];
        $data['title']="Product Updated || Admin Panel";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 

        $data1["results"] = $this->header->fetch_alledit_products($pid);
        $this->load->view("product_updated", $data1);

        $this->load->view("footer");
    }
    public function productedit(){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('pid','pid','trim|required');
        $this->form_validation->set_rules('catid','catid','trim|required');
        $this->form_validation->set_rules('subid','subid','trim|required');
        $this->form_validation->set_rules('name','name','trim|required');
        $this->form_validation->set_rules('price','price','trim|required');
        $this->form_validation->set_rules('avail','avail','trim|required');
        $this->form_validation->set_rules('feature','feature','trim|required');
        $this->form_validation->set_rules('hp','hp','trim|required');

        $this->form_validation->set_rules('color','color','trim');
        $this->form_validation->set_rules('size','size','trim');

        $pid = $this->input->post('pid');

        $catid = $this->input->post('catid');
        $subid = $this->input->post('subid');
        $name = $this->input->post('name');
        $item = $this->input->post('item');
        $quality = $this->input->post('quality');
        $size = $this->input->post('size');
        $color = $this->input->post('color');
        $price = $this->input->post('price');
        $discount = $this->input->post('discount');
        $feature = $this->input->post('feature');
        $avail = $this->input->post('avail');
        $hp = $this->input->post('hp');
        $body = $this->input->post('body');

        if ($this->form_validation->run()==false) {
            $this->all_product();
        }else{

            $products=array(
                'catid' => $catid,
                'subid' => $subid,
                'name' => $name,
                'item' => $item,
                'quality' => $quality,
                'price' => $price,
                'discount' => $discount,
                'feature' => $feature,
                'avail' => $avail,
                'hp' => $hp,
                'body' => $body
            );

            $this->db->where('pid',$pid);
            $this->db->update('product',$products);

            

            
            $this->db->where("pid", $pid); 
            $this->db->delete("color_size");

            //color
            $explode = explode(',',$color);
            $explode_length = count($explode);

            for ($i=0; $i <$explode_length ; $i++) { 
                $colors = $explode[$i];
                $color_size=array(
                    'pid' => $pid,
                    'color' => $colors
                );

                $this->db->insert('color_size',$color_size);
            }

            //size
            $explode_s = explode(',',$size);
            $explode_length_s = count($explode_s);

            for ($i=0; $i <$explode_length_s ; $i++) { 
                $sizes = $explode_s[$i];
                $color_size=array(
                    'pid' => $pid,
                    'size' => $sizes
                );

                $this->db->insert('color_size',$color_size);
            }


            $config['upload_path'] = './assest/images/product/';

            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = '200000';
            $config['max_width'] = '1524000';
            $config['max_height'] = '1000000';

            $this->load->library('upload', $config);
            $this->load->library('image_lib');
                        
            $upload = $this->upload->do_upload('userfile');


            if($upload == true){
                unlink('./assest/images/product/'.$pid.'.jpg');
                $data1 = array('upload_data' => $this->upload->data());
                $image= $data1['upload_data']['file_name'];

                $configBig = array();
                $configBig['image_library'] = 'gd2';
                $configBig['source_image'] = './assest/images/product/'.$image;
                        
                        
                $configBig['create_thumb'] = TRUE;
                $configBig['maintain_ratio'] = FALSE;
                $configBig['width'] = 450;
                $configBig['height'] = 450;
                $configBig['thumb_marker'] = "_big";
                $this->image_lib->initialize($configBig);
                $this->image_lib->resize();
                $this->image_lib->clear();
                unset($configBig);

                $filename1 = $data1['upload_data']['raw_name'].'_big'.$data1['upload_data']['file_ext'];

                $rename = $this->input->post('userfile').$pid.".jpg";

                rename('./assest/images/product/' .$filename1, './assest/images/product/' .$rename);

                unlink('./assest/images/product/'.$image);
            }

            redirect('home/all_product');
        }
    }
    public function changeProducthp(){
        $id = $this->input->post('id');

        $this->db->where("pid",$id);
        $category_info=$this->db->get("product");
        foreach ($category_info->result_array() as $category_info_all) {
            $hp = $category_info_all['hp'];
            if ($hp==1) {
               $data=array(
                    'hp' => 0
                );

                $this->db->where("pid",$id); 
                $this->db->update('product',$data);
            }else{
                $data=array(
                    'hp' => 1
                );

                $this->db->where("pid",$id); 
                $this->db->update('product',$data);
            }

        }
        
    }
    //product end

    public function all_coustomer(){
        $data=[];
        $data['title']="ALL Coustomer || Admin Panel";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data);

        //pagination start
        $config = array();
        $config["base_url"] = base_url() . "home/all_coustomer";
        $config["total_rows"] = $this->header->all_coustomer_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = 'FIRST';
        $config["uri_segment"] = 3;
        $config['last_link'] = 'LAST';
        $config['next_link'] = '...NEXT';
        $config['prev_link'] = 'PREV...';

        $config['full_tag_open'] = '<div class="paginations">';
        $config['full_tag_close'] = '</div>';
        $config['anchor_class'] = 'class="number" ';
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data1["results"] = $this->header->fetch_coustomer($config["per_page"], $page);
        $data1["links"] = $this->pagination->create_links();
        //pagination end

        $this->load->view("all_coustomer", $data1);

        $this->load->view("footer");
    }
    public function order_list(){
        $data=[];
        $data['title']="Order List || Admin Panel";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 

        //pagination start
        $config = array();
        $config["base_url"] = base_url() . "home/order_list";
        $config["total_rows"] = $this->header->orderlist_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = 'FIRST';
        $config["uri_segment"] = 3;
        $config['last_link'] = 'LAST';
        $config['next_link'] = '...NEXT';
        $config['prev_link'] = 'PREV...';

        $config['full_tag_open'] = '<div class="paginations">';
        $config['full_tag_close'] = '</div>';
        $config['anchor_class'] = 'class="number" ';
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data1["results"] = $this->header->fetch_order($config["per_page"], $page);
        $data1["links"] = $this->pagination->create_links();
        //pagination end


        $this->load->view("order_list", $data1);

        $this->load->view("footer");
    }
    
    public function changeCoustomerStatus(){
        

        $id = $this->input->post('status');

        $this->db->where("id",$id);
        $category_info=$this->db->get("coustomer");
        foreach ($category_info->result_array() as $category_info_all) {
            $status = $category_info_all['status'];
            if ($status==1) {
               $data=array(
                    'status' => 0
                );

                $this->db->where("id",$id); 
                $this->db->update('coustomer',$data);
            }else{
                $data=array(
                    'status' => 1
                );

                $this->db->where("id",$id); 
                $this->db->update('coustomer',$data);
            }

        }
        
    }
    public function changeOrderStatus(){
        $id = $this->input->post('status');

        $this->db->where("id",$id);
        $category_info=$this->db->get("order");
        foreach ($category_info->result_array() as $category_info_all) {
            $status = $category_info_all['status'];
            if ($status==1) {
               $data=array(
                    'status' => 0
                );

                $this->db->where("id",$id); 
                $this->db->update('order',$data);
            }else{
                $data=array(
                    'status' => 1
                );

                $this->db->where("id",$id); 
                $this->db->update('order',$data);
            }

        }
    }

    public function createbill(){
        $orderid = $this->input->post('orderid');
        echo '
        <form action="'.base_url().'home/createbillupdate" method="POST" class="form-horizontal container" role="form" style="padding:20px 20px 0 20px;border:1px solid #ddd;margin-bottom:10px;">
            <div class="form-group">
                <div class="col-sm-6"> 
                    <label for="">Courier Cost</label>
                    <input type="hidden" class="form-control" name="create_by" value="'.$this->session->userdata('name').'">
                    <input type="hidden" class="form-control" name="orderid" value="'.$orderid.'">
                    <input type="text" class="form-control" name="courier">
                </div>
                <div class="col-sm-6"> 
                    <label for="">Others</label>
                    <input type="text" class="form-control" name="others">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12"> 
                    <label for="">Note</label>
                    <input type="text" class="form-control" name="note">
                </div>
                <div class="col-sm-12 text-center">
                    <label for="" style="visibility:hidden;padding-top:30px">Note</label>
                    <button type="submit" class="btn btn-info">UPDATE</button>
                </div>
            </div>
        </form>


        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th width="18%">Action</th>
                    </tr>
                </thead>
                <tbody>
        ';

        $i=1;
        $sum = 0;
        $qty = 0;

        $this->db->where("orderid",$orderid);
        $this->db->order_by("id",'desc');
        $pro_info=$this->db->get("orderlist");
        foreach ($pro_info->result_array() as $pro_all) {
            $id = $pro_all['id'];
            $pid = $pro_all['pid'];

            $name = $pro_all['name'];
            $quantity = $pro_all['quantity'];
            $price = $pro_all['price'];
            $pricee = $pro_all['price']* $quantity;
            $size = $pro_all['size'];
            $color = $pro_all['color'];

            $stat = $pro_all['status'];
            if ($stat==0) {
                $status = '<button class="btn btn-sm btn-warning" disabled>PENDING</button>';
            }elseif ($stat==1) {
                $status = '<button class="btn btn-sm btn-success" disabled>DONE</button>';
            }elseif ($stat==2) {
                $status = '<button class="btn btn-sm btn-danger" disabled>CENCEL</button>';
            }

            $Totalprice = $price*$quantity;

            if ($stat==0 || $stat==1) {
        ?>
                <tr id="hide<?php echo $id; ?>">
                    <td><?php echo $i++; ?></td>
                    <td><img width="20" src="<?php echo base_url() ?>assest/images/product/<?php echo $pid; ?>.jpg" onerror="this.src='<?php echo base_url(); ?>assest/images/product/alt.jpg'"; style="height:20px !important;"></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $color; ?></td>
                    <td><?php echo $size; ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td><?php echo $price;?>Tk.</td>
                    <td><?php echo $Totalprice; ?>Tk.</td>
                    <td><span id="statusbill<?php echo $id; ?>"><?php echo $status; ?></span></td>

                    <td>
                        <button class="btn btn-sm btn-warning" value="0:<?php echo $id; ?>" onclick="billstatus(this)">PENDING</button>
                        <button class="btn btn-sm btn-danger" value="2:<?php echo $id; ?>" onclick="billstatus(this)">CENCEL</button>
                        <button class="btn btn-sm btn-success" value="1:<?php echo $id; ?>" onclick="billstatus(this)">DONE</button>
                    </td>
                </tr>
                <?php
                    $qty = $qty + $quantity;
                    $sum = $sum+$pricee;
                }}
                $this->db->where('id',1);
                $setting = $this->db->get('setting');
                foreach ($setting->result_array() as $setting_vat) {
                    $vatdata = $setting_vat['vat'];
                }

                $this->db->where('id',$orderid);
                $orderinfo = $this->db->get('order');
                foreach ($orderinfo->result_array() as $orderdata) {
                    $courier = $orderdata['courier'];
                    $others = $orderdata['others'];
                    $note = 'Note: <b>'.$orderdata['note'].'</b>';
                }


                $vat = $vatdata/100;

                $vatadd = $sum*$vat;

                $gTottal = $sum + $vatadd+$courier+$others;
                ?>
                <tr>
                    <th class="text-right" colspan="7">Sub Total</th>
                    <td><?php echo $sum; ?>Tk.</td>
                </tr>
                <tr>
                    <th class="text-right" colspan="7">Vat</th>
                    <td><?php echo $vatdata;?>% (<?php echo $vatadd;?>Tk.)</td>
                </tr>
                
                <tr>
                    <td colspan="6"><?php echo $note;?></td>                    
                    <th class="text-right">Courier/others</th>
                    <td><?php echo $courier+$others;?>Tk.</td>
                </tr>
                <tr class="info">
                    <th class="text-right" colspan="7">Grant Total</th>
                    <td><?php echo $gTottal;?>Tk.</td>
                </tr>

            </tbody>
        </table>
    </div>
    <?php 
    }
    public function vatchange(){
        $vat = $this->input->post('vat');
        $changevat = array('vat' => $vat);
        $this->db->where('id',1);
        $this->db->update('setting', $changevat);
        echo 'Vat Changing Successfully.';
    }

    public function createbillupdate(){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('create_by','create_by','trim|required');
        $this->form_validation->set_rules('orderid','orderid','trim|required');
        $this->form_validation->set_rules('courier','courier','trim');
        $this->form_validation->set_rules('others','others','trim');
        $this->form_validation->set_rules('note','note','trim');
        $orderid = $this->input->post('orderid');

        if ($this->form_validation->run()==false) {
            $this->order_list();
        }else{
            $biils=array(
                'create_by' => $this->input->post('create_by'),
                'courier' => $this->input->post('courier'),
                'others' => $this->input->post('others'),
                'note' => $this->input->post('note')
            );
            $this->db->where('id',$orderid);
            $this->db->update('order',$biils);
            redirect('home/order_list');
        }
    }
    public function billstatus(){
        $bstatus = $this->input->post('bstatus');

        $bexplode = explode(':',$bstatus);
        $status = $bexplode[0];
        $id = $bexplode[1];


        $upstatus=array(
            'status' => $status
        );

        $this->db->where('id',$id);  
        $this->db->update('orderlist',$upstatus);



        $this->db->where("id", $id); 
        $query = $this->db->get("orderlist");     
        $row = $query->row();

        $status=$row->status;

        if ($status==0) {
            echo '<button class="btn btn-sm btn-warning" disabled>PENDING</button>';
        }elseif ($status==1) {
            echo '<button class="btn btn-sm btn-success" disabled>DONE</button>';
        }elseif ($status==2) {
            echo 2;
        }

    }
    public function deletedorder(){
        $orderid = $this->input->post('orderid');

        $this->db->where('id',$orderid);  
        $this->db->delete('order');
        echo 'Order deleted Successfull';
    }

    //admin panel works start 
    public function contact(){
        $data=[];
        $data['title']="Contact List || Admin Panel";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 


        $this->load->view("contact");

        $this->load->view("footer");
    }

    public function delcontact(){
        $delid = $this->input->post('delid');
        $result = $this->header->delcontact($delid);
        echo json_encode($result);
    }
    public function editcontact(){
        $eid = $this->input->post('eid');        
        $this->db->where('id',$eid);
        $query = $this->db->get('contact');
        foreach ($query->result_array() as $value) {
            $id = $value['id'];
            $name = $value['name'];
            $email = $value['email'];
            $subject = $value['subject'];
            $message = $value['message'];
        }

        $fullform = '
            
            <div class="form-group">
                <label for="">To</label> <span class="label label-default"> <small>your</small></span>
                <input type="text" class="form-control" id="conTo" value="'.$this->session->userdata('email').'">
            </div>
            <div class="form-group">
                <label for="">From</label>
                <input type="text" class="form-control" id="conFrom" value="'.$email.'" readonly>
            </div>
            <div class="form-group">
                <label for="">Subject</label>
                <input type="text" class="form-control" id="conSubject" placeholder="Enter Subject">
            </div>
            <div class="form-group">
                <label for="">Message</label>
                <textarea id="conMessage" class="form-control" cols="30" rows="5" placeholder="Enter Message"></textarea>
            </div>
            <button type="submit" class="btn btn-success" onclick="ReplyMessages()">Reply <i class="icofont icofont-undo"></i></button>
            
            ';
        echo json_encode($fullform);
    }
    public function ReplyMessages(){
        $conTo = $this->input->post('conTo');
        $conFrom = $this->input->post('conFrom');
        $conSubject = $this->input->post('conSubject');
        $conMessage = $this->input->post('conMessage');

        mail($conTo,$conSubject,$conMessage,$conFrom);

        
        $result = 'success';
        echo json_encode($result);
    }

    public function delcoustomer(){
        $delid = $this->input->post('delid');
        $result = $this->header->delcoustomer($delid);
        echo json_encode($result);
    }
    public function userstatus(){
        $id = $this->input->post('editg');

        $this->db->where("id",$id);
        $category_info=$this->db->get("users");
        foreach ($category_info->result_array() as $category_info_all) {
            $status = $category_info_all['status'];
            if ($status==1) {
               $data=array(
                    'status' => 0
                );

                $this->db->where("id",$id); 
                $this->db->update('users',$data);
            }else{
                $data=array(
                    'status' => 1
                );

                $this->db->where("id",$id); 
                $this->db->update('users',$data);
            }

        }
    }
    public function userdel(){
        $delid = $this->input->post('delid');

        $this->db->where('id',$delid);
        $this->db->delete('users');
    }
    public function editcategories(){
        $id = $this->input->post('id');

        $this->db->where("id",$id);
        $category_info=$this->db->get("category");
        foreach ($category_info->result_array() as $category_info_all) {
            $menu = $category_info_all['menu'];
        }

        echo '
        <form action="'.base_url().'home/editcategoriessubmit" method="POST" role="form">

            <div class="form-group">
                <label for="">label</label>
                <input type="hidden" name="id" value="'.$id.'">
                <input type="text" class="form-control" name="menu" value="'.$menu.'">
            </div>


            <button type="submit" class="btn btn-info">Update</button>
        </form>
        ';
    }
    public function editsubcategories(){
        $id = $this->input->post('id');

        $this->db->where("id",$id);
        $category_info=$this->db->get("category");
        foreach ($category_info->result_array() as $category_info_all) {
            $submenu = $category_info_all['submenu'];
        }

        echo '
        <form action="'.base_url().'home/editsubcategoriessubmit" method="POST" role="form">

            <div class="form-group">
                <label for="">label</label>
                <input type="hidden" name="id" value="'.$id.'">
                <input type="text" class="form-control" name="submenu" value="'.$submenu.'">
            </div>


            <button type="submit" class="btn btn-info">Update</button>
        </form>
        ';
    }
    public function editcategoriessubmit(){
        $id = $this->input->post('id');
        $menu = $this->input->post('menu');
        if (!empty($id) || !empty($menu)) {
            $data=array(
                'menu' => $menu
            );

            $this->db->where("id",$id); 
            $this->db->update('category',$data);
            redirect('home/all_category');
        }

    }
    public function editsubcategoriessubmit(){
        $id = $this->input->post('id');
        $submenu = $this->input->post('submenu');
        if (!empty($id) || !empty($menu)) {
            $data=array(
                'submenu' => $submenu
            );

            $this->db->where("id",$id); 
            $this->db->update('category',$data);
            redirect('home/all_category');
        }

    }
    public function delcategory(){
        $delid = $this->input->post('delid');
        $result = $this->header->delcategory($delid);
        echo json_encode($result);
    }
    




} 
?>