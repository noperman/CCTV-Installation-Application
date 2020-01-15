function setFormPermintaanInstallasi(val){
  unsetFormPermintaanInstallasi()
  unsetFormJadwalSurvei()
  hideJadwalSurvei()
  $('#formPermintaanInstallasi').show('slow');
  if(val=='tambah'){
    $('#h3-tambah').show('slow');
    $('#btn-tambah').show('slow');
    $('#h3-perbarui').hide('slow');
    $('#btn-perbarui').hide('slow');
  }else{
    $('#h3-tambah').hide('slow');
    $('#btn-tambah').hide('slow');
    $('#h3-perbarui').show('slow');
    $('#btn-perbarui').show('slow');

    $.ajax({
			type : "POST",
			data : 'id='+val,
			url : 'getPermintaanInstallasiById',
			dataType : 'json',
			success : function(hasil){
        $("[name='id']").val(hasil[0].id);
        $("[name='nama']").val(hasil[0].nama);
        $("[name='jk']").val(hasil[0].jk);
        $("[name='instansi']").val(hasil[0].instansi);
        $("[name='notelp']").val(hasil[0].no_telp);
        $("[name='alamat']").val(hasil[0].alamat);
        $("[name='keterangan']").val(hasil[0].keterangan);
      }
		});
  }
}

function unsetFormPermintaanInstallasi(){
  $("[name='id']").val('');
  $("[name='nama']").val('');
  $("[name='jk']").val('Laki-laki');
  $("[name='instansi']").val('');
  $("[name='notelp']").val('');
  $("[name='alamat']").val('');
  $("[name='keterangan']").val('');
}

function hidePermintaanInstallasi(){
  $('#formPermintaanInstallasi').hide('slow');
}

function hapusPermintaanInstallasi(id){
  var tanya = confirm('Apakah anda yakin akan menghapus data?');
  
  if(tanya){
    $.ajax({
      type:'POST',
      data:'id='+id,
      url:'hapusPermintaanInstallasi',
      success:function(){
        window.location.replace('permintaan_installasi');
      }
    });
  }
}

function setFormJadwalSurvei(val){
  $('#formJadwalSurvei').show('slow')
  unsetFormPermintaanInstallasi()
  hidePermintaanInstallasi()
  $("[name='id_permintaan']").val(val);
}

function unsetFormJadwalSurvei(){
  $("[name='id_permintaan']").val('');
  $("[name='jadwal_survei']").val('');
  $("[name='alat']").val('');
  $("[name='bahan']").val('');
  $("#small_alat").html('');
  $("#small_bahan").html('');
}

function hideJadwalSurvei(){
  $('#formJadwalSurvei').hide('slow');
}

$('#bahan').on('change', function(){
  var id = $('#bahan').val()
  $.ajax({
    type : "POST",
    data : 'id='+id,
    url : 'getBahansById',
    dataType : 'json',
    success : function(hasil){
      var bahan = []
       $.each(hasil, function(key, val){
         bahan.push(val.detail_bahan)
       })
       $('#small_bahan').html(bahan.join(", "))
    }
  });
})