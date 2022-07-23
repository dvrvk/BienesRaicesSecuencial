<?php
    require '../../includes/funciones.php';

    //Comprobar si esta logeado
    $auth = estaAutenticado();

    if(!$auth) {
        header('location: /');
    }

    //Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();
    $db->set_charset('utf8');
    
    //Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensajes de errores
    $errores = [];

    //inicializo las variables (esto me permite guardar los datos por si no paso la validación)
    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorId = '';

    //Se ejecuta tras dar a enviar
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        //Asigno valores POST a las variables -- evito la inyección de código
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db,$_POST['precio']);
        $descripcion = mysqli_real_escape_string($db,$_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db,$_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db,$_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db,$_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string($db,$_POST['vendedor']);
        $creado = date('Y/m/d');

        //Asignar files hacia una variable
        $imagen = $_FILES['imagen'];

        //Validación del formulario
        if(!$titulo) {
            $errores[] ="Debes añadir un título";
        }
        if (!$precio) {
            $errores[] ="El precio es obligatorio";
        }
        if (strlen($descripcion) < 50) { //long descripción < 50
            $errores[] ="La descripción tiene que tener al menos 50 caracteres";
        }
        if (!$habitaciones) {
            $errores[] ="El nº de habitaciones es obligatorio";
        }
        if (!$wc) {
            $errores[] ="El nº de wc es obligatorio";
        }
        if (!$estacionamiento) {
            $errores[] ="El nº de estacionamientos es obligatorio";
        }
        if (!$vendedorId) {
            $errores[] ="Selecciona un vendedor";
        }
        if(!$imagen['name'] || $imagen['error']) {
            $errores[] = "La imagen es obligatoria";
        }

        //Validar por tamaño (1000Kb max) -- bites - kb (máximo 1mb)
        $medida = 1000 * 1000; 
        if($imagen['size'] > $medida) {
            $errores[] = "La imagen es muy pesada";
        } 
        
        //Revisar que el arreglo de errores está vacio (isSet o empty)
            //Si no hay errores se inserta
        if(empty($errores)){ 

            /* Subida de archivos*/

            //1.Crear una carpeta
            $carpetaImagenes ='../../imagenes';
            if (!is_dir($carpetaImagenes)) { //is_dir dice si existe la carpeta
                mkdir($carpetaImagenes);     // Creo la carpeta
            }

            //2. Generar nombre único
            $nombreImagen =md5(uniqid(rand(), true)) . ".jpg";

            //3. Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . "/" . $nombreImagen);
        
            //Insertar datos en la base de datos
            $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId) 
                        VALUES('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId') ";
            
                //echo $query; //Comprobar la consulta

            $resultado = mysqli_query($db, $query);

            if($resultado) {
                //Redireccionar al usuario
                header('Location: /admin?resultado=1');
            };
        }

    }

    //Template
    incluirTemplate('header');



?>

<main class="contenedor secction">
    <h1>Crear</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    
    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>
            
            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" id="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo ?>">

            <label for="precio">Precio:</label>
            <input type="number"  name="precio" id="precio" placeholder="Precio Propiedad" value="<?php echo $precio ?>">

            <label for="imagen">Imagen:</label>
            <input type="file"  name="imagen" id="imagen" accept="image/jpeg, imagen/png" name="imagen">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>
            
            <label for="habitaciones">Habitaciones:</label>
            <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" max="15" value="<?php echo $habitaciones ?>">

            <label for="wc">Baños:</label>
            <input type="number" name="wc" id="wc" placeholder="Ej: 2" min="1" max="15" value="<?php echo $wc ?>">

            <label for="estacionamiento">Plazas Garaje:</label>
            <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej: 1" min="1" max="15" value="<?php echo $estacionamiento ?>">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            
            <select name="vendedor">
                <option value="">->Seleccione<-</option>
                <?php while($vendedor = mysqli_fetch_assoc($resultado)): ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : '' ?>
                    value="<?php echo $vendedor['id'] ?>">
                        <?php echo $vendedor['nombre'] . " " . $vendedor['apellido'] ?>
                    </option>
                <?php endwhile; ?>
            </select>

        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
    incluirTemplate('footer');
?>