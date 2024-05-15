<?php 
// Para poder utilizar variables de otros ficheros
session_start();

// Condicionale donde si no existe la variable la crea y la define
if (!$_SESSION["display"]) {
$_SESSION["display"] = "none";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluacion PHP</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img_customers/customer_icon_149954.ico" type="image/x-icon">
</head>

<body>
    <header>
        <h1>Identificate para acceder</h1>
    </header>
    <main>
        <!-- El formulario se gestionara con el metodo post y se dirigira al fichero customer -->
        <form action="customer.php" method="POST">
            <fieldset>
                <legend>Identificación</legend>
                <div>
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email">
                </div>
                <div>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password">
                </div>
                <div>
                    <button type="submit">Iniciar sesión</button>
                </div>
                <div>
                    <button type="reset">Borrar datos</button>
                </div>
            </fieldset>
        </form>
    </main>
    <!-- Este div es el cuadro del mensaje que aparecera en caso de que haya errores en los datos del usuario -->
    <!-- En caso de que los datos no coincidan con los del json nos regresamos a esta pagina con la variable $_SESSION["display"] = block -->
    <div class="mensaje" style="display:<?=$_SESSION["display"]?>; background-color: #f0f0f0;">
        <p >Usuario no encontrado, email o contraseña incorrectos</p>
    </div>
</body>

</html>

<!-- Vuelvo a dejar el valor en none, porque sino, una vez que ha tomado el valor block se queda asi todo el tiempo -->
<?php $_SESSION["display"] = "none";?>