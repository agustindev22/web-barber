<?php
session_start();
if ($_POST) {
    include("bd.php");

    $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    $password = md5($password); //se hace opara poder poner tu contrseña nque utilizaste en registro de usuarios y no poner los datos del encryptado

    $sentencia = $conexion->prepare("SELECT *, count(*) as n_usuario
    FROM tbl_usuarios 
    WHERE usuario=:usuario 
    AND password=:password ");

    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->execute();

    $lista_usuarios = $sentencia->fetch(PDO::FETCH_LAZY);
    $n_usuario = $lista_usuarios["n_usuario"];

    if ($n_usuario > 0) {
        $_SESSION["usuario"] = $lista_usuarios["usuario"];
        $_SESSION["logueado"] = true;
        header("Location: index.php");
        exit(); // Termina la ejecución del script después de la redirección
    } else {

        $mensaje = "Usuario o Contraseña incorrecta.. ❌";
    }
}
?>



<!doctype html>
<html lang="en">

<head>
    <title>Login</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <link rel="shortcut icon" href="../img/silla-logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>

    <main>
        <div class="container">
            <div class="row">
                <div class="col"></div>
                <div class="col">
                <br></br>
                  <?php if(isset($mensaje)){?>
                    <div class="alert alert-danger" role="alert">
                        <strong><?php echo $mensaje?></strong> 
                    </div>
                 <?php }?>
                    <br></br>
                    <div class="card text-center">
                        <div class="card-header">Iniciar sesión</div>
                        <div class="card-body">
                            <form action="login.php" method="post">
                                <div class="mb-3">
                                    <label for="" class="form-label">Usuario:</label>
                                    <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario"" />
                              </div>

                              <div class=" mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Escriba Su Contraseña" />
                                </div>

                                <button type="submit" class="btn btn-success">Entrar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
            </div>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>