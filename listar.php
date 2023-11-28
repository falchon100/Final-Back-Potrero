<?php
session_start();
if (isset($_SESSION['usuario'])) {
$usuario = $_SESSION['usuario'];
}
    else {
        header ("location:login.html");
    }
 
    // Establecer tiempo de vida de la sesión en segundos
    $inactividad = 600;
    // Comprobar si $_SESSION["timeout"] está establecida
    if(isset($_SESSION["timeout"])){
        // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
        $sessionTTL = time() - $_SESSION["timeout"];
        if($sessionTTL > $inactividad){
            session_destroy();
            header("location:login.html");
        }
    }
    // El siguiente key se crea cuando se inicia sesión
    $_SESSION["timeout"] = time();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <h1>Tienda de ropa</h1>
    <h2>Lista de ropa</h2>
    <p>La siguiente lista muestra los datos de la ropa actualmente en stock.</p>
    <br>
    <br>
    <a class='btn btn-success' href="listar.php">TODOS</a>
    <a class='btn btn-success' href="buzo.php">BUZOS</a>
    <a class='btn btn-success' href="nike.php">NIKE</a>
    <a class='btn btn-success' href="mayor.php">SUPREME</a>
    <a class='btn btn-danger' href="cerrarsesion.php">Cerrar Session</a>
    <table class='table' border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>TIPO DE PRENDA</th>
                <th>MARCA</th>
                <th>TALLE</th>
                <th>PRECIO</th>
                <th>IMAGEN</th>
                <th>BORRAR</th>
                <th>EDITAR</th>
            </tr>
        </thead>
    <?php
    // 1) Conexion
    $conexion=mysqli_connect("127.0.0.1","root","");
    mysqli_select_db($conexion,"tienda");

    // 2) Preparar la orden SQL
    // Sintaxis SQL SELECT
    // SELECT * FROM nombre_tabla
    // => Selecciona todos los campos de la siguiente tabla
    // SELECT campos_tabla FROM nombre_tabla
    // => Selecciona los siguientes campos de la siguiente tabla
    $consulta= "SELECT*FROM ropa";

    // 3) Ejecutar la orden y obtenemos los registros
    $datos= mysqli_query ($conexion,$consulta);

    // 4) Mostrar los datos del registro
    

    while ( $reg = mysqli_fetch_array($datos) ) { ?>
    <tbody>
        <tr>
            <td><?php echo $reg['id']; ?></td>
            <td><?php echo $reg['prenda']; ?></td>
            <td><?php echo $reg['marca']; ?></td>
            <td><?php echo $reg['talle']; ?></td>
            <td><?php echo $reg['precio']; ?></td>
            <td><img src="data:image/jpg;base64, <?php echo base64_encode($reg['imagen']) ?> " width="100px" height="100px" alt=""> </td>
            <td> <a href="borrar.php?id=<?php echo $reg['id'];?>"> BORRAR</a></td> 
            <td> <a href="modificar.php?id=<?php echo $reg['id'];?>"> MODIFICAR</a></td> 
        </tr>
    </tbody>
    <?php } ?>
    </table>
</body>
</html>
