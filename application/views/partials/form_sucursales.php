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
<form id="formSucursal" autocomplete="off" method="post">
  <div class="row">
    <div class="form-group col-md-4">
      <label class="label-required">Nombre Sucursal:</label>
      <input type="text" class="form-control" name="nombreSucursal" id="nombreSucursal" placeholder="Nombre Sucursal" value="<?php echo isset($sucursal) ? $sucursal["NOMBRE_SUCURSAL"] : '' ?>">
    </div>
    <div class="form-group col-md-4">
      <label for="cargo">Cargo:</label>
      <?php
        $listaCargo = ['' => '----'] + $listaCargo;
        $js = 'class="form-control" id="cargo" style="width:100%;"';
        echo form_dropdown('cargo',$listaCargo, isset($sucursal) ? $sucursal['ID_CARGO'] : '',$js);  
      ?>    
    </div>
    <div class="form-group col-md-4">
      <label for="direccionSucursal">Direccion Sucursal:</label>
      <input type="text" class="form-control" name="direccionSucursal" id="direccionSucursal" placeholder="Direccion Sucursal" value="<?php echo isset($sucursal) ? $sucursal["DIRECCION_SUCURSAL"] : '' ?>">
    </div>
    <div class="form-group col-md-4">
      <label for="telefonoSucursal">Telefono Sucursal:</label>
      <input type="text" class="form-control" name="telefonoSucursal" id="telefonoSucursal" placeholder="Telefono Sucursal" value="<?php echo isset($sucursal) ? $sucursal["TELEFONO_SUCURSAL"] : '' ?>">
    </div>
  </div>
  <div class="row justify-content-center">
    <button type="button" class="btn btn-primary btn-lg mb-4 mr-4" id="procesar" onclick="validarCampos();"><i class="fa-solid fa-user"></i> Procesar</button>
    <button type="button" class="btn btn-warning btn-lg mb-4 d-none" id="modificar" onclick="actualizarSucursal();"><i class="fa-solid fa-pencil"></i> Modificar</button>
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
    $("#formSucursal").validate({
        rules: {
            nombreSucursal: {
                required: true
            },
            cargo: {
                required: true
            },
            direccionSucursal: {
                required: true
            },
            telefonoSucursal: {
                required: true
            }
        },
        messages: { 
            nombreSucursal: {
                required: "Por favor, complete el campo"
            },
            cargo: {
                required: "Por favor, complete el campo"
            },
            direccionSucursal: {
                required: "Por favor, complete el campo"
            },
            telefonoSucursal: {
                required: "Por favor, complete el campo"
            }
        }
    });
});

  function validarCampos(){
    if($("#formSucursal").valid() != true){
      return false;
    }else{
      procesarSucursal();
    }
  }

   function procesarSucursal(){
        var bodyFormData = new FormData();
        bodyFormData.append('nombreSucursal',$("#nombreSucursal").val());
        bodyFormData.append('cargo',$("#cargo").val());
        bodyFormData.append('direccionSucursal',$("#direccionSucursal").val());
        bodyFormData.append('telefonoSucursal',$("#telefonoSucursal").val());
        return axios({
            method: 'post',
            url: "<?php echo base_url('')?>" + 'index.php/sucursal/saveSucursal',
            data: bodyFormData,
            headers: {'Content-Type': 'multipart/form-data' },
        }).then((result) => {
            location.href = "<?php echo base_url() ?>" + 'index.php/sucursal/index';                           
            console.log('exito');
            
        }).catch(error => {
            console.log('error');
        });
  }

  function actualizarSucursal(){
    var bodyFormData = new FormData();
    if(window.view == 'edit'){
      bodyFormData.append("idSucursal", window.idSucursal); //Se manda el id de sucursal a la vista de editar
    }
        bodyFormData.append('nombreSucursal',$("#nombreSucursal").val());
        bodyFormData.append('cargo',$("#cargo").val());
        bodyFormData.append('direccionSucursal',$("#direccionSucursal").val());
        bodyFormData.append('telefonoSucursal',$("#telefonoSucursal").val());
        return axios({
            method: 'post',
            url: "<?php echo base_url('')?>" + 'index.php/sucursal/update',
            data: bodyFormData,
            headers: {'Content-Type': 'multipart/form-data' },
        }).then((result) => {
            location.href = "<?php echo base_url() ?>" + 'index.php/sucursal/index';                           
            console.log('exito');
            
        }).catch(error => {
            console.log('error');
        });
  }
</script>