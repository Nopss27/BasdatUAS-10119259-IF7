<!-- Begin Page Content -->
<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-center text-gray-800"><strong><?= $title; ?></strong></h1>


        <div class="row">
          <div class="col-lg-7 mx-auto">

          <?= form_error('kode_gaji', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= form_error('nip', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= form_error('total_gaji', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

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

          <?php if( empty($gaji)) : ?>
            <div class="alert alert-danger" role="alert">
            Data Gaji tidak ditemukan
            </div>
          <?php endif; ?>

          <table class="table text-center table-hover">
            <thead>
              <tr>
                <th scope="col">Kode Gaji</th>
                <th scope="col">NIP</th>
                <th scope="col">Total Gaji</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>

              <?php foreach($gaji as $g) : ?>
              <tr>
                <td><?= $g['kode_gaji']; ?></td>
                <td><?= $g['nip']; ?></td>
                <td><?= $g['total_gaji']; ?></td>
                <td>
                <a href="" class="badge bg-success text-light" data-toggle="modal" data-target="#editModal<?= $g['kode_gaji']; ?>">Ubah</a>
                <a href="<?= base_url(); ?>gaji/hapus/<?= $g['kode_gaji']; ?>" class="badge badge-primary text-light" name="hapus">Hapus</a>
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
      <form action="<?= 'gaji'; ?>" method="post">
        <div class="modal-body">
           <div class="mb-3 form-group">
            <input type="text" class="form-control" id="kode_gaji" name="kode_gaji" placeholder="Kode Gaji">
          </div>
           <div class="mb-3 form-group">
            <!-- <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP"> -->
            <select class="form-control" id="exampleFormControlSelect1" name="nip">
            <option hidden>-- Pilih NIP --</option>
            <?php foreach($pegawai as $p) : ?>
            <option><?= $p['nip']; ?></option>
            <?php endforeach; ?>
            </select>
          </div>
           <div class="mb-3 form-group">
            <input type="text" class="form-control" id="total_gaji" name="total_gaji" placeholder="Total Gaji">
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
foreach ($gaji as $g) : ?>
<div class="modal fade" id="editModal<?= $g['kode_gaji']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form action="<?= base_url('gaji/edit'); ?>" method="post">

            <!-- <input type="hidden" name="kode_gaji" value="<?= $g['kode_gaji']; ?>"> -->

            <div class = "text-danger">
            <p>Kode Gaji tidak dapat diubah!</p>
            </div>

           <div class="mb-3 form-group">
             <label>Kode Gaji</label>
            <input type="text" class="form-control" id="kode_gaji" name="kode_gaji" value="<?= $g['kode_gaji']; ?>">
          </div>
           <div class="mb-3 form-group">
             <label>NIP</label>
            <!-- <input type="text" class="form-control" id="nip" name="nip" value="<?= $g['nip']; ?>"> -->
            <select class="form-control" id="exampleFormControlSelect1" name="nip">
            <option hidden><?= $g['nip']; ?></option>
            <?php foreach($pegawai as $p) : ?>
            <option><?= $p['nip']; ?></option>
            <?php endforeach; ?>
            </select>
          </div>
           <div class="mb-3 form-group">
             <label>Total Gaji</label>
            <input type="text" class="form-control" id="total_gaji" name="total_gaji" value="<?= $g['total_gaji']; ?>">
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

