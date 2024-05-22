<?php
include("../../bd.php");
if (isset($_GET['txtID'])){

    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";

    $sentencia=$conexion->prepare("DELETE FROM tbl_usuarios WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    header("Location:index.php");
}
$sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios`");  //consulta
$sentencia->execute();                                         // y muestra
$lista_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);        //los registros

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-dark" href="crear.php" role="button">Agregar Usuarios</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-secondary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
               <?php foreach (  $lista_usuarios as $regisrto){?>
                    <tr class="">
                        <td scope="row"><?php echo $regisrto["ID"];?></td>
                        <td><?php echo $regisrto["usuario"];?></td>
                        <td>****</td>
                        <td><?php echo $regisrto["correo"];?></td>
                        <td>
                        <a name="" id="" class=" btn btn-danger" href="index.php?txtID=<?php echo $regisrto["ID"]?>" role="button">Borrar</a>
                        </td>
                    </tr>
                <?php } ?>    
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php include("../../templates/footer.php") ?>