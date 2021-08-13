<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lembur extends CI_Controller 
{

  public function index()
  {
    $data['title'] = 'Data Lembur';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['lembur'] = $this->db->get('lembur')->result_array();
    $data['pegawai'] = $this->db->get('pegawai')->result_array();
    $cari = $this->input->post('cari');

    $this->form_validation->set_rules('id_lembur', 'Id Lembur', 'required|is_unique[lembur.id_lembur]');
    $this->form_validation->set_rules('nip', 'NIP', 'required');
    $this->form_validation->set_rules('bulan', 'Bulan', 'required');
    $this->form_validation->set_rules('tahun', 'Tahun', 'required');
    $this->form_validation->set_rules('jmlh_jam_lembur', 'Jumlah Jam Lembur', 'required');
    $this->form_validation->set_rules('uang_lembur', 'Uang Lembur', 'required');
  
    // Script cari data
    if($cari) {
      $this->db->like('id_lembur', $cari);
      $this->db->or_like('nip', $cari);
      $this->db->or_like('bulan', $cari);
      $this->db->or_like('tahun', $cari);
      $this->db->or_like('jmlh_jam_lembur', $cari);
      $this->db->or_like('uang_lembur', $cari);
      $data['lembur'] = $this->db->get('lembur')->result_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('lembur/index', $data);
      $this->load->view('templates/footer');
    } else {
      $this->tambah();
    }
  }

  public function tambah() {
    $data['title'] = 'Data Lembur';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['lembur'] = $this->db->get('lembur')->result_array();
    $data['pegawai'] = $this->db->get('pegawai')->result_array();

    if($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('lembur/index', $data);
      $this->load->view('templates/footer');
    } else {
      $data = [
        'id_lembur' => $this->input->post('id_lembur'),
        'nip' => $this->input->post('nip'),
        'bulan' => $this->input->post('bulan'),
        'tahun' => $this->input->post('tahun'),
        'jmlh_jam_lembur' => $this->input->post('jmlh_jam_lembur'),
        'uang_lembur' => $this->input->post('uang_lembur'),
      ];

      $this->db->insert('lembur', $data);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
      redirect('lembur');
    }
  }

  public function hapus($id_lembur) {
    $this->db->where('id_lembur', $id_lembur);
    $this->db->delete('lembur');

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
      redirect('lembur');
  }

  public function edit() {
    $data['pegawai'] = $this->db->get('pegawai')->result_array();

    $id_lembur = $this->input->post('id_lembur');
    $nip = $this->input->post('nip');
    $bulan = $this->input->post('bulan');
    $tahun = $this->input->post('tahun');
    $jmlh_jam_lembur = $this->input->post('jmlh_jam_lembur');
    $uang_lembur = $this->input->post('uang_lembur');

    if(empty($id_lembur) || empty($nip) || empty($bulan) || empty($tahun) || empty($jmlh_jam_lembur) || empty($uang_lembur)) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal diedit!</div>');
      redirect('lembur');
    } else {   
      $data = [
        'id_lembur' => $id_lembur,
        'nip' => $nip,
        'bulan' => $bulan,
        'tahun' => $tahun,
        'jmlh_jam_lembur' => $jmlh_jam_lembur,
        'uang_lembur' => $uang_lembur
      ];
      $this->db->where('id_lembur', $id_lembur);
      $this->db->update('lembur', $data);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah</div>');
      redirect('lembur');
    }    
  }
}