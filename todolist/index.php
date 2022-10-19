<!-- TODO Requerimos la conexion -->
<?php 
require 'conexion.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-Do List</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body style="background-color: #E6E6FA;">
    <div class="container text-center">
    <br>
       <div class="row">
          <form action="app/add.php" method="POST" autocomplete="off">
            <div class="mb-3">
                <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                    <input type="text" 
                        name="title" 
                        class="form-control"
                        style="border-color: #ff6666"
                        placeholder="Necesitas agregar una tarea" />
                    <br>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Campos Vacios!</strong> Asegurate de llenar los campos.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <button type="submit" class="btn btn-primary">Agregar Tarea</button>

                <?php }else{ ?>
                <br>
                <input type="text" 
                        name="title" 
                        class="form-control"
                        placeholder="Agregar una nueva tarea" />
                <br>
                <button type="submit" class="btn btn-primary">Agregar Tarea</button>
                <?php } ?>
             </div>     
          </form>
       </div>
       <?php 
          $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
       ?>
       <div class="row">
            <?php if($todos->rowCount() <= 0){ ?>
<<<<<<< HEAD

                <h3 align="center">No hay tareas para mostrar.</h3>
<!--  -->
                <!-- <div class="todo-item">
=======
                <div class="todo-item">
>>>>>>> a842af8226d43743a0b4f472377a471da4f69642
                    <div class="empty">
                        <img src="img/empty.png" width="100%" />
                        <img src="img/Ellipsis.gif" width="80px">
                    </div>
                </div>
            <?php } ?>

            <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="card">
                    <div class="card-body">
                        <span id="<?php echo $todo['id']; ?>"
                            class="remove-to-do">x</span>
                        <?php if($todo['checked']){ ?> 
                            <input type="checkbox"
                                class="check-box form-check-input"
                                data-todo-id ="<?php echo $todo['id']; ?>"
                                checked />
                            <h5 class="card-title"><?php echo $todo['title'] ?></h5>
                        <?php }else { ?>
                            <input type="checkbox"
                                data-todo-id ="<?php echo $todo['id']; ?>"
                                class="check-box form-check-input" />
                            <h5 class="card-title"><?php echo $todo['title'] ?></h5>
                        <?php } ?>
                        <br>
                        <!-- TODO Dando formato a la fecha -->
                        <p class="card-text">Creado: <?php echo date("d/m/Y - h:i:a", strtotime($todo['date_time'])) ?></p>
                    </div>
                </div>
            <?php } ?>
       </div>
            <!-- TODO Agregando la parte de reportes -->
            <br>
            <button type="button" class="btn btn-outline-info" name="report" onclick="parent.location='report.php'">Reporte </button>
    </div>

    <!-- Agregando scripts -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
                
                $.post("app/remove.php", 
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                             $(this).parent().hide(600);
                         }
                      }
                );
            });

            $(".check-box").click(function(e){
                const id = $(this).attr('data-todo-id');
                
                $.post('app/check.php', 
                      {
                          id: id
                      },
                      (data) => {
                          if(data != 'error'){
                              const h2 = $(this).next();
                              if(data === '1'){
                                  h2.removeClass('checked');
                              }else {
                                  h2.addClass('checked');
                              }
                          }
                      }
                );
            });
        });
    </script>
</body>
</html>