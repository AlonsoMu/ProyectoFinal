<?php


require_once '../models/Estudiante.php';

if (isset($_POST['operacion'])){

  $estudiante = new Estudiante();

  if ($_POST['operacion'] == 'registrar'){

    //PASO 1: Recolectar todos los valores enviados
    //por la vista y almacenarlos en un array asociativo
    $datosGuardar = [
      "apellidos"     => $_POST['apellidos'],
      "nombres"       => $_POST['nombres'],
      "tipodocumento" => $_POST['tipodocumento'],
      "nrodocumento"  => $_POST['nrodocumento'],
      "fechanacimiento" => $_POST['fechanacimiento'],
      "idcarrera"     => $_POST['idcarrera'],
      "idsede"        => $_POST['idsede'],
      "fotografia"    => ''
    ];

    //Vamos a verificar si la vista nos envió una FOTOGRAFIA
    if (isset($_FILES['fotografia'])){

      $rutaDestino = '../views/img/fotografias/'; //Carpeta
      $fechaActual = date('c'); //C = Complete, AÑO/MES/DIA/HORA/MINUTO/SEGUNDO
      $nombreArchivo = sha1($fechaActual) . ".jpg";
      $rutaDestino .= $nombreArchivo;

      //Guardamos la fotografía en el servidor
      if (move_uploaded_file($_FILES['fotografia']['tmp_name'], $rutaDestino)){
        $datosGuardar['fotografia'] = $nombreArchivo;
      }

    }

    //PASO 2: Enviar el array al método registrar
    $estudiante->registrarEstudiante($datosGuardar);

  }

  if ($_POST['operacion'] == 'listar'){
    $data = $estudiante->listarEstudiantes();

    if ($data){
      $numeroFila = 1;
      $datosEstudiante = '';
      $botonNulo = " <a href='#' class='btn btn-sm btn-warning' title='No tiene fotografía'><i class='bi bi-eye-slash-fill'></i></a>";
      
      foreach($data as $registro){
        $datosEstudiante = $registro['apellidos'] . ' ' . $registro['nombres'];

        //La primera parte a RENDERIZAR, es lo standard (siempre se muestra)
        echo "
          <tr>
            <td>{$numeroFila}</td>
            <td>{$registro['apellidos']}</td>
            <td>{$registro['nombres']}</td>
            <td>{$registro['tipodocumento']}</td>
            <td>{$registro['nrodocumento']}</td>
            <td>{$registro['fechanacimiento']}</td>
            <td>{$registro['carrera']}</td>
            <td>
              <a href='#' data-idestudiante='{$registro['idestudiante']}' class='btn btn-sm btn-danger eliminar'><i class='bi bi-trash3'></i></a>
              <a href='#' class='btn btn-sm btn-info'><i class='bi bi-pencil-fill'></i></a>";
        
        //La segunda parte a RENDERIZAR, es el botón VER FOTOGRAFÍA
        if ($registro['fotografia'] == ''){
          echo $botonNulo;
        }else{
          echo " <a href='../views/img/fotografias/{$registro['fotografia']}' data-lightbox='{$registro['idestudiante']}' data-title='{$datosEstudiante}' class='btn btn-sm btn-warning'><i class='bi bi-eye-fill'></i></a>";
        }

        //La tercera parte a RENDERIZAR, cierre de la fila
        echo "
            </td>
          </tr>
        ";

        $numeroFila++;
      }
    }
  } //Fin operacion=listar


  //Verifica si se ha recibido un valor llamado 'operacion' mediante el método POST y si ese valor es igual a 'obt_foto
  if($_POST['operacion'] == 'obt_foto'){
    //Obtiene el valor del campo 'idestudiante' enviado desde el formulario HTML y lo asigna a la variable $idestudiante 
    $idestudiante = $_POST['idestudiante'];

    //Crea un objeto de la clase Estudiante y llama al método 'obtenerEstudiante' para obtener la información del
    //estudiante, resultado se asigna a la variable $archivoimg
    $archivoimg= $estudiante->obtenerEstudiante($idestudiante);

    echo $archivoimg;
    //Imprime la variable $archivoimg en la pantalla

  }

  //Verifica si el valor del campo 'operacion' en la solicitud POST es igual a 'eliminar',
  // Si es así, se ejecutará el código para eliminar el estudiante.
  if($_POST['operacion'] == 'eliminar'){

    //Asigna el valor del campo 'idestudiante' de la solicitud POST a la variable $idestudiante
    $idestudiante = $_POST['idestudiante'];

    $registro = $estudiante->obtenerEstudiante($idestudiante);
    //Este valor se utiliza posteriormente para eliminar la fotografía del estudiante, si existe.

    $estudiante->eliminarEstudiante($idestudiante);
    //Elimina el registro del estudiante correspondiente de la base de datos.
  
    
    //Verifica si el estudiante tiene una fotografía guardada en la base de datos,
    //utilizando la variable $registro que se obtuvo anteriormente.
    if ($registro['fotografia']) {


      //Construye una ruta de archivo que apunta a la fotografía del estudiante, 
      //utilizando el nombre de archivo almacenado en la base de datos.
      $rutaArchivo = '../views/img/fotografias/' . $registro['fotografia'];
      if (file_exists($rutaArchivo)) {
        //si el archivo de la fotografía realmente existe en el servidor, utilizando la función file_exists().
        // Si existe, se elimina el archivo utilizando la función unlink()
        unlink($rutaArchivo);
      }
    }
    
  }

}