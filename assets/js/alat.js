function setformkelompokalat(val){
  $('#formKelompokAlat').show('slow');
  if(val=='tambah'){
    $('#h3-tambah').show();
    $('#btn-tambah').show();
    $('#h3-perbarui').hide();
    $('#btn-perbarui').hide();
  }else{
    $('#h3-tambah').hide();
    $('#btn-tambah').hide();
    $('#h3-perbarui').show();
    $('#btn-perbarui').show();

    $.ajax({
			type : "POST",
			data : 'id='+val,
			url : 'getKelompokAlatById',
			dataType : 'json',
			success : function(hasil){
        $("[name='kelompok_alat_id']").val(hasil[0].id);
        $("[name='kelompok_alat']").val(hasil[0].nama_alat);
      }
		});
  }
  unsetFormAlat();
  hideFormAlat();
}

function unsetFormKelompokAlat(){
  $("[name='kelompok_alat_id']").val('');
  $("[name='kelompok_alat']").val('');
}

function hideFormKelompokAlat(){
  $('#formKelompokAlat').hide();
}

function hapusKelompokAlat(id){
  var tanya = confirm('Apakah anda yakin akan menghapus data?');
  
  if(tanya){
    $.ajax({
      type:'POST',
      data:'id='+id,
      url:'hapusKelompokAlat',
      success:function(){
        window.location.replace('alat');
      }
    });
  }
}

function setformalat(val){
  $('#formAlat').show('slow');
  if(val=='tambah'){
    $('#h3-tambah-alat').show();
    $('#btn-tambah-alat').show();
    $('#h3-perbarui-alat').hide();
    $('#btn-perbarui-alat').hide();
  }else{
    $('#h3-tambah-alat').hide();
    $('#btn-tambah-alat').hide();
    $('#h3-perbarui-alat').show();
    $('#btn-perbarui-alat').show();

    $.ajax({
			type : "POST",
			data : 'id='+val,
			url : 'getAlatById',
			dataType : 'json',
			success : function(hasil){
        $("[name='alat_id']").val(hasil[0].id);
        $("[name='alat']").val(hasil[0].id_alat);
        $("[name='detail_alat']").val(hasil[0].detail_alat);
      }
		});
  }
  unsetFormKelompokAlat();
  hideFormKelompokAlat();
}

function unsetFormAlat(){
  $("[name='alat_id']").val('');
  $("[name='alat']").val('');
  $("[name='detail_alat']").val('');
}

function hideFormAlat(){
  $('#formAlat').hide();
}

function hapusAlat(id){
  var tanya = confirm('Apakah anda yakin akan menghapus data?');
  
  if(tanya){
    $.ajax({
      type:'POST',
      data:'id='+id,
      url:'hapusAlat',
      success:function(){
        window.location.replace('alat');
      }
    });
  }
}