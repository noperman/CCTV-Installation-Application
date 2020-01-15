<div class="container-fluid">  
  <?php 
    echo $this->session->flashdata('message');

    if(form_error('alat_id') || form_error('alat') || form_error('detail_alat') || form_error('kelompok_alat_id') || form_error('kelompok_alat')){
      echo '<div id="message" class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="far fa-times-circle"></i> Data gagal disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>';
    }
  ?>
  <div class="row" id="formAlat" style="display: none">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 id="h3-tambah-alat" class="card-title">Tambah  Alat</h3>
          <h3 id="h3-perbarui-alat" class="card-title">Perbarui  Alat</h3>
        </div>
        <div class="card-body">
          <form method="post" name="myForm">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <input type="hidden" class="form-control form-control-sm" id="alat_id" name="alat_id">
                  <label for="alat" class="col-sm-3 col-form-label">Kelompok Alat</label>
                  <div class="col-sm-9">
                    <select type="text" class="form-control form-control-sm" id="alat" name="alat">
                      <option value="">--Pilih Kelompok Alat--</option>
                      <?php foreach($alat as $row) {?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['nama_alat'];?></option>
                      <?php } ?>
                    </select> 
                    <?php echo form_error('alat_id','<small class="text-danger">','</small><br>')?>
                    <?php echo form_error('alat','<small class="text-danger">','</small><br>')?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="detail_alat" class="col-sm-3 col-form-label">Alat</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="detail_alat" name="detail_alat" placeholder="Nama  Alat">
                    <?php echo form_error('detail_alat','<small class="text-danger">','</small>')?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group float-left">
                  <button type="submit" name="simpan_alat" class="btn btn-primary" id="btn-tambah-alat" value="on">Simpan</button>
                  <button type="submit" name="perbarui_alat" class="btn btn-primary" id="btn-perbarui-alat" value="on">Perbarui</button>
                  <button type="button" class="btn btn-secondary" onCLick="unsetFormAlat(),hideFormAlat()">Batal</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>  
  <div class="row" id="formKelompokAlat" style="display: none">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 id="h3-tambah" class="card-title">Tambah Kelompok Alat</h3>
          <h3 id="h3-perbarui" class="card-title">Perbarui Kelompok Alat</h3>
        </div>
        <div class="card-body">
          <form method="post" name="myForm">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <input type="hidden" class="form-control form-control-sm" id="kelompok_alat_id" name="kelompok_alat_id">
                  <label for="kelompok_alat" class="col-sm-3 col-form-label">Kelompok Alat</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="kelompok_alat" name="kelompok_alat" placeholder="Nama Kelompok Alat">
                    <?php echo form_error('kelompok_alat_id','<small class="text-danger">','</small><br>')?>
                    <?php echo form_error('kelompok_alat','<small class="text-danger">','</small>')?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group float-left">
                  <button type="submit" name="simpan" class="btn btn-primary" id="btn-tambah" value="on">Simpan</button>
                  <button type="submit" name="perbarui" class="btn btn-primary" id="btn-perbarui" value="on">Perbarui</button>
                  <button type="button" class="btn btn-secondary" onCLick="unsetFormKelompokAlat(),hideFormKelompokAlat()">Batal</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            Master Alat
          </h3>
          <div class="card-tools">
            <a href="#formAlat" class="btn btn-sm btn-primary" role="button" onCLick="setformalat('tambah')">Tambah <i class="fas fa-plus-circle"></i></a>
          </div>
        </div>
        <div class="card-body">
          <table id="mainDatatable" class="table table-sm table-bordered table-hover table-striped" style="font-size: 11pt;padding:0px 5px;">
            <thead>                  
              <tr>
                <th style="width: 40px; text-align:center;">No</th>
                <th style="text-align:center;">Kelompok Alat</th>
                <th style="text-align:center;">Alat</th>
                <th style="width: 30px"></th>
                <th style="width: 30px"></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                // $account_numbers = array(); 
                $i=1; 
                foreach($detail_alat as $row => $data) : 
                //   $display = FALSE;
                //   if(!in_array($data["nama_alat"], $account_numbers)) {
                //       $account_numbers[] = $data["nama_alat"];
                //       $display = TRUE;
                //   }
              ?>
              <tr>
                <td style="text-align:center;"><?=$i++?></td>
                <!-- <td><?= $display ? $data["nama_alat"] : ""?></td> -->
                <td><?=$data["nama_alat"]?></td>
                <td><?=$data['detail_alat']?></td>
                <td style="text-align:center;">
                  <a class="d-sm-inline-block" href="#formAlat" role="button" onCLick="setformalat(<?php echo $data['id']?>)"><i class="far fa-edit"></i></a>
                </td>
                <td style="text-align:center;">
                  <a class="d-sm-inline-block" href="#" onCLick="hapusAlat(<?php echo $data['id']?>)"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
              <?php endforeach?>
            </tbody>
            <tfoot>
              <tr>
                <th style="width: 40px; text-align:center;">No</th>
                <th style="text-align:center;">Kelompok Alat</th>
                <th style="text-align:center;">Alat</th>
                <th style="width: 30px"></th>
                <th style="width: 30px"></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            Kelompok Alat
          </h3>
          <div class="card-tools">
            <a href="#formKelompokAlat" class="btn btn-sm btn-primary" role="button" onClick="setformkelompokalat('tambah')">Tambah <i class="fas fa-plus-circle"></i></a>
          </div>
        </div>
        <div class="card-body">
          <table id="ltpDatatable" class="table table-sm table-bordered table-hover table-striped" style="font-size: 11pt;padding:0px 5px;">
            <thead>                  
              <tr>
                <th style="width: 40px; text-align:center;">No</th>
                <th style="text-align:center;">Nama Alat</th>
                <th style="width: 30px"></th>
                <th style="width: 30px"></th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; foreach($alat as $row => $data) : ?>
              <tr>
                <td style="text-align:center;"><?=$i++?></td>
                <td><?=$data["nama_alat"]?></td>
                <td style="text-align:center;">
                  <a class="d-sm-inline-block" href="#formKelompokAlat" role="button" onCLick="setformkelompokalat(<?php echo $data['id']?>)"><i class="far fa-edit"></i></a>
                </td>
                <td style="text-align:center;">
                  <a class="d-sm-inline-block" href="#" onCLick="hapusKelompokAlat(<?php echo $data['id']?>)"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
              <?php endforeach?>
            </tbody>
            <tfoot>
              <tr>
                <th style="width: 40px; text-align:center;">No</th>
                <th style="text-align:center;">Nama Alat</th>
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