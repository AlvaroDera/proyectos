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
</head>

<body>
        
    <?php 
          $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
       ?>
    <div class="show-todo-section">
    <h1>Ultimas tareas agregadas</h1>
        <?php if($todos->rowCount() <= 0){ ?>
        <div class="todo-item">
            <div class="empty">
                <h1>No hay tareas para mostrar.</h1>
                <button type="button" name="rlobby" onclick="parent.location='index.php'">Agregar una nueva tarea</button>
            </div>
        </div>
        <?php } ?>

        <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="todo-item">

            <h2 class="check"><?php echo $todo['title'] ?></h2>
                    <!-- TODO Dando formato a la fecha -->
                    <small>Creado: <?php echo date("d/m/Y - h:i:a", strtotime($todo['date_time'])) ?></small>
        </div>
        <button type="link" name="tolobby" onclick="parent.location='index.php'">Regresar</button>
        <?php } ?>
    </div>
    
    <!-- Agregando scripts -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>