<?php
include("../../bd.php");


if($_POST){
    $usuario=(isset($_POST["usuario"]))?$_POST["usuario"]:"";
    $password=(isset($_POST["password"]))?$_POST["password"]:"";
    $password= md5($password); // funcion md5 nos permite encriptar nustra contraseña para que no se vea, hay mas formas
    $correo=(isset($_POST["correo"]))?$_POST["correo"]:"";


    
    $sentencia=$conexion->prepare("INSERT INTO `tbl_usuarios` (ID, usuario, password, correo) VALUES (NULL, :usuario, :password, :correo);");
       
    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);
    $sentencia->bindParam(":correo",$correo);

    $sentencia->execute();
    header("Location:index.php");

}



include("../../templates/header.php");
?>
<br />


<div class="card">
    <div class="card-header">Usuarios</div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre De Usuario" />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <!-- Corrección del nombre del campo de contraseña -->
                <input type="password" class="form-control" name="password" id="password" placeholder="Escriba Su Contraseña" />
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" name="correo" id="correo" aria-describedby="emailHelpId" placeholder="abc@mail.com" />
            </div>

            <button type="submit" class="btn btn-success">Crear Usuario</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>





<?php


include("../../templates/footer.php");
?>