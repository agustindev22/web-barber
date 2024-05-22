<?php
include("../../bd.php");

//ACTULIZA LOS DATOS
if ($_POST) {

    $txtID = (isset($_POST["txtID"])) ? $_POST["txtID"] : "";
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";


    $sentencia = $conexion->prepare("UPDATE `tbl_servicios` SET titulo=:titulo, descripcion=:descripcion WHERE ID=:id"); //ACTULIZA LOS DATOS
    $sentencia->bindParam(":id", $txtID);
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);


    $sentencia->execute();
    header("Location:index.php");


    //ACTUALIZACION DE FOTO

    $foto = (isset($_FILES['foto']["name"])) ? $_FILES['foto']["name"] : "";
    $tmp_foto = $_FILES["foto"]["tmp_name"];

    if ($foto !="") {
        $fecha_foto = new DateTime();
        $nombre_foto = $fecha_foto->getTimestamp() . "-" . $foto;

        move_uploaded_file($tmp_foto, "../../../img/" .$nombre_foto);

        $sentencia = $conexion->prepare("SELECT * FROM `tbl_servicios` WHERE ID=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registro_foto = $sentencia->fetch(PDO::FETCH_LAZY);

        if (isset($registro_foto['foto'])) {
            if (file_exists("../../../img/" . $registro_foto['foto'])) {
                unlink("../../../img/" . $registro_foto['foto']);
            }
        }
        $sentencia = $conexion->prepare("UPDATE `tbl_servicios` SET foto=:foto WHERE ID=:id"); //ACTULIZA LOS DATOS
        $sentencia->bindParam(":id", $txtID);
        $sentencia->bindParam(":foto", $nombre_foto);
    
        $sentencia->execute();
    
    }
}



if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_servicios` WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    //RECUPERACION DE DATOS ASIGNADO AL FORMULARIO
    $titulo = $registro["titulo"];
    $descripcion = $registro["descripcion"];
    $foto = $registro["foto"];

}

include("../../templates/header.php");
?>
<br />

<div class="card">
    <div class="card-header">Editar Servicios</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">


            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" value="<?php echo $txtID ?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="Id" />
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto:</label>
                <img src="../../../img/<?php echo $foto ?>" alt="Imagen de Servicio" width="60">
                <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto del Servicio" aria-describedby="fileHelpId" />
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo:</label>
                <input type="text" value="<?php echo $titulo ?>" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo" />
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input type="text" value="<?php echo $descripcion ?>" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion" />
            </div>
            <button type="submit" class="btn btn-success">Editar Servicios</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>









<?php include("../../templates/footer.php"); ?>