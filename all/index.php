<?php

// Obtener los datos del JSON
$json = file_get_contents("../customers.json");
$customers = json_decode($json, true);
// print_r($customers); Probando la captura del JSON

// Funcion para ordenar la fecha de nacimiento
function organizarFecha($fecha)
{
    $birth = explode("-", $fecha);
    $birthOK = $birth[2] . "-" . $birth[1] . "-" . $birth[0];
    return $birthOK;
}

// Probando la función
// organizarFecha($datebirth);

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link rel="stylesheet" href="../css/styleAll.css">
    <link rel="shortcut icon" href="../img_customers/customer_icon_149954.ico" type="image/x-icon">

</head>

<body>
    <main>
        <h1>Nuestros clientes</h1>
        <div class="cards">
            <!-- Bucle foreach de php para incrustar los valores obtenidos del json en el html -->
            <?php foreach ($customers as $row) : ?>
                <div class="card">
                    <div>
                        <img src="../img_customers/<?= $row["foto"]; ?>" alt="foto del usuario">
                    </div>
                    <div>
                        <p>Nombre: <strong> <?= $row["name"]; ?></strong></p>
                        <p>Apellido: <strong> <?= $row["surname"]; ?><</strong></p>
                        <p>Edad: <strong> <?= organizarFecha($row["dateBirth"]); ?></strong></p>
                        <p>Email: <strong> <?= $row["email"]; ?></strong></p>
                    </div>
                </div>

            <?php endforeach ?>
        </div>
    </main>
</body>

</html>