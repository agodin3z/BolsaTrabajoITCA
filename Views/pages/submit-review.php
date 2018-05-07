<?php if (!isset($_SESSION['company'])) {
	header("Location: /company/login");
}
include 'templates/header.php'; ?>
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
	<!--header section -->
	<div class="container-fluid page-title">
		<div class="row blue-banner">
			<div class="container main-container">
				<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
					<h3 class="white-heading">Review</h3>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
					<h5>Escribe algo sobre nosotros.</h5>
				</div>
			</div>
		</div>
	</div>
	<!--header section -->
	<!-- full width section forms -->
	<div class="container-fluid  contact_us">
		<div class="row">
			<div class="container main-container" id="form-user-info">
				<div class="col-lg-9 col-lg-push-1">
					<form  name="contact_us" method="post" action="<?= BASE_URL ?>review/register">
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><label>Nombre:</label></div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12"><input type="text" value="<?= $_SESSION['company']->nombre ?>" readonly></div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><label>Puntaje:</label></div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
		              <?php for ($i=1; $i <= 5; $i++) {	?>
										<label class="btn btn-warning <?= ($review[0]->rating == $i) ? 'active' : ''; ?>">
			                <input type="radio" name="rating" value="<?= $i ?>" required> <?= $i ?>
			              </label>
									<?php } ?>
		            </div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><label>Mensaje:</label></div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12"><textarea id="rev" rows="5" name="testimonio" placeholder="Escribe algo sobre nosotros." maxlength="280" data-validacion-tipo="max:280" onkeyup="countDesc()" onkeydown="countDesc()"><?php
							if (!empty($review)) {
								echo $review[0]->testimonio;
							} ?></textarea>
							<small id="cRev" class="counter"></small>
							<small style="font-size:10px;color:#666">* Para eliminar el review, envíe un mensaje vacío.</small>
							</div>
						</div>
						<div class="form-group submit">
							<div class="col-lg-10 col-lg-push-2 col-md-10 col-md-push-2 col-sm-10 col-sm-push-2 col-xs-12">
								<input type="submit" name="submit"  value="Enviar Review"/>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- full width section forms -->
	<?php include 'templates/footer.php'; ?>
	<?php include 'templates/scripts.php'; ?>
	<?php include 'templates/loader.php'; ?>
	<?php include 'templates/error.php'; ?>
	<script>
	    $(document).ready(function(){
	        $("#form-user-info").submit(function(){
	            return $(this).validate();
	        });
	    })
	</script>
	<script type="text/javascript">
		function countDesc() {
			$("#cRev").text((280 - $("#rev").val().length) + " Caracteres Restantes");
		}
	</script>
</body>
</html>
