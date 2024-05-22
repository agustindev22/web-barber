<?php 
include("admin/bd.php");

$sentencia=$conexion->prepare("SELECT * FROM  tbl_banners ORDER BY id DESC limit 1");
$sentencia->execute();
$lista_banners=$sentencia->fetchAll(PDO::FETCH_ASSOC);


$sentencia=$conexion->prepare("SELECT * FROM  tbl_servicios ORDER BY id DESC ");
$sentencia->execute();
$lista_servicios=$sentencia->fetchAll(PDO::FETCH_ASSOC);
 

 //PARTE DE LOS COMENTARIOS/CONTACTO
if($_POST){
     
      $nombre=filter_var($_POST["nombre"] , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $correo=filter_var($_POST["correo"],FILTER_VALIDATE_EMAIL);
      $mensaje=filter_var($_POST["mensaje"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      
      if($nombre && $correo && $mensaje){
         $sql="INSERT INTO tbl_comentarios (nombre, correo, mensaje) VALUES (:nombre, :correo, :mensaje)";
         $resultado= $conexion->prepare($sql);
         $resultado->bindParam(":nombre", $nombre , PDO::PARAM_STR);
         $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
         $resultado->bindParam(":mensaje", $mensaje , PDO::PARAM_STR);
          $resultado->execute();
      }
      header("Location:index.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Barber</title>
   <link rel="shortcut icon" href="img/silla-logo.png" type="image/x-icon">
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
   <header>
      <img class="logo" src="img/silla-logo.png" alt="">
      <button class="abrir-menu" id="abrir"><i class="bi bi-list"></i></button>
      <nav class="nav " id="nav">
         <button id="cerrar" class="cerrar-menu"><i class="bi bi-x-lg"></i></button>
         <ul class="list-nav">
            <li><a class="link-nav" href="#inicio">Inicio</a></li>
            <li><a class="link-nav" href="#servicios">Servicios</a></li>
            <li><a class="link-nav" href="#nosotros">Nosotros</a></li>
            <li><a class="link-nav" href="#contacto">Contacto</a></li>
         </ul>
      </nav>
   </header>
   <!-- ...............................INICIO -->
   <section class="contenedor" id="inicio">
      <div class="intro">
         <hgroup class="text">

         <?php foreach($lista_banners as $banner){ ?>
            <h1><?php echo $banner ['titulo'];?></h1>
            <p><?php echo $banner ['descripcion'];?></p>
            <p><a href="<?php echo $banner ['link'];?>">Ver cortes</a></p>
         <?php } ?>
         </hgroup>
         <picture class="img-inicio">
            <img src="img/barberia.jpg" alt="">
         </picture>
      </div>
   </section>

   <!-- ............................................ SERVIVIOS -->
   <main>
      <section id="servicios">
         <hgroup class="servicio">
            <h3>SERVICIOS</h3>
            <article class="card-servicios">
               <?php foreach($lista_servicios as $servicios){  ?>
               <div class="servicios-group">
                  <img src="img/<?php echo $servicios["foto"]?>" alt="">
                  <h2><?php echo $servicios["titulo"]?></h2>
                  <p> <?php echo $servicios["descripcion"]?></p>
               </div>

               <!-- <div class="servicios-group">
                  <img src="img/navaja-de-afeitar.png" alt="">
                  <h2>Arreglo de barba</h2>
                  <p>Experimenta la diferencia con nuestro servicio de arreglo de barba. </p>
               </div>

               <div class="servicios-group">
                  <img src="img/color-pelo.png" alt="">
                  <h2>Hacemos color</h2>
                  <p>En nuestra peluquería, entendemos que tu color de pelo es una parte importante de tu
                     identidad. </p>
               </div>

               <div class="servicios-group">
                  <img src="img/calendario.png" alt="">
                  <h2>Horarios</h2>
                  <p>Nos podes encontrar en nuestro local los dias de L a S de 9:30hs a 20hs</p>
               </div> -->
               
               <?php } ?>
               </article>
         </hgroup>
      </section>


      <!-- .................................. NOSOTROS  -->

      <section class="nosotros-intro" id="nosotros">
         <hgroup class="nosotros-text">
            <h1>Nosotros</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.Lorem ipsum dolor, sit amet consectetur
               adipisicing elit.</p>
         </hgroup>
         <picture class="img-nosotros">
            <img src="img/nosotros.jpg" width="100" alt="">
         </picture>
      </section>
      <!-- ............CORTES -->
      <div class="cortes" id="cortes">
         <p>CORTES</p>
         <section class="galeria-cortes">
            <img class="imagenes" src="img-cortes/corte1.jpg" alt="corte 1">

            <img class="imagenes" src="img-cortes/corte2.jpg" alt="corte 1">

            <img class="imagenes" src="img-cortes/corte3.jpg" alt="corte 1">

            <img class="imagenes" src="img-cortes/corte4.jpg" alt="corte 1">

            <img class="imagenes" src="img-cortes/cort5.jpg" alt="corte 1">

            <img class="imagenes" src="img-cortes/corte6.jpg" alt="corte 1">

            <img class="imagenes" src="img-cortes/cort7.jpg" alt="corte 1">
         </section>
      </div>
   </main>


   <!-- foooter -->

   <footer>
      <h2>Contacto</h2>
      <form class="formulario" action="?" method="post">
         <label class="data" for="nombre">Nombre:</label>
         <input type="text" name="nombre" id="nombre" placeholder="Escriba su nombre" required>

         <label class="data" for="correo">Correo Electronico:</label>
         <input type="email" name="correo" id="correo" placeholder="Escriba Su Correo">

         <label class="data" for="message">Mensaje</label>
         <textarea name="mensaje" id="message" rows="6" cols="20"></textarea>

         <input type="submit" value="Enviar Mensaje">
      </form>

      <article class="socialMedia" id="contacto">
         <a href="#"><img src="img/youtube.png" alt="youtube"></a>
         <a href="#"><img src="img/intagram.png" alt="instagam"></a>
         <a href="#"><img src="img/twitter.png" alt="twitter"></a>
      </article>

      <h5>&copy;<a href="https://github.com/agustindev22">MartinezAgustin</a></h5>
   </footer>
   <script src="main.js"></script>
</body>

</html>