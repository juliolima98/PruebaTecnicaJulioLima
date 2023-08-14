<?php $this->load->view("nav") ?>
<div class="card">
	<div class="card-body">
		<div align="center">
			<h3 class="text-primary mb-3">
				Formulario de Sucursales
			</h3>
		</div>							
		<?php $this->load->view('partials/form_sucursales'); ?>
	</div>
</div>
<script type="text/javascript">
	window.view = 'create';
</script>