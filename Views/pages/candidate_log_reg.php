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
      <div class="container main-container-home">
        <div class="col-lg-offset-1 col-lg-11 col-md-12 col-sm-12 col-xs-12">
          <ul class="nav nav-pills ">
            <li class="active"><a data-toggle="tab" href="#register-account">Registrarse</a></li>
            <li><a data-toggle="tab" href="#login">Ingresar</a></li>
          </ul>
          <div class="tab-content">
            <div id="register-account" class="tab-pane fade in active white-text">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 zero-padding-left">
                <p>Crea una cuenta nueva.</p>
                <form name="contact_us" class="contact_us" action="<?= BASE_URL ?>candidate/register" method="post">
                  <div class="form-group">
                    <label>Nombres:</label>
                    <input type="text" name="nombre" data-validacion-tipo="requerido|min:4|max:75" maxlength="75" required>
                    <span class="err white-text"></span>
                  </div>
                  <div class="form-group">
                    <label>Apellidos:</label>
                    <input type="text" name="apellido" data-validacion-tipo="requerido|min:3|max:75" maxlength="75" required>
                    <span class="err white-text"></span>
                  </div>
                  <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" data-validacion-tipo="requerido|email" required>
                    <span class="err white-text"></span>
                  </div>
                  <div class="form-group">
                    <label>Clave:</label>
                    <input type="password" name="passwd" id="password" data-validacion-tipo="requerido|min:6|max:16" maxlength="16" required/>
                    <span class="err white-text"></span>
                  </div>
                  <div class="form-group">
                    <label><small id="err" class="white-text"></small> Confirmar Clave:</label>
                    <input type="password" name="cpassword" id="cpassword" data-validacion-tipo="requerido|min:6|max:16" maxlength="16" required/>
                    <span class="err white-text"></span>
                  </div>
                  <div class="form-group submit">
                    <label>Submit</label>
                    <input id="register" type="submit" name="submit" value="Registrarse" class="register">
                  </div>
                </form>
              </div>
              <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12  pull-right sidebar">
                <div class="widget">
                  <h3 class="text-center">¿Por qué crear una cuenta en ITCA Jobs? </h3>
                  <ul>
                    <li><p class="text-justify"><i class="fa fa-clock-o"></i>Aplicación rápida a ofertas,
                      los documentos necesarios estarán siempre a la mano.</p></li>
                    <li><p class="text-justify"><i class="fa fa-child"></i>Ser objetivo de empleadores,
                    compartes tu perfil y tu Currículum Vitae a los reclutadores.</p></li>
                    <li><p class="text-justify"><i class="fa fa-check-circle-o"></i>Trabajos coincidentes,
                      sugerimos ofertas que se ajustan a las necesidades de cada candidato.</p></li>
                  </ul>
                </div>
              </div>
            </div>
            <div id="login" class="tab-pane fade in  white-text">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 zero-padding-left">
                <p>Inicia Sesión en tu cuenta.</p>
                <form name="contact_us" class="contact_us" action="<?= BASE_URL ?>candidate/login_user" method="post">
                  <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" data-validacion-tipo="requerido|email|max:75" maxlength="75" required>
                    <span class="err white-text"></span>
                  </div>
                  <div class="form-group">
                    <label>Contraseña:</label>
                    <input type="password" name="password" id="password-2" data-validacion-tipo="requerido|min:6|max:16" maxlength="16" required/>
                    <span class="err white-text"></span>
                  </div>
                  <div class="form-group submit">
                    <label>Submit</label>
                    <!--<div class="cbox">
                      <input type="checkbox" name="checkbox"/>
                      <span>Recordarme</span>
                    </div>-->
                  </div>
                  <div class="form-group submit">
                    <label>Submit</label><br>
                    <input type="submit" name="submit" value="Ingresar" class="signin" id="signin">
                    <a href="<?= BASE_URL?>candidate/lost_password" class="lost_password">¿Olvidó la clave?</a>
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
                        <a href="" class="label job-type register">Registrarse</a>
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
    <script>
  	    $(document).ready(function(){
  	        $("#register-account").submit(function(){
  	            return $(this).validate();
  	        });
            $("#login").submit(function(){
  	            return $(this).validate();
  	        });
  	    })
  	</script>

    <script type="text/javascript">
    function checkPasswordMatch() {
      var password = $("#password").val();
      var confirmPassword = $("#cpassword").val();

      if (password != confirmPassword) {
          $("#err").html("<i class='fa fa-times-circle'></i>");
          $("#register").prop('disabled', true);
      } else {
          $("#err").html("<i class='fa fa-check-circle'></i>");
          $("#register").prop('disabled', false);
      }
    }
    $(document).ready(function () {
      $("#password, #cpassword").keyup(checkPasswordMatch);
    });
    </script>

    <?php include 'templates/error.php'; ?>
  </body>
</html>
