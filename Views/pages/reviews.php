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
					<h3 class="white-heading">Testimonios</h3>
				</div>
				<!--<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="favorite">Save Job<i class="fa fa-star-o"></i><span>Posted on March 2016</span></div>
				</div>-->
			</div>
		</div>
	</div>
	<!-- Page Title-->
	<!-- Job Results -->
	<div class="container-fluid  job-recom">
		<div class="row">
			<div class="main-container">
				<div id="review-item" class="col-xs-12">
					<?php foreach ($lista as $r): ?>
						<!--Recomended job-->
						<div class="item recom-job col-lg-3 col-md-4 col-sm-6 col-xs-12">
							<div class="related_job text-center">
								<img src="<?= BASE_URL.$r->logo ?>" alt="" style="max-width:45px;max-height:45px;border-radius:50%;"/>
								<h4 class="text-center" style="margin:7px 0 0 0"><?= $r->empresa ?></h4>
								<!--<span class="label job-type job-partytime">Party Time</span>-->
								<p style="word-break:break-word;margin:5px 0;"><?= $r->testimonio ?></p>
								<span class="text-center">
									<?php for ($i=0; $i < $r->rating; $i++) { ?>
										<i class="fa fa-star-o"></i><i class="fa fa-star"></i>
									<?php	} ?>
								</span>
							</div>
						</div>
						<!--Recomended job-->
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<!-- Job Results -->
	<!--Blue Secions --> <div class="container-fluid green-banner" style="margin-top:36px">
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
