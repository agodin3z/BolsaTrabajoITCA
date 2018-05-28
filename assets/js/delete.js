function delCandidato() {
  var id = $('#id').val();
  swal({
    title: '¿Está seguro?',
    text: "Está a punto de borrar su cuenta "+$('#nombre').val(),
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, borrarla!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
          url: "/candidate/delete/"+id,
          type: "post",
          success: function (response) {
            swal(
             'Borrada!',
             'La cuenta a sido borrada!.',
             'success'
            );
            window.location.replace("/candidate/logout");
          },
          error: function(jqXHR, textStatus, errorThrown) {
            swal(
            'Error!',
            'La cuenta NO fue borrada!.',
            'warning'
           );
          }
      });
    }
  });
}

function delCompany() {
  var id = $('#id').val();
  swal({
    title: '¿Está seguro?',
    text: "Está a punto de borrar su cuenta "+$('#nombre').val(),
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, borrarla!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
          url: "/company/delete/"+id,
          type: "post",
          success: function (response) {
            swal(
             'Borrada!',
             'La cuenta a sido borrada!.',
             'success'
            );
            window.location.replace("/company/logout");
          },
          error: function(jqXHR, textStatus, errorThrown) {
            swal(
            'Error!',
            'La cuenta NO fue borrada!.',
            'warning'
           );
          }
      });
    }
  });
}
