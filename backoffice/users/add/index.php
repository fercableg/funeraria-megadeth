<?php
echo '<pre>';
var_dump($_POST);

echo '<hr>';

session_start();
$_SESSION['errores'] = ['mantenedor' => 'usuarios'];

if ($_POST['email'] == ""){
    $_SESSION['errores']['items']['email'] = 'Debe ingresar un email';
}
if ($_POST['name'] == ""){
    $_SESSION['errores']['items']['name'] = 'Debe ingresar un Nombre al usuario';
}
if ($_POST['lastname'] == ""){
    $_SESSION['errores']['items']['lastname'] = 'Debe ingresar un apellido al usuario';
}

var_dump($_SESSION);
echo '</pre>';

echo '<hr>';


if (count($_SESSION['errores']['items']) > 0) {
    echo 'Errores: ' . count($_SESSION['errores']['items']);
    header("Location: ../");
}
