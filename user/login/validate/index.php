<?php

session_start();

if (isset($_SESSION['user_id'])){
    //el usuario ya está logueado
    header("Location: ../../../dashboard/");
    exit(); //siempre que haya un redireccionamiento
}

$formUsername = $_POST['username'];
$formPassword = $_POST['password'];

$user = 'benjamin.gomez2@mail.udp.cl';
$pass = 'holaMundo!';

if ($user === $formUsername && $pass === $formPassword){
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = 'Profe :)';

    header("Location: ../../../dashboard/");
    exit();
}

echo 'user y pass malos...';