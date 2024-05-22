<?php 

session_start();
$url_base="http://localhost/barberia2/admin/";
if(!isset($_SESSION["usuario"])){
    header("Location:".$url_base."login.php");
}

?>


<!doctype html>
<html lang="en">

<head>
    <title>Administrador sitio web</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <link rel="shortcut icon" href="../../../img/silla-logo.png" type="image/x-icon">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
     <!-- cdn de jquery. DataTable sirve para crear tablas interactivas y dinámicas en páginas web, lo que mejora la experiencia del usuario al trabajar con grandes cantidades de datos. -->
   <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand navbar-light bg-light">
            <div class="nav navbar-nav">
                <a class="nav-item nav-link active" href="<?php echo $url_base;?>index.php" aria-current="page">Administrador <span class="visually-hidden">(current)</span></a>
                <a class="nav-item nav-link" href="<?php echo $url_base;?>seccion/banners/">Banners</a>
                <a class="nav-item nav-link" href="<?php echo $url_base;?>seccion/servicios/">Servicios</a>
                <a class="nav-item nav-link" href="<?php echo $url_base;?>seccion/comentarios/">Contacto</a>
                <a class="nav-item nav-link" href="<?php echo $url_base;?>seccion/usuarios/">Usuarios</a>
                <a class="nav-item nav-link" href="<?php echo $url_base;?>cerrar.php">Cerrar sesion</a>
            </div>
        </nav>

    </header>
    <main>
    <section class="container"> 