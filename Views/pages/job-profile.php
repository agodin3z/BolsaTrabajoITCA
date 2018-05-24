<?php include 'templates/header.php'; ?>
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
        <div class="col-lg-10 col-md-10 col-sm-9">
          <h3 class="white-heading"><?= $oferta->titulo ?></h3>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3">
          <div class="favorite short">Publicado el: <br><?= date('d-M-Y', strtotime(str_replace('-', '/', $oferta->fechaPub))) ?>
          <br><?php if (isset($_SESSION['company']) && $_SESSION['company']->id == $oferta->idEmpresa): ?>
          <a href="<?= BASE_URL ?>jobs/edit/<?= substr(md5($oferta->id), 0, 8) ?>" style="color:#fff">
            <span class="label job-type" style="background:#ce9411;">Editar <i class="fa fa-pencil"></i></span>
          </a>
          <?php endif; ?></div>
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
          <ul class="skills">
            <li><?= $oferta->catOferta ?></li>
          </ul>
          <div class="content">
            <!--<h3 class="small-heading"></h3>-->
            <ul>
              <li><b>Cargo solicitado:</b> <?= $oferta->cargo ?></li>
              <li><b>Área de la empresa:</b> <?= $oferta->area ?></li>
              <li><b>Tipo de Contrato:</b> <?= $oferta->tipoContrato ?></li>
              <li><b>Tipo de Jornada:</b> <?= $oferta->tipoJornada ?></li>
              <li><b>Descripción:</b> <p style="white-space: pre-line;margin:0;"><?= $oferta->descripcion ?></p></li>
              <li><b>Salario:</b> <?= $oferta->salario ?></li>
              <li><b>Localización:</b> <?= $oferta->localizacion ?></li>
              <li><b>Cantidad de Vacantes:</b> <?= $oferta->vacantes ?></li>
            </ul>
            <h3 class="small-heading">Requerimientos</h3>
            <ul>
              <li><b>Educación Mínima:</b> <?= $oferta->educacionMin ?></li>
              <li><b>Edad:</b> <?= $oferta->edad ?></li>
              <li><b>Disponibilidad de Viajar:</b> <?= $oferta->viajar ?></li>
              <li><b>Disponibilidad de Cambio de Residencia:</b> <?= $oferta->residencia ?></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 sidebar">
          <div class="widget w1" style="text-align:left!important">
            <ul>
              <li>
                <img src="<?= BASE_URL.$oferta->logo ?>" class="avatar img-responsive" alt="">
              </li>
              <li>
                <p><b><a href="<?= BASE_URL ?>company/profile/<?= substr(md5($oferta->idEmpresa), 0, 8) ?>"><?= $oferta->empresa ?></a></b></p>
              </li>
              <li>
                <p><b>Email:</b> <?= $oferta->email ?></p>
              </li>
              <li>
                <a href="#" data-toggle="modal" data-target="#myModal"><span class="label job-type apply-job">APLICAR A ESTE TRABAJO</span></a>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                  <!-- Popup Model-->
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Aplica a este trabajo<span><?= $oferta->cargo . " en " . $oferta->empresa ?></span></h3>
                      </div>
                      <form class="" action="<?= (isset($_SESSION['candidate'])) ? BASE_URL.'jobs/apply/'.substr(md5($oferta->id), 0, 8).'/'.$oferta->email : BASE_URL.'candidate/login' ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                          <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" name="name" value="<?php if (isset($_SESSION['candidate'])) {
                              echo $_SESSION['candidate']->nombre . " " . $_SESSION['candidate']->apellido;
                            } ?>" required/>
                          </div>
                          <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" name="email" value="<?php if (isset($_SESSION['candidate'])) {
                              echo $_SESSION['candidate']->email;
                            } ?>" required/>
                          </div>
                          <div class="form-group">
                            <label>Mensaje</label>
                            <textarea name="message" rows="5" class="tinymce" required><?php if (isset($_SESSION['candidate'])) { echo $mensaje; } ?></textarea>
                          </div>
                          <div class="form-group file-type">
                            <label>Sube tu CV o envía el que tienes en tu cuenta. </label>
                            <div class="upload resume">
                              <input type="hidden" name="alt_cv" value="<?php if (isset($_SESSION['candidate'])) {
                                echo $_SESSION['candidate']->curriculum;
                              } ?>">
                              <input type="file" name="cv" class="inputfile" id="select_file" value="<?php if (isset($_SESSION['candidate'])) {
                                echo $_SESSION['candidate']->curriculum;
                              } ?>"/>
                              <div class="upload resume">
            										<div class="filename"><i class="fa fa-file-image-o" aria-hidden="true"></i>Buscar doc</div>
            										<i> Tamaño Máx.: 5 MB.</i>
            									</div>
                            </div>

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
            <ul class="social" style="display:flex;justify-content:center">
              <?php if (!empty($links)): ?>
                <?php foreach ($links as $link): ?>
                  <li class="link"><a href="<?= $link->url ?>" target="_blank"><i class="fa fa-<?= strtolower($this->modelLink->getLink($link->idLink)[0]->nombre) ?>"></i></a></li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Job Data-->
  <!-- Job Related-->
  <?php if (isset($related) && count($related) > 0): ?>
	<div class="container-fluid job-recom">
		<div class="row" style="margin-bottom: 36px;">
			<div class="main-container">
				<div class="col-lg-12 text-center">
					<h3>Trabajos Relacionados</h3>
				</div>
				<div class="col-lg-12">
          <div id="related-job" class="owl-carousel owl-template owl-theme">
            <!--Related job-->
              <?php foreach ($related as $r): ?>
                <div class="item recom-job">
                  <div class="related_job text-center">
                    <img src="<?= BASE_URL.$r->logo ?>" alt="<?= $r->empresa ?>" style="max-width:45px;max-height:45px;border-radius:50%;"/>
                    <a href="<?= BASE_URL ?>jobs/offert/<?= substr(md5($r->id), 0, 8) ?>"><h4 class="text-center" style="margin:7px 0 0 0"><?= $r->titulo ?></h4></a>
                    <div style="display: flex;align-items: center;justify-content: center;">
                      <span class="label job-type job-<?= $r->contrato ?>"><?= $r->tipoContrato ?></span>
                    </div>
                    <p style="word-break:break-word;margin:5px 0;"><?= $r->localizacion ?><br /><?= substr($r->descripcion, 0, 64)."..." ?></p>
                    <span class="salary"><?= $r->salario ?></span>
                  </div>
                </div>
              <?php endforeach; ?>
            <!--Related job-->
  				</div>
        </div>
			</div>
		</div>
	</div>
  <?php else: ?>
    <!--Blue Secions -->
    <div class="container-fluid green-banner" >
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
  <?php endif; ?>
	<!--Job Related-->
<?php include 'templates/footer.php'; ?>
<?php include 'templates/scripts.php'; ?>
<?php include 'templates/loader.php'; ?>
<?php include 'templates/error.php'; ?>
</body>
</html>
