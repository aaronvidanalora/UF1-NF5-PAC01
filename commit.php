<?php
// Establecer la conexión con la base de datos
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
// Seleccionar la base de datos
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));
?>

<html>
 <head>
  <title>Commit</title>
 </head>
 <body>
<?php
// Iniciar la estructura condicional basada en el valor de $_GET['action']
switch ($_GET['action']) {
    // Si la acción es 'add'
    case 'add':
        // Iniciar una nueva estructura condicional basada en el valor de $_GET['type']
        switch ($_GET['type']) {
            // Si el tipo es 'movie'
            case 'movie':
                // Construir la consulta SQL para insertar datos en la tabla 'movie'
                $query = 'INSERT INTO
                    movie
                        (movie_name, movie_year, movie_type, movie_leadactor,
                        movie_director)
                    VALUES
                        ("' . $_POST['movie_name'] . '",
                         ' . $_POST['movie_year'] . ',
                         ' . $_POST['movie_type'] . ',
                         ' . $_POST['movie_leadactor'] . ',
                         ' . $_POST['movie_director'] . ')';
                break;
            // Si el tipo es 'people'
            case 'people':
                // Construir la consulta SQL para insertar datos en la tabla 'people'
                $query = 'INSERT INTO
                    people
                        (people_fullname, people_isactor, people_isdirector)
                    VALUES
                        ("' . $_POST['people_fullname'] . '",
                         ' . (isset($_POST['people_isactor']) ? 1 : 0) . ',
                         ' . (isset($_POST['people_isdirector']) ? 1 : 0) . ')';
                break;
        }
        break;
    // Si la acción es 'edit'
    case 'edit':
        // Iniciar una nueva estructura condicional basada en el valor de $_GET['type']
        switch ($_GET['type']) {
            // Si el tipo es 'movie'
            case 'movie':
                // Construir la consulta SQL para actualizar datos en la tabla 'movie'
                $query = 'UPDATE movie SET
                        movie_name = "' . $_POST['movie_name'] . '",
                        movie_year = ' . $_POST['movie_year'] . ',
                        movie_type = ' . $_POST['movie_type'] . ',
                        movie_leadactor = ' . $_POST['movie_leadactor'] . ',
                        movie_director = ' . $_POST['movie_director'] . '
                    WHERE
                        movie_id = ' . $_POST['movie_id'];
                break;
            // Si el tipo es 'people'
            case 'people':
                // Construir la consulta SQL para actualizar datos en la tabla 'people'
                $query = 'UPDATE people SET
                        people_fullname = "' . $_POST['people_fullname'] . '",
                        people_isactor = ' . (isset($_POST['people_isactor']) ? 1 : 0) . ',
                        people_isdirector = ' . (isset($_POST['people_isdirector']) ? 1 : 0) . '
                    WHERE
                        people_id = ' . $_POST['people_id'];
                break;
        }
        break;
}

// Verificar si la variable $query está definida
if (isset($query)) {
    // Ejecutar la consulta SQL y manejar cualquier error
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
}
?>
  <p>Done!</p>
 </body>
</html>

