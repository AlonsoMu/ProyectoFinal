<?php
session_start();
if(!isset($_SESSION["login"])){
  header("location:../index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COLABORADORES</title>
</head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- Íconos de Bootstrap-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
<body>
  <!-- Modal trigger button -->
  <!--<button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modal-colaboradores">
    Formulario Colaboradores
  </button>-->

  <div class="container mt-3">
    <div class="card table-responsive">
      <div class="card-header bg-primary text-light">
        <div class="row">
          <div class="col-md-6">
            <strong>COLABORADORES</strong>
          </div>
          <div class="col-md-6 text-end">
            <button class="btn btn-success btn-sm" id="abrir-modal" data-bs-toggle="modal" data-bs-target="#modal-colaboradores"><i class="bi bi-plus-circle"></i> Agregar colaborador</button>
          </div>
        </div> 
      </div>
    

  <div class="card-body">
      <div class="table-responsive">   
        <table class="table table-striped table-sm" id="tabla-colaboradores" >
          <colgroup>
            <col width = "3%">
            <col width = "13%">
            <col width = "11%">
            <col width = "11%">
            <col width = "11%">
            <col width = "11%">
            <col width = "18%">
            <col width = "10%">
            <col width = "25%">
        </colgroup>
          <thead>
            <tr>
              <th>#</th>
              <th>Apellidos</th>
              <th>Nombres</th>
              <th>Cargo</th>
              <th>Sede</th>
              <th>Telefono</th>
              <th>Tipo Contrato</th>
              <th>Direccion</th>
              <th>Operaciones</th>

            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>


    <div class="card-footer text-end d-flex justify-content-between">
      <button type="button" class="btn btn-danger me-2" onclick="confirmLogout()">
        <i class="bi bi-box-arrow-right"></i> Cerrar sesión
      </button>
      <a href="entrada.php" class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Volver</a>
    </div>

    <script>
    function confirmLogout() {
      Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Quieres cerrar sesión?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cerrar sesión',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = '../controllers/usuario.controller.php?operacion=finalizar';
        }
      })
    }
    </script>

  <!-- Modal Body -->
  <div class="modal fade" id="modal-colaboradores" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary text-light">
          <h5 class="modal-title" id="modalTitleId">Registro de colaboradores</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
          <form action="" autocomplete="off" id="formulario-colaboradores" > <!--enctype = "multipart/form-data" -->
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control form-control-sm" id="apellidos">
              </div>
              <div class="mb-3 col-md-6">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" class="form-control form-control-sm" id="nombres">
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="cargo" class="form-label">Cargo:</label>
                <select name="cargo" id="cargo" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
              <div class="mb-3 col-md-6">
                <label for="sede" class="form-label">Sede:</label>
                <select name="sede" id="sede" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="telefono" class="form-label">Telefono:</label>
                <input type="text" class="form-control form-control-sm" id="telefono">
              </div>
              <div class="mb-3 col-md-6">
                <label for="direccion" class="form-label">Direccion:</label>
                <input type="text" class="form-control form-control-sm" id="direccion">
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="tipocontrato" class="form-label">Tipo contrato:</label>
                <select name="tipocontrato" id="tipocontrato" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                  <option value="P">Parcial</option>
                  <option value="C">Completo</option>
                </select>
              </div>
              <div class="mb-3 col-md-6">
                <label for="curriculum" class="form-label">Curriculum Vitae:</label>
                <input type="file" id="curriculum" accept=".pdf" class="form-control form-control-sm">
              </div>
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-sm btn-primary" id="guardar-colaborador">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function (){
      
      function obtenerSedes(){
        $.ajax({
          url: '../controllers/sede.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function(result){
            $("#sede").html(result);
          }
          
        });
        
      }
       
      //PARA QUE FUNCIONE LA SELECCION
      //obtenerSedes();
      

      function obtenerCargos(){
        $.ajax({
          url: '../controllers/cargo.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function(result){
            $("#cargo").html(result);
          }
          
        });
        
      }
      //obtenerCargos();

      function mostrarColaboradores(){
        $.ajax({
          url: '../controllers/colaborador.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function(result){
            $("#tabla-colaboradores tbody").html(result);
          }
        });
      }
      mostrarColaboradores();

      function registrarColaborador(){
        var formData = new FormData();

        formData.append("operacion", "registrar");
        formData.append("apellidos", $("#apellidos").val());
        formData.append("nombres", $("#nombres").val());
        formData.append("idcargo", $("#cargo").val());
        formData.append("idsede", $("#sede").val());
        formData.append("telefono", $("#telefono").val());
        formData.append("direccion", $("#direccion").val());
        formData.append("tipocontrato", $("#direccion").val());
        formData.append("cv", $("#curriculum")[0].files[0]);

        $.ajax({
            url: '../controllers/colaborador.controller.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(){
              $("#formulario-colaboradores")[0].reset();
              $("#modal-colaboradores").modal("hide");
              Swal.fire({
                title: 'Guardado correctamente',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              }).then((result) => {
                mostrarColaboradores();
              });  
            }
        });
      }
      

      function preguntarRegistro(){
        Swal.fire({
          icon: 'question',
          title: 'Colaboradores',
          text: '¿Está seguro de registrar al colaborador?',
          footer: 'Desarrollado con PHP',
          confirmButtonText: 'Aceptar',
          confirmButtonColor: '#3498DB',
          showCancelButton: true,
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          //Identificando acción del usuario
          if (result.isConfirmed){
            registrarColaborador();
          }
        });
      }

      $("#tabla-colaboradores tbody").on("click",".eliminar", function(){
        const idcolaboradorEliminar = $(this).data("idcolaborador");
        Swal.fire({
          title: '¿Estás seguro de que deseas eliminar este colaborador?',
          text: "Esta acción no se puede deshacer.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#33B8FF',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, eliminar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '../controllers/colaborador.controller.php',
              type: 'POST',
              data: {
                operacion: 'eliminar',
                idcolaborador: idcolaboradorEliminar
              },
              success: function(result){
                if(result == ""){
                  mostrarColaboradores();
                }
              }
            });
            Swal.fire(
              '¡Eliminado!',
              'El colaborador ha sido eliminado.',
              'success'
            )
          }
        })
      });

      $("#guardar-colaborador").click(preguntarRegistro);

      $("#modal-colaboradores").on("shown.bs.modal", event => {
        $("#apellidos").focus();

        obtenerSedes();
        obtenerCargos();
      });

      
    });
    
  </script>
</body>
</html>