<?php
session_start();
include('config.php');
include_once 'class/motorista.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
$crud = new crudmotorista($conn);
//validacion del boton actualizar
if (isset($_POST['btn-update'])) {
    
    $id = $_GET['edit_id'];
    $Nombre = $_POST['Nombre'];
    $Fecha_de_ingreso = $_POST['Fecha_de_nacimiento'];
    $Fecha_de_nacimiento = $_POST['Fecha_de_ingreso'];
    

    // print_r([$id, $nombre, $direccion, $telefono, $dui]);

    //hace referencia a la funcion update
    if ($crud->update($id, $Nombre,$Fecha_de_nacimiento, $Fecha_de_ingreso)) {
        $msg = "<b>WOW, Actualizacion exitosa!</b>";
    } else {
        $msg = "<b>ERROR, algo anda mal</b>";
    }
}
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    extract($crud->getID($id));
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php require_once "menu.php" ?>
    <title>Motorista</title>
</head>

<body>

    <div class="container"><br>
        <div class="row justify-content-center">
            <div class="col-6 p-5 bg-white shadow-lg rounded">
                <?php
                if (isset($msg)) {
                    echo $msg;
                }
                ?>
                <h3>ACTUALIZAR MOTORISTA</h3>
                <hr>
                <form method="post">
                    <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input id="Nombre" value="<?php echo $Nombre; ?>" class="form-control" type="text" name="Nombre">
                    </div>

                  
                    <div class="form-group">
                        <label for="Fecha_de_nacimiento">Fecha de nacimiento</label>
                        <input id="Fecha_de_nacimiento" value="<?php echo $Fecha_de_nacimiento; ?>" class="form-control" type="date" name="Fecha_de_nacimiento">
                        </div>
                    <div class="form-group">
                        <label for="Fecha_de_ingreso">Fecha de ingreso</label>
                        <input id="Fecha_de_ingreso" value="<?php echo $Fecha_de_ingreso; ?>" class="form-control" type="date" name="Fecha_de_ingreso">
                    </div><br>
                    <button class="btn btn-primary" name="btn-update" type="submit">Actualizar</button>
                </form>
            </div>


        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>