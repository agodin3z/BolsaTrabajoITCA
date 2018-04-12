<?php include 'templates/header.php'; ?>
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
					<h3 class="white-heading">Contáctanos</h3>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
					<h5>Salúdanos, escribe un mensaje o síguenos en las redes sociales.</h5>
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
					<form  name="contact_us" method="post" action="<?= BASE_URL ?>contact/sendMail">
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><label>Nombre:</label></div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12"><input type="text" name="name" data-validacion-tipo="requerido|min:4" required>
							<span class="err"></span></div>							
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><label>Email:</label></div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12"><input type="email" name="email" data-validacion-tipo="requerido|email" required/>
							<span class="err"></span></div>							
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><label>Mensaje:</label></div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12"><textarea rows="5" name="message" data-validacion-tipo="requerido|min:25" required></textarea>
							<span class="err"></span></div>							
						</div>
						<div class="form-group submit">
							<div class="col-lg-10 col-lg-push-2 col-md-10 col-md-push-2 col-sm-10 col-sm-push-2 col-xs-12">
								<input type="submit" name="submit" value="Enviar Mensaje"/>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- full width section forms -->
	<!-- full width section Map -->
	<div class="container-fluid white-bg">
		<div class="row">
			<div class="container main-container">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class='embed-container'>
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3871.738111565552!2d-89.57152508559884!3d13.974187895867079!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f62e8ed3ad17547%3A0xaa51d77dc02c89a3!2sITCA+FEPADE!5e0!3m2!1ses!2sus!4v1524095117064" width="1170" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- full width section Map-->
	<!-- full width section about us-->
	<div class="container-fluid white-bg about_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<h3>Información</h3>
					<p><strong>Regional Santa Ana</strong><br />
						Final 10a. Av. Sur, Finca Procavia,<br />
						Santa Ana
					</p>
					<ul class="contacts">
						<li><i class="fa fa-phone"></i>(503) 2440-4348</li>
						<li><i class="fa fa-phone"></i>(503) 2440-2007</li>
					</ul>
					<ul class="social">
						<li><a href="https://www.facebook.com/itca.fepade.santaana/"><i class="fa fa-facebook"></i></a></li>
					</ul>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<h3>Sobre nosotros</h3>
					<p>En La Escuela Especializada en Ingeniería ITCA-FEPADE estamos comprometidos con la calidad académica, la empresarialidad y la pertinencia de nuestra oferta educativa.</p>
				</div>
			</div>
		</div>
	</div>
	<!-- full width section about us-->
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
</body>
</html>
