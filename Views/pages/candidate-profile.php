<?php if (!isset($_SESSION["company"]) && !$me) {
  header("Location: /company/login");
}
include 'templates/header.php'; ?>
<body class="candidate-dashboard">
  <style media="screen">
    #mceu_14, #mceu_17, #mceu_18 { display: none !important; }
    #mceu_10 { border: 1px solid #e2e2e2; border-radius: 8px; }
  </style>
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
  <!-- Page Title-->
  <div class="container-fluid page-title dashboard">
    <div class="row blue-banner">
      <div class="container main-container">
        <div class="col-lg-8 col-md-8 col-sm-8">
          <?php $nombre=explode(" ",$candidato->nombre); $apellido=explode(" ",$candidato->apellido); ?>
          <h3 class="white-heading"><?= $nombre[0]." ".$apellido[0] ?></h3>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="favorite short">
            <?php if (!empty($candidato->curriculum)): ?>
              <a href="<?= BASE_URL.$candidato->curriculum ?>" target="_blank" style="color:#fff !important;">
                Descargar CV<i class="fa fa-download"></i>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row dashboard">
      <div class="container main-container gery-bg">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  no-padding user-data">
          <div class="separator ">
            <div class="no-padding user-image"><img src="<?= BASE_URL.$candidato->foto ?>" alt=""/></div>
            <div class="user-tag"><?php if (count((array)$perfil) > 1) echo $perfil->titulo; ?>
              <span><?= $nombre[0]." ".$apellido[0] ?></span>
            </div>
            <div class="jos-status">
              <?php if (isset($preferencias) && !empty($preferencias)): ?>
                <span class="label job-type job-partytime">
                  <?= $preferencias->situacion ?>
                </span>
              <?php endif; ?>
            </div>
          </div>
          <div class="separator">
            <div class="user-tag">
              <?php if (isset($preferencias) && !empty($preferencias)): ?>
                <label>Salario Mínimo<span>$<?= $preferencias->salarioMin ?></span></label>
              <?php endif; ?>
            </div>
          </div>
          <div class="separator">
            <div class="user-tag">
              <?php if (isset($preferencias) && !empty($preferencias)): ?>
                <label>Cargo Deseado<span><?= $preferencias->cargo ?></span></label>
              <?php endif; ?>
            </div>
          </div>
          <div class="separator">
            <div class="user-tag">
              <?php if (count((array)$this->modelPais->getPais($candidato->pais)) > 0): ?>
                <label>País<span><?= $this->modelPais->getPais($candidato->pais)[0]->nombre ?></span></label>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page Titl!e-->
  <!-- Job Data -->
  <div class="container-fluid white-bg">
    <div class="row">
      <div class="container main-container-job">
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
          <div class="content">
            <h3 class="small-heading">Datos personales</h3>
            <ul>
              <li><b>Nombre:</b> <?= $candidato->nombre.' '.$candidato->apellido ?> </li>
              <li><b>Sexo:</b> <?= $candidato->sexo ?> </li>
              <li><b>DUI:</b> <?= $candidato->dui ?> </li>
              <li><b>Teléfono:</b> <?= $candidato->tel ?> </li>
              <li><b>Fecha de nacimiento:</b> <?= $candidato->fechaNac ?> </li>
              <li><b>Estado Civil:</b> <?php if (isset($candidato->idEstado)) { echo $this->model->getEstado($candidato->idEstado)->nombre; } ?> </li>
              <li><b>Dirección:</b> <?= $candidato->dir ?> </li>
              <li><b>Código ZIP:</b> <?= $candidato->zip ?> </li>
              <li><b>Ubicacion:</b> <?php if (isset($candidato->ciudad)) { echo $this->modelPais->getMunicipio($candidato->ciudad)[0]->nombre.', '; }
                                        if (isset($candidato->depto)) { echo $this->modelPais->getDepto($candidato->depto)[0]->nombre.', '; }
                                        if (isset($candidato->pais)) { echo $this->modelPais->getPais($candidato->pais)[0]->nombre; } ?> </li>
            </ul>
          </div>
          <div class="">
            <?php if (isset($idioma) && count($idioma) > 0): ?>
              <h3 class="small-heading">Idiomas</h3>
              <ul class="skills">
                <?php foreach ($idioma as $i): ?>
                  <li><?= $this->modelIdioma->getIdioma($i->idIdioma)[0]->idioma ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>
          <div class="content">
            <?php if (count((array)$perfil) > 1): ?>
              <h3 class="small-heading">Perfil Profesional</h3>
              <ul>
                <li><b>Título:</b> <?= $perfil->titulo ?></li>
              </ul>
              <p><?= $perfil->descripcion ?></p>
            <?php endif; ?>
            <?php if (isset($habilidad) && !empty($habilidad)): ?>
              <h3 class="small-heading">Habilidades</h3>
              <ul>
                <?php foreach ($habilidad as $skill): ?>
                  <li><?= $skill->habilidad ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <?php if (isset($conocimiento) && !empty($conocimiento)): ?>
              <h3 class="small-heading">Conocimientos</h3>
              <ul>
                <?php foreach ($conocimiento as $program): ?>
                  <li><?= $program->programa ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <?php if (isset($estudios) && !empty($estudios)): ?>
              <h3 class="small-heading">Educación</h3>
              <ul class="education">
                <?php foreach ($estudios as $study): ?>
                  <li>
                    <div class="data-row">
                      <div class="date"><?= date('M Y', strtotime(str_replace('-', '/', $study->inicio)))." - ".date('M Y', strtotime(str_replace('-', '/', $study->fin))) ?></div>
                      <h3><?= $study->institucion ?></h3>
                      <p><?= $study->notas ?></p>
                    </div>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <?php if (isset($experiencias) && !empty($experiencias)): ?>
              <h3 class="small-heading">Experiencia Laboral</h3>
              <ul class="education">
                <?php foreach ($experiencias as $exp): ?>
                  <li>
                    <div class="data-row">
                      <div class="date"><?= date('M Y', strtotime(str_replace('-', '/', $exp->inicio)))." - ".date('M Y', strtotime(str_replace('-', '/', $exp->fin))) ?></div>
                      <h3><?= $exp->empresa ?></h3>
                      <p><?= $exp->cargo ?></p>
                      <p><?= $exp->funciones ?></p>
                    </div>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <?php if (isset($preferencias) && !empty($preferencias)): ?>
              <h3 class="small-heading">Preferencias Laborales</h3>
              <ul>
                <ul>
                  <li><b>Situación actual:</b> <?= $preferencias->situacion ?></li>
                  <li><b>Cargo deseado:</b> <?= $preferencias->cargo ?></li>
                  <li><b>Área de trabajo deseada:</b> <?= $preferencias->area ?></li>
                  <li><b>Salario Mínimo deseado:</b> $<?= $preferencias->salarioMin ?></li>
                  <li><b>Ubicación deseada:</b> <?= $preferencias->depto ?></li>
                </ul>
              </ul>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 sidebar">
          <div class="widget w1">
            <ul>
              <li>
                <a href="#" data-toggle="modal" data-target="#myModal"><span class="label job-type apply-job">CONTRÁTAME</span></a>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                  <!-- Popup Model-->
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Contactar a Candidato<span><?= "Enviando mensaje a ".$nombre[0]." ".$apellido[0] ?></span></h3>
                      </div>
                      <form class="" action="<?= (isset($_SESSION['company'])) ? BASE_URL.'candidate/hire/'.substr(md5($candidato->id), 0, 8).'/'.$candidato->email : BASE_URL.'company/login' ?>" method="post">
                        <div class="modal-body">
                          <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" name="name" value="<?php if (isset($_SESSION['company'])) {
                              echo $_SESSION['company']->nombre;
                            } ?>" required/>
                          </div>
                          <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" name="email" value="<?php if (isset($_SESSION['company'])) {
                              echo $_SESSION['company']->email_contact;
                            } ?>" required/>
                          </div>
                          <div class="form-group">
                            <label>Mensaje</label>
                            <textarea name="message" class="tinymce" rows="5" required><?php if (isset($_SESSION['company'])) {
                              echo "Hola ".$nombre[0]."! <br><br>
                              Somos ".$_SESSION['company']->nombre.", nos gustaría que fueras parte del equipo. <br><br>
                              Responde este mensaje si también estás interesado.";
                            } ?></textarea>
                          </div>
                        </div>
                        <div class="modal-footer" style="display:flex">
                          <input type="submit" class="label job-type apply-job" name="enviar" value="Enviar" style="display:block;width:75%;margin:0 auto;">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- End Modal-->
              </li>
            </ul>
            <!--<ul class="social">
              <li><a href="#"><i class="fa fa-link"></i>www</a></li>
              <li><a href="#"><i class="fa fa-facebook"></i>facebook</a></li>
              <li><a href="#"><i class="fa fa-twitter"></i>twitter</a></li>
            </ul>-->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Job Data-->
  <!--Blue Secions --> <div class="container-fluid green-banner" >
  <div class="row">
    <div class="container main-container v-middle" id="style-2">
      <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12  ">
        <h3 class="white-heading">¿Tienes alguna pregunta?<span class="call-us"><strong>envíanos un email o llámanos</strong></span></h3>
      </div>
      <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
        <a href="<?= BASE_URL ?>contact" class="btn btn-getstarted bg-red">Comienza Ahora</a>
      </div>
    </div>
  </div>
</div>
<!--blue Section -->
<?php include 'templates/footer.php'; ?>
<?php include 'templates/scripts.php'; ?>
<?php include 'templates/loader.php'; ?>
<?php include 'templates/error.php'; ?>
</body>
</html>
