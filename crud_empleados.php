<?php
if (!empty($_POST)){
    $txt_id =utf8_decode ($_POST["txt_id"]);
    $txt_codigo =utf8_decode ($_POST["txt_codigo"]);
    $txt_nombres =utf8_decode ($_POST["txt_nombres"]);
    $txt_apellidos =utf8_decode ($_POST["txt_apellidos"]);
    $txt_direccion =utf8_decode ($_POST["txt_direccion"]);
    $txt_telefono =utf8_decode ($_POST["txt_telefono"]);
    $drop_puesto =utf8_decode ($_POST["drop_puesto"]);
    $txt_fn =utf8_decode ($_POST["txt_fn"]);

    $sql = "";

  if(isset($_POST["btn_crear"])){
    $sql = "INSERT INTO empleados(codigo, nombres, apellidos, direccion, telefono, fecha_nacimiento, id_puesto) 
    VALUES ('".$txt_codigo."','".$txt_nombres."','".$txt_apellidos."','".$txt_direccion."','".$txt_telefono."','".$txt_fn."',".$drop_puesto.");";
}


if(isset($_POST["btn_actualizar"])){
    $sql = "UPDATE empleados SET codigo='". $txt_codigo."', nombres='".$txt_nombres."', apellidos='". $txt_apellidos ."', direccion='". $txt_direccion ."', telefono='". $txt_telefono ."', fecha_nacimiento='". $txt_fn ."', id_puesto=". $drop_puesto ." WHERE id_empleados=". $txt_id .";";
}
if(isset($_POST["btn_borrar"])){
    $sql = "DELETE  from empleados  WHERE id_empleados=". $txt_id .";";
}

     include("datos_conexion.php");
    $db_conexion =  mysqli_connect($db_host, $db_user, $db_pass, $db_db);  
    
    
  if($db_conexion->query($sql)===true){
    $db_conexion ->close();
    echo"Exito";
    header("location: /empresa_php/empleado.php");
    exit();
    }else{
      echo"Error" . $sql ."<br>". $db_conexion ->close();
    }
  
}
?>