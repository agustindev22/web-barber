<?php 
$servidor="localhost";
$baseDatos="barberia";
$usuario="root";
$contraseña="";
try{
   $conexion= new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario,$contraseña);
   //echo "conexion exitosa 👍";
} catch(Exception $errot){
    echo $error->getMessage();
}

?>