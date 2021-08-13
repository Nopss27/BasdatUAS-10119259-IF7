<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Golongan extends CI_Controller 
{

  public function index()
  {
    $data['title'] = 'Data Golongan';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['golongan'] = $this->db->get('golongan')->result_array();
    $cari = $this->input->post('cari');

    $this->form_validation->set_rules('kode_golongan', 'Kode Golongan', 'required|is_unique[golongan.kode_golongan]');
    // $this->form_validation->set_rules('tnjng_suami_atau_istri', 'Tunjangan Suami Atau Istri', 'required');
    // $this->form_validation->set_rules('tnjng_anak', 'Tunjangan Anak', 'required');
    // $this->form_validation->set_rules('tnjng_transportasi', 'Tunjangan Transportasi', 'required');

    // Script cari data
    if($cari) {
      $this->db->like('kode_golongan', $cari);
      $this->db->or_like('tnjng_suami_atau_istri', $cari);
      $this->db->or_like('tnjng_anak', $cari);
      $this->db->or_like('tnjng_transportasi', $cari);
      $data['golongan'] = $this->db->get('golongan')->result_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('golongan/index', $data);
      $this->load->view('templates/footer');
    } else {
      $this->tambah();
    }
  }
    public function tambah() {
    $data['title'] = 'Data Golongan';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['golongan'] = $this->db->get('golongan')->result_array();
  
      if($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('golongan/index', $data);
        $this->load->view('templates/footer');
      } else {
        $data = [
          'kode_golongan' => $this->input->post('kode_golongan'),
          'tnjng_suami_atau_istri' => $this->input->post('tnjng_suami_atau_istri'),
          'tnjng_anak' => $this->input->post('tnjng_anak'),
          'tnjng_transportasi' => $this->input->post('tnjng_transportasi'),
        ];
  
        $this->db->insert('golongan', $data);
  
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
        redirect('golongan');
      }
    }

    public function hapus($kode_golongan) {
      $this->db->where('kode_golongan', $kode_golongan);
      $this->db->delete('golongan');
  
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        redirect('golongan');
    }

    public function edit() {
      $kode_golongan = $this->input->post('kode_golongan');
      $tnjng_suami_atau_istri = $this->input->post('tnjng_suami_atau_istri');
      $tnjng_anak = $this->input->post('tnjng_anak');
      $tnjng_transportasi = $this->input->post('tnjng_transportasi');
  
      if(empty($kode_golongan)) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal diedit!</div>');
        redirect('golongan');
      } else {   
        $data = [
          'kode_golongan' => $kode_golongan,
          'tnjng_suami_atau_istri' => $tnjng_suami_atau_istri,
          'tnjng_anak' => $tnjng_anak,
          'tnjng_transportasi' => $tnjng_transportasi
        ];
        $this->db->where('kode_golongan', $kode_golongan);
        $this->db->update('golongan', $data);
  
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah</div>');
        redirect('golongan');
      }    
    }
}

