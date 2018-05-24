<?php if (!isset($_SESSION["company"]) || (isset($oferta) && $oferta->idEmpresa != $_SESSION['company']->id)) {
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
				<?php if (isset($oferta)): ?>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<h3 class="white-heading">Editar Oferta</h3>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-6 colxs-12 capital">
						<h5>Edita una de tus ofertas de trabajo</h5>
					</div>
				<?php else: ?>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<h3 class="white-heading">Crear Oferta</h3>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-6 colxs-12 capital">
						<h5>Publica una nueva oferta de trabajo</h5>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!--header section -->
	<!-- full width section forms -->
	<div class="container-fluid white-bg contact_us">
		<form action="<?= BASE_URL ?>jobs/register" method="post" name="contact_us" id="form-user-info" enctype="multipart/form-data">
			<div class="row user-information">
				<div class="container main-container ">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Título:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<?php if (isset($oferta)): ?>
									<input id="id" type="hidden" name="id" value="<?= $oferta->id ?>">
								<?php endif; ?>
								<input id="titulo" type="text" name="titulo" placeholder="Título de la oferta" value="<?php if (isset($oferta)) echo $oferta->titulo ?>" data-validacion-tipo="requerido|max:110" maxlength="110" />
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Área de <br>la Empresa:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="text" name="area" placeholder="Área de la empresa" value="<?php if (isset($oferta)) echo $oferta->area ?>" data-validacion-tipo="max:75" maxlength="75" />
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Cargo:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="text" name="cargo" placeholder="Cargo" value="<?php if (isset($oferta)) echo $oferta->cargo ?>" data-validacion-tipo="max:75" maxlength="75"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Tipo de <br>Contrato:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<select name="contrato" class="form-control item-list asSelect2">
									<option value="">-- Selecciona una opción --</option>
									<?php foreach ($tipo as $t): ?>
										<option value="<?= $t->id ?>" <?php if (isset($oferta) && $oferta->contrato == $t->id) echo "selected" ?>><?= $t->nombre ?></option>
									<?php endforeach; ?>
								</select>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Tipo de <br>Jornada:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<select name="jornada" class="form-control item-list asSelect2">
									<option value="">-- Selecciona una opción --</option>
									<?php foreach ($jornada as $j): ?>
										<option value="<?= $j->id ?>" <?php if (isset($oferta) && $oferta->jornada == $j->id) echo "selected" ?>><?= $j->nombre ?></option>
									<?php endforeach; ?>
								</select>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Categoría:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<select name="categoria" class="form-control item-list asSelect2">
									<option value="">- Selecciona una opción -</option>
									<?php foreach ($categoria as $cat): ?>
										<option value="<?= $cat->id ?>" <?php if (isset($oferta) && $oferta->categoria == $cat->id) echo "selected" ?>><?= $cat->nombre ?></option>
									<?php endforeach; ?>
								</select>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Email de <br>Contacto:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="email" name="email" placeholder="Email de contacto" value="<?php if (isset($oferta)) echo $oferta->email ?>" data-validacion-tipo="max:75|email" maxlength="75"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Salario:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="text" name="salario" placeholder="Salario a devengar" value="<?php if (isset($oferta)) echo $oferta->salario ?>" data-validacion-tipo="max:75" maxlength="75"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Localización:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="text" name="localizacion" placeholder="Localización" value="<?php if (isset($oferta)) echo $oferta->localizacion ?>" data-validacion-tipo="max:75" maxlength="75"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Descripción:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<textarea id="descripcion" name="descripcion" class="textarea" placeholder="Descripción de la oferta" rows="5" data-validacion-tipo="requerido|max:5000" onkeyup="countDesc()" onkeydown="countDesc()" maxlength="5000"><?php
								if (isset($oferta)) echo $oferta->descripcion ?></textarea>
								<small id="cDescripcion" class="counter"></small>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Vacantes:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="number" name="vacantes" placeholder="Vacantes disponibles" value="<?php if (isset($oferta)) echo $oferta->vacantes ?>" min="1" max="99"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Educación Mínima:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="text" name="educacionMin" placeholder="Educación mínima requerida" value="<?php if (isset($oferta)) echo $oferta->educacionMin ?>" data-validacion-tipo="max:75" maxlength="75"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Edad:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="text" name="edad" placeholder="Edad mínima o rango de edad" value="<?php if (isset($oferta)) echo $oferta->edad ?>" data-validacion-tipo="max:75" maxlength="75"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Disponibilidad <br>de Viajar:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<select name="viajar" class="form-control item-list asSelect2">
									<option value="">- Selecciona una opción -</option>
									<option value="Si" <?php if (isset($oferta) && $oferta->viajar == "Si") echo "selected" ?>>Si</option>
									<option value="No" <?php if (isset($oferta) && $oferta->viajar == "No") echo "selected" ?>>No</option>
								</select>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Cambio de <br>Residencia:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<select name="residencia" class="form-control item-list asSelect2">
									<option value="">- Selecciona una opción -</option>
									<option value="Si" <?php if (isset($oferta) && $oferta->residencia == "Si") echo "selected" ?>>Si</option>
									<option value="No" <?php if (isset($oferta) && $oferta->residencia == "No") echo "selected" ?>>No</option>
								</select>
								<span class="err"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- User Data Row-->
	</div>
	<!-- full width section forms -->
	<!-- Blue Area -->
	<div class="container-fluid blue-banner preview_cv">
		<div class="row">
			<div class="container main-container">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center white-text">
					<input type="submit" class="btn btn-getstarted bg-red center-small" name="enviar" value="Guardar Cambios" style="margin-top:0">
					<!--<a href="#" class="btn btn-getstarted bg-red center-small">Guardar Cambios</a>-->
					<?php if (isset($oferta)): ?>
						<input type="button" class="btn btn-getstarted bg-red center-small" name="borrar" value="Borrar Oferta" style="margin-top:0"
						onclick="delOferta();">
					<?php endif; ?>
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
	function countDesc() {
		$("#cDescripcion").text((5000 - $("#descripcion").val().length) + " Caracteres Restantes"); //Detectamos los Caracteres del Input
	}
	</script>
	<script type="text/javascript">
	  function delOferta() {
			var id = $('#id').val();
	    swal({
	      title: '¿Está seguro?',
	      text: "Está a punto de borrar la Oferta: "+$('#titulo').val(),
	      type: 'warning',
	      showCancelButton: true,
	      confirmButtonColor: '#3085d6',
	      cancelButtonColor: '#d33',
	      confirmButtonText: 'Sí, borrarla!'
	    }).then((result) => {
	      if (result.value) {
					$.ajax({
			        url: "/jobs/delete/"+id,
			        type: "post",
			        success: function (response) {
								swal(
								 'Borrada!',
								 'La oferta laboral a sido borrada!.',
								 'success'
							 	);
								window.location.replace("/jobs");
			        },
			        error: function(jqXHR, textStatus, errorThrown) {
								swal(
								'Error!',
								'La oferta laboral NO fue borrada!.',
								'warning'
							 );
			        }
			    });
	      }
	    });
	  }
	</script>
</body>
</html>
