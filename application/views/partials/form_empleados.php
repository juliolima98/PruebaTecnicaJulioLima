<!DOCTYPE html>
<html>
<head>
  <title>Nuevo Empleado</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="http://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js" type="text/javascript"></script>
</head>
<style type="text/css">
  .error {
    color: red !important;
    display: block;
  }
</style>
<form id="formEmpleado" autocomplete="off" method="post">
  <div class="row">
    <div class="form-group col-md-4">
      <label class="label-required">Nombre empleado:</label>
      <input type="text" class="form-control" name="nombreEmpleado" id="nombreEmpleado" placeholder="Nombre Empleado" value="<?php echo isset($empleado) ? $empleado["NOMBRE_EMPLEADO"] : '' ?>">
    </div>
    <div class="form-group col-md-4">
      <label for="apellidosEmpleado">Apellidos empleados:</label>
      <input type="text" class="form-control" name="apellidosEmpleado" id="apellidosEmpleado" placeholder="Apellidos Empleado" value="<?php echo isset($empleado) ? $empleado["APELLIDO_EMPLEADO"] : '' ?>">
    </div>
    <div class="form-group col-md-4">
      <label for="direccionEmpleado">Direccion empleado:</label>
      <input type="text" class="form-control" name="direccionEmpleado" id="direccionEmpleado" placeholder="Direccion Empleado" value="<?php echo isset($empleado) ? $empleado["DIRECCION_EMPLEADO"] : '' ?>">
    </div>
    <div class="form-group col-md-4">
      <label for="TelefonoEmpleado">Telefono empleado:</label>
      <input type="text" class="form-control" name="telefonoEmpleado" id="telefonoEmpleado" placeholder="Telefono Empleado" value="<?php echo isset($empleado) ? $empleado["TELEFONO_EMPLEADO"] : '' ?>">
    </div>
    <div class="form-group col-md-4">
      <label for="sucursal">Sucursal:</label>
      <?php
        $listaSucursal = ['' => '----'] + $listaSucursal;
        $js = 'class="form-control" id="sucursal" style="width:100%;"';
        echo form_dropdown('sucursal',$listaSucursal, isset($empleado) ? $empleado['ID_SUCURSAL'] : '',$js);  
      ?>    
    </div>
    <div class="form-group col-md-4">
      <label for="cargo">Cargo:</label>
      <?php
        $listaCargo = ['' => '----'] + $listaCargo;
        $js = 'class="form-control" id="cargo" style="width:100%;"';
        echo form_dropdown('cargo',$listaCargo, isset($empleado) ? $empleado['ID_CARGO'] : '',$js);  
      ?>    
    </div>
    <div class="form-group col-md-4">
      <label for="estado">Estado:</label>
      <?php
        $listaEstadoEmpleado = ['' => '----'] + $listaEstadoEmpleado;
        $js = 'class="form-control" id="estadoEmpleado" style="width:100%;"';
        echo form_dropdown('estadoEmpleado',$listaEstadoEmpleado,isset($empleado) ? $empleado['ID_ESTADO'] : '',$js);  
      ?>
    </div>
  </div>
  <div class="row justify-content-center">
    <button type="button" class="btn btn-primary btn-lg mb-4 mr-4" id="procesar" onclick="validarCampos();"><i class="fa-solid fa-user"></i> Procesar</button>
    <button type="button" class="btn btn-warning btn-lg mb-4 d-none" id="modificar" onclick="actualizarEmpleado();"><i class="fa-solid fa-pencil"></i> Modificar</button>
  </div>
</form>
</html>

<script type="text/javascript">
    $(document).ready(function() {
       if(window.view == 'edit'){
            $("#modificar").removeClass("d-none");
            $("#procesar").addClass("d-none");
        }
    //Validate js
    $("#formEmpleado").validate({
        rules: {
            nombreEmpleado: {
                required: true
            },
            apellidosEmpleado: {
                required: true
            },
            direccionEmpleado: {
                required: true
            },
            telefonoEmpleado: {
                required: true
            },
            sucursal: {
              required: true
            },
            cargo: {
              required: true
            },
            estadoEmpleado: {
                required: true
            }
        },
        messages: { 
            nombreEmpleado: {
                required: "Por favor, complete el campo"
            },
            apellidosEmpleado: {
                required: "Por favor, complete el campo"
            },
            direccionEmpleado: {
                required: "Por favor, complete el campo"
            },
            telefonoEmpleado: {
                required: "Por favor, complete el campo"
            },
            sucursal: {
              required: "Por favor, complete el campo"
            },
            cargo: {
              required: "Por favor, complete el campo"
            },
            estadoEmpleado: {
              required: "Por favor, complete el campo"
            }
        }
    });
});

  function validarCampos(){
    if($("#formEmpleado").valid() != true){
      return false;
    }else{
      procesarEmpleado();
    }
  }

   function procesarEmpleado(){
        var bodyFormData = new FormData();
        bodyFormData.append('nombreEmpleado',$("#nombreEmpleado").val());
        bodyFormData.append('sucursal',$("#sucursal").val());
        bodyFormData.append('apellidosEmpleado',$("#apellidosEmpleado").val());
        bodyFormData.append('direccionEmpleado',$("#direccionEmpleado").val());
        bodyFormData.append('telefonoEmpleado',$("#telefonoEmpleado").val());
        bodyFormData.append('cargo',$("#cargo").val());
        bodyFormData.append('estadoEmpleado',$("#estadoEmpleado").val());
        return axios({
            method: 'post',
            url: "<?php echo base_url('')?>" + 'index.php/empleados/saveEmpleado',
            data: bodyFormData,
            headers: {'Content-Type': 'multipart/form-data' },
        }).then((result) => {
            location.href = "<?php echo base_url() ?>" + 'index.php/empleados/index';                           
            console.log('exito');
            
        }).catch(error => {
            console.log('error');
        });
  }

  function actualizarEmpleado(){
    var bodyFormData = new FormData();
    if(window.view == 'edit'){
      bodyFormData.append("idEmpleado", window.idEmpleado); //Se manda el id de empleado a la vista de editar
    }
      bodyFormData.append('nombreEmpleado',$("#nombreEmpleado").val());
      bodyFormData.append('sucursal',$("#sucursal").val());
      bodyFormData.append('apellidosEmpleado',$("#apellidosEmpleado").val());
      bodyFormData.append('direccionEmpleado',$("#direccionEmpleado").val());
      bodyFormData.append('telefonoEmpleado',$("#telefonoEmpleado").val());
      bodyFormData.append('cargo',$("#cargo").val());
      bodyFormData.append('estadoEmpleado',$("#estadoEmpleado").val());
      axios({
          method: 'post',
          url: "<?php echo base_url('')?>" + 'index.php/empleados/update',
          data: bodyFormData,
          headers: {'Content-Type': 'multipart/form-data' },
      }).then((result) => {
          //location.href = "<?php //echo base_url() ?>" + 'index.php/empleados/index';   
          var data = JSON.parse(response);
          //console.log(response);
          console.log('exito');
          
      }).catch(error => {
          console.log('error');
      });
  }
</script>