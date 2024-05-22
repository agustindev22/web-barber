<?php
include("../../bd.php");


if (isset($_GET['txtID'])){

    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:""; 
   //Proceso de borrado que busque la imagen y la borre.
   $sentencia=$conexion->prepare("SELECT * FROM `tbl_servicios` WHERE ID=:id");
   $sentencia->bindParam(":id",$txtID);  
   $sentencia->execute();       
   $registro_foto=$sentencia->fetch(PDO::FETCH_LAZY);
    
   if(isset($registro_foto['foto'])){
       if(file_exists("../../../img/". $registro_foto['foto'])){
          unlink("../../../img/".$registro_foto['foto']);
       }
   }
       //BORRA EN LA BASE DE DATOS.
   $sentencia=$conexion->prepare("DELETE FROM tbl_servicios WHERE ID=:id");
   $sentencia->bindParam(":id", $txtID);
   $sentencia->execute();

   header("Location:index.php");
}


$sentencia=$conexion->prepare("SELECT * FROM `tbl_servicios`");  //consulta
$sentencia->execute();                                         // y muestra
$lista_servicios= $sentencia->fetchAll(PDO::FETCH_ASSOC);        //los registros


include("../../templates/header.php");



?>
<br />
<div class="card">
    <div class="card-header"><a name="" id="" class="btn btn-dark" href="crear.php" role="button">Agregar Servicios</a></div>
    <div class="card-body">

        <div class="table-responsive-sm">
            <table class="table table-secondary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody>
                <?php foreach ($lista_servicios as $key => $value) { ?>
                    <tr class="">
                        <td><?php echo $value['ID']?></td>
                        <td> <img src="../../../img/<?php echo $value ['foto']?>" width="50"  alt=""></td>
                        <td><?php echo $value ['titulo']?></td>
                        <td><?php echo $value ['descripcion']?></td>
                        <td>
                              <a name="" id="" class=" btn btn-primary" href="editar.php?txtID=<?php echo $value["ID"]?>" role="button">Editar</a>
                              <a name="" id="" class=" btn btn-danger" href="index.php?txtID=<?php echo $value["ID"]?>" role="button">Borrar</a>
                        </td>
                    </tr>
                <?php } ?>    
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted"></div>
</div>







<?php include("../../templates/footer.php"); ?>