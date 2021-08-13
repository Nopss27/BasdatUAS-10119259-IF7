<!-- Begin Page Content -->
<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-center text-gray-800"><strong><?= $title; ?></strong></h1>


        <div class="row">
          <div class="col-lg-7 mx-auto">

          <?= form_error('kode_jabatan', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= form_error('nama_jabatan', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= form_error('gaji', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

          <?= $this->session->flashdata('message'); ?>
         
          <div class="row mt-3">
          <a href="" class="btn btn-primary mb-2" data-toggle="modal" data-target="#dataModal">Tambah Data</a>

            <div class="col-md-10 mx-auto">
              <form action="" method="post">
                <div class="input-group mb-2">
                  <input type="text" name="cari" class="form-control text-center" placeholder="Cari Data Tamu">
                  <button class="btn btn-success" type="submit">Cari</button>
                </div>
              </form>
            </div>
          </div>

          <?php if( empty($jabatan)) : ?>
            <div class="alert alert-danger" role="alert">
            Data Jabatan tidak ditemukan
            </div>
          <?php endif; ?>

          <table class="table text-center table-hover">
            <thead>
              <tr>
                <th scope="col">Kode Jabatan</th>
                <th scope="col">Nama Jabatan</th>
                <th scope="col">Gaji</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>

              <?php foreach($jabatan as $j) : ?>
              <tr>
                <td><?= $j['kode_jabatan']; ?></td>
                <td><?= $j['nama_jabatan']; ?></td>
                <td><?= $j['gaji']; ?></td>
                <td>
                <a href="" class="badge bg-success text-light" data-toggle="modal" data-target="#editModal<?= $j['kode_jabatan']; ?>">Ubah</a>
                <a href="<?= base_url(); ?>jabatan/hapus/<?= $j['kode_jabatan']; ?>" class="badge badge-primary text-light" name="hapus">Hapus</a>
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
      <form action="<?= 'jabatan'; ?>" method="post">
        <div class="modal-body">
           <div class="mb-3 form-group">
            <input type="text" class="form-control" id="kode_jabatan" name="kode_jabatan" placeholder="Kode Jabatan">
          </div>
           <div class="mb-3 form-group">
            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="Nama Jabatan">
          </div>
           <div class="mb-3 form-group">
            <input type="text" class="form-control" id="gaji" name="gaji" placeholder="Gaji">
          </div>
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
foreach ($jabatan as $j) : ?>
<div class="modal fade" id="editModal<?= $j['kode_jabatan']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form action="<?= base_url('jabatan/edit'); ?>" method="post">

            <input type="hidden" name="id" value="<?= $j['kode_jabatan']; ?>">

            <div class = "text-danger">
            <p>Kode Jabatan tidak dapat diubah!</p>
            </div>

           <div class="mb-3 form-group">
             <label>Kode Jabatan</label>
            <input type="text" class="form-control" id="kode_jabatan" name="kode_jabatan" value="<?= $j['kode_jabatan']; ?>">
          </div>
           <div class="mb-3 form-group">
             <label>Nama Jabatan</label>
            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" value="<?= $j['nama_jabatan']; ?>">
          </div>
           <div class="mb-3 form-group">
             <label>Gaji</label>
            <input type="text" class="form-control" id="gaji" name="gaji" value="<?= $j['gaji']; ?>">
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

