<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller 
{

  public function index()
  {
    $data['title'] = 'Data Pegawai';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['pegawai'] = $this->db->get('pegawai')->result_array();
    $cari = $this->input->post('cari');

    $this->form_validation->set_rules('nip', 'NIP', 'required');
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('kode_jabatan', 'Kode Jabatan', 'required');
    $this->form_validation->set_rules('kode_golongan', 'Kode Golongan', 'required');
    $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'required');
    $this->form_validation->set_rules('status', 'Status', 'required');
    $this->form_validation->set_rules('jmlh_anak', 'Jumlah Anak', 'required');

   // Script cari data
   if($this->input->post('cari')) {
    $this->db->like('nip', $cari);
    $this->db->or_like('nama', $cari);
    $this->db->or_like('kode_jabatan', $cari);
    $this->db->or_like('kode_golongan', $cari);
    $this->db->or_like('jk', $cari);
    $this->db->or_like('alamat', $cari);
    $this->db->or_like('tgl_lahir', $cari);
    $this->db->or_like('status', $cari);
    $this->db->or_like('jmlh_anak', $cari);
    $data['pegawai'] = $this->db->get('pegawai')->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('pegawai/index', $data);
    $this->load->view('templates/footer');
  } else {
    $this->tambah();
  }
  }

  public function tambah() {
    $data['title'] = 'Data Pegawai';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['pegawai'] = $this->db->get('pegawai')->result_array();
    $data['kode_jabatan'] = $this->db->get('jabatan')->result_array();
    $data['kode_golongan'] = $this->db->get('golongan')->result_array();


    if($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('pegawai/index', $data);
      $this->load->view('templates/footer');
    } else {
      $data = [
        'nip' => $this->input->post('nip'),
        'nama' => $this->input->post('nama'),
        'kode_jabatan' => $this->input->post('kode_jabatan'),
        'kode_golongan' => $this->input->post('kode_golongan'),
        'jk' => $this->input->post('jk'),
        'alamat' => $this->input->post('alamat'),
        'tgl_lahir' => $this->input->post('tgl_lahir'),
        'status' => $this->input->post('status'),
        'jmlh_anak' => $this->input->post('jmlh_anak'),
      ];

      $this->db->insert('pegawai', $data);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
      redirect('pegawai');
    }
  }

  public function edit() {
    $data['kode_jabatan'] = $this->db->get('jabatan')->result_array();
    $data['kode_golongan'] = $this->db->get('golongan')->result_array();

    $nip = $this->input->post('nip');
    $nama = $this->input->post('nama');
    $kode_jabatan = $this->input->post('kode_jabatan');
    $kode_golongan = $this->input->post('kode_golongan');
    $jk = $this->input->post('jk');
    $alamat = $this->input->post('alamat');
    $tgl_lahir = $this->input->post('tgl_lahir');
    $status = $this->input->post('status');
    $jmlh_anak = $this->input->post('jmlh_anak');

    if(empty($nip) || empty($nama) || empty($kode_jabatan) || empty($kode_golongan) || empty($jk) || empty($alamat) || empty($tgl_lahir) || empty($status)) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal diedit!</div>');
      redirect('pegawai');
    } else {   
      $data = [
        'nip' => $nip,
        'nama' => $nama,
        'kode_jabatan' => $kode_jabatan,
        'kode_golongan' => $kode_golongan,
        'jk' => $jk,
        'alamat' => $alamat,
        'tgl_lahir' => $tgl_lahir,
        'status' => $status,
        'jmlh_anak' => $jmlh_anak
      ];
      $this->db->where('nip', $nip);
      $this->db->update('pegawai', $data);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah</div>');
      redirect('pegawai');
    }    
  }

  public function hapus($nip) {
    $this->db->where('nip', $nip);
    $this->db->delete('pegawai');

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
      redirect('pegawai');
  }

}