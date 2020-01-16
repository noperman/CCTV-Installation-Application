<div class="container-fluid">
  <?php echo $this->session->flashdata('message');?>
  <?php 
    if(form_error('id') || form_error('catatan') || form_error('foto[]')){
      echo '<div id="message" class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="far fa-times-circle"></i> Data gagal disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>';
    }
  ?>
  <div class="row" id="formInstallasi" style="display:none;">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            Upload Data Installasi
          </h3>
        </div>
        <div class="card-body">
          <form method="post" enctype="multipart/form-data" onsubmit="return validate()" name="myForm">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <input type="hidden" name="id" class="form-control form-control-sm" id="id">
                  <input type="hidden" name="id_permintaan" class="form-control form-control-sm" id="id_permintaan">
                  <label for="catatan" class="col-sm-3 col-form-label">Catatan</label>
                  <div class="col-sm-9">
                    <textarea class="form-control form-control-sm" id="catatan" name="catatan" placeholder="Catatan (Max 200 Chars)"></textarea>
                    <?php echo form_error('id','<small class="text-danger">','</small><br>')?>
                    <?php echo form_error('id_permintaan','<small class="text-danger">','</small><br>')?>
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
              </div>
              <div class="col-md-6">
                <div class="form-group float-left">
                  <button type="submit" name="simpan" class="btn btn-sm btn-primary" id="btn-tambah" value="on">Simpan</button>
                  <button type="button" class="btn btn-sm btn-secondary" onCLick="unsetformInstallasi(),hideformInstallasi()">Batal</button>
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
          <h3 class="card-title">Data Installasi</h3>
        </div>
        <div class="card-body">
          <div class="row">
          <?php 
            $installasi_ = $installasi;
            if($this->session->userdata('level_user') == "1"){
              $installasi_ = $installasi_admin;
            }
            foreach($installasi_ as $row => $data) : ?>
            <div class="card border-primary mb-3 col-md-3">
              <div class="card-header <?=($data['status'] == 'Belum Dikerjakan')?'bg-secondary': (($data['status'] == 'Proses Installasi') ? 'bg-danger' :(($data['status'] == 'Selesai') ? 'bg-success' :''));?>">
                <h4 class="<?=($data['status'] == "Cancel")?'text-danger':''?>"><?=date('d F Y', strtotime($data['tgl_installasi']))?> <small><?=($data['status'] == "Cancel")?'('.$data['status'].')':''?></small></h4>
              </div>
              <div class="card-body">
                <p class="card-text text-justify">
                  Teknisi : <?=$data['fullname']?><br>
                  Permintaan : <?=date('d F Y',strtotime($data['tgl_permintaan']))?><br>
                  Survei : <?=date('d F Y',strtotime($data['tgl_survei']))?><br>
                  <?=$data['instansi'].', '.$data['nama'].', '.$data['jk'].'<br>'.$data['alamat'].', '.$data['no_telp'].'<br>'.$data['keterangan']?>
                </p>
                <p class="card-text text-justify">
                  Alat :
                  <?php 
                  $alat_koma = array(); foreach($data['alat'] as $alat){
                    $alat_koma[] = $alat['detail_alat'];
                  }
                  echo implode(", ",$alat_koma);
                  ?><br>
                  Bahan :
                  <?php 
                  $bahan_koma = array(); $i=1; foreach($data['bahan'] as $bahan){
                    $bahan_koma[] = '<br>'.$i++.'. '.$bahan['bahan'].' '.$bahan['jumlah'].' '.$bahan['satuan'];
                  }
                  echo implode(", ",$bahan_koma);
                  ?>
                </p>
                <?php if($data['status'] == 'Belum Dikerjakan'):?>
                  <a href="#" class="btn btn-sm btn-primary float-right" onCLick="mulaiInstallasi(<?=$data['id']?>)">Mulai</a>
                <?php elseif($data['status'] == 'Proses Installasi'):?>
                  <a href="#formInstallasi" class="btn btn-sm btn-primary float-right" onCLick="setformInstallasi('<?=$data['id']?>','<?=$data['id_permintaan']?>')">Selesai</a>
                <?php elseif($data['status'] == 'Selesai') :?>
                  <a href="<?=base_url('installasi/hasil/'.$data['id']).'/'.$data['id_photos']?>" class="btn btn-sm btn-primary float-right">Hasil</a>
                <?php elseif($data['status'] == 'Cancel'):?>
                <?php endif?>
              </div>
            </div>
          <?php endforeach?>
          </div>
        </div>
        <div class="card-footer clearfix">
          <?=$links;?>
        </div>
      </div>
    </div>
  </div>
</div>