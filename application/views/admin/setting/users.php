<div class="container-fluid">
  <?php echo $this->session->flashdata('message');?>
  <!-- users validation -->
  <?php 
    if(form_error('user_id') || form_error('fullname') || form_error('email') || form_error('password') || form_error('level') || form_error('alamat') || form_error('notelp')){
      echo '<div id="message" class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="far fa-times-circle"></i> Data gagal disimpan<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>';
    }
  ?>
  <!-- users validation -->
  <!-- level_user validation -->
  <?php echo form_error('level_user_id','<div id="message" class="alert alert-danger alert-dismissible fade show" role="alert">
					<i class="far fa-times-circle"></i> ','	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
          </div>')?>
  <?php echo form_error('nama_level','<div id="message" class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="far fa-times-circle"></i> ','	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>')?>
  <!-- level_user validation -->
  <div class="row" id="formUser" style="display: none">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 id="tambahUser" class="card-title">Tambah User</h3>
          <h3 id="editUser" class="card-title">Perbarui User</h3>
        </div>
        <div class="card-body">
          <form method="post" name="myForm">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <input type="hidden" class="form-control form-control-sm" id="user_id" name="user_id">
                  <label for="fullname" class="col-sm-3 col-form-label">Nama Lengkap</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="fullname" name="fullname" placeholder="Nama Lengkap">
                    <?php echo form_error('fullname','<small class="text-danger">','</small><br>')?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="Email">
                    <?php echo form_error('email','<small class="text-danger">','</small><br>')?>
                  </div>
                </div>
                <div id="divPassword" class="form-group row">
                  <label for="password" class="col-sm-3 col-form-label">Password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Password">
                    <input type="password" class="form-control form-control-sm mt-2" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
                    <?php echo form_error('password','<small class="text-danger">','</small><br>')?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="level" class="col-sm-3 col-form-label">Level User</label>
                  <div class="col-sm-9">
                    <select type="text" class="form-control form-control-sm" id="level" name="level">
                      <option value="">--Pilih Level User--</option>
                      <?php foreach($level_user as $row) {?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['level_user'];?></option>
                      <?php } ?>
                    </select> 
                    <?php echo form_error('level','<small class="text-danger">','</small><br>')?>
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
                  <label for="notelp" class="col-sm-3 col-form-label">Nomor Telepon</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="notelp" name="notelp" placeholder="Nomor Telepon">
                    <?php echo form_error('notelp','<small class="text-danger">','</small><br>')?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="customCheck" class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="customCheck" name="customCheck" value="1"> Active?
                    </div>
                  </div>
                </div>
                <div class="form-group float-right">
                  <button type="submit" name="simpanUser" class="btn btn-primary" id="btn-tamahUser" value="tambah">Simpan</button>
                  <button type="submit" name="perbaruiUser" class="btn btn-primary" id="btn-ubahUser" value="perbarui">Perbarui</button>
                  <button type="button" class="btn btn-secondary" onCLick="unsetformuser(),hideformuser()">Batal</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row" id="formLevelUser" style="display: none">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 id="tambahLevelUser" class="card-title">Tambah Level User</h3>
          <h3 id="editLevelUser" class="card-title">Perbarui Level User</h3>
        </div>
        <div class="card-body">
          <form method="post" name="myForm">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <input type="hidden" class="form-control form-control-sm" id="level_user_id" name="level_user_id">
                  <label for="nama_level" class="col-sm-3 col-form-label">Level User</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="nama_level" name="nama_level" placeholder="Level User">
                    <?php echo form_error('level_user_id','<small class="text-danger">','</small><br>')?>
                    <?php echo form_error('nama_level','<small class="text-danger">','</small>')?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group float-left">
                  <button type="submit" name="simpanLevelUser" class="btn btn-primary" id="btn-tamahLevelUser" value="tambah">Simpan</button>
                  <button type="submit" name="perbaruiLevelUser" class="btn btn-primary" id="btn-ubahLevelUser" value="perbarui">Perbarui</button>
                  <button type="button" class="btn btn-secondary" onCLick="unsetformleveluser(),hideformleveluser()">Batal</button>
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
          <h3 class="card-title">List Users</h3>
          <div class="card-tools">
            <a class="btn btn-sm btn-primary float-md-right" href="#formUser" role="button" onCLick="setformuser('tambah')">Tambah <i class="fas fa-plus-circle"></i></a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
          <table id="mainDatatable" class="table table-sm table-bordered table-hover table-striped" style="font-size: 11pt;padding:0px 5px;">
            <thead>
              <tr>
                <th style="width: 40px; text-align:center;">No</th>
                <th>Username</th>
                <th>Email</th>
                <th>Level</th>
                <th style="text-align:center;">Status</th>
                <th style="width: 30px"></th>
                <th style="width: 30px"></th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; foreach($users as $row) : ?>
              <tr>
                <td style="text-align:center;"><?=$i++?></td>
                <td><?=$row['fullname']?><?=($row['id'] == '1')?' ':' ('.$row['status_teknisi'].')'?></td>
                <td><?=$row['email']?></td>
                <td><?=$row['level_user']?></td>
                <td style="text-align:center;">
                  <?php if($row['status'] == "1") : echo "Aktif";else : echo "Tidak aktif";endif;?>  
                </td>
                <td style="text-align:center;">
                  <a class="d-sm-inline-block" href="#formUser" role="button" onCLick="setformuser(<?php echo $row['id']?>)"><i class="far fa-edit"></i></a>
                </td>
                <td style="text-align:center;">
                  <a class="d-sm-inline-block" href="#" onCLick="hapusUser(<?php echo $row['id']?>)"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
              <?php endforeach?>
            </tbody>
            <tfoot>
              <tr>
                <th style="width: 40px; text-align:center;">No</th>
                <th>Username</th>
                <th>Email</th>
                <th>Level</th>
                <th style="text-align:center;">Status</th>
                <th style="width: 30px"></th>
                <th style="width: 30px"></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- /.card --> 
    </div>
    <!-- /.col -->
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Level Users</h3>
          <div class="card-tools"
            ><a class="btn btn-sm btn-primary float-md-right" href="#formLevelUser" role="button" onCLick="setformleveluser('tambah')">Tambah <i class="fas fa-plus-circle"></i></a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="ltpDatatable" class="table table-sm table-bordered table-hover table-striped" style="font-size: 11pt;padding:0px 5px;">
            <thead>                  
              <tr>
                <th style="width: 40px; text-align:center;">No</th>
                <th style="text-align:center;">Level</th>
                <th style="width: 30px"></th>
                <th style="width: 30px"></th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; foreach($level_user as $row) : ?>
              <tr>
                <td style="text-align:center;"><?=$i++?></td>
                <td><?=$row['level_user']?></td>
                <td style="text-align:center;">
                  <a class="d-sm-inline-block" href="#formLevelUser" role="button" onCLick="setformleveluser(<?php echo $row['id']?>)"><i class="far fa-edit"></i></a>
                </td>
                <td style="text-align:center;">
                  <a class="d-sm-inline-block" href="#" onCLick="hapusLevelUser(<?php echo $row['id']?>)"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
              <?php endforeach?>
            </tbody>
            <tfoot>                   
              <tr>
                <th style="width: 40px; text-align:center;">No</th>
                <th style="text-align:center;">Level</th>
                <th style="width: 30px"></th>
                <th style="width: 30px"></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
</div>