<div class="login-box">
  <div class="login-logo">
    <a href="<?=base_url()?>"><b>CCTV</b>Installation</a>
  </div>
  <?php echo $this->session->flashdata('message');?>
  
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan masukan email dan password anda dengan benar</p>

      <form action="<?php base_url();?>" method="post">
        <div class="form-group mb-3">
          <div class="input-group">
            <input type="email" class="form-control" name="email" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <?php echo form_error('email','<small class="text-danger">','</small>')?>
        </div>
        <div class="form-group mb-3">
          <div class="input-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <?php echo form_error('password','<small class="text-danger">','</small>')?>
        </div>
        <div class="row">
          <div class="col-6">
            <!-- <a class="btn btn-primary btn-block" href="<?=base_url()?>auth/register">Register</a> -->
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>