function mulaiInstallasi(id){
  var tanya = confirm('Apakah anda yakin akan memulai Instalasi?');
  
  if(tanya){
    $.ajax({
      type:'POST',
      data:'id='+id,
      url:'installasi/mulaiInstallasi',
      success:function(){
        window.location.replace('installasi')
      }
    })
  }
}

function validate(){
  var $fileUpload = $("input[type='file']");
  if (parseInt($fileUpload.get(0).files.length)>20){
    alert("You can only upload a maximum of 20 files");
    return false
  }
}

function setformInstallasi(val,val2){
  unsetformInstallasi()
  $('#formInstallasi').show('slow')
  $("[name='id']").val(val)
  $("[name='id_permintaan']").val(val2)
}

function unsetformInstallasi(){
  $("[name='id']").val('')
  $("[name='catatan']").val('')
  $("[name='foto']").val('')
}

function hideformInstallasi(){
  $('#formInstallasi').hide('slow')
}