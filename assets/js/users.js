function setformuser(val){
  $('#formUser').show('slow');
  if(val=='tambah'){
    unsetformuser();
    $('#tambahUser').show();
    $('#btn-tamahUser').show();
    $('#editUser').hide();
    $('#btn-ubahUser').hide();
    $('#divPassword').show();
  }else{
    unsetformuser();
    $('#tambahUser').hide();
    $('#btn-tamahUser').hide();
    $('#editUser').show();
    $('#btn-ubahUser').show();
    $('#divPassword').hide();

    $.ajax({
			type : "POST",
			data : 'id='+val,
			url : 'getUserById',
			dataType : 'json',
			success : function(hasil){
        $("[name='user_id']").val(hasil[0].id);
        $("[name='fullname']").val(hasil[0].fullname);
        $("[name='email']").val(hasil[0].email);
        $("[name='level']").val(hasil[0].id_level);
        $("[name='alamat']").val(hasil[0].alamat);
        $("[name='notelp']").val(hasil[0].no_t);
        if(hasil[0].status == 1){
          $('#customCheck').attr('checked',true);
        }else{
          $('#customCheck').attr('checked',false);
        }
      }
		});
  }
  unsetformleveluser();
  hideformleveluser();
}

function unsetformuser(){
  $("[name='user_id']").val('');
  $("[name='fullname']").val('');
  $("[name='email']").val('');
  $("[name='password']").val('');
  $("[name='confirmPassword']").val('');
  $("[name='level']").val('');
  $("[name='alamat']").val('');
  $("[name='notelp']").val('');
}

function hideformuser(){
  $('#formUser').hide();
}

function hapusUser(id){
  var tanya = confirm('Apakah anda yakin akan menghapus data?');
  
  if(tanya){
    $.ajax({
      type:'POST',
      data:'id='+id,
      url:'hapusUser',
      success:function(){
        window.location.replace('users');
      }
    });
  }
}

function setformleveluser(val){
  $('#formLevelUser').show('slow');
  if(val=='tambah'){
    unsetformleveluser();
    $('#tambahLevelUser').show();
    $('#btn-tamahLevelUser').show();
    $('#editLevelUser').hide();
    $('#btn-ubahLevelUser').hide();
  }else{
    unsetformleveluser();
    $('#tambahLevelUser').hide();
    $('#btn-tamahLevelUser').hide();
    $('#editLevelUser').show();
    $('#btn-ubahLevelUser').show();

    $.ajax({
			type : "POST",
			data : 'id='+val,
			url : 'getLevelUserById',
			dataType : 'json',
			success : function(hasil){
				$('[name="level_user_id"]').val(hasil[0].id);
        $('[name="nama_level"]').val(hasil[0].level_user);
      }
		});
  }
  unsetformuser();
  hideformuser();
}

function unsetformleveluser(){
  $("[name='level_user_id']").val('');
  $("[name='nama_level']").val('');
}

function hideformleveluser(){
  $('#formLevelUser').hide();
}

function hapusLevelUser(id){
  var tanya = confirm('Apakah anda yakin akan menghapus data?');
  
  if(tanya){
    $.ajax({
      type:'POST',
      data:'id='+id,
      url:'hapusLevelUser',
      success:function(){
        window.location.replace('users');
      }
    });
  }
}