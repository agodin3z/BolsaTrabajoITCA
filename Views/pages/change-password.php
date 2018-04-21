<?php if (!isset($_SESSION['candidate']) && !isset($_SESSION['company'])) {
  header("Location: /");
} include 'templates/header.php'; ?>
<body class="title-image">
  <div id="loadessr"><div id="loader"></div></div>
  <!-- Header Image Or May be Slider-->
  <div id="header" class="container-fluid pages">
    <div class="row">
      <!-- Header Image Or May be Slider-->
      <div class="top_header">
        <?php include 'templates/menu.php'; ?>
      </div>
    </div>
  </div>
  <!-- Header Image Or May be Slider-->
  <div class="container-fluid login_register header_area login_tabs">
    <div class="row">
      <div class="container main-container">
        <div class="col-lg-offset-1 col-lg-11 col-md-12 col-sm-12 col-xs-12">
          <ul class="nav nav-pills ">
            <li class="active"><a data-toggle="tab" href="#register-account">Cambiar la contraseña</a></li>
          </ul>
          <div class="tab-content">
            <div id="lost-password" class="tab-pane fade in active white-text">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 zero-padding-left">
                <p>Cambiar la contraseña <br />
                  Por favor ingrese la contraseña actual. <br />
                  Luego ingrese la nueva contraseña y confírmela.</p>
                <form  name="contact_us" class="contact_us" action="<?= ($_SERVER['REQUEST_URI'] == '/company/change_passwd') ? BASE_URL.'company/update_passwd' : BASE_URL.'candidate/update_passwd'; ?>" method="post">
                  <div class="form-group">
                    <label>Contraseña Actual:</label>
                    <input type="password" name="old_passwd" data-validacion-tipo="requerido|min:6|max:16" maxlength="16" required>
                    <span class="err white-text"></span>
                  </div>
                  <div class="form-group">
                    <label>Nueva Contraseña:</label>
                    <input id="password" type="password" name="new_passwd" data-validacion-tipo="requerido|min:6|max:16" maxlength="16" required>
                    <span class="err white-text"></span>
                  </div>
                  <div class="form-group">
                    <label><small id="err" class="white-text"></small> Confirmar Contraseña:</label>
                    <input id="cpassword" type="password" name="check_passwd" data-validacion-tipo="requerido|min:6|max:16" maxlength="16" required>
                    <span class="err white-text"></span>
                  </div>
                  <div class="form-group submit">
                    <label>Submit</label>
                    <input type="submit" name="submit" value="Cambiar Contraseña" class="signin" id="signin">
                  </div>
                </form>
              </div>
              <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12  pull-right sidebar">
                <div class="widget">
                  <h3 class="text-center">Consejos para elegir tu contraseña</h3>
                  <ul>
                    <li>
                      <p class="text-justify">Haz claves de una longitud mínima de 8 caracteres. Los caracteres vuelven a la contraseña más robusta.</p><br>
                      <p class="text-justify">Realizar combinaciones alfanuméricas. Estas son más difíciles de descubrir, teniendo en cuenta las diversas posibilidades de combinación de los caracteres.</p><br>
                      <p class="text-justify">Evitar palabras comunes. Quienes conocen de informática pueden revelar una clave en cuestión de segundos. </p>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <?php include 'templates/footer.php'; ?>
    <?php include 'templates/scripts.php'; ?>
    <?php include 'templates/loader.php'; ?>
    <?php include 'templates/error.php'; ?>
    <script>
  	    $(document).ready(function(){
  	        $("#lost-password").submit(function(){
  	            return $(this).validate();
  	        });
  	    })
  	</script>
    <script type="text/javascript">
    function checkPasswordMatch() {
      var password = $("#password").val();
      var confirmPassword = $("#cpassword").val();

      if (password != confirmPassword)
          $("#err").html("<i class='fa fa-times-circle'></i>");
      else
          $("#err").html("<i class='fa fa-check-circle'></i>");
    }
    $(document).ready(function () {
      $("#password, #cpassword").keyup(checkPasswordMatch);
    });
    </script>
  </body>
</html>
