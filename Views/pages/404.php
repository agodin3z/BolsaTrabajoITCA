<?php include 'templates/header.php'; ?>
<body class="title-image">
  <div id="header" class="container-fluid pages">
    <div class="row">
      <!-- Header Image Or May be Slider-->
      <div class="top_header">
        <?php include 'templates/menu.php'; ?>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="error-404-area section pt-120 pb-120">
        <div class="container">
          <div class="row">
            <div class="wrapper-404 text-center col-xs-12">
              <img src="<?= IMG_URL ?>404.png" alt="" style="margin-top:120px;margin-bottom:25px;">
              <h1>404</h1>
              <h2>Page Not Found</h2>
              <br><br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'templates/footer.php'; ?>
  <?php include 'templates/scripts.php'; ?>
</body>
</html>
