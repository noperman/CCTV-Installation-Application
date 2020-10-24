<div class="row" id="laporan" style="display: block">
    <div class="col-md-12">
      <div class="card card-outline">
        <div class="card-header">
          <h3 class="card-title">
            Laporan
          </h3>
          <div class="card-tools">
            <button type="button" id="tutup" class="btn btn-tool btn-sm" title="Tutup">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body pad">
        <form name="myForm">
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label>Range Tanggal</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control form-control-sm float-right" id="range_tgl" name="range_tgl">
                </div>
              </div>
            </div>
            <div class="col-md-2 align-self-end mb-3">
              <div class="form-group">
                <button type="button" class="btn btn-sm btn-primary float-left" id="cariLaporan">Cari</button>
              </div>
            </div>
          </div>
        </form>
          <table id="tbl-laporan" class="table table-sm table-bordered table-hover table-striped" style="font-size: 10pt;padding:0px 5px;">
            <thead>
              <tr>
                <!-- <th style="width: 10px">#</th> -->
                <th>TGL INSTALLASI</th>
                <th>NAMA</th>
                <th>INSTANSI</th>
                <th>ALAMAT</th>
                <th>NO TELP</th>
                <th>TEKNISI</th>
                <th class="text-center">STATUS</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <!-- <th style="width: 10px">#</th> -->
                <th>TGL INSTALLASI</th>
                <th>NAMA</th>
                <th>INSTANSI</th>
                <th>ALAMAT</th>
                <th>NO TELP</th>
                <th>TEKNISI</th>
                <th class="text-center">STATUS</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>