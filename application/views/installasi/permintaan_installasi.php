<div class="container-fluid">
  <?php echo $this->session->flashdata('message');?>
  <?php 
    if(form_error('id') || form_error('nama') || form_error('jk') || form_error('instansi') || form_error('notelp') || form_error('alamat') || 
    form_error('keterangan') || form_error('id_permintaan') || form_error('jadwal_survel') || form_error('teknisi')){
      echo '<div id="message" class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="far fa-times-circle"></i> Data gagal disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>';
    }
  ?>
  <div class="row" id="formJadwalSurvei" style="display:none;">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            Buat Jadwal Survei
          </h3>
        </div>
        <div class="card-body">
          <form method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <input type="hidden" class="form-control form-control-sm" id="id_permintaan" name="id_permintaan">
                  <label for="jadwal_survei" class="col-sm-3 col-form-label">Jadwal Survei</label>
                  <div class="col-md-9">
                    <input type="date" class="form-control form-control-sm" id="jadwal_survei" name="jadwal_survei" placeholder="Jadwal Survei">
                    <?php echo form_error('id_permintaan','<small class="text-danger">','</small>')?>
                    <?php echo form_error('jadwal_survei','<small class="text-danger">','</small>')?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="teknisi" class="col-sm-3 col-form-label">Teknisi</label>
                  <div class="col-sm-9">
                    <select type="text" class="form-control form-control-sm" id="teknisi" name="teknisi">
                      <option value="">-- Pilih Teknisi --</option>
                      <?php foreach($teknisi as $teknisi) :?>
                        <option value="<?=$teknisi['id']?>"><?=$teknisi['fullname'].' ('.$teknisi['status_teknisi'].')'?></option>
                      <?php endforeach?>
                    </select> 
                    <?php echo form_error('teknisi','<small class="text-danger">','</small>')?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group float-left">
                  <button type="submit" name="simpan_jadwal_survei" class="btn btn-primary" id="btn-simpan" value="on">Simpan</button>
                  <button type="button" class="btn btn-secondary" onCLick="unsetFormJadwalSurvei(),hideJadwalSurvei()">Batal</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row" id="formPermintaanInstallasi" style="display: none">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 id="h3-tambah" class="card-title">
            Tambah Permintaan Installasi
          </h3>
          <h3 id="h3-perbarui" class="card-title">
            Perbarui Permintaan Installasi
          </h3>
        </div>
        <div class="card-body">
          <form method="post" name="myForm">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <input type="hidden" class="form-control form-control-sm" id="id" name="id">
                  <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Nama">
                    <?php echo form_error('id','<small class="text-danger">','</small>')?>
                    <?php echo form_error('nama','<small class="text-danger">','</small>')?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                  <div class="col-sm-9">
                    <select type="text" class="form-control form-control-sm" id="jk" name="jk">
                      <option value="Laki-laki">Laki-Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select> 
                    <?php echo form_error('jk','<small class="text-danger">','</small>')?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="instansi" class="col-sm-3 col-form-label">Instansi</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="instansi" name="instansi" placeholder="Instansi">
                    <?php echo form_error('instansi','<small class="text-danger">','</small>')?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="notelp" class="col-sm-3 col-form-label">Nomor Telepon</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="notelp" name="notelp" placeholder="Nomor Telepon">
                    <?php echo form_error('notelp','<small class="text-danger">','</small>')?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                  <div class="col-sm-9">
                    <textarea class="form-control form-control-sm" id="alamat" name="alamat" placeholder="Alamat Lengkap (Max : 200 Char)"></textarea>
                    <?php echo form_error('alamat','<small class="text-danger">','</small><br>')?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                  <div class="col-sm-9">
                    <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" placeholder="Keterangan (Max : 200 Char)"></textarea>
                    <?php echo form_error('keterangan','<small class="text-danger">','</small><br>')?>
                  </div>
                </div>
                <div class="form-group float-right">
                  <button type="submit" name="simpan" class="btn btn-primary" id="btn-tambah" value="on">Simpan</button>
                  <button type="submit" name="perbarui" class="btn btn-primary" id="btn-perbarui" value="on">Perbarui</button>
                  <button type="button" class="btn btn-secondary" onCLick="unsetFormPermintaanInstallasi(),hidePermintaanInstallasi()">Batal</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Permintaan Installasi</h3>
          <div class="card-tools">
            <a href="#formPermintaanInstallasi" class="btn btn-sm btn-primary float-md-right" role="button" onClick="setFormPermintaanInstallasi('tambah')">Buat <i class="fas fa-plus-circle"></i></a>
          </div>
        </div>
        <div class="card-body">
          <table id="mainDatatable" class="table table-sm table-bordered table-hover table-striped" style="font-size: 11pt;padding:0px 5px;">
            <thead>
              <tr>
                <th style="width: 40px; text-align:center;">No</th>
                <th>Tgl Permintaan</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Instansi</th>
                <th>No Telp</th>
                <th>Alamat</th>
                <th>Keterangan</th>
                <th style="text-align:center;">Status</th>
                <th style="text-align:center">Tgl Survei</th>
                <th style="width: 30px"></th>
                <th style="width: 30px"></th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; foreach($permintaan_installasi as $row) : ?>
              <tr>
                <td style="text-align:center;"><?=$i++?></td>
                <td><?=date('d F Y',strtotime($row['tgl_permintaan']))?></td>
                <td><?=$row['nama']?></td>
                <td><?=$row['jk']?></td>
                <td><?=$row['instansi']?></td>
                <td><?=$row['no_telp']?></td>
                <td><?=$row['alamat']?></td>
                <td><?=$row['keterangan']?></td>
                <td style="text-align:center;"><?=$row['status']?></td>
                <td style="text-align:center;">
                  <?php if($row['tgl_survei']){ echo date('d F Y', strtotime($row['tgl_survei']));}else{?>
                  <a class="d-sm-inline-block" href="#formJadwalSurvei" role="button" onCLick="setFormJadwalSurvei(<?php echo $row['id']?>)"><i class="fas fa-plus"></i></a>
                  <?php }?>
                </td>
                <td style="text-align:center;">
                  <a class="d-sm-inline-block" href="#formPermintaanInstallasi" role="button" onCLick="setFormPermintaanInstallasi(<?php echo $row['id']?>)"><i class="far fa-edit"></i></a>
                </td>
                <td style="text-align:center;">
                  <a class="d-sm-inline-block" href="#" onCLick="hapusPermintaanInstallasi(<?php echo $row['id']?>)"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
              <?php ; endforeach?>
            </tbody>
            <tfoot>
              <tr>
                <th style="width: 40px; text-align:center;">No</th>
                <th>Tgl Permintaan</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Instansi</th>
                <th>No Telp</th>
                <th>Alamat</th>
                <th>Keterangan</th>
                <th style="text-align:center;">Status</th>
                <th style="text-align:center">Tgl Survei</th>
                <th style="width: 30px"></th>
                <th style="width: 30px"></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>