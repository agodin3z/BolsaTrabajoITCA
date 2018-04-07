<?php include 'templates/header.php'; ?>
<body class="title-image">
  <div id="header" class="container-fluid pages">
    <div class="row">
      <!-- Header Image Or May be Slider-->
      <div class="top_header">
        <nav class="navbar navbar-fixed-top">
          <div class="container" style="display:flex;align-items: center;justify-content: center;">
            <div class="logo">
              <a href="<?= BASE_URL ?>"><img src="<?= IMG_URL ?>logo2.png" alt="Photo" style="filter:grayscale();" /> </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="error-404-area section pt-120 pb-120">
        <div class="container">
          <div class="row">
            <div class="wrapper-404 text-center col-xs-12">
              <img src="<?= IMG_URL ?>500.png" alt="" style="margin-top:50px;margin-bottom:0px;">
              <h1>500</h1>
              <h2>Internal Server Error</h2>
              <br><br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'templates/scripts.php'; ?>
</body>
</html>
