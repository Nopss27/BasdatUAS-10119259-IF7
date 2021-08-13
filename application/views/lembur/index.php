<!-- Begin Page Content -->
<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-center text-gray-800"><strong><?= $title; ?></strong></h1>


        <div class="row">
          <div class="col-lg-7 mx-auto">

          <?= form_error('id_lembur', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= form_error('nip', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= form_error('bulan', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= form_error('tahun', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= form_error('jmlh_jam_lembur', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= form_error('uang_lembur', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

          <?= $this->session->flashdata('message'); ?>
         
          <div class="row mt-3">
          <a href="" class="btn btn-primary mb-2" data-toggle="modal" data-target="#dataModal">Tambah Data</a>

            <div class="col-md-10 mx-auto">
              <form action="" method="post">
                <div class="input-group mb-2">
                  <input type="text" name="cari" class="form-control text-center" placeholder="Cari Data Lembur">
                  <button class="btn btn-success" type="submit">Cari</button>
                </div>
              </form>
            </div>
          </div>

          <?php if( empty($lembur)) : ?>
            <div class="alert alert-danger" role="alert">
            Data Lembur Pegawai tidak ditemukan
            </div>
          <?php endif; ?>

          <table class="table text-center table-hover">
            <thead>
              <tr>
                <th scope="col">Id Lembur</th>
                <th scope="col">NIP</th>
                <th scope="col">Bulan</th>
                <th scope="col">Tahun</th>
                <th scope="col">Jumlah Jam Lembur</th>
                <th scope="col">Uang Lembur</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>

              <?php foreach($lembur as $l) : ?>
              <tr>
                <td><?= $l['id_lembur']; ?></td>
                <td><?= $l['nip']; ?></td>
                <td><?= $l['bulan']; ?></td>
                <td><?= $l['tahun']; ?></td>
                <td><?= $l['jmlh_jam_lembur']; ?></td>
                <td><?= $l['uang_lembur']; ?></td>
                <td>
                <a href="" class="badge bg-success text-light" data-toggle="modal" data-target="#editModal<?= $l['id_lembur']; ?>">Ubah</a>
                <a href="<?= base_url(); ?>lembur/hapus/<?= $l['id_lembur']; ?>" class="badge badge-primary text-light" name="hapus">Hapus</a>
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
      <form action="<?= 'lembur'; ?>" method="post">
        <div class="modal-body">
           <div class="mb-3 form-group">
            <input type="text" class="form-control" id="id_lembur" name="id_lembur" placeholder="Id Lembur">
          </div>
           <div class="mb-3 form-group">
            <!-- <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP"> -->
            <select class="form-control" id="exampleFormControlSelect1" name="nip">
            <option>-- Pilih NIP --</option>
            <?php foreach($pegawai as $p) : ?>
            <option><?= $p['nip']; ?></option>
            <?php endforeach; ?>
            </select>
          </div>
           <div class="mb-3 form-group">
            <input type="text" class="form-control" id="bulan" name="bulan" placeholder="Bulan">
          </div>
           <div class="mb-3 form-group">
            <input type="text" class="form-control" id="tahun" name="tahun" placeholder="Tahun">
          </div>
           <div class="mb-3 form-group">
            <input type="text" class="form-control" id="jmlh_jam_lembur" name="jmlh_jam_lembur" placeholder="Jumlah Jam Lembur">
          </div>
           <div class="mb-3 form-group">
            <input type="text" class="form-control" id="uang_lembur" name="uang_lembur" placeholder="Uang Lembur">
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
foreach ($lembur as $l) : ?>
<div class="modal fade" id="editModal<?= $l['id_lembur']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form action="<?= base_url('lembur/edit'); ?>" method="post">

            <input type="hidden" name="id_lembur" value="<?= $l['id_lembur']; ?>">

            <div class = "text-danger">
            <p>Id Lembur tidak dapat diubah!</p>
            </div>

           <div class="mb-3 form-group">
             <label>Id Lembur</label>
            <input type="text" class="form-control" id="id_lembur" name="id_lembur" value="<?= $l['id_lembur']; ?>">
          </div>
           <div class="mb-3 form-group">
             <label>NIP</label>
            <!-- <input type="text" class="form-control" id="nip" name="nip" value="<?= $g['nip']; ?>"> -->
            <select class="form-control" id="exampleFormControlSelect1" name="nip" value="<?= $l['nip']; ?>">
            <option><?= $l['nip']; ?></option>
            <?php foreach($pegawai as $p) : ?>
            <option><?= $p['nip']; ?></option>
            <?php endforeach; ?>
            </select>
          </div>
           <div class="mb-3 form-group">
             <label>Bulan</label>
            <input type="text" class="form-control" id="bulan" name="bulan" value="<?= $l['bulan']; ?>">
          </div>
           <div class="mb-3 form-group">
             <label>Tahun</label>
            <input type="text" class="form-control" id="tahun" name="tahun" value="<?= $l['tahun']; ?>">
          </div>
           <div class="mb-3 form-group">
             <label>Jumlah Jam Lembur</label>
            <input type="text" class="form-control" id="jmlh_jam_lembur" name="jmlh_jam_lembur" value="<?= $l['jmlh_jam_lembur']; ?>">
          </div>
           <div class="mb-3 form-group">
             <label>Uang Lembur</label>
            <input type="text" class="form-control" id="uang_lembur" name="uang_lembur" value="<?= $l['uang_lembur']; ?>">
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

