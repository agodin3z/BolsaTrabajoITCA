<?php if (isset($_SESSION['candidate'])) {
  header("Location: /candidate");
} elseif (isset($_SESSION['company'])) {
  header("Location: /company");
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
            <li class="active"><a data-toggle="tab" href="#register-account">¿Olvidó la Clave?</a></li>
          </ul>
          <div class="tab-content">
            <div id="lost-password" class="tab-pane fade in active white-text">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 zero-padding-left">
                <p>¿Olvidó la Clave? <br />
                  Por favor ingrese su dirección email. <br />
                  Recibirá una clave temporal vía email.</p>
                <form  name="contact_us" class="contact_us" action="<?= ($_SERVER['REQUEST_URI'] == '/company/lost_password') ? BASE_URL.'company/reset' : BASE_URL.'candidate/reset'; ?>" method="post">
                  <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" data-validacion-tipo="requerido|email|max:75" maxlength="75" required>
                    <span class="err white-text"></span>
                  </div>
                  <div class="form-group submit">
                    <label>Submit</label>
                    <input type="submit" name="submit" value="Resetear Clave" class="signin" id="signin">
                  </div>
                </form>
              </div>
              <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12  pull-right sidebar">
                <div class="widget">
                  <h3 class="text-center">¿No tienes una cuenta?</h3>
                  <ul>
                    <li>
                      <p>Si desea obtener más información sobre cómo ITCA Jobs puede ayudarlo con sus necesidades de contratación, envíenos un mensaje <a href="<?= BASE_URL ?>contact">aquí</a>.</p></li>
                      <li><p>Un miembro de nuestro equipo se pondrá en contacto con usted en breve.</p></li>
                      <li>
                        <a href="<?= BASE_URL ?>candidate/login" class="label job-type register">Registrarse</a>
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
  </body>
</html>
