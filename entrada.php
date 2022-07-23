<?php 

require 'includes/funciones.php';
incluirTemplate("header");

?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Terraza en el techo de tu casa</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img lloading="lazy" src="build/img/destacada2.jpg" alt="Imagen de la propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque quis tincidunt odio, at viverra turpis. Cras eget facilisis libero. Morbi eget odio quam. Mauris erat nibh, ullamcorper eget metus interdum, pellentesque aliquam eros. Cras sit amet neque quam. Donec rhoncus semper nibh, non finibus nulla consequat in. Sed accumsan lacus eu tortor faucibus bibendum. Etiam feugiat nisl nec elit dictum, nec finibus purus mattis. Nullam condimentum ante id bibendum ullamcorper. Donec aliquet, augue id fermentum mattis, nisi ante cursus massa, ut euismod nulla justo at est. Sed turpis dui, maximus sit amet nibh nec, venenatis molestie orci. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam tincidunt, orci vel consequat lobortis, odio tortor fermentum mi, eget maximus ante augue a lorem.</p>

            <p>Vestibulum scelerisque finibus leo, in ultricies eros dictum at. Integer eu orci nec magna fringilla hendrerit. Nullam eget lectus neque. Nulla quis lacus nunc. Nullam eu nulla quam. Sed malesuada nibh vel pellentesque sollicitudin. Quisque cursus posuere sem, sed placerat lorem tincidunt vitae. Ut sapien lacus, rhoncus nec purus non, tempor finibus leo.</p>

        </div>
    </main>

    <?php 
    incluirTemplate("footer");
    ?>
    
