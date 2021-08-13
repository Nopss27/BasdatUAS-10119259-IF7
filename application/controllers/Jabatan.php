<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller 
{

  public function index()
  {
    $data['title'] = 'Data Jabatan';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['jabatan'] = $this->db->get('jabatan')->result_array();
    $cari = $this->input->post('cari');

    $this->form_validation->set_rules('kode_jabatan', 'Kode Jabatan', 'required|is_unique[jabatan.kode_jabatan]');
    $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required');
    $this->form_validation->set_rules('gaji', 'Gaji', 'required');
  
    // Script cari data
    if($cari) {
      $this->db->like('kode_jabatan', $cari);
      $this->db->or_like('nama_jabatan', $cari);
      $this->db->or_like('gaji', $cari);
      $data['jabatan'] = $this->db->get('jabatan')->result_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('jabatan/index', $data);
      $this->load->view('templates/footer');
    } else {
      $this->tambah();
    }
  }

  public function tambah() {
    $data['title'] = 'Data Jabatan';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['jabatan'] = $this->db->get('jabatan')->result_array();

    if($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('jabatan/index', $data);
      $this->load->view('templates/footer');
    } else {
      $data = [
        'kode_jabatan' => $this->input->post('kode_jabatan'),
        'nama_jabatan' => $this->input->post('nama_jabatan'),
        'gaji' => $this->input->post('gaji'),
      ];

      $this->db->insert('jabatan', $data);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
      redirect('jabatan');
    }
  }

  public function hapus($kode_jabatan) {
    $this->db->where('kode_jabatan', $kode_jabatan);
    $this->db->delete('jabatan');

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
      redirect('jabatan');
  }

  public function edit() {
    $kode_jabatan = $this->input->post('kode_jabatan');
    $nama_jabatan = $this->input->post('nama_jabatan');
    $gaji = $this->input->post('gaji');

    if(empty($kode_jabatan) || empty($nama_jabatan) || empty($gaji)) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal diedit!</div>');
      redirect('jabatan');
    } else {   
      $data = [
        'kode_jabatan' => $kode_jabatan,
        'nama_jabatan' => $nama_jabatan,
        'gaji' => $gaji
      ];
      $this->db->where('kode_jabatan', $kode_jabatan);
      $this->db->update('jabatan', $data);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah</div>');
      redirect('jabatan');
    }    
  }
}