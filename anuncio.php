<?php 

//Template
require 'includes/funciones.php';
incluirTemplate("header");

// Obtengo el id
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header("location: index.php");
}

// Conecto a la base de datos
require 'includes/config/database.php';
$db = conectarDB();
$db->set_charset('utf8');

// Consulta
$query = "SELECT * FROM propiedades WHERE id = ${id}";

//Resultado
$resultado = mysqli_query($db, $query);

if($resultado->num_rows === 0) { //Compruebo que nos devuelve algún resultado (accedo al objeto v.330(5.12))
    header("location: index.php");
}

$propiedad = mysqli_fetch_assoc($resultado);
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>

        <img lloading="lazy" src="imagenes/<?php echo $propiedad['imagen']; ?> " alt="Imagen de la propiedad">

        <div class="resumen-propiedad">
            <p class="precio"><?php echo $propiedad['precio']; ?>€</p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="iconos" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img class="iconos" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img class="iconos" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>

            <p>
            <?php echo $propiedad['descripcion']; ?>
            </p>

        </div>
    </main>

    
    <?php 

    incluirTemplate("footer");

    //cerrar conexión
    mysqli_close($db);

    ?>
    