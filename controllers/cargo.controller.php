<?php

// Una vez que el archivo es incluido(../models/Cargo.php), se pueden utilizar las clases, funciones 
//y variables que se encuentran en él en el archivo actual.

require_once '../models/Cargo.php'; 


//Isset : Determina si una variable está definida y no es NULL 
//retorna TRUE si la variable existe y tiene un valor diferente de NULL, y FALSE en caso contrario.
if (isset($_POST['operacion'])){ 

  $cargo = new Cargo();

  if ($_POST['operacion'] == 'listar'){

    $data = $cargo->listarCargos();
    
    //Enviar los datos a la vista
    //Si contiene información, si no está vacío...
    if ($data){
      echo "<option value='' selected>Seleccione</option>";
      foreach($data as $registro){
        echo "<option value='{$registro['idcargo']}'>{$registro['cargo']}</option>";
      }
    }else{
      echo "<option value=''>No encontramos datos</option>";
    }
  }

}