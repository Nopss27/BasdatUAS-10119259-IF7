<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji extends CI_Controller 
{

  public function index()
  {
    $data['title'] = 'Data Gaji';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['gaji'] = $this->db->get('gaji')->result_array();
    $data['pegawai'] = $this->db->get('pegawai')->result_array();
    $cari = $this->input->post('cari');
  
    $this->form_validation->set_rules('kode_gaji', 'Kode Gaji', 'required|is_unique[gaji.kode_gaji]');
    $this->form_validation->set_rules('nip', 'NIP', 'required');
    $this->form_validation->set_rules('total_gaji', 'Total Gaji', 'required');
   
    // Script cari data
    if($cari) {
      $this->db->like('kode_gaji', $cari);
      $this->db->or_like('nip', $cari);
      $this->db->or_like('total_gaji', $cari);
      $data['gaji'] = $this->db->get('gaji')->result_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('gaji/index', $data);
      $this->load->view('templates/footer');
    } else {
      $this->tambah();
    }
  }

  public function tambah() {
    $data['title'] = 'Data Gaji';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['gaji'] = $this->db->get('gaji')->result_array();
    $data['pegawai'] = $this->db->get('pegawai')->result_array();

    if($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('gaji/index', $data);
      $this->load->view('templates/footer');
    } else {
      $data = [
        'kode_gaji' => $this->input->post('kode_gaji'),
        'nip' => $this->input->post('nip'),
        'total_gaji' => $this->input->post('total_gaji')
      ];

      $this->db->insert('gaji', $data);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
      redirect('gaji');
    }
  }

  public function hapus($kode_gaji) {
    $this->db->where('kode_gaji', $kode_gaji);
    $this->db->delete('gaji');

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
      redirect('gaji');
  }

  public function edit() {
    $data['pegawai'] = $this->db->get('pegawai')->result_array();

    $kode_gaji = $this->input->post('kode_gaji');
    $nip = $this->input->post('nip');
    $total_gaji = $this->input->post('total_gaji');

    if(empty($kode_gaji)) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal diedit!</div>');
      redirect('gaji');
    } else {   
      $data = [
        'kode_gaji' => $kode_gaji,
        'nip' => $nip,
        'total_gaji' => $total_gaji   
      ];
      $this->db->where('kode_gaji', $kode_gaji);
      $this->db->update('gaji', $data);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah</div>');
      redirect('gaji');
    }    
  }
}