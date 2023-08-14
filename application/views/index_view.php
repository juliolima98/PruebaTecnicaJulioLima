<!DOCTYPE html>
<html>
<head>
	<title>Pagina de inicio</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
</head>
<body>
<?php $this->load->view("nav") ?>	
	<div class="card">
		<div class="text text-center">
			<b><h1>Pagina de inicio</h1></b>
		</div>
		<div class="card-body">
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">Empleado</th>
			      <th scope="col">Telefono</th>
			      <th scope="col">Sucursal</th>
			      <th scope="col">Cargo</th>
			      <th scope="col">Estado</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach ($empleados as $empleado): ?>
				    <tr>
				      <td><?php echo $empleado['NOMBRE_EMPLEADO']." ".$empleado['APELLIDO_EMPLEADO']; ?></td>
				      <td><?php echo $empleado['TELEFONO_EMPLEADO']; ?></td>
				      <td><?php echo $empleado['NOMBRE_SUCURSAL']; ?></td>
				      <td><?php echo $empleado['NOMBRE_CARGO']; ?></td>
				      <td><?php echo $empleado['DESCRIPCION_ESTADO']; ?></td>
				    </tr>
				<?php endforeach; ?>
			  </tbody>
			</table>
		</div>

	</div> 
</body>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
</html>