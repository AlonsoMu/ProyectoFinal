<?php

require_once 'Conexion.php';

// extends : Herencia (PDO) en php
class Colaborador extends Conexion{

  // Objeto que almacena la conexion que viene desde el padre (Conexion) y la compartira con todos los metodos (CRUD)
  private $accesoBD;

  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion();
 }

  
  //Datos[] es un array asociativo, que contiene la información
  //a guardar proveniente del controlador
  public function registrarColaborador($datos = []){
    try {
        $consulta = $this->accesoBD->prepare("CALL spu_colaboradores_registrar(?,?,?,?,?,?,?,?)");
        $consulta->execute(
          array(
            $datos['apellidos'], 
            $datos['nombres'], 
            $datos['idcargo'],
            $datos['idsede'],
            $datos['telefono'],
            $datos['direccion'],
            $datos['tipocontrato'],
            $datos['cv']
          )
        );
    }
    catch (Exception $e) {
    die($e->getMessage());
    }
  }

  // La funcion registrarColaborador inserta un registro en la BD con la informacion de un colaborador
  // los parametros se obtiene del arreglo $datos que se pasa como parametro a la funcion

  public function listarColaboradores(){
    try{
        $consulta = $this->accesoBD->prepare("CALL spu_colaboradores_listar()");
        $consulta->execute();
  
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
      }
      catch(Exception $e){
        die($e->getMessage());
      }
    }
    // La funcion listarColaboradores devuelve un arreglo asociativo que contiene la informacion de los
    // colaboradores en la base de datos, y en caso de que ocurra alguen error en la consulta
    // mostrara un error en la pantalla


  public function eliminarColaborador($idcolaborador = 0){
    try {
        $consulta = $this->accesoBD->prepare("CALL spu_colaboradores_eliminar(?)");
        $consulta->execute(array($idcolaborador));

      }
      catch (Exception $e) {
        die($e->getMessage());
      }
    }

    // La funcion eliminarColaborador elimina un registro de un colaborador en la BD
    // mediante el ID


  public function obtenerColaborador($idcolaborador = 0){
    try{
        $consulta = $this->accesoBD->prepare("CALL spu_obtener_colaboradores(?)");
        $consulta->execute(array($idcolaborador));
        $consulta = $consulta->fetch();
        return $consulta;
      }
      catch(Exception $e){
        die($e->getMessage());
      }
    }
    // La funcion obtenerColaborador obtiene un registro de un colaborador (cv) en la BD

    
}
  