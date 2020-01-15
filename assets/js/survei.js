function validate(){
  var $fileUpload = $("input[type='file']");
  if (parseInt($fileUpload.get(0).files.length)>20){
    alert("You can only upload a maximum of 20 files");
    return false
  }
}

function setformSurvei(val){
  unsetformSurvei()
  unsetformJadwalInstallasi()
  hideformJadwalInstallasi()
  $('#formSurvei').show('slow')
  $("[name='id']").val(val)
  reloadTblBahan()
  selected()
}

function selected(){
  $('#tbl-bahan tbody').on('click', 'tr', function(){
    $(this).toggleClass('selected');
    if(tbl_bahan.rows('.selected').data().length >= 1){
      $('#hpsBhn').removeClass('disabled');
    }else{
      $('#hpsBhn').addClass('disabled');
    }
  })
}

function unsetformSurvei(){
  $("[name='id']").val('')
  $("[name='catatan']").val('')
  $("[name='foto']").val('')
}

function hideformSurvei(){
  $('#formSurvei').hide('slow')
}

function setformJadwalInstallasi(val,val2){
  unsetformSurvei()
  hideformSurvei()
  unsetformJadwalInstallasi()
  $('#formJadwalInstallasi').show('slow')
  $("[name='id_survei']").val(val)
  $("[name='id_permintaan']").val(val2)
}

function unsetformJadwalInstallasi(){
  $("[name='id_survei']").val('')
  $("[name='id_permintaan']").val('')
  $("[name='jadwal_installasi']").val('')
}

function hideformJadwalInstallasi(){
  $('#formJadwalInstallasi').hide('slow')
}

function mulaiSurvei(id){
  var tanya = confirm('Apakah anda yakin akan memulai survei?');
  
  if(tanya){
    $.ajax({
      type:'POST',
      data:'id='+id,
      url:'survei/mulaiSurvei',
      success:function(){
        window.location.replace('survei');
      }
    });
  }
}

$('#alat').on('change', function(){
  var id = $('#alat').val()
  $.ajax({
    type : "POST",
    data : 'id='+id,
    url : 'survei/getAlatsById',
    dataType : 'json',
    success : function(hasil){
      var alat = []
       $.each(hasil, function(key, val){
         alat.push(val.detail_alat)
       })
       $('#small_alat').html(alat.join(", "))
    }
  });
})

$('#tutupBahan').on('click', function(){
  $('#tblBahan').hide('slow')
})

$('#bukaBahan').on('click', function(){
  $('#tblBahan').show('slow')
})

function resetBahan(){
  $('#bahan').val('');$('#jumlah').val('');$('#satuan').val('')
}

$('#tambahBahan').on('click',function(){
  const nama_bahan = $('#bahan').val()
  const jumlah = $('#jumlah').val()
  const satuan = $('#satuan').val()
  const id_survei = $('#id').val()

  if(!nama_bahan || !jumlah || !satuan || !id_survei){
    alert('Lengkapi form bahan!')
  }else{
    if(parseInt(jumlah) <= 0){
      alert('Isi form bahan dengan benar!!!')
    }else{
      $.ajax({
        type    : "POST",
        data    : {id_survei : id_survei, bahan : nama_bahan, jumlah : jumlah, satuan: satuan},
        url     : baseurl+'survei/tambahBahan',
        success : function(){
          // alert('Data berhasil disimpan.')
          reloadTblBahan()
          $('#tblBahan').show('slow')
          resetBahan()
        }
      })
    }
  }
})

var id = $("#id").val();
if(!id){
  id = 0;
}
const tbl_bahan = $("#tbl-bahan").DataTable({
  dom: 'lftip',
  ajax: {
    url: baseurl+"survei/dataBahan/"+id
  },
  paging: true,
  lengthChange: false,
  searching: false,
  ordering: true,
  info: false,
  autoWidth: false,
  columns : [
    { "data" : "id" },
    { "data" : "bahan" },
    { "data" : "jumlah", className: "td-center" },
    { "data" : "satuan", className: "td-center"}
  ]
})

function reloadTblBahan(){
  var id = $("#id").val();
  if(!id){
    id = 0;
  }
  tbl_bahan.ajax.url(baseurl+"survei/dataBahan/"+id).load()
}

$('#hpsBhn').on('click', function(){
  var tanya = confirm('Apakah anda yakin akan menghapus bahan?');
  
  if(tanya){
    const selected = tbl_bahan.rows('.selected').data();
    const data = [];
    $.each(selected, function (i, v) {
      data.push(v.id)
    });
    if (selected.length > 0) {
      $.ajax({
        type: "post",
        url: baseurl + "survei/hapusBahan",
        data: {
          data: JSON.stringify(data)
        },
        dataType: "json",
        contentType: "application/x-www-form-urlencoded",
        success: function (x) {
          // console.log(x)
          reloadTblBahan()
          // alert('Bahan berhasil dihapus.')
        }
      })
    }
  }
})
