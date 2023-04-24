<?php

require_once 'Conexion.php';

// extends : Herencia (PDO) en php
class Estudiante extends Conexion{

  // Objeto que almacena la conexion que viene desde el padre (Conexion) y la compartira con todos los metodos (CRUD)
  private $accesoBD;

  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion();
  }

  

  //Datos[] es un array asociativo, que contiene la información
  //a guardar proveniente del controlador
  public function registrarEstudiante($datos = []){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_estudiantes_registrar(?,?,?,?,?,?,?,?)");
      $consulta->execute(
        array(
          $datos['apellidos'], 
          $datos['nombres'], 
          $datos['tipodocumento'],
          $datos['nrodocumento'],
          $datos['fechanacimiento'],
          $datos['idcarrera'],
          $datos['idsede'],
          $datos['fotografia']
        )
      );
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function listarEstudiantes(){
    try{
      //1. Preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_estudiantes_listar()");
      //2. Ejecutamos la consulta 
      $consulta->execute();

      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  // La funcion listarEstudiantes devuelve un arreglo asociativo que contiene la informacion de los
  // cargos en la base de datos, y en caso de que ocurra alguen error en la consulta
  // mostrara un error en la pantalla

  public function obtenerEstudiante($idestudiante = 0){
    try{
        //1. Preparamos la consulta
        $consulta = $this->accesoBD->prepare("CALL spu_obtener_estudiantes(?)");
        //2. Ejecutamos la consulta 
        $consulta->execute(array($idestudiante));
        $registro = $consulta->fetch();
  
        return $registro;
      }
      catch(Exception $e){
        die($e->getMessage());
      }
    }
    // La funcion obtenerEstudiante obtiene un registro de un estudiante (fotorgrafia) en la BD

  public function eliminarEstudiante($idestudiante = 0){
    try {
      //1. Preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_estudiantes_eliminar(?)");
      //2. Ejecutamos la consulta 
      $consulta->execute(array($idestudiante));
      
      return true;

    }catch (Exception $e) {
      die($e->getMessage());
    }
  }
    // La funcion eliminarEstudiante elimina un registro de un colaborador en la BD
    // mediante el ID

}