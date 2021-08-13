<!-- Begin Page Content -->
<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-center text-gray-800"><strong><?= $title; ?></strong></h1>


        <div class="row">
          <div class="col-lg-8 mx-auto">

          <?= form_error('nip', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= form_error('nama', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= form_error('kode_jabatan', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= form_error('kode_golongan', '<div class="alert alert-danger" role="alert">', '</div>'); ?>    
          <?= form_error('jk', '<div class="alert alert-danger" role="alert">', '</div>'); ?>    
          <?= form_error('alamat', '<div class="alert alert-danger" role="alert">', '</div>'); ?>    
          <?= form_error('tgl_lahir', '<div class="alert alert-danger" role="alert">', '</div>'); ?>    
          <?= form_error('status', '<div class="alert alert-danger" role="alert">', '</div>'); ?>    
          <?= form_error('jmlh_anak', '<div class="alert alert-danger" role="alert">', '</div>'); ?>    

          <?= $this->session->flashdata('message'); ?>
         
          <div class="row mt-3">
          <a href="" class="col-sm btn btn-primary mb-2" data-toggle="modal" data-target="#dataModal">Tambah Data</a>

            <div class="col-md-10 mx-auto">
              <form action="" method="post">
                <div class="input-group mb-2">
                  <input type="text" name="cari" class="form-control text-center" placeholder="Cari Data Pegawai">
                  <button class="btn btn-success" type="submit">Cari</button>
                </div>
              </form>
            </div>
          </div>

          <?php if( empty($pegawai)) : ?>
            <div class="alert alert-danger" role="alert">
            Data Pegawai tidak ditemukan
            </div>
          <?php endif; ?>

          <table class="table text-center table-hover">
            <thead>
              <tr>
                <th scope="col">NIP</th>
                <th scope="col">Nama Pegawai</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Golongan</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Alamat</th>
                <th scope="col">Tgl Lahir</th>
                <th scope="col">Status</th>
                <th scope="col">Jumlah Anak</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>

              <?php foreach($pegawai as $p) : ?>
              <tr>
                <td><?= $p['nip']; ?></td>
                <td><?= $p['nama']; ?></td>
                <td><?= $p['kode_jabatan']; ?></td>
                <td><?= $p['kode_golongan']; ?></td>
                <td><?= $p['jk']; ?></td>
                <td><?= $p['alamat']; ?></td>
                <td><?= $p['tgl_lahir']; ?></td>
                <td><?= $p['status']; ?></td>
                <td><?= $p['jmlh_anak']; ?></td>
                <td>
                <a href="" class="badge bg-success text-light" data-toggle="modal" data-target="#editModal<?= $p['nip']; ?>">Ubah</a>
                <a href="<?= base_url(); ?>pegawai/hapus/<?= $p['nip']; ?>" class="badge badge-primary text-light" name="hapus">Hapus</a>
                <!-- <a href="" class="badge bg-secondary text-light" data-toggle="modal" data-target="#telpModal<?= $p['id']; ?>">Kirim Pesan</a> -->
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>


          </div>
        </div>



    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Tambah Modal Component -->
<div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dataModalLabel">Tambah Data Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= 'pegawai'; ?>" method="post">
        <div class="modal-body">
           <div class="mb-3 form-group">
            <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP">
          </div>
          <div class="mb-3 form-group">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pegawai">
          </div>
          <div class="mb-3 form-group">
            <!-- <input type="text" class="form-control" id="kode_jabatan" name="kode_jabatan" placeholder="Kode Jabatan"> -->
            <select class="form-control" id="exampleFormControlSelect1" name="kode_jabatan">
            <option>-- Pilih Kode Jabatan --</option>
            <?php foreach($kode_jabatan as $k) : ?>
            <option><?= $k['kode_jabatan']; ?></option>
            <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 form-group">
            <!-- <input type="text" class="form-control" id="kode_golongan" name="kode_golongan" placeholder="Kode Golongan"> -->
            <select class="form-control" id="exampleFormControlSelect1" name="kode_golongan">
            <option>-- Pilih Kode Golongan --</option>
            <?php foreach($kode_golongan as $g) : ?>
            <option><?= $g['kode_golongan']; ?></option>
            <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 form-group">
          <select class="form-control" id="exampleFormControlSelect1" name="jk">    
          <option hidden>-- Pilih Jenis Kelamin --</option>      
          <option>P</option>      
          <option>L</option>  
          </select>    
          </div>
          <div class="mb-3 form-group">
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
          </div>
          <div class="mb-3 form-group">
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tgl Lahir">
          </div>
          <div class="mb-3 form-group">
            <input type="text" class="form-control" id="status" name="status" placeholder="Status">
          </div>
          <div class="mb-3 form-group">
            <input type="text" class="form-control" id="jmlh_anak" name="jmlh_anak" placeholder="Jumlah Anak">
          </div>

           <!-- <div class="mb-3 form-group">
            <select class="form-control" id="exampleFormControlSelect1" name="kode">
            <option>-- Pilih Kode Kamar --</option>
            <?php foreach($kodeKamar as $k) : ?>
            <option><?= $k['kode_kamar']; ?></option>
            <?php endforeach; ?>
            </select>
          </div> -->
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal Component -->
<?php
foreach ($pegawai as $p) : ?>
<div class="modal fade" id="editModal<?= $p['nip']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form action="<?= base_url('pegawai/edit'); ?>" method="post">

            <input type="hidden" name="id" value="<?= $p['nip']; ?>">

            <div class = "text-danger">
            <p>NIP pegawai tidak dapat diubah!</p>
            </div>

           <div class="mb-3 form-group">
             <label>NIP</label>
            <input type="text" class="form-control" id="nip" name="nip" value="<?= $p['nip']; ?>">
          </div>
           <div class="mb-3 form-group">
             <label>Nama Pegawai</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $p['nama']; ?>">
          </div>
           <div class="mb-3 form-group">
             <label>Kode Jabatan</label>
            <!-- <input type="text" class="form-control" id="kode_jabatan" name="kode_jabatan" value="<?= $p['kode_jabatan']; ?>"> -->
            <select class="form-control" id="exampleFormControlSelect1" name="kode_jabatan">
            <option hidden><?= $p['kode_jabatan']; ?></option>
            <?php foreach($kode_jabatan as $k) : ?>
            <option><?= $k['kode_jabatan']; ?></option>
            <?php endforeach; ?>
            </select>
          </div>
           <div class="mb-3 form-group">
           <label>Kode Golongan</label>
            <!-- <input type="text" class="form-control" id="kode_golongan" name="kode_golongan" value="<?= $p['kode_golongan']; ?>"> -->
            <select class="form-control" id="exampleFormControlSelect1" name="kode_golongan">
            <option hidden><?= $p['kode_golongan']; ?></option>
            <?php foreach($kode_golongan as $g) : ?>
            <option><?= $g['kode_golongan']; ?></option>
            <?php endforeach; ?>
            </select>
          </div>
           <div class="mb-3 form-group">
           <label>Jenis Kelamin</label>
          <select class="form-control" id="exampleFormControlSelect1" name="jk" value="<?= $p['jk']; ?>">    
          <option><?= $p['jk']; ?></option>      
          <option><?= $p['jk'] == 'L' ? 'P' : 'L'; ?></option>  
          </select>    
          </div>
           <div class="mb-3 form-group">
           <label>Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $p['alamat']; ?>">
          </div>
           <div class="mb-3 form-group">
           <label>Tgl Lahir</label>
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= $p['tgl_lahir']; ?>">
          </div>
           <div class="mb-3 form-group">
           <label>Status</label>
            <input type="text" class="form-control" id="status" name="status" value="<?= $p['status']; ?>">
          </div>
           <div class="mb-3 form-group">
           <label>Jumlah Anak</label>
            <input type="text" class="form-control" id="jmlh_anak" name="jmlh_anak" value="<?= $p['jmlh_anak']; ?>">
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Ubah</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>

<!-- Telp Modal -->
<!-- <?php
foreach ($tamu as $t) : ?>
<div class="modal fade" id="telpModal<?= $t['id']; ?>" tabindex="-1" aria-labelledby="telpModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="telpModalLabel">No Telepon Tamu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form action="<?= base_url('pesan'); ?>" method="post">
            <input type="hidden" name="id" value="<?= $t['id']; ?>">

           <div class="mb-3 form-group">
            <input type="text" class="form-control tlpon" id="tlpon" name="tlpon" value="<?= $t['no_telp']; ?>">
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btnCopy">Lanjut</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?> -->

