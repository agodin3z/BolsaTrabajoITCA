<?php if (!isset($_SESSION['candidate'])) {
header("Location: /candidate/login");
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
					<h5>Modifica/Completa tus datos personales y profesionales </h5>
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
		<form action="<?= BASE_URL ?>candidate/update_user" method="post" name="contact_us" id="form-user-info" enctype="multipart/form-data">
			<div class="row user-information">
				<div class="container main-container ">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Nombre:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input id="id" type="hidden" name="id" value="<?= $_SESSION['candidate']->id ?>">
								<input id="nombre" type="text" name="nombre" value="<?= $_SESSION['candidate']->nombre ?>" maxlength="75" data-validacion-tipo="requerido|max:75"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Apellidos:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="text" name="apellido" value="<?= $_SESSION['candidate']->apellido ?>" maxlength="125" data-validacion-tipo="requerido|max:125"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Email:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="email" name="email" value="<?= $_SESSION['candidate']->email ?>" maxlength="75" data-validacion-tipo="requerido|max:75|email"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>DUI:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="text" name="dui" placeholder="Documento Unico de Identidad" value="<?= $_SESSION['candidate']->dui ?>" maxlength="10" pattern="[0-9]{8}-[0-9]{1}" title="########-#" data-validacion-tipo="max:10"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Nacimiento:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="date" name="fechaNac" value="<?= date('Y-m-d', strtotime(str_replace('-', '/', $_SESSION['candidate']->fechaNac))); ?>"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Género:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<select name="sexo" class="form-control item-list asSelect2">
									<option value="">-- Selecciona una opción --</option>
									<option value="M" <?php if ($_SESSION['candidate']->sexo == "M") { echo "selected";} ?>>Masculino</option>
									<option value="F" <?php if ($_SESSION['candidate']->sexo == "F") { echo "selected";} ?>>Femenino</option>
								</select>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Estado Civil:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<select name="idEstado" class="form-control item-list asSelect2" required>
									<option value="">-- Selecciona una opción --</option>
									<?php foreach ($eCivil as $r): ?>
										<option value="<?= $r->id ?>" <?php if ($_SESSION['candidate']->idEstado == $r->id) { echo "selected";} ?>><?= $r->nombre ?></option>
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
								<input type="text" name="tel" placeholder="Telefono fijo o personal" value="<?= $_SESSION['candidate']->tel ?>" pattern="[2,7,6]+[0-9]{3}-[0-9]{4}" title="2###-#### ó 7###-####" maxlength="9" data-validacion-tipo="max:9"/>
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
										<option value="<?= $p->id ?>" <?php if ($_SESSION['candidate']->pais == $p->id) { echo "selected"; } ?>><?= $p->nombre ?></option>
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
									<?php if ($_SESSION['candidate']->pais == 'SV'): ?>
										<?php foreach ($this->modelPais->getDeptos(array('SV')) as $p): ?>
											<option value="<?= $p->id ?>" <?php if ($_SESSION['candidate']->depto == $p->id) { echo "selected";} ?>><?= $p->nombre ?></option>
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
									<?php if ($_SESSION['candidate']->pais == 'SV'): ?>
										<?php foreach ($this->modelPais->getMunicipios(array($_SESSION['candidate']->depto)) as $p): ?>
											<option value="<?= $p->id ?>" <?php if ($_SESSION['candidate']->ciudad == $p->id) { echo "selected";} ?>><?= $p->nombre ?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Código Postal:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="text" name="zip" placeholder="Código Postal" value="<?= $_SESSION['candidate']->zip ?>" maxlength="6" data-validacion-tipo="max:6"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Dirección:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<textarea id="dir" name="dir" class="textarea" placeholder="Dirección" rows="5" data-validacion-tipo="max:225" onkeyup="countDir()" onkeydown="countDir()" maxlength="225"><?=
								$_SESSION['candidate']->dir ?></textarea>
								<small id="cDir" class="counter"></small>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group file-type ">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label class="default">Fotografía:</label>
							</div>
							<div class="col-lg-8 col-md-8  col-sm-8 col-xs-12">
								<input type="file" name="foto" class="inputfile" id="select_file" placeholder="">
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
							<label>Perfil Profesional</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row user-information">
				<div class="container main-container">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Cargo o Título:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="text" name="titulo" placeholder="Cargo" value="<?php if (count((array)$perfil) > 1) { echo $perfil->titulo; } ?>" maxlength="75" data-validacion-tipo="max:75"/>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Descripción o<br>Perfil Profesional:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<textarea id="desc" name="descripcion" rows="5" class="textarea" placeholder="Perfil Profesional" onkeyup="countDesc()" onkeydown="countDesc()" maxlength="500" data-validacion-tipo="max:500"><?php if (count((array)$perfil) > 1) { echo $perfil->descripcion; } ?></textarea>
								<small id="cDesc" class="counter"></small>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Idiomas:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<select name="idioma[]" class="form-control item-list asSelect2" multiple="multiple">
									<?php if ((count((array)$idiomaPer) > 0)) { $idPer = $idiomaPer; $x = 0; }
									foreach ($idiomas as $i): ?>
										<option value="<?= $i->id ?>" <?php if (isset($idPer) && $i->id == $idPer[$x]->idIdioma && $_SESSION['candidate']->id == $idPer[0]->idPersona) { echo "selected";} ?>><?= $i->idioma ?></option>
									<?php if ($i->id == $idPer[$x]->idIdioma && $x < count((array)$idiomaPer)-1) { $x++; } endforeach; ?>
								</select>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Conocimientos <br>Informáticos:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<select name="programa[]" class="form-control item-list asSelect2Tag" multiple="multiple">
									<?php foreach ($programs as $prog): ?>
										<option value="<?= $prog->programa ?>" selected><?= $prog->programa ?></option>
									<?php endforeach; ?>
								</select>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
								<label>Habilidades <br>o Destrezas:</label>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<select name="habilidad[]" class="form-control item-list asSelect2Tag" multiple="multiple">
									<?php foreach ($skills as $sk): ?>
										<option value="<?= $sk->habilidad ?>" selected><?= $sk->habilidad ?></option>
									<?php endforeach; ?>
								</select>
								<span class="err"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Company Details-->
			<div class="container-fluid post-job grey-bg">
				<div class="row">
					<div class="container main-container">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label>Formación</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row user-information">
				<div class="container main-container">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<!-- Inicio -->
						<?php if (isset($estudios) && !empty($estudios)): ?>
							<?php foreach ($estudios as $e): ?>
								<div id="new_Edu">
									<div class="form-group">
										<input type="hidden" name="idEst" value="<?= $e->id ?>">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="default">Institucion:</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
											<input type="text" name="institucion[]" placeholder="Centro Educativo" value="<?= $e->institucion ?>" maxlength="75" data-validacion-tipo="max:75"/>
											<span class="err"></span>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="default">Nivel de <br>Estudios:</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
											<input type="text" name="nivel[]" placeholder="Estudios superiores, Educación básica, etc" value="<?= $e->nivel ?>" maxlength="30" data-validacion-tipo="max:30"/>
											<span class="err"></span>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="default">Notas:</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
											<textarea class="textarea" placeholder="Alguna nota sobre ese periodo" name="nota[]" rows="5" maxlength="240" data-validacion-tipo="max:240"><?= $e->notas ?></textarea>
											<span class="err"></span>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="default">Inicio:</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
											<input type="date" name="iniEst[]" placeholder="Periodo" value="<?= date('Y-m-d', strtotime(str_replace('-', '/', $e->inicio))); ?>" data-validacion-tipo="fecha:inicio">
											<span class="err"></span>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="default">Fin:</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
											<input type="date" name="finEst[]" placeholder="Periodo" value="<?= date('Y-m-d', strtotime(str_replace('-', '/', $e->fin))); ?>" data-validacion-tipo="fecha:fin">
											<span class="err"></span>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<div id="new_Edu">
								<div class="form-group">
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<label class="default">Institucion:</label>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
										<input type="text" name="institucion[]" placeholder="Centro Educativo" value="" maxlength="75" data-validacion-tipo="max:75"/>
										<span class="err"></span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<label class="default">Nivel de <br>Estudios:</label>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
										<input type="text" name="nivel[]" placeholder="Estudios superiores, Educación básica, etc" value="" maxlength="30" data-validacion-tipo="max:30"/>
										<span class="err"></span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<label class="default">Notas:</label>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
										<textarea class="textarea" placeholder="Alguna nota sobre ese periodo" name="nota[]" rows="5" maxlength="240" data-validacion-tipo="max:240"></textarea>
										<span class="err"></span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<label class="default">Inicio:</label>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
										<input type="date" name="iniEst[]" placeholder="Periodo" value="" data-validacion-tipo="fecha:inicio">
										<span class="err"></span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<label class="default">Fin:</label>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
										<input type="date" name="finEst[]" placeholder="Periodo" value="" data-validacion-tipo="fecha:fin">
										<span class="err"></span>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<!-- Fin -->
						<div id="btnEdu" class="form-group">
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 pull-right">
								<a id="Add_Edu"><i class='fa fa-plus' style='vertical-align:super;'></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid post-job grey-bg">
				<div class="row">
					<div class="container main-container">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label>Experiencia Laboral</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row user-information">
				<div class="container main-container">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<!-- Inicio -->
						<?php if (isset($experiencia) && !empty($experiencia)): ?>
							<?php foreach ($experiencia as $e): ?>
								<div id="new_Exp">
									<div class="form-group">
										<input type="hidden" name="idExp" value="<?= $e->id ?>">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="default">Empresa:</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
											<input type="text" name="empresa[]" placeholder="Nombre de la Empresa" value="<?= $e->empresa ?>" maxlength="75" data-validacion-tipo="max:75">
											<span class="err"></span>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="default">Cargo:</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
											<input type="text" name="cargo[]" placeholder="Cargo" value="<?= $e->cargo ?>" maxlength="75" data-validacion-tipo="max:75">
											<span class="err"></span>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="default">Inicio:</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
											<input type="date" name="iniExp[]" placeholder="Periodo" value="<?= date('Y-m-d', strtotime(str_replace('-', '/', $e->inicio))); ?>" data-validacion-tipo="fecha:inicio">
											<span class="err"></span>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="default">Fin:</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
											<input type="date" name="finExp[]" placeholder="Periodo" value="<?= date('Y-m-d', strtotime(str_replace('-', '/', $e->fin))); ?>" data-validacion-tipo="fecha:fin">
											<span class="err"></span>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
											<label class="default">Funciones <br>y logros:</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
											<textarea class="textarea" name="funciones[]" placeholder="Funciones y logros del cargo" rows="5" maxlength="240" data-validacion-tipo="max:240"><?= $e->funciones ?></textarea>
											<span class="err"></span>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<div id="new_Exp">
								<div class="form-group">
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<label class="default">Empresa:</label>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
										<input type="text" name="empresa[]" placeholder="Nombre de la Empresa" maxlength="75" data-validacion-tipo="max:75">
										<span class="err"></span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<label class="default">Cargo:</label>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
										<input type="text" name="cargo[]" placeholder="Cargo" maxlength="75" data-validacion-tipo="max:75">
										<span class="err"></span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<label class="default">Inicio:</label>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
										<input type="date" name="iniExp[]" placeholder="Periodo" data-validacion-tipo="fecha:inicio">
										<span class="err"></span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<label class="default">Fin:</label>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
										<input type="date" name="finExp[]" placeholder="Periodo" data-validacion-tipo="fecha:fin">
										<span class="err"></span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<label class="default">Funciones <br>y logros:</label>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
										<textarea class="textarea" name="funciones[]" placeholder="Funciones y logros del cargo" rows="5" maxlength="240" data-validacion-tipo="max:240"></textarea>
										<span class="err"></span>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<!-- Fin -->
						<div id="btnExp" class="form-group">
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 pull-right">
								<a id="Add_Exp"><i class='fa fa-plus' style='vertical-align:super;'></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid post-job grey-bg">
				<div class="row">
					<div class="container main-container">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label style="width:250px;">Preferecias de Trabajo</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row user-information">
				<div class="container main-container">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div>
							<div class="form-group">
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
									<label class="default">Situación  <br>Actual:</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
									<input type="text" name="situacion" placeholder="Situación Actual" maxlength="75" data-validacion-tipo="max:75" value="<?php if (count((array)$prefencias) > 1) { echo $prefencias->situacion; } ?>"/>
									<span class="err"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
									<label class="default">Cargo <br>deseado:</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
									<input type="text" name="puesto" placeholder="Cargo deseado" maxlength="75" data-validacion-tipo="max:75" value="<?php if (count((array)$prefencias) > 1) { echo $prefencias->cargo; } ?>"/>
									<span class="err"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
									<label class="default">Área de trabajo <br>deseado:</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
									<input type="text" name="area" placeholder="Área de trabajo deseado" maxlength="25" data-validacion-tipo="max:25" value="<?php if (count((array)$prefencias) > 1) { echo $prefencias->area; } ?>"/>
									<span class="err"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
									<label class="default">Salario Mínimo <br>deseado:</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
									<input type="number" name="salarioMin" step="any" min="1" placeholder="Salario Mínimo" max="9999999.99" data-validacion-tipo="max:10" value="<?php if (count((array)$prefencias) > 1) { echo $prefencias->salarioMin; } ?>"/>
									<span class="err"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
									<label class="default">Departamento:</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
									<input type="text" name="deptoP" placeholder="Departamento" maxlength="35" data-validacion-tipo="max:35" value="<?php if (count((array)$prefencias) > 1) { echo $prefencias->depto; } ?>"/>
									<span class="err"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid post-job grey-bg">
				<div class="row">
					<div class="container main-container">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label>Curriculum Vitae</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row company-details">
				<div class="container main-container">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div>
							<div class="form-group file-type ">
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
									<label class="default">Subir CV:</label>
								</div>
								<div class="col-lg-8 col-md-8  col-sm-8 col-xs-12">
									<input type="file" name="curriculum" class="inputfile" id="select_file" placeholder=""/>
									<!--<span class="err"></span>-->
									<div class="upload resume">
										<div class="filename"><i class="fa fa-file-image-o" aria-hidden="true"></i>Buscar doc</div>
										<i> Tamaño Máx.: 5 MB.</i>
									</div>
								</div>
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
					onclick="delCandidato();">
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
						if (!$(this).validate()) {
							Swal('Oops...', 'Algunos datos son erróneos!', 'error')
						};
						return $(this).validate();
					})
	    })
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
		  $('#Add_Edu').click(function() {
		    $("#new_Edu:last").clone()
											.find("input").val("").end()
											.find("textarea").val("").end()
											.insertBefore("#btnEdu");
		  });

			$('#Add_Exp').click(function() {
		    $("#new_Exp:last").clone()
											.find("input").val("").end()
											.find("textarea").val("").end()
											.insertBefore("#btnExp");
		  });
		});
	</script>
	<script type="text/javascript">
	function countDir() {
		$("#cDir").text((225 - $("#dir").val().length) + " Caracteres Restantes"); //Detectamos los Caracteres del Input
	}
	function countDesc() {
		$("#cDesc").text((500 - $("#desc").val().length) + " Caracteres Restantes");
	}
	</script>
	<script type="text/javascript" src="<?= JS_URL ?>localizacion.js"></script>
	<script type="text/javascript" src="<?= JS_URL ?>delete.js"></script>
</body>
</html>
