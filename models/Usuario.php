<?php
session_start();
require_once 'Conexion.php';

// extends : Herencia (PDO) en php
class Usuario extends Conexion{

    // Objeto que almacena la conexion que viene desde el padre (Conexion) y la compartira con todos los metodos (CRUD)
  private $accesoBD;

   public function __CONSTRUCT(){
      $this->accesoBD = parent::getConexion(); //El valor de retorno de esta funcion ha sido asignada a este objeto. Si getConexion devuelve el retorno al acceso.
    }

   public function iniciarSesion($nombreUsuario = ""){
    try{
      //1. Preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_usuarios_login(?)");
      //2. Ejecutamos la consulta 
      $consulta->execute(array($nombreUsuario));
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }
  // La funcion listarSedes devuelve un arreglo asociativo que contiene la informacion de los
  // cargos en la base de datos, y en caso de que ocurra alguen error en la consulta
  // mostrara un error en la pantalla
}