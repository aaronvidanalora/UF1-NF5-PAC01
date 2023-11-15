<?php
// Establecer la conexión con la base de datos
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
// Seleccionar la base de datos
mysqli_select_db($db,'moviesite') or die(mysqli_error($db));

// Verificar si la acción es 'edit'
if ($_GET['action'] == 'edit') {
    // Recuperar la información del registro
    $query = 'SELECT
            people_fullname, people_isactor, people_isdirector
        FROM
            people
        WHERE
            people_id = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    // Extraer los resultados en variables individuales
    extract(mysqli_fetch_assoc($result));
} else {
    // Establecer valores predeterminados en caso de que la acción no sea 'edit'
    $people_fullname = '';
    $people_isactor = 0;
    $people_isdirector = 0;
}
?>
<html>
 <head>
  <title><?php echo ucfirst($_GET['action']); ?> Person</title>
 </head>
 <body>
  <!-- Formulario para editar o añadir información de una persona -->
  <form action="commit.php?action=<?php echo $_GET['action']; ?>&type=people"
   method="post">
   <table>
    <!-- Campo para el nombre completo de la persona -->
    <tr>
     <td>Person Full Name</td>
     <td><input type="text" name="people_fullname"
      value="<?php echo $people_fullname; ?>"/></td>
    </tr>
    <!-- Checkbox para indicar si la persona es actor -->
    <tr>
     <td>Is Actor?</td>
     <td><input type="checkbox" name="people_isactor" value="1" <?php echo ($people_isactor == 1) ? 'checked' : ''; ?> /></td>
    </tr>
    <!-- Checkbox para indicar si la persona es director -->
    <tr>
     <td>Is Director?</td>
     <td><input type="checkbox" name="people_isdirector" value="1" <?php echo ($people_isdirector == 1) ? 'checked' : ''; ?> /></td>
    </tr>
    <!-- Sección para el botón de enviar y un posible campo oculto para la edición -->
    <tr>
     <td colspan="2" style="text-align: center;">
<?php
// Si la acción es 'edit', agregar un campo oculto con el ID de la persona
if ($_GET['action'] == 'edit') {
    echo '<input type="hidden" value="' . $_GET['id'] . '" name="people_id" />';
}
?>
      <!-- Botón de enviar el formulario -->
      <input type="submit" name="submit"
       value="<?php echo ucfirst($_GET['action']); ?>" />
     </td>
    </tr>
   </table>
  </form>
 </body>
</html>
