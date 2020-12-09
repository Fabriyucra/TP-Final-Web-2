<?php
session_start();
require_once('source/inc/head.php');
unset($_SESSION['logueado']);
?>

<body class="pag-login ">
<?php require_once('source/inc/ga.php'); ?>
<?php if(isset($_GET['error'])) { ?>
    <script>alert('Su clave o contraseña es incorrecta o no existe el usuario')</script>
<?php } ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>CD&U Logistica</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assert/css/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-wide w3-padding w3-card">
        <a href="#home" class="w3-bar-item w3-button"><b>CD&U</b> Logistica</a>
        <!-- Float links to the right. Hide them on small screens -->
        <div class="w3-right w3-hide-small">
            <a href="#projects" class="w3-bar-item w3-button">Servicos</a>
            <a href="#about" class="w3-bar-item w3-button">About</a>
            <a href="#contact" class="w3-bar-item w3-button">Contact</a>
            <!-- Login-->
            <button onclick="document.getElementById('id01').style.display='block'"><i class="w3-xlarge w3-block fa fa-user-circle" aria-hidden="true"></i>
            </button>

            <div id="id01" class="w3-modal">
                <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                    <div class="w3-center"><br>
                        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                        <img src="assets/imagenes/avatar.jpg" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
                    </div>

                    <form class="w3-container" action="source/validarLogin.php" method="post"">// aca pasamos por get para validar login
                        <div class="w3-section">
                            <label><b>Username</b></label>
                            <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="usuario" required>
                            <label><b>Password</b></label>
                            <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="password" required>
                            <button class="w3-button w3-block w3-black w3-section w3-padding" type="submit">Login</button>

                        </div>
                    </form>

                    <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
                        <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Header -->

<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
    <img class="w3-image" src="assets/imagenes/index.jpg" alt="Architecture" width="1500" height="800">
    <div class="w3-display-middle w3-margin-top w3-center">
        <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>CD&U</b></span> <span class="w3-hide-small w3-text-light-grey">Logistica</span></h1>
    </div>
</header>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

    <!-- Project Section -->
    <div class="w3-container w3-padding-32" id="projects">
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Servicios</h3>
    </div>

    <div class="w3-row-padding">
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-display-container">
                <div class="w3-display-topleft w3-black w3-padding">Vehiculos Modernos</div>
                <img src="assets/imagenes/camion-login.png" alt="House" style="width:100%">
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-display-container">
                <div class="w3-display-topleft w3-black w3-padding">Viajes a todo el pais</div>
                <img src="assets/imagenes/viajes1.jpg" alt="House" style="width:100%">
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-display-container">
                <div class="w3-display-topleft w3-black w3-padding">Seguimiento Satelital</div>
                <img src="assets/imagenes/seguimientos.jpg" alt="House" style="width:100%">
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-display-container">
                <div class="w3-display-topleft w3-black w3-padding">Graficos del Progreso</div>
                <img src="assets/imagenes/graficos.jpg" alt="House" style="width:100%">
            </div>
        </div>
    </div>

    <div class="w3-row-padding">
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-display-container">
                <div class="w3-display-topleft w3-black w3-padding">Grupo de trabajo</div>
                <img src="assets/imagenes/empleados.jpg" alt="House" style="width:99%">
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-display-container">
                <div class="w3-display-topleft w3-black w3-padding">Mantenimiento</div>
                <img src="assets/imagenes/mantenimientos.jpg" alt="House" style="width:99%">
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-display-container">
                <div class="w3-display-topleft w3-black w3-padding">Supervision</div>
                <img src="assets/imagenes/empleados1.png" alt="House" style="width:99%">
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-display-container">
                <div class="w3-display-topleft w3-black w3-padding">Control Logistico</div>
                <img src="assets/imagenes/camion.png" alt="House" style="width:99%">
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div class="w3-container w3-padding-32" id="about">
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">About</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
            minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
            ex ea commodo consequat. Excepteur sint
            occaecat cupidatat non proident, sunt in culpa qui officia
            deserunt mollit anim id est laborum consectetur adipiscing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
            minim veniam, quis nostrud exercitation ullamco
            laboris nisi ut aliquip ex ea commodo consequat.
        </p>
    </div>

    <div class="w3-row-padding w3-grayscale">
        <div class="w3-col l3 m6 w3-margin-bottom">
            <img src="assets/imagenes/team2.jpg" alt="John" style="width:100%">
            <h3>John Doe</h3>
            <p class="w3-opacity">CEO &amp; Founder</p>
            <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
            <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <img src="assets/imagenes/team1.jpg" alt="Jane" style="width:100%">
            <h3>Jane Doe</h3>
            <p class="w3-opacity">Administradora Lider</p>
            <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
            <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <img src="assets/imagenes/team3.jpg" alt="Mike" style="width:100%">
            <h3>Mike Ross</h3>
            <p class="w3-opacity">Supervisor Regional</p>
            <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
            <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <img src="assets/imagenes/team4.jpg" alt="Dan" style="width:100%">
            <h3>Dan Star</h3>
            <p class="w3-opacity">Chofer</p>
            <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
            <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="w3-container w3-padding-32" id="contact">
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Contact</h3>
        <p>Lets get in touch and talk about your next project.</p>
        <form action="/action_page.php" target="_blank">
            <input class="w3-input w3-border" type="text" placeholder="Name" required="" name="Name">
            <input class="w3-input w3-section w3-border" type="text" placeholder="Email" required="" name="Email">
            <input class="w3-input w3-section w3-border" type="text" placeholder="Subject" required="" name="Subject">
            <input class="w3-input w3-section w3-border" type="text" placeholder="Comment" required="" name="Comment">
            <button class="w3-button w3-black w3-section" type="submit">
                <i class="fa fa-paper-plane"></i> SEND MESSAGE
            </button>
        </form>
    </div>

    <!-- Image of location/map -->
    <div class="w3-container">
        <img src="assets/imagenes/map.jpg" class="w3-image" style="width:100%">
    </div>

    <!-- End page content -->
</div>
<?php require_once('source/inc/scripts.php'); ?>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-16">
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
</footer>


</body></html>
