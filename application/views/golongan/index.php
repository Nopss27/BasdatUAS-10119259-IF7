<!-- Begin Page Content -->
<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-center text-gray-800"><strong><?= $title; ?></strong></h1>


        <div class="row">
          <div class="col-lg-7 mx-auto">

          <?= form_error('kode_golongan', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= form_error('tnjng_suami_atau_istri', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= form_error('tnjng_anak', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= form_error('tnjng_transportasi', '<div class="alert alert-danger" role="alert">', '</div>'); ?>    

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

          <?php if( empty($golongan)) : ?>
            <div class="alert alert-danger" role="alert">
            Data tamu tidak ditemukan
            </div>
          <?php endif; ?>

          <table class="table text-center table-hover">
            <thead>
              <tr>
                <th scope="col">Golongan</th>
                <th scope="col">Tunjangan Suami Atau Istri</th>
                <th scope="col">Tunjangan Anak</th>
                <th scope="col">Tunjangan Transportasi</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>

              <?php foreach($golongan as $g) : ?>
              <tr>
                <td><?= $g['kode_golongan']; ?></td>
                <td><?= $g['tnjng_suami_atau_istri']; ?></td>
                <td><?= $g['tnjng_anak']; ?></td>
                <td><?= $g['tnjng_transportasi']; ?></td>
                <td>
                <a href="" class="badge bg-success text-light" data-toggle="modal" data-target="#editModal<?= $g['kode_golongan']; ?>">Ubah</a>
                <a href="<?= base_url(); ?>golongan/hapus/<?= $g['kode_golongan']; ?>" class="badge badge-primary text-light" name="hapus">Hapus</a>
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
      <form action="<?= 'golongan'; ?>" method="post">
        <div class="modal-body">
           <div class="mb-3 form-group">
            <input type="text" class="form-control" id="kode_golongan" name="kode_golongan" placeholder="Kode Golongan">
          </div>
           <div class="mb-3 form-group">
           <input type="text" class="form-control" id="tnjng_suami_atau_istri" name="tnjng_suami_atau_istri" placeholder="Tunjangan Suami / Istri">
          </div>
           <div class="mb-3 form-group">
            <input type="text" class="form-control" id="tnjng_anak" name="tnjng_anak" placeholder="Tunjangan Anak">
          </div>
           <div class="mb-3 form-group">
            <input type="text" class="form-control" id="tnjng_transportasi" name="tnjng_transportasi" placeholder="Tunjangan Transportasi">
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
foreach ($golongan as $g) : ?>
<div class="modal fade" id="editModal<?= $g['kode_golongan']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form action="<?= base_url('golongan/edit'); ?>" method="post">

            <input type="hidden" name="kode_golongan" value="<?= $g['kode_golongan']; ?>">

            <div class = "text-danger">
            <p>Kode Golongan tidak dapat diubah!</p>
            </div>

           <div class="mb-3 form-group">
             <label>Kode Golongan</label>
            <input type="text" class="form-control" id="kode_golongan" name="kode_golongan" value="<?= $g['kode_golongan']; ?>">
          </div>
           <div class="mb-3 form-group">
             <label>Tunjangan Suami / Istri</label>
            <input type="text" class="form-control" id="tnjng_suami_atau_istri" name="tnjng_suami_atau_istri" value="<?= $g['tnjng_suami_atau_istri']; ?>">
          </div>
           <div class="mb-3 form-group">
             <label>Tunjangan Anak</label>
            <input type="text" class="form-control" id="tnjng_anak" name="tnjng_anak" value="<?= $g['tnjng_anak']; ?>">
          </div>
           <div class="mb-3 form-group">
           <label>tunjangan Transportasi</label>
            <input type="text" class="form-control" id="tnjng_transportasi" name="tnjng_transportasi" value="<?= $g['tnjng_transportasi']; ?>">
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



