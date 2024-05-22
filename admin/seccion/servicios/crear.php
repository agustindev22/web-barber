<?php
include ("../../bd.php");
if($_POST){
    
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    
    $sentencia=$conexion->prepare("INSERT INTO `tbl_servicios` (`ID`, `titulo`, `descripcion`, `foto`) VALUES (NULL, :titulo, :descripcion, :foto);");
    
  //SECCION PARA ADJUNTAR LA FOTO { 
    $foto=(isset($_FILES['foto']["name"]))?$_FILES['foto']["name"]:"";
    $fecha_foto= new DateTime();
    $nombre_foto=$fecha_foto->getTimestamp()."-".$foto;
    $tmp_foto=$_FILES["foto"]["tmp_name"];

    if($tmp_foto!=""){
        move_uploaded_file($tmp_foto,"../../../img/".$nombre_foto);
    }
 // } 
    $sentencia->bindParam(":foto", $nombre_foto); 
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->execute();
    header("Location:index.php");
        
}

include("../../templates/header.php");
?>
<br />

<div class="card">
    <div class="card-header">Servicios</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="foto" class="form-label">Foto:</label>
                <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto del Servicio" aria-describedby="fileHelpId" />
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo" />
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion" />
            </div>
            <button type="submit" class="btn btn-success">Agregar Servicios</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>




<?php include("../../templates/footer.php") ?>