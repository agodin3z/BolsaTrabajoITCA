<?php include 'templates/header.php'; ?>
<body>
	<div id="loadessr"><div id="loader"></div></div>
	<!-- Header Image Or May be Slider-->
	<div id="header" class="container-fluid home">
		<div class="row">
			<div class="header_banner">
				<div class="slides">
					<div class="slider_items parallax-window" data-parallax="scroll" data-image-src="<?= IMG_URL ?>headerimage1.jpg"></div>
				</div>
			</div>
			<!-- Header Image Or May be Slider-->
			<div class="top_header">
				<?php include 'templates/menu.php'; ?>
				<div class="container slogan">
					<div class="col-lg-12">
						<h1 class="animated fadeInDown">¿En busca de un trabajo?</h1>
						<h3 class="text-center"><span>Únete a nosotros</span> y explora miles de trabajos.</h3>
						<a href="<?= BASE_URL ?>jobs">Tenemos <span><?= $total->total ?></span> ofertas de trabajo para tí!</a>
					</div>
				</div>
			</div>
			<div class="jobs_filters">
				<div class="container">
					<form class="" action="<?= BASE_URL ?>jobs/search/" method="get">

						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 filter_width bgicon">
							<div class="form-group">
								<select class="" name="cat">
									<option value="">-- Seleccione una opción --</option>
									<?php foreach ($this->modelJob->getCategorias() as $p): ?>
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
		</div>
	</div>
	<!-- Header Section -->
	<!--maine container Section -->
	<div class="container main-container-home">
		<div class="jobs_results">
			<!--Filters Category -->
			<div class="tab_filters">
				<div class="col-lg-12">
					<h5 style="border:none;">Trabajos Recientes</h5>
				</div>
			</div>
			<!-- Filters Category -->
			<div class="jobs-result">
				<!--Search Result 01-->
				<div class="col-lg-12">
					<?php if (!empty($ofertas)): ?>
						<?php foreach ($ofertas as $o): ?>
							<a href="<?= BASE_URL ?>jobs/offert/<?= substr(md5($o->id), 0, 8) ?>">
								<div class="filter-result 01">
									<div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 pull-left">
										<div class="company-left-info pull-left">
											<img src="<?= BASE_URL.$o->logo ?>" alt=""/>
										</div>
										<div class="box-result job">
											<h3><?= $o->titulo ?></h3>
											<h4><?= $o->empresa." - ".$o->area ?></h4>
											<h4><?= substr($o->descripcion, 0, 128) ?></h4>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-5 col-xs-12 pull-right">
										<div class="pull-right location">
											<p><?= $o->localizacion ?></p>
										</div>
										<div class="data-job">
											<h3><?= $o->salario ?></h3>
											<span class="label job-type job-<?= $o->contrato ?> "><?= $o->tipoContrato ?></span>
										</div>
									</div>
								</div>
							</a>
						<?php endforeach; ?>
					<?php endif; ?>
					<div class="clearfix"></div>
					<div class="col-lg-12">
						<button class="btn btn-default dropdown-toggle" type="button" id="load_more" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="window.location.href ='<?= BASE_URL?>jobs'">
							Ver más trabajos <span class="glyphicon glyphicon-menu-down"></span>
						</button>
					</div>
					<!--jobs result-->
				</div>
			</div>
			<!--Search Result 01-->
		</div>
	</div>
	<!--main container Section -->
	<!-- Green Banner-->
	<div class="container-fluid green-banner">
		<div class="row">
			<div class="container main-container v-middle">
				<div class="col-lg-10 col-md-8 col-sm-8 col-xs-12 ">
					<h3 class="white-heading">Comienza construyendo  <span>Tú futuro ahora!</span></h3>
				</div>
				<div class="col-lg-2 col-md-4 col-sm-4 col-xs-12 no-padding-left">
					<a href="<?= BASE_URL ?>candidate/login" class="btn btn-getstarted bg-red">empieza ahora</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Green Banner-->
	<!-- Testimionals Slider-->
	<div class="container-fluid testimonio" style="background:url(<?= IMG_URL ?>testbg.png);">
		<div class="row">
			<div class="container main-container">
				<div class="col-lg-12">
					<div id="testimonio" class="owl-carousel owl-template owl-theme">
						<!--Slides-->
						<?php if (!empty($reviews)): ?>
							<?php foreach ($reviews as $r): ?>
								<div class="item">
									<img src="<?= BASE_URL.$r->logo ?>" alt="Logo <?= $r->empresa ?>" style="max-width:54px;max-height:54px;border-radius:50%;"/>
									<div class="info">
										<h5><?= $r->empresa ?></h5>
										<span class="rating" class="text-center" style="color:#ce9114">
											<?php for ($i=0; $i < $r->rating; $i++) { ?>
												<i class="fa fa-star"></i>
											<?php	} ?>
										</span>
										<p style="word-break:break-word;margin-top:8px"><?= $r->testimonio ?></p>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<div class="item">
								<img src="<?= IMG_URL ?>tes-profile.png" alt="Photo" />
								<div class="info">
									<h5>Anna Smith</h5>
									<span>Web Designer</span>
									<p>Nam eu eleifend nulla. Duis consectetur sit amet risus sit amet venenatis. Pellentesque pulvinar ante a tincidunt placerat.
									Donec dapibus efficitur arcu, a rhoncus lectus egestas elem</p>
								</div>
							</div>
						<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Testimionals Slider-->
	<!-- Clients Slider-->
	<div class="container-fluid clients">
		<div class="row">
			<div class="container main-container">
				<div class="col-lg-12">
					<ul>
						<?php if (isset($empresas) && count((array)$empresas) > 0): ?>
							<?php foreach ($empresas as $corp): ?>
								<li><img src="<?= BASE_URL.$corp->logo ?>" alt="<?= $corp->nombre ?>" /> </li>
							<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Client Slider-->
	<?php include 'templates/footer.php'; ?>
	<?php include 'templates/scripts.php'; ?>
	<?php include 'templates/loader.php'; ?>
</body>
</html>
