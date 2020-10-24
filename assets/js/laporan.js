$(function(){
	// Button datatable modification
	$('button.dt-button').addClass('btn btn-primary btn-sm mb-2')
	$('button.dt-button span').text('Export Excel')
});

// var i = 1;
const tbl_laporan = $('#tbl-laporan').DataTable({
  dom: 'Blftip',
  buttons: [
    'excelHtml5'
  ],
  // ajax: {
  //   url: baseurl+"riwayat_pembayaran/riwayat_pembayaran/"+tglM.replace("/","-")+"/"+tglS.replace("/","-")+"/"+status
  // },
  paging: false,
  lengthChange: false,
  searching: false,
  ordering: true,
  info: false,
  autoWidth: false,
  columns : [
    // { "data" : "id" },
    { "data" : "tgl_installasi"},
    { "data" : "nama" },
    { "data" : "instansi", className: "td-center" },
    { "data" : "alamat" },
    { "data" : "no_telp", className: "td-center" },
    { "data" : "teknisi"},
    { "data" : "status", className: "td-center" },
  ]
});

$('#range_tgl').daterangepicker()

$('#cariLaporan').on('click', function(){
  if(document.forms.myForm.range_tgl.value.trim() == ""){
		alert("Silahkan pilih tanggal mulai dan tanggal selesai");
		document.getElementById('range_tgl').style.borderColor='red';
		document.getElementById('range_tgl').focus();
		return false;
  }
  var exTgl = $('#range_tgl').val().split(" - ");
  var tglM = exTgl[0].replace("/","-");
  var tglS = exTgl[1].replace("/","-");

  tbl_laporan.ajax
  .url(baseurl+"laporan/getLaporan/"+tglM.replace("/","-")+"/"+tglS.replace("/","-"))
  .load();

	// Button datatable modification
	// $('button.dt-button').addClass('btn btn-primary btn-sm mb-2')
	// $('button.dt-button span').text('Export Excel')
});