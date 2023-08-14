<!DOCTYPE html>
<html>
<head>
  <title>Nuevo Cargo</title>
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
<form id="formCargos" autocomplete="off" method="post">
  <div class="row">
    <div class="form-group col-md-4">
      <label class="label-required">Nombre Cargo:</label>
      <input type="text" class="form-control" name="nombreCargo" id="nombreCargo" placeholder="Nombre Cargo" value="<?php echo isset($cargo) ? $cargo["NOMBRE_CARGO"] : '' ?>">
    </div>
    <div class="form-group col-md-4">
      <label for="descripcionCargo">Descripcion Cargo:</label>
      <input type="text" class="form-control" name="descripcionCargo" id="descripcionCargo" placeholder="Descripcion Cargo" value="<?php echo isset($cargo) ? $cargo["DESCRIPCION_CARGO"] : '' ?>">
    </div>
  </div>
  <div class="row justify-content-center">
    <button type="button" class="btn btn-primary btn-lg mb-4 mr-4" id="procesar" onclick="validarCampos();"><i class="fa-solid fa-user"></i> Procesar</button>
    <button type="button" class="btn btn-warning btn-lg mb-4 d-none" id="modificar" onclick="actualizarCargo();"><i class="fa-solid fa-pencil"></i> Modificar</button>
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
    $("#formCargos").validate({
        rules: {
            nombreCargo: {
                required: true
            },
            descripcionCargo: {
                required: true
            }
        },
        messages: { 
            nombreCargo: {
                required: "Por favor, complete el campo"
            },
            descripcionCargo: {
                required: "Por favor, complete el campo"
            }
        }
    });
});

  function validarCampos(){
    if($("#formCargos").valid() != true){
      return false;
    }else{
      procesarCargo();
    }
  }

   function procesarCargo(){
        var bodyFormData = new FormData();
        bodyFormData.append('nombreCargo',$("#nombreCargo").val());
        bodyFormData.append('descripcionCargo',$("#descripcionCargo").val());
        return axios({
            method: 'post',
            url: "<?php echo base_url('')?>" + 'index.php/cargos/saveCargo',
            data: bodyFormData,
            headers: {'Content-Type': 'multipart/form-data' },
        }).then((result) => {
            location.href = "<?php echo base_url() ?>" + 'index.php/cargos/index';                           
            console.log('exito');
            
        }).catch(error => {
            console.log('error');
        });
  }

  function actualizarCargo(){
    var bodyFormData = new FormData();
    if(window.view == 'edit'){
      bodyFormData.append("idCargo", window.idCargo); //Se manda el id de cargo a la vista de editar
    }
        bodyFormData.append('nombreCargo',$("#nombreCargo").val());
        bodyFormData.append('descripcionCargo',$("#descripcionCargo").val());
        return axios({
            method: 'post',
            url: "<?php echo base_url('')?>" + 'index.php/cargos/update',
            data: bodyFormData,
            headers: {'Content-Type': 'multipart/form-data' },
        }).then((result) => {
            location.href = "<?php echo base_url() ?>" + 'index.php/cargos/index';                           
            console.log('exito');
            
        }).catch(error => {
            console.log('error');
        });
  }
</script>