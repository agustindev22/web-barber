<?php 
include ("../../bd.php");
 //PARA EDITAR 
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";

    $sentencia=$conexion->prepare("SELECT * FROM `tbl_banners` WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
     

    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $titulo=$registro["titulo"];
    $descripcion=$registro["descripcion"];
    $link=$registro["link"];
}

if($_POST){
    
    $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:"";
    $titulo=(isset($_POST["titulo"]))?$_POST["titulo"]:""; 
    $descripcion=(isset($_POST["descripcion"]))?$_POST["descripcion"]:""; 
    $link=(isset($_POST["link"]))?$_POST["link"]:""; 

    $sentencia=$conexion->prepare("UPDATE `tbl_banners` SET titulo=:titulo, descripcion=:descripcion, link=:link  WHERE ID=:id"); //ACTULIZA LOS DATOS
    $sentencia->bindParam(":id", $txtID);
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":link", $link);
    
    $sentencia->execute();
    header("Location:index.php");

}



include("../../templates/header.php");

?>


<br />
<div class="card">
    <div class="card-header">Banners</div>
    <div class="card-body">
        <form action="" method="post">

           <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <input type="text" value="<?php echo $txtID?>"  class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="Escriba el titulo" />
            </div>


            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" value="<?php echo $titulo?>"  class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Escriba el titulo" />
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <input type="text" value="<?php echo $descripcion?>" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Escriba la descripcion" />
            </div>

            <div class="mb-3">
                <label for="link" class="form-label">Link</label>
                <input type="text" value="<?php echo $link?>"  class="form-control" name="link" id="link" aria-describedby="helpId" placeholder="Escriba el enlace/link" />
            </div>
            <button type="submit" class="btn btn-success">Actualizar Edicion</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php");?>