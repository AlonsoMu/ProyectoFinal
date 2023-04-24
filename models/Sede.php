<?php

require_once 'Conexion.php';
// extends : Herencia (PDO) en php
class Sede extends Conexion{

  // Objeto que almacena la conexion que viene desde el padre (Conexion) y la compartira con todos los metodos (CRUD)
  private $accesoBD;

  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion(); // El valor de retorno (getConexion) de esta funcion ha sido asignada a este objeto(accesoBD)
  }

  public function listarSedes(){
    try{
      //1. Preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_sedes_listar()");
      //2. Ejecutamos la consulta 
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }
  // La funcion listarSedes devuelve un arreglo asociativo que contiene la informacion de los
  // cargos en la base de datos, y en caso de que ocurra alguen error en la consulta
  // mostrara un error en la pantalla
}