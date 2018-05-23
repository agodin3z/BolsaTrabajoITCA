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
	<div class="container-fluid blue-banner page-title bg-image">
		<div class="row section-title">
			<div class="container main-container">
				<div class="col-lg-8 col-md-8 col-sm-8">
					<h3 class="white-heading">Ofertas de Trabajo</h3>
				</div>
			</div>
		</div>
	</div>
	<!-- Page Title-->
	<!-- Job Categories Filters -->
	<div class="jobs_filters">
		<div class="container">
			<form class="" action="<?= BASE_URL ?>jobs/search/" method="get">

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 filter_width bgicon">
					<div class="form-group">
						<select class="" name="cat">
							<option value="">-- Seleccione una opción --</option>
							<?php foreach ($this->model->getCategorias() as $p): ?>
								<option value="<?= $p->categoria ?>"><?= $p->catOferta ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<span>ej. Ventas</span>
				</div>

				<div class="col-lg-5 col-md-4 col-sm-6 col-xs-12 filter_width bgicon">
					<div class="form-group">
						<input type="text" class="form-control" name="key" placeholder="Cargo o palabra clave">
						<span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
					</div>
					<span>ej. Diseñador</span>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 filter_width bgicon location">
					<div class="form-group">
						<input type="text" class="form-control" name="loc" placeholder="Localización">
						<span class="glyphicon fa fa-location-arrow" aria-hidden="true"></span>
					</div>
					<span>ej. Santa Ana</span>
				</div>
				<div class="col-lg-1 col-md-2 col-sm-6 col-xs-12 filter_width bgicon submit">
					<div class="form-group">
						<input type="submit" class="customsubmit" value="Search">
						<span class="glyphicon fa fa-search" aria-hidden="true"></span>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Job Categories Filters -->
	<!-- Job Results -->
	<div class="container main-container">
		<div class="jobs-result">
			<div class="col-lg-12">
				<h3 class="recom">Ofertas Laborales <?php if (isset($empresa)) echo "de $empresa"; ?></h3>
				<h4>
					<?php if (isset($_GET['cat']) && !empty($_GET['cat'])): ?>
						<b>Categoría:</b> <?= $this->modelCat->getCategoria($_GET['cat'])->nombre ?> &nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if (isset($_GET['key']) && !empty($_GET['key'])): ?>
						<b>Frase:</b> <?= $_GET['key'] ?> &nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if (isset($_GET['loc']) && !empty($_GET['loc'])): ?>
						<b>Localización:</b> <?= $_GET['loc'] ?> &nbsp;&nbsp;&nbsp;
					<?php endif; ?>
				</h4>
			</div>
			<!--Search Result 01-->
			<div class="col-lg-12">
				<!--jobs result-->
				<?php if (count($lista) > 0): ?>
					<?php foreach($lista as $r):
	          /*$pais = $this->modelPais->getPais($r->pais);*/ ?>
					<div class="filter-result 01">
						<div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 pull-left">
							<div class="company-left-info pull-left">
								<img src="<?= BASE_URL.$r->logo ?>" alt=""/>
							</div>
							<div class="box-result job">
								<a href="<?= BASE_URL ?>jobs/offert/<?= substr(md5($r->id), 0, 8) ?>"><h3><?= $r->titulo ?></h3></a>
								<h4><?= $r->empresa."<br>".$r->catOferta." - ".$r->area ?></h4>
								<h4><?= substr($r->descripcion, 0, 128)."..." ?></h4>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-5 col-xs-12 pull-right">
							<div class="pull-right location">
								<p><?= $r->localizacion ?></p>
							</div>
							<div class="data-job">
								<h3><?= $r->salario ?></h3>
								<span class="label job-type job-<?= $r->contrato ?> "><?= $r->tipoContrato ?></span>
								<?php if (isset($_SESSION['company']) && $_SESSION['company']->id == $r->idEmpresa): ?>
			          <span class="label job-type" style="background:#009688;">
									<a href="<?= BASE_URL ?>jobs/edit/<?= substr(md5($r->id), 0, 8) ?>" style="color:#fff">Editar <i class="fa fa-pencil"></i></a>
								</span>
			          <?php endif; ?>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="col-xs-12">
						<div class="filter-result 01">
							<div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 pull-left">
								<div class="box-result job">
									<h3>Sin resultados</h3>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<!--jobs result-->

				<div class="clearfix"></div>
				<!--<div class="col-lg-12">
					<button class="btn btn-default dropdown-toggle" type="button" id="load_more" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Más Candidatos <span class="glyphicon glyphicon-menu-down"></span>
					</button>
				</div>-->
			</div>
			<!--Search Result 01-->
		</div>
	</div>
	<!-- Job Results -->
	<!--Blue Secions -->
	<div class="container-fluid green-banner">
		<div class="row">
			<div class="container main-container v-middle" id="style-2">
				<div class="col-lg-10 col-md-8 col-sm-8 col-xs-12  ">
					<h3 class="white-heading">¿Tienes alguna pregunta?<span class="call-us"><strong>envíanos un email o llámanos</strong></span></h3>
				</div>
				<div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
					<a href="<?= BASE_URL ?>candidate/login" class="btn btn-getstarted bg-red">comienza ahora</a>
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
