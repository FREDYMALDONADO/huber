<?php
session_start();
include('config.php');
include_once 'class/cliente.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
$crud = new crudcliente($conn);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php require_once"menu.php" ?>
    <title>LISTA Clientes</title>
</head>

<body>


<div class="container"><br>
     <table id="cliente" class="table table-light table-stripe table-bordered" cellspacing="0" width="100%">
         <tbody>
             <tr>
                 <th>Id</th>
                 <th>Nombre</th>
                 <th>Email</th>
                 <th>Fecha de ingreso</th>
                 <th>Tipo</th>
             </tr>
             <?php
                $query = "SELECT * FROM clientes";
                $crud->datacliente($query)
                ?>
                
         </tbody>
     </table>   
        
</div>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>