<?php if (!isset($_SESSION["company"])) {
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
				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<h3 class="white-heading">Configuración</h3>
				</div>
				<div class="col-lg-9 col-md-8 col-sm-6 colxs-12 capital">
					<h5>Modifica/Completa tus datos de empresa </h5>
				</div>
			</div>
		</div>
	</div>
	<!--header section -->
	<div class="container-fluid post-job grey-bg">
		<div class="row">
			<div class="container main-container">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<label>Datos de la cuenta</label>
				</div>
			</div>
		</div>
	</div>
	<!-- full width section forms -->
	<div class="container-fluid white-bg contact_us">
		<form action="<?= BASE_URL ?>company/update_user" method="post" name="contact_us" id="form-user-info" enctype="multipart/form-data">
			<div class="row user-information">
				<div class="container main-container ">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Nombre:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input id="id" type="hidden" name="idC" value="<?= $_SESSION['company']->id ?>">
								<input id="nombre" type="text" name="nombre" value="<?= $_SESSION['company']->nombre ?>" maxlength="75" data-validacion-tipo="requerido|max:75"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Email: <br>(Privado)</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="email" name="email" value="<?= $_SESSION['company']->email ?>" maxlength="75" data-validacion-tipo="requerido|max:75|email"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Email Contacto: <br>(Público)</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="email" name="email_contact" value="<?= $_SESSION['company']->email_contact ?>" maxlength="75" data-validacion-tipo="requerido|max:75|email"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Categoría:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<select name="categoria" class="form-control item-list asSelect2" required>
									<option value="">-- Selecciona una opción --</option>
									<?php foreach ($categorias as $cat): ?>
										<option value="<?= $cat->id ?>" <?php if ($_SESSION['company']->categoria == $cat->id) { echo "selected";} ?>><?= $cat->nombre ?></option>
									<?php endforeach; ?>
								</select>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Teléfono:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="text" name="tel" placeholder="Telefono fijo o móvil" value="<?= $_SESSION['company']->tel ?>" maxlength="9" pattern="[2,7,6]+[0-9]{3}-[0-9]{4}" title="2###-#### ó 7###-####" data-validacion-tipo="max:9"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>País:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<select id="pais" name="pais" class="form-control item-list asSelect2">
									<option value="">-- Selecciona una opción --</option>
									<?php foreach ($paises as $p): ?>
										<option value="<?= $p->id ?>" <?php if ($_SESSION['company']->pais == $p->id) { echo "selected";} ?>><?= $p->nombre ?></option>
									<?php endforeach; ?>
								</select>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Departamento:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<select id="depto" name="depto" class="form-control item-list asSelect2">
									<option value="">- Selecciona una opción -</option>
									<?php if ($_SESSION['company']->pais == 'SV'): ?>
										<?php foreach ($this->modelPais->getDeptos(array('SV')) as $p): ?>
											<option value="<?= $p->id ?>" <?php if ($_SESSION['company']->depto == $p->id) { echo "selected";} ?>><?= $p->nombre ?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Ciudad:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<select id="ciudad" name="ciudad" class="form-control item-list asSelect2">
									<option value="">- Selecciona una opción -</option>
									<?php if ($_SESSION['company']->pais == 'SV'): ?>
										<?php foreach ($this->modelPais->getMunicipios(array($_SESSION['company']->depto)) as $p): ?>
											<option value="<?= $p->id ?>" <?php if ($_SESSION['company']->ciudad == $p->id) { echo "selected";} ?>><?= $p->nombre ?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Dirección:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<textarea id="dir" name="dir" class="textarea" placeholder="Dirección" rows="3" data-validacion-tipo="max:225" onkeyup="countDir()" onkeydown="countDir()" maxlength="225"><?=
								$_SESSION['company']->dir ?></textarea>
								<small id="cDir" class="counter"></small>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Descripción:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<textarea id="desc" name="descripcion" class="textarea" placeholder="Descripción" rows="4" data-validacion-tipo="max:500" onkeyup="countDesc()" onkeydown="countDesc()" maxlength="500"><?=
								$_SESSION['company']->descripcion ?></textarea>
								<small id="cDesc" class="counter"></small>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Acerca de:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<textarea id="about" name="about" class="textarea" placeholder="Acerca de" rows="5" data-validacion-tipo="max:700" onkeyup="countAbout()" onkeydown="countAbout()" maxlength="700"><?=
								$_SESSION['company']->about ?></textarea>
								<small id="cAbout" class="counter"></small>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Mision:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<textarea id="mision" name="mision" class="textarea" placeholder="Mision" rows="5" data-validacion-tipo="max:500" onkeyup="countMision()" onkeydown="countMision()" maxlength="500"><?=
								$_SESSION['company']->mision ?></textarea>
								<small id="cMision" class="counter"></small>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Vision:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<textarea id="vision" name="vision" class="textarea" placeholder="Vision" rows="5" data-validacion-tipo="max:500" onkeyup="countVision()" onkeydown="countVision()" maxlength="500"><?=
								$_SESSION['company']->vision ?></textarea>
								<small id="cVision" class="counter"></small>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Valores:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<select name="valor[]" class="form-control item-list asSelect2Tag" multiple="multiple">
									<?php foreach ($valores as $val): ?>
										<option value="<?= $val->valor ?>" selected><?= $val->valor ?></option>
									<?php endforeach; ?>
								</select>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group file-type ">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label class="default">Logo:</label>
							</div>
							<div class="col-lg-8 col-md-8  col-sm-8 col-xs-12">
								<input type="file" name="logo" class="inputfile" id="select_file" placeholder="">
								<!--<span class="err"></span>-->
								<div class="upload resume">
									<div class="filename"><i class="fa fa-file-image-o" aria-hidden="true"></i>Buscar imagen</div>
									<i> Tamaño Mín.: 250x250 px</i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- User Data Row-->
			<div class="container-fluid post-job grey-bg">
				<div class="row">
					<div class="container main-container">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label style="min-width:250px;">Redes Sociales / Websites</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row user-information">
				<div class="container main-container">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<!-- Inicio -->
						<?php if (isset($links) && !empty($links)): ?>
							<?php foreach ($links as $link): ?>
								<div id="new_Link">
									<div class="form-group">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="default">Tipo:</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
											<input type="hidden" name="id" value="<?= $link->id ?>">
											<div class="input-group" style="width:100%;display:flex;">
												<select name="idLink[]" class="form-control item-list" style="max-width:250px">
													<option value="">-- Selecciona una opción --</option>
													<?php foreach ($tipos as $tipo): ?>
														<option value="<?= $tipo->id ?>" <?php if ($link->idLink == $tipo->id) { echo "selected"; } ?>><?= $tipo->nombre ?></option>
													<?php endforeach; ?>
												</select>
												<span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
												<input type="text" name="url[]" placeholder="https://misitio.com/usuario" value="<?= $link->url ?>" maxlength="200" data-validacion-tipo="max:200|url" style="border-radius: 0px 8px 8px 0px;"/>
											</div>
											<span class="err"></span>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<div id="new_Link">
								<div class="form-group">
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<label class="default">Tipo:</label>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
										<div class="input-group" style="width:100%;display:flex;">
											<select name="idLink[]" class="form-control item-list" style="max-width:250px">
												<option value="">-- Selecciona una opción --</option>
												<?php foreach ($tipos as $tipo): ?>
													<option value="<?= $tipo->id ?>"><?= $tipo->nombre ?></option>
												<?php endforeach; ?>
											</select>
											<span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
											<input type="text" name="url[]" placeholder="https://misitio.com/usuario" value="" maxlength="200" data-validacion-tipo="max:200|url" style="border-radius: 0px 8px 8px 0px;"/>
										</div>
										<span class="err"></span>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<!-- Fin -->
						<div id="copyBtn" class="form-group">
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 pull-right">
								<a id="Add_Link"><i class='fa fa-plus' style='vertical-align:super;'></i></a>
							</div>
						</div>

					</div>
				</div>
			</div>
	</div>
	<!-- full width section forms -->
	<!-- Blue Area -->
	<div class="container-fluid blue-banner preview_cv">
		<div class="row">
			<div class="container main-container">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center white-text">
					<input type="submit" class="btn btn-getstarted bg-red center-small" name="enviar" value="Guardar Cambios" style="margin-top:0">
					<!--<a href="#" class="btn btn-getstarted bg-red center-small">Guardar Cambios</a>-->
					<input type="button" class="btn btn-getstarted bg-red center-small" name="borrar" value="Borrar Cuenta" style="margin-top:0"
					onclick="delCompany();">
				</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Blue Area -->
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
		$(document).ready(function() {
		  $('#Add_Link').click(function() {
		    $("#new_Link").last().clone()
											.find("input").val("").end()
											.find("select").val("").end()
											.insertBefore("#copyBtn");
		  });
		});
	</script>
	<script type="text/javascript">
	function countDir() {
		$("#cDir").text((225 - $("#dir").val().length) + " Caracteres Restantes");
	}
	function countDesc() {
		$("#cDesc").text((500 - $("#desc").val().length) + " Caracteres Restantes");
	}
	function countAbout() {
		$("#cAbout").text((700 - $("#about").val().length) + " Caracteres Restantes");
	}
	function countMision() {
		$("#cMision").text((500 - $("#mision").val().length) + " Caracteres Restantes");
	}
	function countVision() {
		$("#cVision").text((500 - $("#vision").val().length) + " Caracteres Restantes");
	}
	</script>
	<script type="text/javascript" src="<?= JS_URL ?>localizacion.js"></script>
	<script type="text/javascript" src="<?= JS_URL ?>delete.js"></script>
</body>
</html>
