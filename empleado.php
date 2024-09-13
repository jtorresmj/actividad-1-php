

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="https://umg.edu.gt/miumg/"target="_blank">Umg</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Menu
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="empleado.php">Empleado</a></li>
            <li><a class="dropdown-item" href="#">Nuevo</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Vacio</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" action="" method="post" >
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>   
</header>
    <h1>Formulario Empleado</h1>
    <div class="container">
    <form action="crud_empleados.php" method = "post" class="form-group needs-validation" novalidate>>
    <label for="lbl_id" class="form-label"><b>ID</b></label>
    <input type="text" class="form-control" name="txt_id" id="txt_id" value="0" readonly>

    <label for="lbl_codigo" class="form-label"><b>Codigo</b></label>
    <input type="text" class="form-control" name="txt_codigo" id="txt_codigo" placeholder="Ej: E001" pattern=[E]{1}[0-9]{3} required>
    <label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
    <input type="text" class="form-control" name="txt_nombres" id="txt_nombres" placeholder="Ej: Javier Isaacc " required>
    <label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
    <input type="text" class="form-control" name="txt_apellidos" id="txt_apellidos" placeholder="Ej: Torres cruz" required>
    <label for="lbl_direccion" class="form-label"><b>Direccion</b></label>
    <input type="text" class="form-control" name="txt_direccion" id="txt_direccion" placeholder="Ej: Boca del Monte" required>
    <label for="lbl_telefono" class="form-label"><b>Telefono</b></label>
    <input type="number" class="form-control" name="txt_telefono" id="txt_telefono" placeholder="Ej: 12345678" required>
    <label for="lbl_fn" class="form-label"><b>Fecha de Nacimiento</b></label>
    <input type="date" class="form-control" name="txt_fn" id="txt_fn" placeholder="Ej: yyyy/MM/dd" required>
    <label for="lbl_puesto" class="form-label"><b>Puesto</b></label>
    <select name="drop_puesto" id="drop_puesto" class="form-select" aria-label="Default select example" required>
        <option selected disabled value="">Seleccione un puesto</option>
        <?php
        include ("datos_conexion.php");
        $db_conexion =  mysqli_connect($db_host, $db_user, $db_pass, $db_db);
        $db_conexion ->real_query("SELECT id_puestos AS id, puesto FROM puestos;");
        $resultado = $db_conexion->use_result();
        while ($fila = $resultado->fetch_assoc()){
              echo"<option value=". $fila['id']  .">". $fila['puesto'] ." </option>";
}
$db_conexion ->close();
?>
    </select>
    </br>
    <button class="btn btn-primary" name="btn_crear" id="btn_crear" value="crear"><i class="bi bi-floppy"> Crear</i></button>
    <button class="btn btn-warning" name="btn_actualizar" id="btn_actualizar" value="actualizar"><i class="bi bi-pencil-square"></i> Actualizar</i></button>
    <button class="btn btn-danger" name="btn_borrar" id="btn_borrar" value="borrar"><i class="bi bi-trash3"></i> Borrar</i></button>
    </form>
<div
  class="table-responsive"
>
  <table
    class="table table-striped-columns table-hover table-borderless table-primary align-middle"
  >
    <thead class="table-light">
      <caption>
        Table Name
      </caption>
      <tr>
        <th>Codigo</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Puesto</th>
        <th>Nacimiento</th>
      </tr>
    </thead>
    <tbody id="tbl_empleados">
    <?php
        include ("datos_conexion.php");
        $db_conexion =  mysqli_connect($db_host, $db_user, $db_pass, $db_db);
        $db_conexion ->real_query("SELECT e.id_empleados AS id, e.codigo, e.nombres, e.apellidos, e.direccion, e.telefono,p.puesto, e.fecha_nacimiento,e.id_puesto FROM empleados AS e INNER JOIN puestos AS p ON e.id_puesto = p.id_puestos;");
        $resultado = $db_conexion->use_result();
        while ($fila = $resultado->fetch_assoc()){
          echo"<tr data-id=". $fila['id']. " data-idp=". $fila['id_puesto']. ">";
          echo"<td>". $fila['codigo']. "</td>";
          echo"<td>". $fila['nombres']. "</td>";
          echo"<td>". $fila['apellidos']. "</td>";
          echo"<td>". $fila['direccion']. "</td>";
          echo"<td>". $fila['telefono']. "</td>";
          echo"<td>". $fila['puesto']. "</td>";
          echo"<td>". $fila['fecha_nacimiento']. "</td>";   

          echo"<tr>";
}
$db_conexion ->close();
?>

      
    </tbody>
    <tfoot>
      
    </tfoot>
  </table>
</div>


    </div>
</body>



<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
    $("#tbl_empleados").on('click', 'tr td', function (e) {
        var target, id, idp, codigo, nombres, apellidos, direccion, telefono, nacimiento;
        target = $(e.target);
        id = target.parent().data('id');
        idp = target.parent().data('idp');
        codigo = target.parent('tr').find("td").eq(0).html();
        nombres = target.parent('tr').find("td").eq(1).html();
        apellidos = target.parent('tr').find("td").eq(2).html();
        direccion = target.parent('tr').find("td").eq(3).html();
        telefono = target.parent('tr').find("td").eq(4).html();
        nacimiento = target.parent('tr').find("td").eq(6).html();
        $("#txt_id").val(id);
        $("#txt_codigo").val(codigo);
        $("#txt_nombres").val(nombres);
        $("#txt_apellidos").val(apellidos);
        $("#txt_direccion").val(direccion);
        $("#txt_fn").val(nacimiento);
        $("#drop_puesto").val(idp);



    });
</script>



</body>
</html>