<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller
{

    function __construct() {
       parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->load->library('email');

        $admin_user = $this->session->userdata('username');
        if(!empty($admin_user))
        {   
            redirect('home');
        }
    }

    function index()
    {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->helper('form');
        $this->load->library('form_validation');      
        $this->form_validation->set_rules('username',  'username',  'required');
        $this->form_validation->set_rules('password',  'password',  'required|min_length[1]');
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('login');
        }
        else
        {
            
            $data = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'status' => 1
            );
    
    
            
            $this->db->where('username', $data['username']);
            $query = $this->db->get("users");
            
            $row = $query->row();
            
            $username = $row->username;
            $password = $row->password;
            $status = $row->status;
    
    
            if($username == $data['username'] && $password == $data['password'] && $status == $data['status'])
            {
                $this->session->set_userdata('id', $row->id); 
                $this->session->set_userdata('username', $row->username); 
                $this->session->set_userdata('name', $row->name); 
                $this->session->set_userdata('email', $row->email); 
                $this->session->set_userdata('role', $row->role); 
                $this->session->set_userdata('status', $row->status); 
                
                redirect('home');
            
            }
            else{
                $this->session->set_flashdata('flash_data', 'username or password is not matched!');
                $this->load->view('login');
            }
        }
    }
    



}
