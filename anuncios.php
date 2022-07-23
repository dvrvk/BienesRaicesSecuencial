<?php 

require 'includes/funciones.php';
incluirTemplate("header");

?>

    <main class="contenedor seccion">

        <section class="seccion contenedor">
            <h2>Casas en Venta</h2>
            <?php 
                $limite = 10;
                include 'includes/templates/anuncios.php';
            ?>
            <div class="alinear-derecha">
                <a href="anuncios.php" class="boton-verde">Ver Todas</a>
            </div>
    
        </section>
    </main>

    <?php 

    incluirTemplate("footer");

    ?>
