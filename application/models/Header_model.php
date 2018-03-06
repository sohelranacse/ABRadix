<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class header_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //chenge password
    public function changePassword2($passwordIn ,$hiddenSessionId){
    	$this->db->where('id', $hiddenSessionId);
        $this->db->like('password', $passwordIn);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{return false;}
    }
    public function changePassword3($passwordNewCon, $id){
    	$field = array(
			'password' => $passwordNewCon
		);	
		$this->db->where('id',$id);
		$this->db->update('users', $field);

		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
    }
    //change password end


    //menu submenu create
    public function menuCreate($menus){
    	$this->db->insert('menu',$menus);
    }
    public function selectMenu(){
        $this->db->select('*');
		$this->db->from('menu');
		$this->db->order_by('id','DESC');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->result();
		}else{
			return FALSE;
		}
    }
    public function subMenuCreate($menus){
    	$this->db->insert('menu',$menus);
    }
    public function selectMenuheader(){
        $this->db->select('*');
		$this->db->from('menu');
        $this->db->order_by('id', 'desc');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->result();
		}else{
			return FALSE;
		}
    }
    public function selectMenuheader2($id){
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('menuid',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            return $query->result();
        }else{
            return FALSE;
        }
    }//menu submenu create end


    public function selectlastuser(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            return $query->result();
        }else{
            return FALSE;
        }
    }//user last insert user id


    public function userlistAll(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            return $query->result();
        }else{
            return FALSE;
        }
    }


    public function record_count() {
        return $this->db->count_all("product");
    }
    public function fetch_products($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->join('category', 'product.subid = category.id');
        $this->db->order_by("product.pid",'desc');
        $query = $this->db->get("product");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function fetch_alledit_products($pid) {
        $this->db->where('pid', $pid);
        $this->db->join('category', 'product.subid = category.id');
        $this->db->order_by("product.pid",'desc');
        $query = $this->db->get("product");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    //product end

    
    public function all_coustomer_count() {
        return $this->db->count_all("product");
    }
    public function fetch_coustomer($limit, $start){
        $this->db->limit($limit, $start);
        $this->db->order_by("id",'desc');
        $query = $this->db->get("coustomer");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function orderlist_count() {
        return $this->db->count_all("order");
    }
    public function fetch_order($limit, $start){
        $this->db->limit($limit, $start);
        $this->db->where("status","1");
        $this->db->order_by("id",'desc');
        $query=$this->db->get("order");
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    //edit,delete,update works start
    public function delcontact($delid){
        $this->db->where('id', $delid);
        $this->db->delete('contact');
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
    public function delcoustomer($delid){
        $this->db->where('id', $delid);
        $this->db->delete('coustomer');
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }


    //home panel works
    public function allcart($sesids){
        $this->db->where('sesid',$sesids);
        $query = $this->db->get('cart');
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return false;
        }
    }
    public function allcart_up($sesids, $added){
        $this->db->where('sesid',$sesids);
        $this->db->where('id',$added);
        $query = $this->db->get('cart');
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return false;
        }
    }
    public function deletedcart($cid){
        $this->db->where('id', $cid);
        $this->db->delete('cart');
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
    public function delcategory($delid){
        $this->db->where('id', $delid);
        $this->db->delete('category');
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
    public function deleteproduct($delid){
        $this->db->where('pid', $delid);
        $this->db->delete('product');
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

}