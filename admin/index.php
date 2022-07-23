<?php

    require '../includes/funciones.php';
    
    //Comprobar si esta logeado
    $auth = estaAutenticado();

    if(!$auth) {
        header('location: /');
    }

    //1.Importar la conexión
    require '../includes/config/database.php';
    $db = conectarDB();
    $db->set_charset('utf8');

    //2.Escribir el Query
    $query = "SELECT * FROM propiedades";

    //3.Consultar la base de datos
    $resultadoConsulta = mysqli_query($db, $query);

    //Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null; //revisa que haya un get, sino es null

    //Validación id botón eliminar
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];
      $id = filter_var($id, FILTER_VALIDATE_INT);

      if ($id) {
        
        //Eliminar el archivo
        $query = "SELECT imagen FROM propiedades WHERE id = ${id}";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);

        unlink('../imagenes/' . $propiedad['imagen']);

        //Eliminar la propiedad 
        $query = "DELETE FROM propiedades WHERE id = ${id}";
        $resultado = mysqli_query($db, $query);

        //Redireccionar
        if($resultado) {
            header('location: /admin');
        }
      }
    }
    //Incluye un template
    incluirTemplate('header');

?>

<main class="contenedor secction">
    <h1>Administrador de Bienes Raices</h1>
    <?php if (intval($resultado) === 1): ?> <!--intval convierte a valor entero-->
        <p class="alerta exito">Anuncio Creado Correctamente</p>
    <?php elseif (intval($resultado) === 2): ?> 
        <p class="alerta exito">Anuncio Actualizado Correctamente</p>
    <?php elseif (intval($resultado) === 3): ?> 
        <p class="alerta error">Anuncio Eliminado Correctamente</p>
    <?php endif;?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Accciones</th>
            </tr>
        </thead>

        <tbody><!--4.Mostrar los datos-->
        <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
            <tr>
                <td><?php echo $propiedad['id']; ?></td>
                <td><?php echo $propiedad['titulo']; ?></td>
                <td><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"></td>
                <td><?php echo $propiedad['precio']; ?> €</td>
                <td>
                    <form method="POST" class="w-100">
                        <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-verde-block">Actualizar</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php
    incluirTemplate('footer');
    //Cerrar la conexión
    mysqli_close($db);
?>