<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CVVEN</title>
        <link rel="stylesheet" href="<?php echo base_url("application/bootstrap/css/bootstrap.min.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url("application/bootstrap/js/bootstrap.min.js"); ?>" />
    </head>
<body>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/codeigniter/index.php">CVVEN</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/codeigniter/index.php">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/codeigniter/index.php/Formulaire/reserv">Reservation<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/codeigniter/index.php/Formulaire/ListeReserv">Liste Reservation<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links-->
            <?php if(!isset($_SESSION['co'])){
                ?>
            <li class="nav-item active">
                <a class="nav-link" href="/codeigniter/index.php/Formulaire/inscription">Inscription<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/codeigniter/index.php/Formulaire/connexion">Login<span class="sr-only">(current)</span></a>
            </li>
            <?php }
            else{
            ?>
            <li class="nav-item active">
                <a href="#" class="nav-link">Mon Compte</a>
            </li>
            <li class="nav-item active">
                <a href="/codeigniter/index.php/Formulaire/logout" class="nav-link">Logout</a>
            </li>
            <?php }?>
        </ul>
    </div>
</nav>
<br>
