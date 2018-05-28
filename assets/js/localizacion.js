
//Obtener los departamentos
function getDeptos() {
  $.getJSON('/company/deptos/' + $('#pais').val(), function(data){
      //console.log(data);
      $('#depto').empty();
      var options = '<option value="">-- Seleccione una opción --</option>';
      if (data.length > 0) {
        $('#depto').prop("disabled", false);
        //var php = "<?= $condDep ?>";
        for (var x = 0; x < data.length; x++) {
            options += '<option value="' + data[x].id + '" >' + data[x].nombre + '</option>';
        }
      } else {
        $('#depto').prop("disabled", !this.checked);
      }
      $('#depto').html(options);
  });
}

//Obtener los Municipios
function getMunicipios() {
  $.getJSON('/company/municp/' + $('#depto').val(), function(data){
      //console.log(data);
      $('#ciudad').empty();
      var options = '<option value="">-- Seleccione una opción --</option>';
      if (data.length > 0) {
        $('#ciudad').prop("disabled", false);
        //var php = "<?= $condMun ?>";
        for (var x = 0; x < data.length; x++) {
            options += '<option value="' + data[x].id + '" >' + data[x].nombre + '</option>';
        }
      } else {
        $('#ciudad').prop("disabled", !this.checked);
      }
      $('#ciudad').html(options);
  });
}

$(document).ready(function(){
  $('#pais').on('change', function (){
    getDeptos();
    setTimeout(function () { getMunicipios(); }, 200);
  });

  $('#depto').change(function (){
    getMunicipios();
  });
});
