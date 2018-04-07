<nav class="navbar navbar-fixed-top">
  <div class="container">
    <div class="logo">
      <a href="<?= BASE_URL ?>"><img src="<?= IMG_URL ?>logo2.png" alt="Photo" /> </a>
    </div>
    <div class="logins">
      <?php if (!isset($_SESSION['candidate']) && !isset($_SESSION['company'])): ?>
        <a href="<?= BASE_URL ?>company/login" class="post_job"><span class="label job-type partytime">EMPRESA</span></a>
        <a href="<?= BASE_URL ?>candidate/login" class="post_job"><span class="label job-type partytime">CANDIDATO</span></a>
      <?php elseif (isset($_SESSION['company'])): ?>
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <?php if (empty($_SESSION['company']->logo)): ?>
              <a href="" class="login dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user"></i>
              </a>
            <?php else: ?>
              <a href="" class="login dropdown-toggle no-padding" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:0!important;">
                <img src="<?= BASE_URL.$_SESSION['company']->logo ?>" alt="" style="max-width:45px;max-height:45px;border-radius:50%;"/>
              </a>
            <?php endif; ?>
            <ul class="dropdown-menu" style="width:160px;right:0;left:unset;">
              <li><a href="<?= BASE_URL ?>company/">Mi Perfil</a></li>
              <li><a href="<?= BASE_URL ?>review/admin">Crear Review</a></li>
              <li><a href="<?= BASE_URL ?>jobs/create">Crear Oferta</a></li>
              <li><a href="<?= BASE_URL.'jobs/company/'.substr(md5($_SESSION['company']->id), 0,8) ?>">Mis Ofertas</a></li>
              <li><a href="<?= BASE_URL ?>company/settings">Configuración</a></li>
              <li><a href="<?= BASE_URL ?>company/change_passwd">Cambiar Clave</a></li>
              <li><a href="<?= BASE_URL ?>company/logout">Cerrar Sesión</a></li>
            </ul>
          </li>
        </ul>
      <?php else: ?>
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <?php if (empty($_SESSION['candidate']->foto)): ?>
            <a href="" class="login dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user"></i>
            </a>
          <?php else: ?>
            <a href="" class="login dropdown-toggle no-padding" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:0!important;">
              <img src="<?= BASE_URL.$_SESSION['candidate']->foto ?>" alt="" style="max-width:45px;max-height:45px;border-radius:50%;"/>
            </a>
          <?php endif; ?>
          <ul class="dropdown-menu" style="width:160px;right:0;left:unset;">
            <li><a href="<?= BASE_URL ?>candidate/">Mi Perfil</a></li>
            <li><a href="<?= BASE_URL ?>candidate/settings">Configuración</a></li>
            <li><a href="<?= BASE_URL ?>candidate/change_passwd">Cambiar Clave</a></li>
            <li><a href="<?= BASE_URL ?>candidate/logout">Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
      <?php endif; ?>
    </div>
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?= BASE_URL ?>">Inicio</a></li>
        <li><a href="<?= BASE_URL ?>jobs">Ofertas</a></li>
        <li><a href="<?= BASE_URL ?>company/list">Empresas</a></li>
        <?php if (isset($_SESSION['company'])): ?>
        <li><a href="<?= BASE_URL ?>candidate/list">Candidatos</a></li>
        <?php endif; ?>
        <li><a href="<?= BASE_URL ?>contact">Contáctanos</a></li>
        <li><a href="<?= BASE_URL ?>about">Acerca de</a></li>
        <?php if (!isset($_SESSION['candidate']) && !isset($_SESSION['company'])): ?>
        <li class="mobile-menu"><a href="<?= BASE_URL ?>company/login">EMPRESA</a></li>
        <li class="mobile-menu"><a href="<?= BASE_URL ?>candidate/login">CANDIDATO</a></li>
        <?php elseif (isset($_SESSION['company'])): ?>
          <li class="mobile-menu"><a href="<?= BASE_URL ?>company/">Mi Perfil</a></li>
          <li class="mobile-menu"><a href="<?= BASE_URL ?>review/admin">Crear Review</a></li>
          <li class="mobile-menu"><a href="<?= BASE_URL ?>jobs/create">Crear Oferta</a></li>
          <li class="mobile-menu"><a href="<?= BASE_URL.'jobs/company/'.substr(md5($_SESSION['company']->id), 0,8) ?>">Mis Ofertas</a></li>
          <li class="mobile-menu"><a href="<?= BASE_URL ?>company/settings">Configuración</a></li>
          <li class="mobile-menu"><a href="<?= BASE_URL ?>company/change_passwd">Cambiar Clave</a></li>
          <li class="mobile-menu"><a href="<?= BASE_URL ?>company/logout">Cerrar Sesión</a></li>
        <?php else: ?>
        <li class="mobile-menu"><a href="<?= BASE_URL ?>candidate/">Mi Perfil</a></li>
        <li class="mobile-menu"><a href="<?= BASE_URL ?>candidate/settings">Configuración</a></li>
        <li class="mobile-menu"><a href="<?= BASE_URL ?>candidate/change_passwd">Cambiar Clave</a></li>
        <li class="mobile-menu"><a href="<?= BASE_URL ?>candidate/logout">Cerrar Sesión</a></li>
        <?php endif; ?>
      </ul>
      </div><!-- navbar-collapse -->
    </div>
    <!-- container-fluid -->
  </nav>
