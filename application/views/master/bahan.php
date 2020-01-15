<div class="container-fluid">  
  <?php 
    echo $this->session->flashdata('message');

    if(form_error('bahan_id') || form_error('bahan') || form_error('detail_bahan') || form_error('kelompok_bahan_id') || form_error('kelompok_bahan')){
      echo '<div id="message" class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="far fa-times-circle"></i> Data gagal disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>';
    }
  ?>
  <div class="row" id="formBahan" style="display: none">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 id="h3-tambah-bahan" class="card-title">Tambah  Bahan</h3>
          <h3 id="h3-perbarui-bahan" class="card-title">Perbarui  Bahan</h3>
        </div>
        <div class="card-body">
          <form method="post" name="myForm">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <input type="hidden" class="form-control form-control-sm" id="bahan_id" name="bahan_id">
                  <label for="bahan" class="col-sm-3 col-form-label">Kelompok Bahan</label>
                  <div class="col-sm-9">
                    <select type="text" class="form-control form-control-sm" id="bahan" name="bahan">
                      <option value="">--Pilih Kelompok Bahan--</option>
                      <?php foreach($bahan as $row) {?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['nama_bahan'];?></option>
                      <?php } ?>
                    </select> 
                    <?php echo form_error('bahan_id','<small class="text-danger">','</small><br>')?>
                    <?php echo form_error('bahan','<small class="text-danger">','</small><br>')?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="detail_bahan" class="col-sm-3 col-form-label">Bahan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="detail_bahan" name="detail_bahan" placeholder="Nama  Bahan">
                    <?php echo form_error('detail_bahan','<small class="text-danger">','</small>')?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group float-left">
                  <button type="submit" name="simpan_bahan" class="btn btn-primary" id="btn-tambah-bahan" value="on">Simpan</button>
                  <button type="submit" name="perbarui_bahan" class="btn btn-primary" id="btn-perbarui-bahan" value="on">Perbarui</button>
                  <button type="button" class="btn btn-secondary" onCLick="unsetFormBahan(),hideFormBahan()">Batal</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>  
  <div class="row" id="formKelompokBahan" style="display: none">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 id="h3-tambah" class="card-title">Tambah Kelompok Bahan</h3>
          <h3 id="h3-perbarui" class="card-title">Perbarui Kelompok Bahan</h3>
        </div>
        <div class="card-body">
          <form method="post" name="myForm">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <input type="hidden" class="form-control form-control-sm" id="kelompok_bahan_id" name="kelompok_bahan_id">
                  <label for="kelompok_bahan" class="col-sm-3 col-form-label">Kelompok Bahan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="kelompok_bahan" name="kelompok_bahan" placeholder="Nama Kelompok Bahan">
                    <?php echo form_error('kelompok_bahan_id','<small class="text-danger">','</small><br>')?>
                    <?php echo form_error('kelompok_bahan','<small class="text-danger">','</small>')?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group float-left">
                  <button type="submit" name="simpan" class="btn btn-primary" id="btn-tambah" value="on">Simpan</button>
                  <button type="submit" name="perbarui" class="btn btn-primary" id="btn-perbarui" value="on">Perbarui</button>
                  <button type="button" class="btn btn-secondary" onCLick="unsetFormKelompokBahan(),hideFormKelompokBahan()">Batal</button>
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
            Master Bahan
          </h3>
          <div class="card-tools">
            <a href="#formBahan" class="btn btn-sm btn-primary" role="button" onCLick="setformbahan('tambah')">Tambah <i class="fas fa-plus-circle"></i></a>
          </div>
        </div>
        <div class="card-body">
          <table id="mainDatatable" class="table table-sm table-bordered table-hover table-striped" style="font-size: 11pt;padding:0px 5px;">
            <thead>                  
              <tr>
                <th style="width: 40px; text-align:center;">No</th>
                <th style="text-align:center;">Kelompok Bahan</th>
                <th style="text-align:center;">Bahan</th>
                <th style="width: 30px"></th>
                <th style="width: 30px"></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $account_numbers = array(); $i=1; 
                foreach($detail_bahan as $row => $data) : 
                  $display = FALSE;
                  if(!in_array($data["nama_bahan"], $account_numbers)) {
                      $account_numbers[] = $data["nama_bahan"];
                      $display = TRUE;
                  }
              ?>
              <tr>
                <td style="text-align:center;"><?=$i++?></td>
                <td><?= $display ? $data["nama_bahan"] : ""?></td>
                <td><?=$data['detail_bahan']?></td>
                <td style="text-align:center;">
                  <a class="d-sm-inline-block" href="#formBahan" role="button" onCLick="setformbahan(<?php echo $data['id']?>)"><i class="far fa-edit"></i></a>
                </td>
                <td style="text-align:center;">
                  <a class="d-sm-inline-block" href="#" onCLick="hapusBahan(<?php echo $data['id']?>)"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
              <?php endforeach?>
            </tbody>
            <tfoot>
              <tr>
                <th style="width: 40px; text-align:center;">No</th>
                <th style="text-align:center;">Kelompok Bahan</th>
                <th style="text-align:center;">Bahan</th>
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
            Kelompok Bahan
          </h3>
          <div class="card-tools">
            <a href="#formKelompokBahan" class="btn btn-sm btn-primary" role="button" onClick="setformkelompokbahan('tambah')">Tambah <i class="fas fa-plus-circle"></i></a>
          </div>
        </div>
        <div class="card-body">
          <table id="ltpDatatable" class="table table-sm table-bordered table-hover table-striped" style="font-size: 11pt;padding:0px 5px;">
            <thead>                  
              <tr>
                <th style="width: 40px; text-align:center;">No</th>
                <th style="text-align:center;">Nama Bahan</th>
                <th style="width: 30px"></th>
                <th style="width: 30px"></th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; foreach($bahan as $row => $data) : ?>
              <tr>
                <td style="text-align:center;"><?=$i++?></td>
                <td><?=$data["nama_bahan"]?></td>
                <td style="text-align:center;">
                  <a class="d-sm-inline-block" href="#formKelompokBahan" role="button" onCLick="setformkelompokbahan(<?php echo $data['id']?>)"><i class="far fa-edit"></i></a>
                </td>
                <td style="text-align:center;">
                  <a class="d-sm-inline-block" href="#" onCLick="hapusKelompokBahan(<?php echo $data['id']?>)"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
              <?php endforeach?>
            </tbody>
            <tfoot>
              <tr>
                <th style="width: 40px; text-align:center;">No</th>
                <th style="text-align:center;">Nama Bahan</th>
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