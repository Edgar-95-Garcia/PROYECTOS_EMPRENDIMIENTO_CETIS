<?php
class conect
{
    private $host;
    private $server;
    private $user;
    private $pass;
    private $data_base;
    private $conexion;
    private $flag;
    private $error_conexion;
    function __construct()
    {
        #$this->user = "cetis_admin";
        $this->user = "proye539_admin";
        #$this->pass = "Cetis@23-/-";
        $this->pass = "2&Z8D5^ad82#";
        $this->server = "mysql:host=mx74.hostgator.mx;dbname=proye539_cetis_emprendimiento";
        #$this->server = "mysql:host=localhost;dbname=cetis_emprendimiento";
        $this->conexion = null;
        $this->flag = false;
        $this->error_conexion = "Error en la conexion a MYSQL";
        date_default_timezone_set("America/Mexico_City");
    }
    function __destruct()
    {
        $this->server = "";
        $this->user = "";
        $this->pass = "";
        $this->data_base = "";
        $this->conexion = null;
        $this->flag = false;
        $this->error_conexion = "";
    }
    function testConection()
    {
        $this->conexion = $this->connect();
        if ($this->conexion) {
            echo "Conexión establecida";
        } else {
            echo "Conexión no establecida";
        }
    }
    function connect()
    {
        try {
            $this->conexion = new PDO($this->server, $this->user, $this->pass);
            $this->flag = true;
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
        }
        return $this->conexion;
    }
    function close()
    {
        $this->conexion = null;
    }
}