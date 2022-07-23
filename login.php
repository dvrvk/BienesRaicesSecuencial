<?php 
//Conectar
require 'includes/config/database.php';
$db = conectarDB();
$db->set_charset('utf8');

//Autenticar el usuario
$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)); //sanitizado + filtrado
    $password = mysqli_real_escape_string($db, $_POST['password']); //sanitizado

    if(!$email) {
        $errores[] = "El email es obligatorio o no es valido";
    }
    if (!$password) {
        $errores[] = "El password es obligatorio o no es valido";
    }

    if(empty($errores)) {
        //Revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email = '${email}'";
        $resultado = mysqli_query($db, $query);

        if($resultado->num_rows) {
            //Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);

            //Verificar si el password es correcto
            $auth = password_verify($password, $usuario['password']); //pasamos el password que meti y el de la bd hasheado 
            
            if($auth) {
                //El usuario esta autenticado
                session_start();

                //LLenar el arreglo de la sesión
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                //Redireccionar tras iniciar sesión
                header('location: /admin');

            } else {
                $errores[] = "El password es incorrecto";
            }

        } else {
            $errores[] = "El usuario no existe";
        }
    }

}


//Incluye el header
require 'includes/funciones.php';
incluirTemplate("header");

?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form class="formulario" method="POST">
        <fieldset>
               <legend>Email y Password</legend> 

               <label for="email">E-mail</label>
               <input type="email" placeholder="Tu email" id="email" name="email">

               <label for="password">Teléfono</label>
               <input type="password" placeholder="Tu password" id="password" name="password">

            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>

<?php 
    incluirTemplate("footer");
?>