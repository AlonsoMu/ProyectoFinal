<?php




require_once '../models/Colaborador.php';

if (isset($_POST['operacion'])){

  $colaborador = new Colaborador();

  if($_POST['operacion'] == 'listar'){
    $data = $colaborador->listarColaboradores();

    if ($data){
        $numeroFila = 1;
        $datosColaborador = '';
        $botonNulo = " <a href='#' class='btn btn-sm btn-warning' title='No tiene documento'><i class='bi bi-eye-slash-fill'></i></a>";
        
        foreach($data as $registro){
            $datosColaborador = $registro['apellidos'] . ' ' . $registro['nombres'];

            //La primera parte a RENDERIZAR, es lo standard (siempre se muestra) 
            echo "
                <tr>
                <td>{$numeroFila}</td>
                <td>{$registro['apellidos']}</td>
                <td>{$registro['nombres']}</td>
                <td>{$registro['cargo']}</td>
                <td>{$registro['sede']}</td>
                <td>{$registro['telefono']}</td>
                <td>{$registro['tipocontrato']}</td>
                <td>{$registro['direccion']}</td>

                <td>
                    <a href='#' data-idcolaborador='{$registro['idcolaborador']}' class='btn btn-sm btn-danger eliminar'><i class='bi bi-trash3'></i></a>
                    <a href='#' class='btn btn-sm btn-info'><i class='bi bi-pencil-fill'></i></a>";
            
            //La segunda parte a RENDERIZAR, es el botón VER FOTOGRAFÍA
            if ($registro['cv'] == ''){
                echo $botonNulo;
            }else{
                echo " <a href='../views/pdf/documento/{$registro['cv']}' data-lightbox='{$registro['idcolaborador']}' data-title='{$datosColaborador}' class='btn btn-sm btn-warning' target='_blank'> <i class='bi bi-file-earmark-pdf-fill'></i></a>";
            }

            //La tercera parte a RENDERIZAR, cierre de la fila
            echo "
                </td>
                </tr>
            ";

            $numeroFila++;
        }
    }
  }

  if($_POST['operacion'] == 'registrar'){
    //PASO 1: Recolectar todos los valores enviados
    //por la vista y almacenarlos en un array asociativo
    $datosGuardar = [
        "apellidos"     => $_POST['apellidos'],
        "nombres"       => $_POST['nombres'],
        "idcargo"       => $_POST['idcargo'],
        "idsede"        => $_POST['idsede'],
        "telefono"      => $_POST['telefono'],
        "direccion"     => $_POST['direccion'],
        "tipocontrato"  => $_POST['tipocontrato'],
        "cv"            => '',
      ];
  
      //Vamos a verificar si la vista nos envió una FOTOGRAFIA
      if (isset($_FILES['cv'])){
  
        $rutaDestino = '../views/pdf/documento/'; //Carpeta
        $fechaActual = date('c'); //C = Complete, AÑO/MES/DIA/HORA/MINUTO/SEGUNDO
        $nombreArchivo = sha1($fechaActual) . ".pdf";
        $rutaDestino .= $nombreArchivo;
  
        //Guardamos la fotografía en el servidor
        if (move_uploaded_file($_FILES['cv']['tmp_name'], $rutaDestino)){
          $datosGuardar['cv'] = $nombreArchivo;
        }
  
      }
  
      //PASO 2: Enviar el array al método registrar
      $colaborador->registrarColaborador($datosGuardar);
  
    }
    
    if($_POST['operacion'] == 'eliminar'){
      $idcolaborador = $_POST['idcolaborador'];
      $registro = $colaborador->obtenerColaborador($idcolaborador);
      
      if ($registro['cv']) {
        $rutaArchivo = '../views/pdf/documento/' . $registro['cv'];
        if (file_exists($rutaArchivo)) {
          unlink($rutaArchivo);
        }
      }
  
      $colaborador->eliminarColaborador($idcolaborador);
      
    }

      if($_POST['operacion'] =='obt_pdf'){
        $idcolaborador = $_POST['idcolaborador'];
        $archivopdf = $colaborador->obtenerColaborador($idcolaborador);

        echo $archivopdf;
      }
  }

