<?php 
    //Importar base de datos
    require __DIR__ . '/../config/database.php'; //DIR te permite hacer referencia a la carpeta del archivo
    $db = conectarDB();
    $db->set_charset('utf8');

    //Consultar
    $query = "SELECT * FROM propiedades LIMIT ${limite}";

    //Leer los resultados
    $resultado = mysqli_query($db, $query);

    //Función 
    function truncate(string $texto, int $cantidad) : string
    {
        if(strlen($texto) >= $cantidad) {
            return substr($texto, 0, $cantidad) . "...";
        } else {
            return $texto;
        }
    }
    
?>

<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
                <div class="anuncio">
                    
                    <img src="/imagenes/<?php echo $propiedad['imagen'];?>" alt="anuncio" loading="lazy">
                    
                    <div class="contenido-anuncio">
                        <h3><?php 
                            echo truncate($propiedad['titulo'],20);
                            ?>
                        </h3>
                        <p><?php 
                            echo truncate($propiedad['descripcion'], 100);
                        ?>
                        </p>
                        <p class="precio"><?php echo $propiedad['precio'];?>€</p>
                        <ul class="iconos-caracteristicas">
                            <li>
                                <img class="iconos" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                                <p><?php echo $propiedad['wc'];?></p>
                            </li>
                            <li>
                                <img class="iconos" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                                <p><?php echo $propiedad['estacionamiento'];?></p>
                            </li>
                            <li>
                                <img class="iconos" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                                <p><?php echo $propiedad['habitaciones'];?></p>
                            </li>
                        </ul>
    
                        <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">
                            Ver Propiedad
                        </a>
                    </div> <!--.contenido-anuncio-->
                </div> <!--.anuncio-->
    <?php endwhile; ?>

            </div> <!--.contenedor-anuncios-->

<?php 
    //Cerar la conexión
    mysqli_close($db);
?>