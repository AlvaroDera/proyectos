<!-- TODO Requerimos la conexion -->
<?php 
    require 'conexion.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>

<body style="background-color: #E6E6FA;">

    <?php 
          $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
       ?>
    <div class="show-todo-section">
        <h1>Ultimas<small class="text-muted"> tareas agregadas</small></h1>
        <?php if($todos->rowCount() <= 0){ ?>
        <div class="todo-item">
            <div class="empty">
                <h1>No hay tareas para mostrar. </h1>
                <button type="button" class="btn btn-primary" name="rlobby" onclick="parent.location='index.php'">Agregar una nueva tarea</button>
            </div>
        </div>
        <?php } ?>

        <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
            <br>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title"><?php echo $todo['title'] ?></h2>
                <!-- TODO Dando formato a la fecha -->
                <small>Creado: <?php echo date("d/m/Y - h:i:a", strtotime($todo['date_time'])) ?></small>
            </div>
        </div>

        <?php } ?>
        <br>
        <button type="link" class="btn btn-outline-info" name="tolobby" onclick="parent.location='index.php'"><span class="material-symbols-rounded">
arrow_back
</span>Regresar</button>
    </div>

    <!-- Agregando scripts -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>