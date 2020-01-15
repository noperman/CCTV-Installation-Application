function setformkelompokbahan(val){
  $('#formKelompokBahan').show('slow');
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
			url : 'getKelompokBahanById',
			dataType : 'json',
			success : function(hasil){
        $("[name='kelompok_bahan_id']").val(hasil[0].id);
        $("[name='kelompok_bahan']").val(hasil[0].nama_bahan);
      }
		});
  }
  unsetFormBahan();
  hideFormBahan();
}

function unsetFormKelompokBahan(){
  $("[name='kelompok_bahan_id']").val('');
  $("[name='kelompok_bahan']").val('');
}

function hideFormKelompokBahan(){
  $('#formKelompokBahan').hide();
}

function hapusKelompokBahan(id){
  var tanya = confirm('Apakah anda yakin akan menghapus data?');
  
  if(tanya){
    $.ajax({
      type:'POST',
      data:'id='+id,
      url:'hapusKelompokBahan',
      success:function(){
        window.location.replace('bahan');
      }
    });
  }
}

function setformbahan(val){
  $('#formBahan').show('slow');
  if(val=='tambah'){
    $('#h3-tambah-bahan').show();
    $('#btn-tambah-bahan').show();
    $('#h3-perbarui-bahan').hide();
    $('#btn-perbarui-bahan').hide();
  }else{
    $('#h3-tambah-bahan').hide();
    $('#btn-tambah-bahan').hide();
    $('#h3-perbarui-bahan').show();
    $('#btn-perbarui-bahan').show();

    $.ajax({
			type : "POST",
			data : 'id='+val,
			url : 'getBahanById',
			dataType : 'json',
			success : function(hasil){
        $("[name='bahan_id']").val(hasil[0].id);
        $("[name='bahan']").val(hasil[0].id_bahan);
        $("[name='detail_bahan']").val(hasil[0].detail_bahan);
      }
		});
  }
  unsetFormKelompokBahan();
  hideFormKelompokBahan();
}

function unsetFormBahan(){
  $("[name='bahan_id']").val('');
  $("[name='bahan']").val('');
  $("[name='detail_bahan']").val('');
}

function hideFormBahan(){
  $('#formBahan').hide();
}

function hapusBahan(id){
  var tanya = confirm('Apakah anda yakin akan menghapus data?');
  
  if(tanya){
    $.ajax({
      type:'POST',
      data:'id='+id,
      url:'hapusBahan',
      success:function(){
        window.location.replace('bahan');
      }
    });
  }
}