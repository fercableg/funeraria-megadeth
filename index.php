<?php

// iniciar o reanudar la sesión del usuario actual
session_start();

//echo '<pre>';
//var_dump($_SERVER);
//echo '</pre>';

if (isset($_SESSION['user_id'])){
    //el usuario está logueado
    header("Location: dashboard/");
    exit(); //siempre que haya un redireccionamiento
} else{
    //si no hay SESSION es porque no hay usuario
    header("Location: user/login");
    exit();
}
?>