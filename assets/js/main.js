$(function () {
  $("#mainDatatable").DataTable();
  $("#ltpDatatable").DataTable({
    dom: '<"row"<"col-md-12 col-sm-12 text-left"l>><t><"row"<"col-md-12 col-sm-12 text-left"p>>',
  });
  
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
  
  $('#message').delay(1000).fadeOut();
  
  $('[name="myForm"]').on('keyup keypress', function(e) {
		var keyCode = e.keyCode || e.which;
		if (keyCode === 13) {
			e.preventDefault();
			return false;
		}
	});
});