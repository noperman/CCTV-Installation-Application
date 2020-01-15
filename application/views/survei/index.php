<div class="container-fluid">
  <?php echo $this->session->flashdata('message');?>
  <?php 
    if(form_error('id') || form_error('catatan') || form_error('foto[]') || form_error('id_survei') || form_error('jadwal_installasi')){
      echo '<div id="message" class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="far fa-times-circle"></i> Data gagal disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>';
    }
  ?>

  <div class="row" id="formJadwalInstallasi" style="display:none;">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            Buat Jadwal Installasi
          </h3>
        </div>
        <div class="card-body">
          <form method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <input type="hidden" class="form-control form-control-sm" name="id_permintaan" id="id_permintaan">
                  <input type="hidden" class="form-control form-control-sm" name="id_survei" id="id_survei">
                  <label for="jadwal_installasi" class="col-sm-3 col-form-label">Tanggal Installasi</label>
                  <div class="col-md-9">
                    <input type="date" class="form-control form-control-sm" id="jadwal_installasi" name="jadwal_installasi" placeholder="Tanggal Survei">
                    <?php echo form_error('id_permintaan','<small class="text-danger">','</small><br>')?>
                    <?php echo form_error('id_survei','<small class="text-danger">','</small><br>')?>
                    <?php echo form_error('jadwal_installasi','<small class="text-danger">','</small>')?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group float-left">
                  <button type="submit" name="simpan_jadwal_installasi" class="btn btn-primary" value="on">Simpan</button>
                  <button type="button" class="btn btn-secondary" onCLick="unsetformJadwalInstallasi(),hideformJadwalInstallasi()">Batal</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row" id="formSurvei" style="display:none;">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            Upload Data Survei
          </h3>
        </div>
        <div class="card-body">
          <form method="post" enctype="multipart/form-data" onsubmit="return validate()" name="myForm">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <input type="hidden" name="id" class="form-control form-control-sm" id="id">
                  <label for="jadwal_installasi" class="col-sm-3 col-form-label">Jadwal Installasi</label>
                  <div class="col-md-9">
                    <input type="date" class="form-control form-control-sm" id="jadwal_installasi" name="jadwal_installasi" placeholder="Jadwal Installasi">
                    <?php echo form_error('id','<small class="text-danger">','</small><br>')?>
                    <?php echo form_error('jadwal_installasi','<small class="text-danger">','</small>')?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="alat" class="col-sm-3 col-form-label">Alat Installasi</label>
                  <div class="col-sm-9">
                    <select type="text" class="form-control form-control-sm" id="alat" name="alat">
                      <option value="">-- Pilih Alat --</option>
                      <?php foreach($master_alat as $alat) :?>
                        <option value="<?=$alat['id']?>"><?=$alat['nama_alat']?></option>
                      <?php endforeach?>
                    </select> 
                    <small id="small_alat"></small>
                    <?php echo form_error('alat','<small class="text-danger">','</small>')?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="bahan" class="col-sm-3 col-form-label">Bahan Installasi</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="bahan" name="bahan" placeholder="Bahan">
                    <div class="row">
                      <input type="number" class="form-control form-control-sm col-md-2 mt-2 ml-2" id="jumlah" name="jumlah" placeholder="Jumlah">
                      <input type="text" class="form-control form-control-sm col-md-4 mt-2 ml-2" id="satuan" name="satuan" placeholder="Satuan">
                      <a href="#" class="btn btn-sm btn-primary mt-2 ml-2" id="tambahBahan">Tambah</a>
                      <a href="#tblBahan" class="btn btn-sm btn-primary mt-2 ml-2" id="bukaBahan">Lihat</a>
                    </div>
                    <?php echo form_error('bahan','<small class="text-danger">','</small>')?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label for="catatan" class="col-sm-3 col-form-label">Catatan</label>
                  <div class="col-sm-9">
                    <textarea class="form-control form-control-sm" id="catatan" name="catatan" placeholder="Catatan (Max 200 Chars)"></textarea>
                    <?php echo form_error('catatan','<small class="text-danger">','</small>')?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="foto" class="col-sm-3 col-form-label">Lampiran</label>
                  <div class="col-sm-9">
                    <input type="file" class="form-control form-control-sm"  name="foto[]" multiple id="foto" accept="image/x-png,image/gif,image/jpeg"> 
                    <?php echo form_error('foto[]','<small class="text-danger">','</small>')?>
                  </div>
                </div>
                <div class="form-group float-right">
                  <button type="submit" name="simpan" class="btn btn-sm btn-primary" id="btn-tambah" value="on">Simpan</button>
                  <button type="button" class="btn btn-sm btn-secondary" onCLick="unsetformSurvei(),hideformSurvei()">Batal</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row" id="tblBahan" style="display: none">
    <div class="col-md-12">
      <div class="card card-outline">
        <div class="card-header">
          <h3 class="card-title">
            Bahan Installasi
          </h3>
          <div class="card-tools">
            <button type="button" id="tutupBahan" class="btn btn-tool btn-sm" title="Tutup">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body pad">
          <div class="row mb-2">
            <button type="button" class="btn btn-sm btn-danger disabled ml-2" id="hpsBhn">Hapus</button>
          </div>
          <table id="tbl-bahan" class="table table-sm table-bordered table-hover table-striped" style="font-size: 10pt;padding:0px 5px;">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>BAHAN</th>
                <th style="text-align:center;">JUMLAH</th>
                <th style="text-align:center;">SATUAN</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th style="width: 10px">#</th>
                <th>BAHAN</th>
                <th style="text-align:center;">JUMLAH</th>
                <th style="text-align:center;">SATUAN</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Survei</h3>
        </div>
        <div class="card-body">
          <div class="row">
          <?php 
            $survei_ = $survei;
            if($this->session->userdata('level_user') == "1"){
              $survei_ = $survei_admin;
            }
            foreach($survei_ as $row => $data) : ?>
            <div class="card border-primary mb-3 col-md-3">
              <div class="card-header <?=($data['status_survei'] == 'Ditolak')?'bg-secondary': (($data['status_survei'] == 'Dimulai') ? 'bg-danger' :(($data['status_survei'] == 'Selesai') ? 'bg-warning' :(($data['status_survei'] == 'Diterima') ? 'bg-success' :'')));?>">
                <h4><?=date('d F Y', strtotime($data['tgl_survei']))?></h4>
              </div>
              <div class="card-body">
                <p class="card-text text-justify">
                  Teknisi : <?=$data['fullname']?><br>
                  Permintaan : <?=date('d F Y',strtotime($data['tgl_permintaan']))?><br>
                  <?=$data['instansi'].', '.$data['nama'].', '.$data['jk'].'<br>'.$data['alamat'].', '.$data['no_telp'].'<br>'.$data['keterangan']?>
                </p>
                <!-- <p class="card-text text-justify">
                  Alat :
                  <?php 
                  // $alat_koma = array(); foreach($data[0] as $alat){
                  //   $alat_koma[] = $alat['detail_alat'];
                  // }
                  // echo implode(", ",$alat_koma);
                  ?><br>
                  Bahan :
                  <?php 
                  // $bahan_koma = array(); foreach($data[1] as $bahan){
                  //   $bahan_koma[] = $bahan['detail_bahan'];
                  // }
                  // echo implode(", ",$bahan_koma);
                  ?>
                </p> -->
                <?php if($data['status_survei'] == 'Ditolak'):?>
                  <a href="#" class="btn btn-sm btn-primary float-right" onCLick="mulaiSurvei(<?php echo $data['id_survei']?>)">Mulai</a>
                <?php elseif($data['status_survei'] == 'Dimulai'):?>
                  <a href="#formSurvei" class="btn btn-sm btn-primary float-right" onCLick="setformSurvei(<?php echo $data['id_survei']?>)">Selesai</a>
                <?php elseif($data['status_survei'] == 'Selesai') :?>
                <div class="row">                 
                    <?php if($this->session->userdata('level_user') == '1') : ?>
                      <a href="#formJadwalInstallasi" class="btn btn-sm btn-primary ml-2" onCLick="setformJadwalInstallasi('<?=$data['id_survei']?>','<?=$data['id_permintaan']?>')">Acc</a>
                      <a href="#formJadwalInstallasi" class="btn btn-sm btn-primary ml-2" onCLick="setformJadwalInstallasi('<?=$data['id_survei']?>','<?=$data['id_permintaan']?>')">Cancel</a>
                    <?php endif?>
                    <!-- <form action="<?=base_url('survei/hasil/'.$data['id_photos'])?>" method="post">
                      <button type="submit" class="btn btn-sm btn-primary ml-2" name="survei" value="<?=$data['id_survei']?>">Hasil</button>
                    </form> -->
                  <a href="<?=base_url('survei/hasil/'.$data['id_survei']).'/'.$data['id_photos']?>" class="btn btn-sm btn-primary ml-2">Hasil</a>
                </div>
                <?php elseif($data['status_survei'] == 'Diterima'):?>
                  <a href="<?=base_url('survei/hasil/'.$data['id_photos'])?>" class="btn btn-sm btn-primary float-right">Lihat</a>
                <?php endif?>
              </div>
            </div>
          <?php endforeach?>
          </div>
        </div>
        <div class="card-footer clearfix">
          <?php echo $links;?>
        </div>
      </div>
    </div>
  </div>
</div>