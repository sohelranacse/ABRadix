<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function loginUsernameorEmail($userOrEmail){
        $this->db->where('username', $userOrEmail);
        return $this->db->get('users')->row();
    }
    public function loginPassword($password ,$LoginemailorUser){
        $this->db->where('username', $LoginemailorUser);
        $this->db->like('password', $password);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{return false;}
    }



    public function validate_user($data) {
        $this->db->where('username', $data['username']);
        $this->db->where('password', md5($data['password']));
        return $this->db->get('users')->row();
    }

    function __destruct() {
        $this->db->close();
    }
}
