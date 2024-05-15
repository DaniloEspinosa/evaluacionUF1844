<?php
session_start();

// Datos que se envían desde el formulario con el metodo POST
$email = $_POST["email"];
$key = $_POST["password"];

// Declaro las variables que luego utilizare
$name = "";
$surname = "";
$datebirth = "";
$foto = "";

// Obtener los datos del JSON

$json = file_get_contents("./customers.json");
$customers = json_decode($json, true);

// print_r($customers); Probando la captura del JSON

// Esta variable se define false y cuando encuentra el usuario se cambia por true
$usuarioEncontrado = false;

// En este bucle for recorremos el JSON para comparar email y contraseña
for ($i = 0; $i < count($customers); $i++) {
    if ($email === $customers[$i]["email"] && $key === $customers[$i]["key"]) {
        // Cuando se encuentra la coincidencia se le asigna el valor a las variables creadas previamente
        $name = $customers[$i]['name'];
        $surname = $customers[$i]['surname'];
        $datebirth = $customers[$i]['dateBirth'];
        $foto = $customers[$i]['foto'];

        // Se cambia el valor de esta variable para que no entre en la siguiente condicion y regrese al index.php
        $usuarioEncontrado = true;
        break;
    }
}

// En caso que el usuario no se encuentra se mantiene en el index
if ($usuarioEncontrado == false) {
    // Asignamos el valor block a esta variable para mostrar el mensaje en el index
    $_SESSION["display"] = "block";
    // Instruccion para regresar al index
    header("location: index.php");
}

// Funcion que calcula la edad exacta del usuario
function calcularEdad($fecha)
{
    $hoy = explode("-", date("Y-m-d"));
    $hoyYear = $hoy[0];
    $hoyMonth = $hoy[1];
    $hoyDay = $hoy[2];

    $birth = explode("-", $fecha);
    $birthYear = $birth[0];
    $birthMonth = $birth[1];
    $birthDay = $birth[2];

    $edad = $hoyYear - $birthYear;

    if (($hoyMonth < $birthMonth) || (($hoyMonth == $birthMonth) && ($hoyDay < $birthDay))) {
        $edad  = $edad - 1;
    }
    return $edad;
}

// Funcion para organizar la fecha del nacimiento en el formato que la debemos mostrar
function organizarFecha($fecha)
{
    $birth = explode("-", $fecha);
    $birthOK = $birth[2] . "-" . $birth[1] . "-" . $birth[0];
    return $birthOK;
}

// Probando el funcionamiento de las funciones
// calcularEdad($datebirth);
// organizarFecha($datebirth);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img_customers/customer_icon_149954.ico" type="image/x-icon">
</head>

<body>
    <main>
        <div>
            <!-- A partir de aqui se incrustaran los valores obtenidos del JSON en caso de que el email y contraseña eran correctos -->
            <img src="img_customers/<?= $foto; ?>" alt="foto del usuario">
        </div>
        <div>
            <h1>Datos del cliente:</h1>
            <p>Nombre: <?= $name; ?></p>
            <p>Apellido: <?= $surname; ?></p>
            <p>Edad: <?= calcularEdad($datebirth); ?></p>
            <p>Email: <?= $email; ?></p>
        </div>
    </main>
</body>

</html>