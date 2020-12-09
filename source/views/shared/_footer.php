<footer>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<h2 class="h4">CD&U Logistica</h2>
				<p>Empresa ficticia de logística de camiones</p>
		</div>
        <?php if($_SESSION['id_rol'] == 4) { ?>
				<div class="col-xs-12 col-sm-4 col-sm-offset-2">
					<h2 class="h4">Mapa del sitio</h2>
					<ul class="list-unstyled">
						<li><a href="empleados.php">Empleados</a></li>
						<li><a href="vehiculos	.php">Vehiculos</a></li>
						<li><a href="viajes.php">Viajes</a></li>
						<li><a href="reportes.php">Reportes</a></li>
						<li><a href="seguimientos.php">Seguimiento</a></li>
					</ul>
				</div>
        <?php } ?>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<p>CD&U Logistica <?php echo date("Y"); ?> Todos los derechos reservados.</p>
				</div>
				<div class="col-xs-12 col-sm-6">
					<p class="text-right">Trabajo práctico final - Programación Web II UNLaM ~ 2020</p>
				</div>
			</div>
		</div>
	</div>
</footer>