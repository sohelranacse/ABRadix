<?php
class Main extends CI_Controller
{

    function __construct() {
        parent::__construct();

        session_start();
        $this->load->model('header_model', 'header');
        $this->load->helper('form');
    }
    public function index() {
        $data=[];
        $data['title']="ABRadix | Online Shop |Trending fashion in every aspect of life. All Product you need. +88 1819 156144";
        $this->load->view("main/headar", $data); 


        $this->load->view('main/index');

        $this->load->view("main/footer");
    }
    public function about() {
        $data=[];
        $data['title']="About us | ABRadix | Online Shop |Trending fashion in every aspect of life. All Product you need. +88 1819 156144";
        $this->load->view("main/headar", $data); 

        $data2['about'] = '';
        $this->load->view('main/page', $data2);

        $this->load->view("main/footer");
    }
    public function contact() {
        $data=[];
        $data['title']="Contact us | ABRadix | Online Shop |Trending fashion in every aspect of life. All Product you need. +88 1819 156144";
        $this->load->view("main/headar", $data); 

        $data2['contact'] = '';
        $this->load->view('main/page', $data2);

        $this->load->view("main/footer");
    }

    public function prodetails($link)
    {
        $explode = explode('_0',$link);
        $pid = $explode[1];

        //start
        $this->db->where("pid", $pid); 
        $query = $this->db->get("product");     
        $row = $query->row();
        $title=$row->name; //end

        $data=[];
        $data['title']=$title." | ABRadix | Online Shop |Trending fashion in every aspect of life. All Product you need. +88 1819 156144";
        $this->load->view("main/headar", $data);

        $data2['link'] = $link;
        $this->load->view('main/prodetails', $data2);

        $this->load->view('main/footer');
    }
    public function category($catid){
        //start
        $this->db->where("id", $catid); 
        $query = $this->db->get("category");     
        $row = $query->row();
        $title=$row->menu; //end

        $data=[];
        $data['title']=$title." | ABRadix | Online Shop |Trending fashion in every aspect of life. All Product you need. +88 1819 156144";
        $this->load->view("main/headar", $data);

        $data2['catid'] = $catid;
        $this->load->view('main/category', $data2);

        $this->load->view('main/footer');
    }
    public function product($id){

        //start
        $this->db->where("id", $id); 
        $query = $this->db->get("category");     
        $row = $query->row();
        $title=$row->submenu; //end

        $data=[];
        $data['title']=$title." | ABRadix | Online Shop |Trending fashion in every aspect of life. All Product you need. +88 1819 156144";
        $this->load->view("main/headar", $data);

        $data2['submenuid'] = $id;
        $this->load->view('main/product', $data2);

        $this->load->view('main/footer');
    }

    //login
    public function coustomerlogin(){
        $email = $this->input->post('logincousemail');
        $password = md5($this->input->post('logincouspassword'));

               
        $LoginQuery = $this->db->get_where('coustomer',array('email'=>$email, 'password'=>$password, 'status'=>1));

        if ($LoginQuery->num_rows()>0) 
        {
            
            $row= $LoginQuery->row();
            
            $_SESSION['email'] = $email;

            redirect('main');
        }
        else 
        {
            //echo '<script type="text/javascript">alert("username or password not matched");</script>';
            redirect('main');
        }
        
    }
    public function logout(){        
        session_destroy();
        redirect('main');
    }
    public function coustomeraccount(){
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $mobile = $this->input->post('mobile');
        $address = $this->input->post('address');

        $address2 = $this->input->post('address2');
        $zip = $this->input->post('zip');
        $city = $this->input->post('city');

        $status = 1;

        
        $checkemail = $this->db->get_where('coustomer',array('email'=>$email));

        if ($checkemail->num_rows()>0) 
        {
            
            $row= $checkemail->row();
            echo 'Email Already Exist.';
        }
        else 
        {
            $coutomerinsert = array(
                'name'      => $name,
                'email'     => $email,
                'password'  => $password,
                'mobile'    => $mobile,
                'address'   => $address,
                'address2'  => $address2,
                'zip'       => $zip,
                'city'      => $city,
                'status'    => $status
            );
            $this->db->insert('coustomer',$coutomerinsert);
            echo 'Account Created Successfully. Log in your Account.';
        }
    }
    //login logout compslete


    public function addtopshop(){
        $pid = $this->input->post('pid');

        $sesid = Session_id();
        $quantity = 1;

        $this->db->where("pid",$pid);
        $pro_info=$this->db->get("product");
        foreach ($pro_info->result_array() as $pro_all) {
            $name = $pro_all['name'];
            $pricePrev = $pro_all['price'];  

            $discount = $pro_all['discount'];

            $sohel = ($pricePrev*$discount)/100;
            $price = $pricePrev-$sohel;
        }
        

        $this->db->where("pid",$pid);
        $this->db->where("sesid",$sesid);
        $cartcheck=$this->db->get("cart");
        foreach ($cartcheck->result_array() as $cart_all) {
            $cartid = $cart_all['id'];
            $cartPid = $cart_all['pid'];
            $cartQty = $cart_all['quantity'];

            if ($cartPid == $pid ) {
                
                $qty = $cartQty+$quantity;

                $ctotal = $price*$qty;

                $cartupdate=array(
                    'quantity' => $qty,
                    'total' => $ctotal
                );

                $this->db->where('id',$cartid);
                $this->db->update('cart',$cartupdate);
                
                $sesids = Session_id(); 
                $this->db->where("sesid",$sesids);
                $query=$this->db->get("cart");
                $rowcount = $query->num_rows();
                echo json_encode($rowcount);
                return false;
            }
        }

        $total = $price*$quantity; //for insert
        $cartinsert=array(
            'pid' => $pid,
            'sesid' => $sesid,
            'name' => $name,
            'quantity' => $quantity,
            'price' => $price,
            'total' => $total
        );

        $this->db->insert('cart',$cartinsert);

        $sesids = Session_id(); 
        $this->db->where("sesid",$sesids);
        $query=$this->db->get("cart");
        $rowcount = $query->num_rows();
        echo json_encode($rowcount);
        return false;

    }
    public function addtopshopDetails(){
        $pid = $this->input->post('pid');
        $name = $this->input->post('name');
        $color = $this->input->post('color');
        $size = $this->input->post('size');

        $price = $this->input->post('price');
        $quantity = $this->input->post('quantity');

        $sesid = Session_id();




        $this->db->where("pid",$pid);
        $this->db->where("sesid",$sesid);
        $cartcheck=$this->db->get("cart");
        foreach ($cartcheck->result_array() as $cart_all) {
            $cartid = $cart_all['id'];
            $cartPid = $cart_all['pid'];
            $cartQty = $cart_all['quantity'];

            if ($cartPid == $pid ) {
                
                $qty = $cartQty+$quantity;
                $ctotal = $price*$qty;
                $cartupdate=array(
                    'quantity' => $qty,
                    'color' => $color,
                    'size' => $size,
                    'price' => $price,
                    'total' => $ctotal
                );

                $this->db->where('id',$cartid);
                $this->db->update('cart',$cartupdate);
                
                $sesids = Session_id(); 
                $this->db->where("sesid",$sesids);
                $query=$this->db->get("cart");
                $rowcount = $query->num_rows();
                echo json_encode($rowcount);
                return false;
            }
        }
        $total = $price*$quantity; //for insert
        $cartinsert=array(
            'pid' => $pid,
            'sesid' => $sesid,
            'name' => $name,
            'quantity' => $quantity,
            'color' => $color,
            'price' => $price,
            'size' => $size,
            'total' => $total
        );

        $this->db->insert('cart',$cartinsert);
        
        $sesids = Session_id(); 
        $this->db->where("sesid",$sesids);
        $query=$this->db->get("cart");
        $rowcount = $query->num_rows();
        echo json_encode($rowcount);
        return false;
    }

    public function cartshow(){
        $sesids = Session_id(); 
        $this->db->where("sesid",$sesids);
        $query=$this->db->get("cart");
        $rowcount = $query->num_rows();
        echo json_encode($rowcount);
    }
    public function cartdetailsshow(){
        $sesids = Session_id();
        $query = $this->header->allcart($sesids);

        echo json_encode($query);
    }
    public function cartupdate(){
        $id = $this->input->post('proid');

        $this->db->where("id",$id);
        $pro_info=$this->db->get("cart");
        foreach ($pro_info->result_array() as $pro_all) {
            $quantity = $pro_all['quantity'];
            $price = $pro_all['price'];
            $total = $pro_all['total'];
        }

        $addQtys = $quantity+1;
        $add_tatal = $total+$price;

        $addQty=array(
            'quantity' => $addQtys,
            'total' => $add_tatal
        );

        $this->db->where('id',$id);  
        $this->db->update('cart',$addQty);

        $sesids = Session_id();
        $query = $this->header->allcart_up($sesids, $id);

        echo json_encode($query);
    }
    public function cartupdate_sub(){
        $id = $this->input->post('proid');

        $this->db->where("id",$id);
        $pro_info=$this->db->get("cart");
        foreach ($pro_info->result_array() as $pro_all) {
            $quantity = $pro_all['quantity'];
            $price = $pro_all['price'];
            $total = $pro_all['total'];
        }

        $addQtys = $quantity-1;
        $add_tatal = $total-$price;

        $addQty=array(
            'quantity' => $addQtys,
            'total' => $add_tatal
        );

        $this->db->where('id',$id);  
        $this->db->update('cart',$addQty);

        $sesids = Session_id();
        $query = $this->header->allcart_up($sesids, $id);

        echo json_encode($query);
    }
    public function cartdeleted(){
        $cid = $this->input->post('cid');
        $this->db->where('id', $cid);
        $this->db->delete('cart');

        $sesids = Session_id(); 
        $this->db->where("sesid",$sesids);
        $query=$this->db->get("cart");
        $rowcount = $query->num_rows();
        echo json_encode($rowcount);

    }

    public function orderlist()
    {
        $data=[];
        $data['title']="Order List | ABRadix | Online Shop |Trending fashion in every aspect of life. All Product you need. +88 1819 156144";
        $this->load->view("main/headar", $data);

        $data2['orderlist'] = '';
        $this->load->view('main/orderlist', $data2);

        $this->load->view('main/footer');
    }

    public function submitorder($sesid){

        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name','name','trim|required');
        $this->form_validation->set_rules('email','email','trim');
        $this->form_validation->set_rules('mobile','mobile','trim|required');
        $this->form_validation->set_rules('address2','address2','trim');
        $this->form_validation->set_rules('zip','zip','trim');
        $this->form_validation->set_rules('city','city','trim');

        $sesid = Session_id();
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $address = $this->input->post('address');

        $address2 = $this->input->post('address2');
        $zip = $this->input->post('zip');
        $city = $this->input->post('city');
        $status = 0;


        $ordernow=array(
            'name' => $name,
            'sesid' => $sesid,
            'email' => $email,
            'mobile' => $mobile,
            'address' => $address,
            'address2' => $address2,
            'zip' => $zip,
            'city' => $city,
            'status' => $status
        );
        $this->db->insert('order',$ordernow);
        redirect('main/orderconfirm');
    }
    public function orderconfirm(){
        $data=[];
        $data['title']="Order Confirm | Checkout | ABRadix | Online Shop |Trending fashion in every aspect of life. All Product you need. +88 1819 156144";
        $this->load->view("main/headar", $data);
        $sesid = Session_id();

        $data2['orderconfirm'] = $sesid;
        $this->load->view('main/orderconfirm', $data2);

        $this->load->view('main/footer');
    }
    public function profile(){
        $data=[];
        $data['title']="Profile | ABRadix | Online Shop |Trending fashion in every aspect of life. All Product you need. +88 1819 156144";
        $this->load->view("main/headar", $data);

        $data2['profile']='';
        $this->load->view('main/profile', $data2);

        $this->load->view('main/footer');
    }
    public function edit_profile(){
        $data=[];
        $data['title']="Edit Profile | ABRadix | Online Shop |Trending fashion in every aspect of life. All Product you need. +88 1819 156144";
        $this->load->view("main/headar", $data);

        $data2['edit_profile']='';
        $this->load->view('main/profile', $data2);

        $this->load->view('main/footer');
    }
    public function change_pass(){
        $data=[];
        $data['title']="Change Password | ABRadix | Online Shop |Trending fashion in every aspect of life. All Product you need. +88 1819 156144";
        $this->load->view("main/headar", $data);

        $data2['change_pass']='';
        $this->load->view('main/profile', $data2);

        $this->load->view('main/footer');
    }
    public function order(){
        $data=[];
        $data['title']="Order | ABRadix | Online Shop |Trending fashion in every aspect of life. All Product you need. +88 1819 156144";
        $this->load->view("main/headar", $data);

        $data2['order']='';
        $this->load->view('main/profile', $data2);

        $this->load->view('main/footer');
    }

    public function invoice_all($invoiceid){
        $data2['title'] = 'Invoice No. :: '.$invoiceid;

        $data2['invoiceid']=$invoiceid;
        $this->load->view('main/invoice_all', $data2);
    }
    public function hadcashPay(){
        $sesid = $this->input->post('sesid');

        $this->db->where('sesid',$sesid);
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $order_profiile = $this->db->get('order');
        foreach ($order_profiile->result_array() as $profile_info) {
            $orderid = $profile_info['id'];
            $ordername = $profile_info['name']; //form sms
        }

        $payment = 'Hand Cash';

        $this->db->where('sesid',$sesid);
        $cart_info = $this->db->get('cart');
        foreach ($cart_info->result_array() as $cart_details) {
            $cid = $cart_details['id'];
            $pid = $cart_details['pid'];
            $name = $cart_details['name'];
            $quantity = $cart_details['quantity'];
            $price = $cart_details['price'];
            $color = $cart_details['color'];
            $size = $cart_details['size'];
            $added_date = $cart_details['added_date'];

            $orderUP=array(
                'payment' => $payment
            );
            $this->db->where('sesid',$sesid);
            $this->db->order_by('id','desc');
            $this->db->limit(1);
            $this->db->update('order',$orderUP);



            $orderlistinsert=array(
                'sesid' => $sesid,
                'orderid' => $orderid,
                'cid' => $cid,
                'pid' => $pid,
                'name' => $name,
                'quantity' => $quantity,
                'price' => $price,
                'color' => $color,
                'size' => $size,
                'cart_date' => $added_date
            );
            $this->db->insert('orderlist',$orderlistinsert);

        }


        $message = 'Order Request by '.$ordername.'. Invoice No : '.$orderid.'. Transection : Handcash.';

        $curlPost = 'user=e-salebazar&password=Z1kemW04&sender=e-salebazar&SMSText='.$message.'&GSM=8801752488173';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://api.bulksms.icombd.com/api/v3/sendsms/plain');
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);
        curl_close($ch);


        $this->db->where('sesid',$sesid);
        $this->db->delete('cart');
        echo "Order Successfully Complete.";
    }
    public function BcashPay(){
        $sesid = $this->input->post('sesid');
        $paymentTrax = $this->input->post('payment');

        $this->db->where('sesid',$sesid);
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $order_profiile = $this->db->get('order');
        foreach ($order_profiile->result_array() as $profile_info) {
            $orderid = $profile_info['id'];
            $ordername = $profile_info['name']; //form sms
        }

        $payment = 'Bkash-'.$paymentTrax;
        $transection = $paymentTrax; //for sms

        $this->db->where('sesid',$sesid);
        $cart_info = $this->db->get('cart');
        foreach ($cart_info->result_array() as $cart_details) {
            $cid = $cart_details['id'];
            $pid = $cart_details['pid'];
            $name = $cart_details['name'];
            $quantity = $cart_details['quantity'];
            $price = $cart_details['price'];
            $color = $cart_details['color'];
            $size = $cart_details['size'];
            $added_date = $cart_details['added_date'];

            $orderUP=array(
                'payment' => $payment
            );
            $this->db->where('sesid',$sesid);
            $this->db->order_by('id','desc');
            $this->db->limit(1);
            $this->db->update('order',$orderUP);



            $orderlistinsert=array(
                'sesid' => $sesid,
                'orderid' => $orderid,
                'cid' => $cid,
                'pid' => $pid,
                'name' => $name,
                'quantity' => $quantity,
                'price' => $price,
                'color' => $color,
                'size' => $size,
                'cart_date' => $added_date
            );
            $this->db->insert('orderlist',$orderlistinsert);

        }

        $message = 'Order Request by '.$ordername.'. Invoice No : '.$orderid.'. Transection : Bkash.TrxId is : '.$transection.'';

        $curlPost = 'user=e-salebazar&password=Z1kemW04&sender=e-salebazar&SMSText='.$message.'&GSM=8801752488173';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://api.bulksms.icombd.com/api/v3/sendsms/plain');
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);
        curl_close($ch);


        $this->db->where('sesid',$sesid);
        $this->db->delete('cart');
        echo "Order Successfully Complete.";

    }
    public function sendcontact(){
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

        $contactinsert=array(
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message
        );

        $this->db->insert('contact',$contactinsert);
        echo 'Contact Send Successfully.';
        return false;
    }
    public function change_password(){

        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id','id','trim|required');
        $this->form_validation->set_rules('password','password','trim|required');
        $this->form_validation->set_rules('npass','npass','trim|required');
        $this->form_validation->set_rules('ncpass','ncpass','trim|required');
        
        $id = $this->input->post('id');

        $password = md5($this->input->post('password'));
        $npass = $this->input->post('npass');
        $ncpass = $this->input->post('ncpass');

        if ($this->form_validation->run()==false) {
            redirect('main/change_password');
        }else{

            $this->db->where("id", $id); 
            $query = $this->db->get("coustomer");     
            $row = $query->row();
            $dbpass=$row->password;

            if ($npass == $ncpass && $password == $dbpass) {

                $matchpass = md5($ncpass);
                $chPass=array(
                    'password' => $matchpass
                );
                $this->db->where('id',$id);
                $this->db->update('coustomer',$chPass);
                redirect('main/profile');
            }else{
                redirect('main/change_password');
            }

        }

        
    }
    public function update_profile(){

        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('ide','ide','trim|required');
        $this->form_validation->set_rules('namee','namee','trim|required');
        $this->form_validation->set_rules('emaile','emaile','trim|required');
        $this->form_validation->set_rules('mobilee','mobilee','trim');
        $this->form_validation->set_rules('citye','citye','trim');
        $this->form_validation->set_rules('addresse','addresse','trim');
        $this->form_validation->set_rules('address2e','address2e','trim');
        $this->form_validation->set_rules('zipe','zipe','trim');
        
        $id = $this->input->post('ide');

        $name = $this->input->post('namee');
        $email = $this->input->post('emaile');
        $mobile = $this->input->post('mobilee');
        $city = $this->input->post('citye');
        $address = $this->input->post('addresse');
        $address2 = $this->input->post('address2e');
        $zip = $this->input->post('zipe');

        if ($this->form_validation->run()==false) {
            $this->edit_profile();
        }else{

            $chPass=array(
                'name'      => $name,
                'email'     => $email,
                'mobile'    => $mobile,
                'city'      => $city,
                'address'   => $address,
                'address2'  => $address2,
                'zip'       => $zip
            );
            $this->db->where('id',$id);
            $this->db->update('coustomer',$chPass);
            redirect('main/profile');

        }

        
    }




}
?>