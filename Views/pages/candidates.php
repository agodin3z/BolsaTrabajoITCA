<?php if (!isset($_SESSION['company']) || isset($_SESSION['candidate'])) {
  header("Location: /company/login");
}
include 'templates/header.php'; ?>
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
					<h3 class="white-heading">Candidatos</h3>
				</div>
			</div>
		</div>
	</div>
	<!-- Page Title-->
	<!-- Job Categories Filters -->
	<div class="jobs_filters">
		<div class="container">
			<form class="" action="<?= BASE_URL ?>candidate/search/" method="get">

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 filter_width bgicon">
					<div class="form-group">
						<select class="" name="cat">
              <option value="">-- Selecciona un cargo --</option>
              <?php foreach ($this->modelPerfilPro->getCargos() as $p): ?>
                <option value="<?= $p->titulo ?>"><?= $p->titulo ?></option>
              <?php endforeach; ?>
            </select>
					</div>
					<span>ej. Diseñador</span>
				</div>

				<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12 filter_width bgicon">
					<div class="form-group">
						<input type="text" class="form-control" name="key" placeholder="Nombre o palabra clave">
						<span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
					</div>
					<span>ej. Juan</span>
				</div>

        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 filter_width bgicon location">
					<div class="form-group">
						<select id="pais" class="" name="pais">
							<option value="">-- País --</option>
							<?php foreach ($this->modelPais->getPaises() as $p): ?>
                <option value="<?= $p->id ?>"><?= $p->nombre ?></option>
              <?php endforeach; ?>
						</select>
					</div>
					<span>ej. El Salvador</span>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 filter_width bgicon location">
					<div class="form-group">
						<select id="depto" class="" name="depto">
							<option value="">- Departamento -</option>
							<?php foreach ($this->modelPais->getDeptos(array('SV')) as $p): ?>
                <option value="<?= $p->id ?>"><?= $p->nombre ?></option>
              <?php endforeach; ?>
						</select>
					</div>
					<span>ej. Santa Ana</span>
				</div>
				<div class="col-lg-1 col-md-2 col-sm-4 col-xs-12 filter_width bgicon submit">
					<div class="form-group">
						<input type="submit" class="customsubmit" value="Buscar">
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
				<h3 class="recom">Listado de Candidatos</h3>
        <h4>
					<?php if (isset($_GET['cat']) && !empty($_GET['cat'])): ?>
						<b>Categoría:</b> <?= $_GET['cat'] ?> &nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if (isset($_GET['key']) && !empty($_GET['key'])): ?>
						<b>Frase:</b> <?= $_GET['key'] ?> &nbsp;&nbsp;&nbsp;
					<?php endif; ?>
          <?php if (isset($_GET['pais']) && !empty($_GET['pais'])): ?>
						<b>País:</b> <?= $this->modelPais->getPais($_GET['pais'])[0]->nombre ?> &nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if (isset($_GET['depto']) && !empty($_GET['depto'])): ?>
						<b>Departamento:</b> <?= $this->modelPais->getDepto($_GET['depto'])[0]->nombre ?> &nbsp;&nbsp;&nbsp;
					<?php endif; ?>
				</h4>
			</div>
			<!--Search Result 01-->
			<div class="col-lg-12">
				<!--jobs result-->
				<?php if (count($lista) > 0): ?>
          <?php foreach($lista as $r):
            $titulo = $this->modelPerfilPro->getPerfilPro($r->id);
            $pais = $this->modelPais->getPais($r->pais);
            $deptoE = $this->modelPais->getDepto($r->depto);
            $salarioMin = $this->modelPreferencias->getPreferencias($r->id);
            $situacion = $this->modelPreferencias->getPreferencias($r->id); ?>
  				<div class="filter-result 01">
  					<div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 pull-left">
  						<div class="company-left-info pull-left">
  							<img src="<?= BASE_URL.$r->foto ?>" alt=""/>
  						</div>
  						<div class="box-result">
                <?php $nombre=explode(" ",$r->nombre); $apellido=explode(" ",$r->apellido); ?>
  							<a href="<?= BASE_URL ?>candidate/profile/<?= substr(md5($r->id), 0, 8) ?>"><h3><?= $nombre[0]." ".$apellido[0] ?></h3></a>
  							<h4><?php if (!empty($titulo)) echo $titulo->titulo; ?></h4>
  						</div>
  					</div>
  					<div class="col-lg-6 col-md-6 col-sm-5 col-xs-12 pull-right">
  						<div class="pull-right location">
  							<p><?php if (!empty($deptoE)) { echo "<a href='".BASE_URL."candidate/search/?depto=".$r->depto."' style='color:#333'>". $deptoE[0]->nombre ."</a>, "; }
                if (!empty($pais)) { echo "<a href='".BASE_URL."candidate/search/?pais=".$r->pais."' style='color:#333'>". $pais[0]->nombre ."</a>"; } ?></p>
  						</div>
  						<div class="data-job">
  							<h3>$<?php if (!empty($salarioMin)) echo $salarioMin->salarioMin; ?></h3>
  							<span class="label job-type job-contract "><?php if (!empty($situacion)) echo $situacion->situacion; ?></span>
  						</div>
  					</div>
  				</div>
  				<?php endforeach; ?>
        <?php else: ?>
          <div class="filter-result 01">
  					<div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 pull-left">
              <div class="box-result">
                <h3>Sin resultados</h3>
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
	<!--Blue Secions --> <div class="container-fluid green-banner">
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
<script type="text/javascript">
	$(document).ready(function(){
		$('#pais').on('change', function (){
			$.getJSON('/company/deptos/' + $('#pais').val(), function(data){
		      //console.log(data);
		      $('#depto').empty();
		      var options = '<option value="">- Departamento -</option>';
		      if (data.length > 0) {
		        $('#depto').prop("disabled", false);
		        for (var x = 0; x < data.length; x++) {
		            options += '<option value="' + data[x].id + '" >' + data[x].nombre + '</option>';
		        }
		      } else {
		        $('#depto').prop("disabled", !this.checked);
		      }
					$('#depto').html(options);
		  });
	  });
	});
</script>
</body>
</html>
