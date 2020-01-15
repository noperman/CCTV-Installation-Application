<div class="container-fluid">
  <?php echo $this->session->flashdata('message');?>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Hasil Survei</h3>
        </div>
        <div class="card-body">
          <div class="row mb-4">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <b>Tanggal Installasi</b>
                </div>
                <div class="col-md-6"><?=date('d F Y', strtotime($hasil_survei[0]['tgl_installasi']))?></div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <b>Alat Installasi</b>
                </div>
                <div class="col-md-6"><?php $alat_koma = array(); foreach($hasil_survei[0][0] as $alat){$alat_koma[] = $alat['detail_alat'];}echo implode(", ",$alat_koma); ?></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <b>Bahan Installasi</b>
                </div>
                <div class="col-md-6"><?php $i=1; foreach($hasil_survei[0][1] as $bahan){echo $i++.'. '.$bahan['bahan'].' '.$bahan['jumlah'].' '.$bahan['satuan'].'<br>';}?></div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <b>Catatan</b>
                </div>
                <div class="col-md-6"><?=$hasil_survei[0]['catatan']?></div>
              </div>
            </div>
            <?php
            // echo "<pre>";
            // print_r($hasil_survei);
            // echo "</pre>";
            ?>
          </div>
          <h1 class="font-weight-light text-center text-lg-left mb-0">Gallery Survei</h1>
          <hr class="mt-2 mb-5">
          <div class="row text-center text-lg-left">
          <?php foreach($images as $row => $datas) : ?>
            <div class="col-lg-3 col-md-4 col-6">
              <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="<?=base_url($datas['path'].$datas['name'])?>" alt="<?=$datas['name']?>" width="400px" height="300px">
              </a>
            </div>
          <?php endforeach?>
          </div>
          <?php 
            // echo'<pre>';
            // print_r($images);
            // echo '</pre>';
          ?>
        </div>
        <div class="card-footer clearfix">
          <?php echo $links;?>
        </div>
      </div>
    </div>
  </div>
</div>