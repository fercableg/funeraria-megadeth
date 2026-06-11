<?php

session_start();

if (!isset($_SESSION['user_id'])){
    //si no hay SESSION es porque no hay usuario
    header("Location: ../");
    exit(); //siempre que haya un redireccionamiento
}