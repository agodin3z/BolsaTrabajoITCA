<?php include 'templates/header.php'; ?>
<body class="candidate-dashboard">
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
          <h3 class="white-heading"><?= $empresa->nombre ?></h3>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="favorite short"><a href="<?= BASE_URL.'jobs/company/'.substr(md5($empresa->id), 0, 8) ?>" target="_blank" style="color:#fff !important;">Ver ofertas<i class="fa fa-arrow-right"></i></a></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page Titl!e-->
  <!-- Job Data -->
  <div class="container-fluid white-bg">
    <div class="row">
      <div class="container main-container-job">
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 sidebar">
          <div class="widget w1" style="text-align:left!important">
            <ul>
              <li>
                <img src="<?= BASE_URL.$empresa->logo ?>" class="avatar img-responsive" alt="">
              </li>
              <li>
                <?php if (!empty($categoria)): ?>
                  <p><b>Categoría:</b> <?= $categoria ?></p>
                <?php endif; ?>
              </li>
              <li>
                <?php if (!empty($empresa->tel)): ?>
                  <p><b>Teléfono:</b> <?= $empresa->tel ?></p>
                <?php endif; ?>
              </li>
              <li>
                <?php if (!empty($empresa->email_contact)): ?>
                  <p><b>Email:</b> <?= $empresa->email_contact ?></p>
                <?php endif; ?>
              </li>
              <li>
                <?php if (!empty($empresa->dir)): ?>
                  <p><b>Dirección:</b> <?= $empresa->dir ?></p>
                <?php endif; ?>
              </li>
              <li>
                <?php if (!empty($empresa->pais)): ?>
                  <p><b>País:</b> <?php if (!empty($empresa->pais)) { echo $this->modelPais->getPais($empresa->pais)[0]->nombre; } ?></p>
                <?php endif; ?>
              </li>
              <li>
                <?php if (!empty($empresa->depto)): ?>
                  <p><b>Depto:</b> <?php if (!empty($empresa->depto)) { echo $this->modelPais->getDepto($empresa->depto)[0]->nombre; } ?></p>
                <?php endif; ?>
              </li>
              <li>
                <?php if (!empty($empresa->ciudad)): ?>
                  <p><b>Ciudad:</b> <?php if (!empty($empresa->ciudad)) { echo $this->modelPais->getMunicipio($empresa->ciudad)[0]->nombre; } ?></p>
                <?php endif; ?>
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
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
          <div class="content">
            <h3 class="small-heading"><?= $empresa->nombre ?></h3>
            <p><?= $empresa->descripcion ?></p>
            <h3 class="small-heading">Acerca de</h3>
            <p><?= $empresa->about ?></p>
            <h3 class="small-heading">Mision</h3>
            <p><?= $empresa->mision ?></p>
            <h3 class="small-heading">Visión</h3>
            <p><?= $empresa->vision ?></p>
            <h3 class="small-heading">Valores:</h3>
            <ul>
              <?php foreach ($valores as $val): ?>
                <li><?= $this->modelValor->getValor($val->id)[0]->valor ?></li>
              <?php endforeach; ?>
            </ul>
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
</body>
</html>
