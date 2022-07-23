<?php 

require 'includes/funciones.php';
incluirTemplate("header");

?>

    <main class="contenedor seccion">
        <h1>Sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen-nosotros">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img src="build/img/nosotros.jpg" alt="Sobre Nosotros" loading="lazy">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>25 años de experiencia</blockquote>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque quis tincidunt odio, at viverra turpis. Cras eget facilisis libero. Morbi eget odio quam. Mauris erat nibh, ullamcorper eget metus interdum, pellentesque aliquam eros. Cras sit amet neque quam. Donec rhoncus semper nibh, non finibus nulla consequat in. Sed accumsan lacus eu tortor faucibus bibendum. Etiam feugiat nisl nec elit dictum, nec finibus purus mattis. Nullam condimentum ante id bibendum ullamcorper. Donec aliquet, augue id fermentum mattis, nisi ante cursus massa, ut euismod nulla justo at est. Sed turpis dui, maximus sit amet nibh nec, venenatis molestie orci. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam tincidunt, orci vel consequat lobortis, odio tortor fermentum mi, eget maximus ante augue a lorem.</p>

                <p>Vestibulum scelerisque finibus leo, in ultricies eros dictum at. Integer eu orci nec magna fringilla hendrerit. Nullam eget lectus neque. Nulla quis lacus nunc. Nullam eu nulla quam. Sed malesuada nibh vel pellentesque sollicitudin. Quisque cursus posuere sem, sed placerat lorem tincidunt vitae. Ut sapien lacus, rhoncus nec purus non, tempor finibus leo.</p>
            </div>
        </div>

    </main>

    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum at quae aliquid dicta est repellat consectetur culpa, ipsum, qui, illo laborum error omnis. Ratione quos, assumenda tempora expedita unde consequatur!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum at quae aliquid dicta est repellat consectetur culpa, ipsum, qui, illo laborum error omnis. Ratione quos, assumenda tempora expedita unde consequatur!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Rapidez</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum at quae aliquid dicta est repellat consectetur culpa, ipsum, qui, illo laborum error omnis. Ratione quos, assumenda tempora expedita unde consequatur!</p>
            </div>
        </div>

    </section>
    
    <?php 
    incluirTemplate("footer");
    ?>
