<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
  }

 public function index()
 {
   $this->form_validation->set_rules('username', 'Username', 'trim|required');
   $this->form_validation->set_rules('password', 'Password', 'trim|required');

   if ($this->form_validation->run() == false) {
     $data['title'] = 'Kepegawaian | Login';
     $this->load->view('templates/auth_header', $data);
     $this->load->view('auth/login'); 
     $this->load->view('templates/auth_footer');
   } else {
     $this->login();
   }
 }

 public function login() 
 {
  $username = $this->input->post('username');
  $password = md5($this->input->post('password'));

  $user = $this->db->get_where('user', ['username' => $username])->row_array();

  
  if($password == $user['password'] && $username == $user['username']) {
   $data = [
     'username' => $user['username'],
     'role_id' => $user['role_id']
   ];
   $this->session->set_userdata($data);
   redirect($user['username']);
  } else {
    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username atau password salah</div>');
     redirect('auth');
  }
}

  public function logout()
  {
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('role_id');

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Telah berhasil logout</div>');
     redirect('auth');
    
  }

}