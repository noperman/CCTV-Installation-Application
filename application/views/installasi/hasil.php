<div class="container-fluid">
  <?php echo $this->session->flashdata('message');?>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Hasil Survei</h3>
        </div>
        <div class="card-body">
          <h1 class="font-weight-light text-center text-lg-left mb-0">Gallery Installasi</h1>
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