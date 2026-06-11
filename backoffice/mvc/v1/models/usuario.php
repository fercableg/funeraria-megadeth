<?php

// CREATE TABLE usuario(
// 	id INT PRIMARY KEY AUTO_INCREMENT,
//     firstname VARCHAR(30) NOT NULL,
//     lastname VARCHAR(30) NOT NULL,
//     username VARCHAR(50) NOT NULL UNIQUE,
//     password VARCHAR(32) NOT NULL,
//     rol INT NOT NULL UNIQUE,
//     datecreate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     dateupdate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     active BOOLEAN NOT NULL DEFAULT FALSE
// );

// INSERT INTO usuario (firstname, lastname, username, password, rol) VALUES ('Benjamín', 'Gómez Estrada', 'benjamin.gomez2@mail.udp.cl', MD5('holaMundo'), 1);
// INSERT INTO usuario (firstname, lastname, username, password, rol) VALUES ('Samuel', 'Hayden', 's.hayden@uac.com', MD5('holaMundo'), 2);


// CREATE TABLE usuario_codigo (
// 	id INT PRIMARY KEY AUTO_INCREMENT,
//     usuarioID INT NOT NULL,
//     codigo VARCHAR(6) NOT NULL,
//     datecrate TIMESTAMP NOT NULL,
//     active BOOLEAN NOT NULL DEFAULT TRUE,
//     CONSTRAINT fk_usucod_usu FOREIGN KEY (usuarioID) REFERENCES usuario(id)
// );

class Usuario 
{
    private $id;
    private $firstname;
    private $lastname;
    private $username;
    private $password;
    private $rol;
    private $dateCreate;
    private $dateUpdate;
    private $active;

    public function __construct() {}

    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->firstname;
    }
    public function getApellido()
    {
        return $this->lastname;
    }
    public function getUsermame()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getRol()
    {
        return $this->rol;
    }
    public function getFechaCreado()
    {
        return $this->dateCreate;
    }
    public function getFechaActualizado()
    {
        return $this->dateUpdate;
    }
    public function isActivo()
    {
        return $this->active;
    }

    public function setId($_n)
    {
        $this->id = $_n;
    }
    public function setNombre($_n)
    {
        $this->firstname = $_n;
    }
    public function setApellido($_n)
    {
        $this->lastname = $_n;
    }
    public function setUsername($_n)
    {
        $this->username = $_n;
    }
    public function setPassword($_n)
    {
        $this->password = md5($_n);
    }
    public function setRol($_n)
    {
        $this->rol = $_n;
    }
    public function setFechaCreado($_n)
    {
        $this->dateCreate = $_n;
    }
    public function setFechaActualizado($_n)
    {
        $this->dateUpdate = $_n;
    }
    public function setActivo($_n)
    {
        $this->active = $_n;
    }

    public function getAll(){
        $lista = [];
        $con = new Conexion();
        $query = "SELECT id, firstname, lastname, username, password, rol, datecreate, dateupdate, active FROM usuario ORDER BY id ASC";
        $rs = mysqli_query($con->getConnection(), $query);
        if($rs){
            while ($registro = mysqli_fetch_assoc($rs)){
                $objeto = new Usuario();
                $objeto->setId($registro['id']);
                $objeto->setNombre($registro['firstname']);
                $objeto->setApellido($registro['lastname']);
                $objeto->setUsername($registro['username']);
                $objeto->setRol($registro['rol']);
                $objeto->setFechaCreado($registro['datecreate']);
                $objeto->setFechaActualizado($registro['dateupdate']);
                $objeto->setActivo($registro['active']);
                array_push($lista, $objeto);
            }
            mysqli_free_result($rs);
        }
        $con->closeConnection();
        return $lista;
    }

    public function powerOn($_id) {
        $con = new Conexion();
        try {
            $query = "UPDATE usuario SET active = 1 WHERE id = ?";
            $stmt = $con->getConnection()->prepare($query);
            $stmt->bind_param(
                "s",
                $_id
            );
            var_dump($stmt);
            $rs = $stmt->execute();
            $stmt->close();
            $con->closeConnection();

            return $rs ? true : false;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }
    public function powerOff($_id) {
        $con = new Conexion();
        try {
            $query = "UPDATE usuario SET active = 0 WHERE id = ?";
            $stmt = $con->getConnection()->prepare($query);
            $stmt->bind_param(
                "s",
                $_id
            );
            var_dump($stmt);
            $rs = $stmt->execute();
            $stmt->close();
            $con->closeConnection();

            return $rs ? true : false;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }
}
