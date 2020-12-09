
    <div class="w3-bar w3-white w3-wide w3-padding w3-card">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarContenido" aria-expanded="false">
				<span class="sr-only">Abrir navegación</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="index.php" class="w3-bar-item w3-button"> <b>CD&U</b> Logistica</a>
		</div>
		<div id="navbarContenido" class="collapse navbar-collapse">
			<div class="w3-bar-item">
				<i class="material-icons">perm_identity</i>
				<strong>Bienvenido, <?php echo $_SESSION['nombre']; ?></strong>
			</div>
			<ul class=" w3-button w3-right">

				<li><a href="Salir.php"><i class="material-icons">settings_power</i>Salir</a></li>
			</ul>
		</div>
	</div>
